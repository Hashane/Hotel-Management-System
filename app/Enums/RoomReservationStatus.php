<?php

namespace App\Enums;

enum RoomReservationStatus: int
{
    case BOOKED = 1;
    case CHECKED_IN = 2;
    case CHECKED_OUT = 3;
    case CANCELLED = 4;
    case NO_SHOW = 5;
    case REFUNDED = 6; // Not in use ATM

    public function label(): string
    {
        return match ($this) {
            self::BOOKED => __('booked'),
            self::CHECKED_IN => __('checked_in'),
            self::CHECKED_OUT => __('checked_out'),
            self::CANCELLED => __('cancelled'),
            self::NO_SHOW => __('no_show'),
            self::REFUNDED => __('refunded'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::BOOKED => __('Room booked and awaiting check-in'),
            self::CHECKED_IN => __('Guest has checked into the room'),
            self::CHECKED_OUT => __('Guest has checked out'),
            self::CANCELLED => __('This room booking was canceled'),
            self::NO_SHOW => __('Room was never occupied (guest didn’t show)'),
            self::REFUNDED => __('Refund issued for this room (partial or full)'),
        };
    }

    public function color(): ?string
    {
        return match ($this) {
            self::BOOKED => 'primary',
            self::CHECKED_IN => 'info',
            self::CHECKED_OUT => 'success',
            self::CANCELLED => 'danger',
            self::NO_SHOW => 'secondary',
            self::REFUNDED => 'dark',
        };
    }
}
