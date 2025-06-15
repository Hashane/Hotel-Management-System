<?php

namespace App\Services\Admin;

use App\Models\RoomReservation;

class PaymentService
{
    public static function chargeNoShowFee(RoomReservation $roomReservation): bool
    {
        return true;
    }
}
