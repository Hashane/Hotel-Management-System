<?php

namespace App\Services\admin;

use App\Helpers\Helper;
use App\Models\Bill;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Services\CartCostCalculator;
use Carbon\Carbon;

class BillingService
{
    public function createBill(Reservation $reservation)
    {
        $settings = Helper::getSettings(['default_checkout_time']);
        $defaultCheckoutTime = $settings['default_checkout_time'] ?? '12:00';

        $roomReservations = RoomReservation::where('reservation_id', $reservation->id)->get();

        $data = [];
        $lateCheckoutFee = 0.0;
        $roomIds = [];

        foreach ($roomReservations as $key => $roomReservation) {
            $defaultCheckoutDateTime = Carbon::createFromFormat('Y-m-d H:i', $roomReservation->check_out.' '.$defaultCheckoutTime);

            $actualCheckout = Carbon::parse($roomReservation->checked_out_at);

            $adjustedCheckout = $roomReservation->check_out; // default if not late

            if ($actualCheckout > $defaultCheckoutDateTime) {
                // Add 1 night to adjusted checkout
                $adjustedCheckout = Carbon::parse($roomReservation->check_out)->addDay()->format('Y-m-d');

                // Calculate 1-night late fee
                $perNightCost = $roomReservation->room->default_rate->pivot->price ?? 0;
                $lateCheckoutFee += $perNightCost;
            }

            $data[] = [
                'room_id' => $roomReservation->room_id,
                'check_in' => $roomReservation->check_in,
                'check_out' => $roomReservation->check_out,
                'occupants' => $roomReservation->occupants,
            ];

            $roomIds[] = $roomReservation->room_id;
        }
        $rooms = Room::whereIn('id', $roomIds)->get();

        $result = app(CartCostCalculator::class)->calculate($data, $rooms, true, 0, $lateCheckoutFee);
        $result['reservation_id'] = $reservation->id;

        return $this->saveBill($result);
    }

    private function saveBill(array $data)
    {
        return Bill::create([
            'totalRoomCost' => $data['totalRoomCost'],
            'reservation_id' => $data['reservation_id'],
            'serviceCharges' => $data['serviceCharges'],
            'subtotal' => $data['totalRoomCost'],
            'discount' => $data['discount'],
            'tax' => $data['tax'],
            'lateCheckoutFee' => $data['lateCheckoutFee'],
            'total' => $data['totalAmount'],
        ]);
    }
}
