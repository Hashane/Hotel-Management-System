<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtraCharge extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_extra_charges')
            ->withTimestamps();
    }

    public function ServiceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
}
