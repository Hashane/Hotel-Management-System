<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Room;
use App\Services\Customer\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CartController
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = $this->cart->getCart();

        $roomIds = array_unique(Arr::pluck($cartItems, 'room-id'));

        $rooms = Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();

        $items=[];

        $totalRoomCost = 0.00;
        $totalAmount = 0.00;
        $serviceCharges = 0.00;
        $tax = 0.00;
        $taxPercentage = 0;

        foreach ($cartItems as $key => $cartItem) {
            $room = $rooms->firstWhere('id', $cartItem['room-id']);

            $perNightCost = $room->default_rate->pivot->price;
            $roomCost = Helper::calculateRoomCost($perNightCost, $cartItem['check-in'], $cartItem['check-out']);
            $totalRoomCost += $roomCost;

            $items[$key] = [
                'room-cost' => $roomCost,
                'room' => $room,
                'occupants' => $cartItem['occupants'],
                'check-in' => $cartItem['check-in'],
                'check-out' => $cartItem['check-out'],
            ];
        }

        $settings = Helper::getSettings(['accommodation_tax','room_service_fee']);
        if(!empty($settings)){
            $taxPercentage = $settings['accommodation_tax'];
            $serviceCharges =  $settings['room_service_fee'];

            $tax = ($totalRoomCost * $taxPercentage)/100;
            $totalAmount = $totalRoomCost + $tax + $serviceCharges;
        }

        return view('customer.cart', compact(['items','totalRoomCost','serviceCharges', 'taxPercentage', 'tax','totalAmount']));
    }


    public function add(Room $room, Request $request)
    {
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in') ?? Carbon::now()->format('Y-m-d');
        $checkOut = $request->input('check_out') ?? Carbon::now()->addDay()->format('Y-m-d');

        $this->cart->add($room->id, $occupants, $checkIn, $checkOut);

        return redirect()->route('rooms')->with('success', 'Room added to cart!');
    }

    public function update(Room $room, Request $request)
    {
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in') ?? Carbon::now()->format('Y-m-d');
        $checkOut = $request->input('check_out') ?? Carbon::now()->addDay()->format('Y-m-d');

        $this->cart->add($room->id, $occupants, $checkIn, $checkOut);

        return redirect()->route('rooms.index')->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $this->cart->remove($id);

        return redirect()->route('cart.index')->with('success', 'Room removed from cart!');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
