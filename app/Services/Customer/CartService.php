<?php

namespace App\Services\Customer;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function calculateCosts(array $cartItems, $rooms, bool $withItems = false): array
    {
        $totalRoomCost = 0.00;
        $items = [];

        foreach ($cartItems as $key => $cartItem) {
            $room = $rooms->firstWhere('id', $cartItem['room-id']);

            $perNightCost = $room->default_rate->pivot->price;
            $roomCost = Helper::calculateRoomCost(
                $perNightCost,
                $cartItem['check-in'],
                $cartItem['check-out']
            );

            $totalRoomCost += $roomCost;

            if ($withItems) {
                $items[$key] = [
                    'room-cost' => $roomCost,
                    'room' => $room,
                    'occupants' => $cartItem['occupants'],
                    'check-in' => $cartItem['check-in'],
                    'check-out' => $cartItem['check-out'],
                ];
            }
        }

        $settings = Helper::getSettings(['accommodation_tax', 'room_service_fee']);

        $taxPercentage = $settings['accommodation_tax'] ?? 0;
        $serviceCharges = $settings['room_service_fee'] ?? 0;

        $tax = ($totalRoomCost * $taxPercentage) / 100;
        $totalAmount = $totalRoomCost + $tax + $serviceCharges;

        return [
            'totalRoomCost' => $totalRoomCost,
            'serviceCharges' => $serviceCharges,
            'tax' => $tax,
            'taxPercentage' => $taxPercentage,
            'totalAmount' => $totalAmount,
            'items' => $items,
        ];
    }

    public function add($roomId, $occupants, $checkIn, $checkOut): void
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

    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

    public function update($roomId, $occupants, $checkIn, $checkOut): void
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
