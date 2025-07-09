<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Used for derived rates
 * (eg: "Non-Refundable” is -10% of “Standard Rate
 */
class RatePlan extends Model
{
    protected $fillable = [
        'name', 'code', 'parent_id', 'adjustment_type', 'adjustment_value',
    ];

    public function parent()
    {
        return $this->belongsTo(RatePlan::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(RatePlan::class, 'parent_id');
    }
}
