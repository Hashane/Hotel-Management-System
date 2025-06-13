<?php

namespace App\Services\admin;

use App\Models\AdminCart;
use Illuminate\Support\Facades\Auth;

class AdminCartService
{
    /**
     * Process Customer check-in
     */
    public function store(array $data): void
    {
        AdminCart::create([
            'user_id' => Auth::user()->id,
            'room_id' => $data['room_id'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'occupants_count' => $data['occupants'],
        ]);
    }
}
