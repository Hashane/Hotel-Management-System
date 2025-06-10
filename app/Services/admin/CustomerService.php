<?php

namespace App\Services\admin;

use App\Enums\RoomStatus;
use App\Models\RoomReservation;

class CustomerService
{
    /**
     * Process Customer check-in
     */
    public function checkIn(array $data): void
    {
        $roomReservation = RoomReservation::with('room')
            ->where('id', $data['room_reservation_id'])
            ->firstOrFail();

        $roomReservation->update([
            'checked_in_at' => now(),
        ]);

        // Mark room as occupied
        $roomReservation->room->update([
            'status' => RoomStatus::OCCUPIED->value,
        ]);
    }
}
