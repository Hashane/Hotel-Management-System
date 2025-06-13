<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case PENDING = 0;
    case CONFIRMED = 1;
    case CANCELLED = 2;
    case BOOKED = 3; // booked but not confirmed after payment
    case CHECKED_IN = 4;
    case CHECKED_OUT = 5;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::CONFIRMED => __('confirmed'),
            self::CANCELLED => __('cancelled'),
            self::BOOKED => __('booked'),
            self::CHECKED_IN => __('checked_in'),
            self::CHECKED_OUT => __('checked_out'),
        };
    }
}
