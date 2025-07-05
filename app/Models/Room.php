<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function withRateTypeAndFacilities($rateTypeId = null)
    {
        return static::with([
            'roomType.facilities',
            'roomType.rateTypes' => function ($query) use ($rateTypeId) {
                if ($rateTypeId) {
                    $query->where('rate_type_id', $rateTypeId);
                }
            },
        ]);
    }

    // accessor
    public function getDefaultRateAttribute()
    {
        return $this->roomType->rateTypes()->first();
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'room_reservations')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function roomReservations(): HasMany
    {
        return $this->hasMany(RoomReservation::class);
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
