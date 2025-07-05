<?php

namespace App\Services\Admin;

use App\Enums\ReservationStatus;
use App\Enums\RoomReservationStatus;
use App\Models\Reservation;
use App\Models\RoomReservation;
use Carbon\Carbon;

class RoomReservationService
{
    /**
     * Process Customer check-in
     */
    public function checkIn(RoomReservation $roomReservation): void
    {
        $roomReservation->load('reservation');

        $roomReservation->reservation->update([
            'status' => ReservationStatus::IN_PROGRESS->value,
        ]);

        $roomReservation->update([
            'checked_in_at' => now(),
        ]);
    }

    public function checkOut(RoomReservation $roomReservation, array $data): Reservation
    {
        $checkoutDateTime = Carbon::createFromFormat('Y-m-d H:i', $data['checkout_date'].' '.$data['checkout_time']);

        $roomReservation->update([
            'check_out' => $checkoutDateTime->toDateString(),
            'checked_out_at' => $checkoutDateTime,
            'status' => RoomReservationStatus::CHECKED_OUT->value,
        ]);

        // Go through all room_reservations and check if all have been checked out
        $reservation = $roomReservation->reservation()->with('roomReservations')->first();

        $allReservationsCheckedIn = $reservation->roomReservations->every(function ($roomReservation) {
            return $roomReservation->status === RoomReservationStatus::CHECKED_OUT->value;
        });

        if ($allReservationsCheckedIn) {
            $reservation->update([
                'status' => ReservationStatus::COMPLETED,
            ]);
        }

        return $reservation;
    }
}
