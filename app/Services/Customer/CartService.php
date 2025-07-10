<?php

namespace App\Services\Customer;

use App\Models\Room;
use App\Models\RoomType;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function add(RoomType $roomType, $occupants, $checkIn, $checkOut): void
    {
        $cart = $this->getCart();
        $uniqueId = uniqid('cart_', true);

        $existingRoomIdsInCart = collect($cart ?? [])
            ->pluck('room_id')
            ->unique()
            ->toArray();

        $room = Room::where('room_type_id', $roomType->id)
            ->whereDoesntHave('roomReservations', function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            })
            ->whereNotIn('id', $existingRoomIdsInCart) // avoid already assigned rooms
            ->inRandomOrder()
            ->first('id');

        if (empty($room)) {
            throw new Exception('This room is already in your cart for the selected dates. Please choose a different room or adjust your stay period.');
        }
        $cart[$uniqueId] = [
            'room_id' => $room['id'],
            'occupants' => $occupants,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
        ];

        Session::put($this->sessionKey, $cart);
        Session::save(); // Explicitly save the session

        Log::debug('Cart after add:', ['cart' => $cart, 'session' => session()->all()]);

    }

    public function getCart(): array
    {
        try {
            $cart = Session::get($this->sessionKey, []);
            Log::debug('Cart retrieved:', ['cart' => $cart]);

            return $cart;
        } catch (Exception $e) {
            Log::error('Cart get error:', ['error' => $e->getMessage()]);

            return [];
        }
    }

    public function update($roomId, $occupants, $checkIn, $checkOut): void
    {
        $cart = $this->getCart();
        $uniqueId = uniqid('cart_', true);

        if (isset($cart[$uniqueId])) {
            $cart[$uniqueId]['room_id'] = $roomId;
            $cart[$uniqueId]['occupants'] = $occupants;
            $cart[$uniqueId]['check_in'] = $checkIn;
            $cart[$uniqueId]['check_out'] = $checkOut;
            Session::put($this->sessionKey, $cart);
        }
    }

    public function remove($id): void
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put($this->sessionKey, $cart);
        }
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }
}
