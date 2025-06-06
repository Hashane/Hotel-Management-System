<?php

namespace App\Utilities\RoomFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class RoomType extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->where('room_types.id', $value)
            ->select('rooms.*');
    }
}
