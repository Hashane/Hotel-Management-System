<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    protected $guarded = [];

    public function ExtraCharges(): HasMany
    {
        return $this->hasMany(ExtraCharge::class);
    }
}
