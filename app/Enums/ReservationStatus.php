<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case CONFIRMED = 1;
    case PENDING = 2;
    case CANCELLED = 3;

    public function label(): string
    {
        return match ($this) {
            self::CONFIRMED => __('confirmed'),
            self::PENDING => __('pending'),
            self::CANCELLED => __('cancelled'),
        };
    }
}
