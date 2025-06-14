<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraCharge extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_extra_charges')
            ->withTimestamps();
    }
}
