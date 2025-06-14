<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use App\Models\Reservation;
use App\Services\admin\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkOut(Reservation $reservation, Request $request)
    {
        DB::beginTransaction();
        try {

            $validated = $request->validate([
                'checkout_date' => ['required', 'date', 'date_format:Y-m-d'],
                'checkout_time' => ['required', 'date_format:H:i'],
            ]);

            $this->customerService->checkOut($reservation, $validated);
            DB::commit();

            return redirect()->back()->with('success', 'Guest checked out successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Check-out failed.');
        }
    }

    public function checkIn(Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $this->customerService->checkIn($reservation);
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
