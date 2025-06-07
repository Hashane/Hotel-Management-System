<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

    public function add($roomId, $quantity = 1, $occupants = 1,$checkIn, $checkOut):void
    {
        $cart = $this->getCart();

        if (isset($cart[$roomId])) {
            $cart[$roomId]['quantity'] += $quantity;
            $cart[$roomId]['occupants'] = $occupants;
            $cart[$roomId]['check-in'] = $checkIn;
            $cart[$roomId]['check-out'] = $checkOut;
        } else {
            $cart[$roomId] = [
                'quantity' => $quantity,
                'occupants' => $occupants,
                'check-in' => $checkIn,
                'check-out' => $checkOut,
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update($roomId, $quantity, $occupants,$checkIn, $checkOut):void
    {
        $cart = $this->getCart();

        if (isset($cart[$roomId])) {
            if ($quantity <= 0) {
                unset($cart[$roomId]);
            } else {
                $cart[$roomId]['quantity'] = $quantity;
                $cart[$roomId]['occupants'] = $occupants;
                $cart[$roomId]['check-in'] = $checkIn;
                $cart[$roomId]['check-out'] = $checkOut;
            }
            Session::put($this->sessionKey, $cart);
        }
    }

    public function remove($roomId):void
    {
        $cart = $this->getCart();
        if (isset($cart[$roomId])) {
            unset($cart[$roomId]);
            Session::put($this->sessionKey, $cart);
        }
    }

    public function clear():void
    {
        Session::forget($this->sessionKey);
    }
}
