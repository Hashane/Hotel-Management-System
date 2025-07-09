<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomType;
use App\Models\Season;
use App\Models\SeasonRoomRate;
use Illuminate\Http\Request;

class SeasonRoomRateController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.season_room_rates.index', [
            'seasons' => Season::orderBy('start_date')->get(),
            'roomTypes' => RoomType::get(),
        ]);
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
    public function show(SeasonRoomRate $seasonRoomRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeasonRoomRate $seasonRoomRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeasonRoomRate $seasonRoomRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeasonRoomRate $seasonRoomRate)
    {
        //
    }
}
