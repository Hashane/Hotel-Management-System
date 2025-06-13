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

        $this->query->whereDoesntHave('roomReservations', function ($query) use ($checkIn, $checkOut) {
            $query->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            });
        });
    }
}
