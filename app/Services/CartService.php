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

    public function add($roomId, $quantity = 1, $occupants = 1):void
    {
        $cart = $this->getCart();

        if (isset($cart[$roomId])) {
            $cart[$roomId]['quantity'] += $quantity;
            $cart[$roomId]['occupants'] = $occupants;
        } else {
            $cart[$roomId] = [
                'quantity' => $quantity,
                'occupants' => $occupants,
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update($roomId, $quantity, $occupants):void
    {
        $cart = $this->getCart();

        if (isset($cart[$roomId])) {
            if ($quantity <= 0) {
                unset($cart[$roomId]);
            } else {
                $cart[$roomId]['quantity'] = $quantity;
                $cart[$roomId]['occupants'] = $occupants;
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
