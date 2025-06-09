<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ReservationRequest;
use App\Models\Reservation;
use App\Services\Customer\CartService;
use Illuminate\Http\Request;

class ReservationController
{
    public function __construct(public CartService $cartService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        return view('customer.reservations.create', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();
        $cart = $this->cartService->getCart();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('customer.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
