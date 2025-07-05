<?php

namespace App\Services\Admin;

use App\Enums\ReservationStatus;
use App\Enums\RoomReservationStatus;
use App\Enums\RoomStatus;
use App\Helpers\Helper;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\RoomType;
use Carbon\Carbon;

class ReservationService
{
    public function __construct(private readonly \App\Services\Customer\ReservationService $customerReservationService) {}

    public function getReservationData($validated)
    {
        $query = RoomType::filterBy($validated);

        $canBeOccupied = false;
        if (isset($validated['occupants'])) {
            $roomsForCheck = (clone $query)->get();
            $canBeOccupied = Helper::checkIfAbleToOccupy($roomsForCheck, $validated['occupants']);
        }

        $rooms = Room::with('roomReservations', 'reservations')->get();

        return [
            'filteredRooms' => $query->paginate(10)->appends(request()->except('page')),
            'canBeOccupied' => $canBeOccupied,
            'rooms' => $rooms,
            'totalRoomsCount' => $rooms->count(),
            'availableRoomsCount' => $rooms->where('status', 1)->count(),
            'partiallyAvailableRoomsCount' => $rooms->filter(fn ($room) => $room->reservations->contains('status', ReservationStatus::PENDING->value)
            )->count(),
            'confirmedBookingsCount' => $rooms->filter(fn ($room) => $room->roomReservations->contains('status', ReservationStatus::CONFIRMED->value)
            )->count(),
            'checkedInRoomsCount' => $rooms->filter(fn ($room) => $room->roomReservations->contains('status', RoomReservationStatus::CHECKED_IN->value)
            )->count(),
            'underMaintenanceRoomsCount' => $rooms->where('status', RoomStatus::MAINTENANCE->value)->count(),
        ];
    }

    /**
     * Process Customer check-in
     */
    public function checkIn(Reservation $reservation): void
    {
        $roomReservation = RoomReservation::with('room')
            ->where('reservation_id', $reservation->id)
            ->firstOrFail();

        $roomReservation->update([
            'checked_in_at' => now(),
        ]);
    }

    public function update(array $data, Reservation $reservation): void
    {
        $this->customerReservationService->update($data, $reservation);
    }

    public function checkOut(Reservation $reservation, array $data): void
    {
        $roomReservation = RoomReservation::with('room')
            ->where('reservation_id', $reservation->id)
            ->firstOrFail();

        $checkoutDateTime = Carbon::createFromFormat('Y-m-d H:i', $data['checkout_date'].' '.$data['checkout_time']);

        $roomReservation->update([
            'check_out' => $checkoutDateTime->toDateString(),
            'checked_out_at' => $checkoutDateTime,
            'status' => RoomReservationStatus::CHECKED_OUT->value,
        ]);

        // Go through all room_reservations and check if all have been checked out
        $reservation->load('roomReservations');
        $allReservationsCheckedIn = $reservation->roomReservations->every(function ($roomReservation) {
            return $roomReservation->status === RoomReservationStatus::CHECKED_OUT->value;
        });

        if ($allReservationsCheckedIn) {
            $reservation->update([
                'status' => ReservationStatus::COMPLETED,
            ]);
        }
    }
}
