<?php

namespace App\Http\Controllers;

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
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        return view('customer.reservation', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
