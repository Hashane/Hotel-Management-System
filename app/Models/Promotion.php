<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'start_date',
        'end_date',
        'rate_plan_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_percent' => 'float',
    ];

    public function ratePlan(): BelongsTo
    {
        return $this->belongsTo(RatePlan::class);
    }

    public function isValid(?Carbon $onDate = null): bool
    {
        $date = $onDate ?? now();

        return $this->start_date <= $date && $this->end_date >= $date;
    }
}
