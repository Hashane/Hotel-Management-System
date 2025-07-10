<?php

namespace App\Http\Controllers\Customer;

use App\Enums\RateType;
use App\Helpers\Helper;
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

        $validated['check_in'] = $validated['check_in'] ?? now()->toDateString();
        $validated['check_out'] = $validated['check_out'] ?? now()->addDay()->toDateString();

        $rateTypeId = RateType::PER_NIGHT->value;

        $startDate = Carbon::parse($validated['check_in']);
        $endDate = Carbon::parse($validated['check_out']);
        $dateCount = $startDate->diffInDays($endDate);

        if ($dateCount >= 7 && $dateCount < 14) {
            $rateTypeId = RateType::WEEKLY->value;
        } elseif ($dateCount >= 14) {
            $rateTypeId = RateType::MONTHLY->value;
        }

        $roomTypes = RoomType::filterBy($validated)->with([
            'facilities',
            'rateTypes' => function ($query) use ($rateTypeId) {
                if ($rateTypeId) {
                    $query->where('rate_type_id', $rateTypeId);
                }
            },
        ])->paginate(10)->appends(request()->except('page'));

        if (! Helper::ratesFullyDefinedForRange($rateTypeId, 1, Carbon::parse($validated['check_in']), Carbon::parse($validated['check_out']))) {

            return view('customer.rooms.index', [
                'roomTypes' => collect(),
                'message' => 'No rooms are available for the selected dates.',
            ]);

        }

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
    public function show()
    {
        return view('customer.rooms.show');
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
