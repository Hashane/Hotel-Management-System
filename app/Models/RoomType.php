<?php

namespace App\Models;

use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'image_urls' => 'array',
    ];

    public function scopeFilterBy($query, array $filters)
    {
        $namespace = 'App\\Utilities\\RoomFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'room_type_facilities');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function rateTypes(): BelongsToMany
    {
        return $this->belongsToMany(RateType::class, 'room_type_rate_types')->withPivot('price');
    }

    // New
    public function roomRates(): HasMany
    {
        return $this->hasMany(RoomRate::class);
    }

    public function losPrices(): HasMany
    {
        return $this->hasMany(LOSPrice::class);
    }

    public function restrictions(): HasMany
    {
        return $this->hasMany(RateRestriction::class);
    }
}
