<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Services\Admin\RateEngineService;
use Carbon\Carbon;

class ReservationCostService
{
    public function calculateReservationTotal(array $reservationItems, $rooms, bool $withItems = false, float $discount = 0.00, float $lateCheckoutFee = 0.00): array
    {
        $totalRoomCost = 0.00;
        $items = [];

        foreach ($reservationItems as $key => $reservationItem) {
            $room = $rooms->firstWhere('id', $reservationItem['room_id']);
            $roomTotal = RateEngineService::for($room->room_type_id, 1, Carbon::parse($reservationItem['check_in']), Carbon::parse($reservationItem['check_out']))->total();

            //            $perNightCost = $room->default_rate->pivot->price;
            //            $roomCost = Helper::calculateRoomCost(
            //                $perNightCost,
            //                $reservationItem['check_in'],
            //                $reservationItem['check_out']
            //            );

            // $totalRoomCost += $roomCost;
            $totalRoomCost += $roomTotal;

            if ($withItems) {
                $items[$key] = [
                    'room_cost' => $roomTotal,
                    'room' => $room,
                    'occupants' => $reservationItem['occupants'],
                    'check_in' => $reservationItem['check_in'],
                    'check_out' => $reservationItem['check_out'],
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
