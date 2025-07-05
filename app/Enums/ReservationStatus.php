<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case IN_PROGRESS = 3;
    case COMPLETED = 4;
    case CANCELLED = 5;
    case NO_SHOW = 6;
    case REFUNDED = 7;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::CONFIRMED => __('confirmed'),
            self::IN_PROGRESS => __('in_progress'),
            self::COMPLETED => __('completed'),
            self::CANCELLED => __('cancelled'),
            self::NO_SHOW => __('no_show'),
            self::REFUNDED => __('refunded'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::PENDING => __('Reservation created but not confirmed (e.g., awaiting payment)'),
            self::CONFIRMED => __('Fully confirmed reservation'),
            self::IN_PROGRESS => __('One or more rooms have been checked in'),
            self::COMPLETED => __('All rooms checked out, reservation fulfilled'),
            self::CANCELLED => __('Entire reservation canceled before check-in'),
            self::NO_SHOW => __('Guest never showed up (booking expired)'),
            self::REFUNDED => __('Entire reservation canceled and refunded'),
        };
    }

    public function color(): ?string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::CONFIRMED => 'primary',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
            self::NO_SHOW => 'secondary',
            self::REFUNDED => 'dark',
        };
    }
}
