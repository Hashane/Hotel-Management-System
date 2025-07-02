<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\Reservation;
use App\Services\Admin\BillingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController
{
    public function __construct(public BillingService $billingService) {}

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
    public function show(Bill $bill)
    {
        $reservation = Reservation::with(['extraCharges.serviceType', 'roomReservations', 'roomReservations.room', 'customer'])->firstWhere('id', $bill->reservation_id);

        return view('admin.billing.show', compact('reservation', 'bill'));
    }

    public function pay(Bill $bill, Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'payment_method' => ['required', 'in:cash,card,online'],
            ]);

            $bill->load([
                'reservation.customer',
                'reservation.extraCharges.serviceType',
                'reservation.roomReservations.room',
            ]);

            DB::commit();

            $this->billingService->pay($bill, $validated);

            return redirect()->route('admin.reservations.index')->with('success', 'Payment Completed');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
