<?php

namespace App\Enums;

enum RateType: int
{
    case PER_NIGHT = 1;
    case WEEKLY = 2;
    case MONTHLY = 3;

    public function label(): string
    {
        return match ($this) {
            self::PER_NIGHT => __('per_night'),
            self::WEEKLY => __('weekly'),
            self::MONTHLY => __('monthly'),
        };
    }
}
