<?php

namespace App\Services\admin;

use App\Enums\RoomStatus;
use App\Models\Reservation;
use App\Models\RoomReservation;
use Carbon\Carbon;

class CustomerService
{
    /**
     * Process Customer check-in
     */
    public function checkIn(Reservation $reservation): void
    {
        $roomReservation = RoomReservation::with('room')
            ->where('id', $reservation->id)
            ->firstOrFail();

        $roomReservation->update([
            'checked_in_at' => now(),
        ]);

        // Mark room as occupied
        $roomReservation->room->update([
            'status' => RoomStatus::OCCUPIED->value,
        ]);
    }

    public function checkOut(Reservation $reservation, array $data): void
    {
        $roomReservation = RoomReservation::with('room')
            ->where('id', $reservation->id)
            ->firstOrFail();

        $checkoutDateTime = Carbon::createFromFormat('Y-m-d H:i', $data['checkout_date'].' '.$data['checkout_time']);

        $roomReservation->update([
            'check_out' => $checkoutDateTime->toDateString(),
            'checked_out_at' => $checkoutDateTime,
        ]);

        $roomReservation->room->update([
            'status' => RoomStatus::AVAILABLE->value,
        ]);
    }
}
