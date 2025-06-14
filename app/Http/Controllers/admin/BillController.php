<?php

namespace App\Http\Controllers\admin;

use App\Models\Bill;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BillController
{
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
