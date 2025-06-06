<?php

namespace App\Utilities\RoomFilters;
use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class RateType extends QueryFilter implements FilterContract
{
    public function handle($value ='asc'): void
    {
        $this->query
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->join('room_type_rate_types', 'room_types.id', '=', 'room_type_rate_types.room_type_id')
            ->where('room_type_rate_types.rate_type_id', $value)
            ->select('rooms.*');
     }
}
