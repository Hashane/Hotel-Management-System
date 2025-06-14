<?php

namespace App\Services;

use App\Helpers\Helper;

class CartCostCalculator
{
    public function calculate(array $cartItems, $rooms, bool $withItems = false, float $discount = 0.00, float $lateCheckoutFee = 0.00): array
    {
        $totalRoomCost = 0.00;
        $items = [];

        foreach ($cartItems as $key => $cartItem) {
            $room = $rooms->firstWhere('id', $cartItem['room_id']);

            $perNightCost = $room->default_rate->pivot->price;
            $roomCost = Helper::calculateRoomCost(
                $perNightCost,
                $cartItem['check_in'],
                $cartItem['check_out']
            );

            $totalRoomCost += $roomCost;

            if ($withItems) {
                $items[$key] = [
                    'room_cost' => $roomCost,
                    'room' => $room,
                    'occupants' => $cartItem['occupants'],
                    'check_in' => $cartItem['check_in'],
                    'check_out' => $cartItem['check_out'],
                ];
            }
        }

        $settings = Helper::getSettings(['accommodation_tax', 'room_service_fee']);

        $taxPercentage = $settings['accommodation_tax'] ?? 0;
        $serviceCharges = $settings['room_service_fee'] ?? 0;

        $tax = ($totalRoomCost * $taxPercentage) / 100;

        $totalAmount = $totalRoomCost + $tax + $serviceCharges + $lateCheckoutFee - $discount;

        return [
            'totalRoomCost' => $totalRoomCost,
            'serviceCharges' => $serviceCharges,
            'tax' => $tax,
            'taxPercentage' => $taxPercentage,
            'lateCheckoutFee' => $lateCheckoutFee,
            'discount' => $discount,
            'totalAmount' => max($totalAmount, 0), // Prevent negative total
            'items' => $items,
        ];
    }
}
