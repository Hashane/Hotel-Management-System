<?php

namespace App\Utilities\RoomFilters;
use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class Price extends QueryFilter implements FilterContract
{
    public function handle($value ='asc'): void
    {
        $direction = strtolower($value) === 'desc' ? 'desc' : 'asc';

        $this->query
            ->join('room_types as rt', 'rooms.room_type_id', '=', 'rt.id')
            ->join('room_type_rate_types as rtrt', 'rt.id', '=', 'rtrt.room_type_id')
            ->orderBy('rtrt.price', $direction)
            ->select('rooms.*');
    }
}
