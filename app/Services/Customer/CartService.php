<?php

namespace App\Services\Customer;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

    public function add($roomId, $occupants = 1,$checkIn, $checkOut):void
    {
        $cart = $this->getCart();
        $uniqueId = uniqid('cart_', true);

        if (isset($cart[$uniqueId])) {
            $cart[$uniqueId]['room-id'] = $roomId;
            $cart[$uniqueId]['occupants'] = $occupants;
            $cart[$uniqueId]['check-in'] = $checkIn;
            $cart[$uniqueId]['check-out'] = $checkOut;
        } else {
            $cart[$uniqueId] = [
                'room-id' => $roomId,
                'occupants' => $occupants,
                'check-in' => $checkIn,
                'check-out' => $checkOut,
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update($roomId, $occupants,$checkIn, $checkOut):void
    {
        $cart = $this->getCart();
        $uniqueId = uniqid('cart_', true);

        if (isset($cart[$uniqueId])) {
            $cart[$uniqueId]['room-id'] = $roomId;
            $cart[$uniqueId]['occupants'] = $occupants;
            $cart[$uniqueId]['check-in'] = $checkIn;
            $cart[$uniqueId]['check-out'] = $checkOut;
            Session::put($this->sessionKey, $cart);
        }
    }

    public function remove($id):void
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put($this->sessionKey, $cart);
        }
    }

    public function clear():void
    {
        Session::forget($this->sessionKey);
    }
}
