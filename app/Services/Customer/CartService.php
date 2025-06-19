<?php

namespace App\Services\Customer;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function add($roomId, $occupants, $checkIn, $checkOut): void
    {
        try {
            $cart = $this->getCart();
            $uniqueId = uniqid('cart_', true);

            $cart[$uniqueId] = [
                'room_id' => $roomId,
                'occupants' => $occupants,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ];

            Session::put($this->sessionKey, $cart);
            Session::save(); // Explicitly save the session

            Log::debug('Cart after add:', ['cart' => $cart, 'session' => session()->all()]);
        } catch (Exception $e) {
            Log::error('Cart add error:', ['error' => $e->getMessage()]);
            throw $e;
        }
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
