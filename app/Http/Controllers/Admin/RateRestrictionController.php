<?php

namespace App\Http\Controllers\Admin;

use App\Models\RateRestriction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RateRestrictionController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = Carbon::parse($request->input('start_date', now()->toDateString()));
        $end = Carbon::parse($request->input('end_date', now()->addDays(2)->toDateString()));

        $roomTypeId = $request->input('room_type') ?? 1;
        $ratePlanId = $request->input('rate_plan_id') ?? 1;

        $period = CarbonPeriod::create($start, $end->copy()->subDay()); // exclude checkout day

        $restrictions = RateRestriction::with(['roomType', 'ratePlan'])->where('room_type_id', $roomTypeId)
            ->where('rate_plan_id', $ratePlanId)
            ->get()
            ->keyBy('date');

        return view('admin.rate_restrictions.index', compact('period', 'restrictions', 'start', 'end'));

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
    public function show(RateRestriction $rateRestriction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RateRestriction $rateRestriction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RateRestriction $rateRestriction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RateRestriction $rateRestriction)
    {
        //
    }
}
