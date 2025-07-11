<?php

namespace App\Http\Controllers\Customer;

use App\Models\Room;
use App\Models\RoomType;
use App\Services\Customer\CartService;
use App\Services\ReservationCostService;
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

        $roomIds = array_unique(Arr::pluck($cartItems, 'room_id'));

        $rooms = Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();

        $result = app(ReservationCostService::class)->calculateReservationTotal($cartItems, $rooms, true);

        return view('customer.cart', $result);
    }

    public function update(Room $room, Request $request)
    {
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in') ?? Carbon::now()->format('Y-m-d');
        $checkOut = $request->input('check_out') ?? Carbon::now()->addDay()->format('Y-m-d');

        $this->cart->add($room->id, $occupants, $checkIn, $checkOut);

        return redirect()->route('rooms.index')->with('success', 'Cart updated!');
    }

    public function add(RoomType $roomType, Request $request)
    {
        $occupants = $request->input('occupants', 1);
        $checkIn = $request->input('check_in') ?? Carbon::now()->format('Y-m-d');
        $checkOut = $request->input('check_out') ?? Carbon::now()->addDay()->format('Y-m-d');

        $this->cart->add($roomType, $occupants, $checkIn, $checkOut);

        return redirect()->back()->withInput()->with('success', 'Room added to cart!');

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
