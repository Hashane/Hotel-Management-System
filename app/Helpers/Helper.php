<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper{
    public static function calculateRoomCost($perNightRate,$checkIn,$checkOut)
    {
        $totalDays = abs(Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut)));
        return $perNightRate * $totalDays;
    }
}

