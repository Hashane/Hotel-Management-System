<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case PENDING = 1; //  booked but not confirmed after payment
    case CONFIRMED = 2;
    case CANCELLED = 3;
    case CHECKED_IN = 4;
    case CHECKED_OUT = 5;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::CONFIRMED => __('confirmed'),
            self::CANCELLED => __('cancelled'),
            self::CHECKED_IN => __('checked_in'),
            self::CHECKED_OUT => __('checked_out'),
        };
    }
}
