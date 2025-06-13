<?php

namespace App\Helpers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Helper
{
    public static function calculateRoomCost($perNightRate, $checkIn, $checkOut)
    {
        $totalDays = abs(Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut)));

        return $perNightRate * $totalDays;
    }

    public static function getSettings($keys)
    {
        return Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray();
    }

    public static function checkIfAbleToOccupy(collection $rooms, int $occupancy): bool
    {
        $totalRoomCapacity = 0;
        foreach ($rooms as $room) {
            $totalRoomCapacity += $room->roomType->capacity;
        }
        if ($totalRoomCapacity < $occupancy) {
            return false;
        }

        return true;
    }
}
