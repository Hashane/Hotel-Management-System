<?php

namespace App\Helpers;

use App\Models\Setting;
use Carbon\Carbon;

class Helper{
    public static function calculateRoomCost($perNightRate,$checkIn,$checkOut)
    {
        $totalDays = abs(Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut)));
        return $perNightRate * $totalDays;
    }

    public static function getSettings($keys){
        return Setting::whereIn('key', $keys)->pluck('value','key')->toArray();
    }
}

