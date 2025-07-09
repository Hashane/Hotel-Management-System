<?php

namespace App\Http\Controllers\Admin;

use App\Models\RatePlan;
use App\Models\RoomRate;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RateCalendarController
{
    public function index(Request $request)
    {
        $roomTypes = RoomType::all();
        $ratePlans = RatePlan::all();

        $selectedRoom = $request->get('room_type_id');
        $selectedRate = $request->get('rate_plan_id');
        $start = Carbon::parse($request->get('start_date', now()->startOfMonth()));
        $end = Carbon::parse($request->get('end_date', now()->endOfMonth()));

        $rates = collect();

        if ($selectedRoom && $selectedRate) {
            $rates = RoomRate::where('room_type_id', $selectedRoom)
                ->where('rate_plan_id', $selectedRate)
                ->whereBetween('date', [$start, $end])
                ->get()
                ->keyBy(fn ($r) => $r->date);
        }

        return view('admin.rate_calendar.index', compact(
            'roomTypes', 'ratePlans', 'rates', 'selectedRoom', 'selectedRate', 'start', 'end'
        ));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'rate_plan_id' => 'required|exists:rate_plans,id',
            'rates' => 'required|array',
            'rates.*.date' => 'required|date',
            'rates.*.price' => 'required|numeric|min:0',
        ]);

        foreach ($data['rates'] as $rate) {
            RoomRate::updateOrCreate(
                [
                    'room_type_id' => $data['room_type_id'],
                    'rate_plan_id' => $data['rate_plan_id'],
                    'date' => $rate['date'],
                ],
                ['price' => $rate['price']]
            );
        }

        return back()->with('success', 'Rates updated successfully.');
    }
}
