<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RateRestriction extends Model
{
    protected $fillable = [
        'room_type_id', 'rate_plan_id', 'date',
        'min_stay', 'stop_sell', 'closed_to_arrival', 'closed_to_departure',
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function ratePlan(): BelongsTo
    {
        return $this->belongsTo(RatePlan::class);
    }
}
