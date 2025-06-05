<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'room_reservation')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
}
