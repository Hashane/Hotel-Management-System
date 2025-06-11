<?php

namespace App\Services\admin;

use App\Models\RoomReservation;

class PaymentService
{
    public static function chargeNoShowFee(RoomReservation $roomReservation): bool
    {
        return false;
    }
}
