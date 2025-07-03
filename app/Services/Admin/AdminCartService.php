<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Room;
use App\Services\CartCostCalculator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AdminCartService
{
    /**
     * Process Customer check-in
     */
    public function store(array $data): void
    {
        Cart::create([
            'user_id' => Auth::user()->id,
            'room_id' => $data['room_id'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'occupants' => $data['occupants'],
        ]);
    }

    public function book(): void
    {
        Cart::query()->update(['status' => 'confirmed']);
    }

    public function assign(int $customerId): void
    {
        $cartItems = Cart::all();
        $roomIds = $cartItems->pluck('room_id')->unique();
        $rooms = Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();

        $priceBreakDown = $this->calculateCost($cartItems->toArray());

        $customer = Customer::findOrFail($customerId);
        $reservation = Helper::makeReservation($customer, $priceBreakDown['totalAmount'], Helper::generateBookingNumber());
        $roomDataMap = Helper::mapRoomToData($cartItems);
        Helper::makeRoomReservation($rooms, $reservation, $roomDataMap);

        Cart::query()->confirmed()->delete();
    }

    public function calculateCost(array $cartItems)
    {
        $roomIds = array_unique(Arr::pluck($cartItems, 'room_id'));

        $rooms = Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();

        return app(CartCostCalculator::class)->calculate($cartItems, $rooms, true);
    }

    public function destroy(Cart $cart): void
    {
        $cart->delete();
    }
}
