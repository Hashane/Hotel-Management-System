<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use App\Services\admin\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function __construct(public CustomerService $customerService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    public function checkOut(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'customer_id' => ['required', Rule::exists('customers', 'id')],
                'room_reservation_id' => ['required', Rule::exists('room_reservations', 'id')],
            ]);

            $this->customerService->checkOut($validated);
            DB::commit();

            return redirect()->back()->with('success', 'Guest checked out successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Check-out failed.');
        }
    }

    public function checkIn(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'customer_id' => ['required', Rule::exists('customers', 'id')],
                'room_reservation_id' => ['required', Rule::exists('room_reservations', 'id')],
            ]);

            $this->customerService->checkIn($validated);
            DB::commit();

            return redirect()->back()->with('success', 'Guest checked in successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Check-in failed.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
