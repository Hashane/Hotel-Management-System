<?php

namespace App\Models;

use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $guarded = [];

    public function scopeFilterBy($query, array $filters)
    {
        $namespace = 'App\\Utilities\\RoomFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

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
