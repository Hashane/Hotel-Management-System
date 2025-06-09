<?php

namespace App\Http\Controllers;

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
        foreach ($cartItems as $key => $cartItem) {
            $room = $rooms->firstWhere('id', $cartItem['room-id']);
            $items[$key] = [
                'room' => $room,
                'occupants' => $cartItem['occupants'],
                'check-in' => $cartItem['check-in'],
                'check-out' => $cartItem['check-out'],
            ];
        }

        return view('customer.cart', compact('items'));
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

        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
