<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    protected $guarded = [];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'room_type_facilities');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function rateTypes(): BelongsToMany
    {
        return $this->belongsToMany(RateType::class, 'room_type_rate_types')->withPivot('price');
    }
}
