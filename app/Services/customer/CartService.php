<?php

namespace App\Services\customer;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function add($roomId, $occupants, $checkIn, $checkOut): void
    {
        $cart = $this->getCart();
        $uniqueId = uniqid('cart_', true);

        if (isset($cart[$uniqueId])) {
            $cart[$uniqueId]['room_id'] = $roomId;
            $cart[$uniqueId]['occupants'] = $occupants;
            $cart[$uniqueId]['check_in'] = $checkIn;
            $cart[$uniqueId]['check_out'] = $checkOut;
        } else {
            $cart[$uniqueId] = [
                'room_id' => $roomId,
                'occupants' => $occupants,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function getCart()
    {
        return Session::get($this->sessionKey, []);
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
