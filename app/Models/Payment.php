<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
