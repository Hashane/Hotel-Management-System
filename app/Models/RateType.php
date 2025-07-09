<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RateType extends Model
{
    protected $guarded = [];

    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class, 'room_type_rate_types')->withPivot('price');
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }
}
