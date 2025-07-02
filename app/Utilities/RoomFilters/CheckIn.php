<?php

namespace App\Utilities\RoomFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;
use Carbon\Carbon;

class CheckIn extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $checkIn = Carbon::parse($value);
        $checkOut = request('check_out') ? Carbon::parse(request('check_out')) : null;

        if (! $checkOut) {
            return;
        }

        // Filter to only RoomTypes with at least one available room
        $this->query->whereHas('rooms', function ($roomQuery) use ($checkIn, $checkOut) {
            $roomQuery->whereDoesntHave('roomReservations', function ($resQuery) use ($checkIn, $checkOut) {
                $resQuery->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                });
            });
        });

        // Count the available rooms
        $this->query->withCount(['rooms as available_rooms_count' => function ($roomQuery) use ($checkIn, $checkOut) {
            $roomQuery->whereDoesntHave('roomReservations', function ($resQuery) use ($checkIn, $checkOut) {
                $resQuery->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                });
            });
        }]);

        // Eager-load only available rooms (in order to show them in  blade)
        $this->query->with(['rooms' => function ($roomQuery) use ($checkIn, $checkOut) {
            $roomQuery->whereDoesntHave('roomReservations', function ($resQuery) use ($checkIn, $checkOut) {
                $resQuery->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                });
            });
        }]);
    }
}
