<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date'];

    public function rates(): HasMany
    {
        return $this->hasMany(SeasonRoomRate::class);
    }
}
