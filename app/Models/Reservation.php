<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_reservation')
            ->withPivot('price')
            ->withTimestamps();
    }
}
