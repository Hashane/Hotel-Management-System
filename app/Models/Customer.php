<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeSearch($query, $search)
    {
        $term = strtolower($search);
        $like = "%$term%";

        return $query->where(function ($q) use ($like, $term) {
            $q->whereRaw('LOWER(name) LIKE ?', [$like])
                ->orWhere('email', $term)
                ->when(is_numeric($term), function ($q) use ($term) {
                    $q->orWhere('id', $term);
                });
        });

    }
}
