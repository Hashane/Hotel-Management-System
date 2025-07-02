<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminCartRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Services\Admin\AdminCartService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminCartController
{
    public function __construct(public AdminCartService $adminCartService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cartItems = Cart::confirmed()->get();
        $priceBreakdown = app(AdminCartService::class)->calculateCost($cartItems->toArray());
        $customers = Customer::search($request->input('search'))->paginate(10)->appends($request->except('page'));

        return view('admin.cart.index', compact('cartItems', 'priceBreakdown', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCartRequest $request)
    {
        $validated = $request->validated();

        $cartItems = Cart::all();
        if ($cartItems->contains('room_id', $validated['room_id'])) {
            return back()->with('error', 'Room is already in the cart.');
        }

        $this->adminCartService->store($validated);

        return redirect()->back()->with('success', 'Added to cart successfully.');

    }

    public function assign(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'customer_id' => ['required', Rule::exists('customers', 'id')],
            ]);
            $this->adminCartService->assign($validated['customer_id']);

            DB::commit();

            return redirect()->back()->with('success', 'Assigned rooms successfully');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }

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
        DB::beginTransaction();
        try {
            $this->adminCartService->destroy($cart);
            DB::commit();

            return redirect()->back()->with('success', 'Removed from cart successfully.');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
