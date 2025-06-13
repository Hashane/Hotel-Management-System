<?php

namespace App\Services\admin;

use App\Enums\ReservationStatus;
use App\Enums\RoomStatus;
use App\Helpers\Helper;
use App\Models\Reservation;
use App\Models\Room;

class ReservationService
{
    public function __construct(private readonly \App\Services\Customer\ReservationService $customerReservationService) {}

    public function update(array $data, Reservation $reservation): void
    {
        $this->customerReservationService->update($data, $reservation);
    }

    public function getReservationData(array $validated)
    {
        $query = Room::filterBy($validated)->with('roomType');

        $canBeOccupied = false;
        if (isset($validated['occupants_count'])) {
            $roomsForCheck = (clone $query)->get();
            $canBeOccupied = Helper::checkIfAbleToOccupy($roomsForCheck, $validated['occupants_count']);
        }

        $rooms = Room::with('roomReservations')->get();

        return [
            'filteredRooms' => $query->paginate(10)->appends(request()->except('page')),
            'canBeOccupied' => $canBeOccupied,
            'rooms' => $rooms,
            'totalRoomsCount' => $rooms->count(),
            'availableRoomsCount' => $rooms->where('status', 1)->count(),
            'partiallyAvailableRoomsCount' => $rooms->filter(fn ($room) => $room->roomReservations->contains('status', ReservationStatus::BOOKED->value)
            )->count(),
            'confirmedBookingsCount' => $rooms->filter(fn ($room) => $room->roomReservations->contains('status', ReservationStatus::CONFIRMED->value)
            )->count(),
            'checkedInRoomsCount' => $rooms->filter(fn ($room) => $room->roomReservations->contains('status', ReservationStatus::CHECKED_IN->value)
            )->count(),
            'underMaintenanceRoomsCount' => $rooms->where('status', RoomStatus::MAINTENANCE->value)->count(),
        ];
    }
}
