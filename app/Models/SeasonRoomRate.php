<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeasonRoomRate extends Model
{
    protected $fillable = ['season_id', 'room_type_id', 'rate_plan_id', 'price'];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
