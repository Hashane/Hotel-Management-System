<?php

namespace App\Http\Controllers;

use App\Enums\RateType;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkIn = request('check_in');
        $checkOut = request('check_out');

        $rateTypeId = RateType::PER_NIGHT->value;

        if ($checkIn && $checkOut) {
            $startDate = Carbon::parse($checkIn);
            $endDate = Carbon::parse($checkOut);
            $dateCount = $startDate->diffInDays($endDate);

            if ($dateCount >= 7 && $dateCount < 14) {
                $rateTypeId = RateType::WEEKLY->value;
            } elseif ($dateCount >= 14) {
                $rateTypeId = RateType::MONTHLY->value;
            }
        }

        $rooms = Room::withRateTypeAndFacilities($rateTypeId)->filterBy(request()->all())->paginate(10)->appends(request()->except('page')); // dd($rooms->roomType->rateTypes->first()->pivot->price);

        return view('customer.rooms.index', compact('rooms'));
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
    public function show(Room $room)
    {
        return view('customer.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
