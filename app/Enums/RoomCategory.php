<?php

namespace App\Enums;

enum RoomCategory: int
{
    case STANDARD = 1;
    case DELUXE = 2;
    case SUITE = 3;

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => __('standard'),
            self::DELUXE => __('deluxe'),
            self::SUITE => __('suite'),
        };
    }
}
