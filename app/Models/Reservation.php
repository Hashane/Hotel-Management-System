<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function scopeSearch($query, $search)
    {
        $term = strtolower($search);
        $like = "%$term%";

        return $query->where(function ($query) use ($like, $term) {
            $query->whereHas('customer', function ($q) use ($like) {
                $q->whereRaw('LOWER(name) LIKE ?', [$like]);
            })->where('booking_number', "$term");

            //            if (is_numeric($term)) {
            //                $query->orWhere('id', $term); // exact ID match if numeric
            //            }
        });

    }

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

    public function roomReservations()
    {
        return $this->hasMany(RoomReservation::class);
    }

    public function extraCharges()
    {
        return $this->belongsToMany(ExtraCharge::class, 'reservation_extra_charges')
            ->withTimestamps();
    }
}
