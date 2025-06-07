<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\CartService;
use Illuminate\Http\Request;
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

        // Retrieve full room info for each item in the cart
        $rooms = Room::with('roomType.facilities',
            'roomType.rateTypes')->whereIn('id', array_keys($cartItems))->get();

        $items = $rooms->map(function($room) use ($cartItems) {
            return [
                'room' => $room,
                'quantity' => $cartItems[$room->id]['quantity'],
                'occupants' => $cartItems[$room->id]['occupants'],
                'check-in' => $cartItems[$room->id]['check-in'],
                'check-out' => $cartItems[$room->id]['check-out'],
            ];
        });

        return view('customer.cart', compact('items'));
    }


    public function add(Room $room, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in', Carbon::now()->format('Y-m-d'));
        $checkOut = $request->input('check_out', Carbon::now()->addDay()->format('Y-m-d'));

        $this->cart->add($room->id, $quantity, $occupants,$checkIn,$checkOut);

        return redirect()->route('rooms')->with('success', 'Room added to cart!');
    }

    public function update(Room $room, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in', Carbon::now()->format('Y-m-d'));
        $checkOut = $request->input('check_out', Carbon::now()->addDay()->format('Y-m-d'));

        $this->cart->add($room->id, $quantity, $occupants,$checkIn,$checkOut);

        return redirect()->route('rooms.index')->with('success', 'Cart updated!');
    }

    public function remove(Room $room)
    {
        $this->cart->remove($room->id);

        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
