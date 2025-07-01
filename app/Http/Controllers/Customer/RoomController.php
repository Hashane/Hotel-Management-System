<?php

namespace App\Http\Controllers\Customer;

use App\Enums\RateType;
use App\Http\Requests\Customer\RoomRequest;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomRequest $request)
    {
        $validated = $request->validated();

        $checkIn = $validated['check_in'] ?? now()->toDateString();
        $checkOut = $validated['check_out'] ?? now()->addDay()->toDateString();

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

        $roomTypes = RoomType::withCount(['rooms as roomCount'])
            ->filterBy($validated)->with([
                'facilities',
                'rateTypes' => function ($query) use ($rateTypeId) {
                    if ($rateTypeId) {
                        $query->where('rate_type_id', $rateTypeId);
                    }
                },
            ])->paginate(10)->appends(request()->except('page'));

        return view('customer.rooms.index', compact('roomTypes'));
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
