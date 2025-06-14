<?php

namespace App\Services\admin;

use App\Enums\RoomStatus;
use App\Models\Cart;
use App\Models\Room;
use App\Services\CartCostCalculator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AdminCartService
{
    /**
     * Process Customer check-in
     */
    public function store(array $data): void
    {
        Cart::create([
            'user_id' => Auth::user()->id,
            'room_id' => $data['room_id'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'occupants' => $data['occupants'],
        ]);
    }

    public function calculateCost()
    {
        $cartItems = Cart::all()->toArray();

        $roomIds = array_unique(Arr::pluck($cartItems, 'room_id'));

        $rooms = Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();

        return app(CartCostCalculator::class)->calculate($cartItems, $rooms, true);
    }

    public function book(): void
    {
        $cartItems = Cart::all();
        $roomIds = $cartItems->pluck('room_id')->unique();

        Room::whereIn('id', $roomIds)
            ->update(['status' => RoomStatus::RESERVED->value]);

        Cart::query()->update(['status' => 'confirmed']);
    }
}
