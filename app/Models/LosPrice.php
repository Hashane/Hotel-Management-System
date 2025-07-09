<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LosPrice extends Model
{
    protected $fillable = ['room_type_id', 'rate_plan_id', 'length_of_stay', 'price'];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
}
