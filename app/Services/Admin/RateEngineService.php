<?php

namespace App\Services\Admin;

use App\Models\LosPrice;
use App\Models\Promotion;
use App\Models\RatePlan;
use App\Models\RoomRate;
use App\Models\Season;
use App\Models\SeasonRoomRate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class RateEngineService
{
    protected ?string $promoCode = null;

    public function __construct(
        protected int $roomTypeId,
        protected int $ratePlanId,
        protected Carbon $checkIn,
        protected Carbon $checkOut
    ) {}

    public static function for(int $roomTypeId, int $ratePlanId, Carbon $checkIn, Carbon $checkOut): self
    {
        return new self($roomTypeId, $ratePlanId, $checkIn, $checkOut);
    }

    public function withPromoCode(?string $code): self
    {
        $this->promoCode = $code;

        return $this;
    }

    public function total(): float
    {
        $nights = $this->checkIn->diffInDays($this->checkOut);

        // 1. LOS specific pricing
        $los = LOSPrice::where('room_type_id', $this->roomTypeId)
            ->where('rate_plan_id', $this->ratePlanId)
            ->where('length_of_stay', $nights)
            ->first();
        if ($los) {
            return $this->applyPromotion($los->price);
        }

        // 2. Daily pricing with season or base fallback
        $period = CarbonPeriod::create($this->checkIn, $this->checkOut->copy()->subDay());
        $total = 0;

        foreach ($period as $date) {
            $total += $this->getRateForDate($date);
        }

        return $this->applyPromotion($total);
    }

    protected function applyPromotion(float $amount): float
    {
        if (! $this->promoCode) {
            return $amount;
        }

        $promo = Promotion::where('code', $this->promoCode)
            ->where('rate_plan_id', $this->ratePlanId)
            ->first();

        if ($promo && $promo->isValid()) {
            return round($amount * (1 - ($promo->discount_percent / 100)), 2);
        }

        return $amount;
    }

    protected function getRateForDate(Carbon $date): float
    {
        // A. Seasonal override
        $season = Season::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->first();

        if ($season) {
            $seasonRate = SeasonRoomRate::where('season_id', $season->id)
                ->where('room_type_id', $this->roomTypeId)
                ->where('rate_plan_id', $this->ratePlanId)
                ->first();

            if ($seasonRate) {
                return (float) $seasonRate->price;
            }
        }

        // B. Derived rate
        $ratePlan = RatePlan::find($this->ratePlanId);
        if ($ratePlan?->parent_id) {
            $baseRate = RoomRate::where('room_type_id', $this->roomTypeId)
                ->where('rate_plan_id', $ratePlan->parent_id)
                ->whereDate('date', $date)
                ->value('price');

            if ($baseRate !== null) {
                return $this->applyDerivedAdjustment($baseRate, $ratePlan);
            }
        }

        // C. Default daily rate
        return (float) RoomRate::where('room_type_id', $this->roomTypeId)
            ->where('rate_plan_id', $this->ratePlanId)
            ->whereDate('date', $date)
            ->value('price') ?? 0;
    }

    protected function applyDerivedAdjustment(float $baseRate, RatePlan $plan): float
    {
        return match ($plan->adjustment_type) {
            'percent' => $baseRate * (1 - ($plan->adjustment_value / 100)),
            'fixed' => $baseRate - $plan->adjustment_value,
            default => $baseRate,
        };
    }
}
