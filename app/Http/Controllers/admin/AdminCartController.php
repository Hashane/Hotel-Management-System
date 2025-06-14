<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\AdminCartRequest;
use App\Models\Cart;
use App\Services\admin\AdminCartService;

class AdminCartController
{
    public function __construct(public AdminCartService $adminCartService) {}

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCartRequest $request)
    {
        $validated = $request->validated();
        $this->adminCartService->store($validated);

        return redirect()->back()->with('success', 'Added to cart successfully.');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function book()
    {
        $this->adminCartService->book();

        return redirect()->back()->with('success', 'Booked rooms successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $adminCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $adminCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCartRequest $AdminCartRequest, Cart $adminCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Removed from cart successfully.');
    }
}
