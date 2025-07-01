<?php

namespace App\Utilities\RoomFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class RoomType extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value === 'any') {
            return;
        }

        $this->query->where('room_category_id', $value);
    }
}
