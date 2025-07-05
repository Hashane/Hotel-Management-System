<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roomTypes = RoomType::with(['rateTypes'])
            ->withCount(['rooms as roomCount'])
            ->paginate(10)
            ->appends($request->except('page'));

        return view('admin.rooms.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
              return view('admin.rooms.create');

    }

    public function services()
    {
              return view('admin.rooms.services');

    }


public function facilities()
    {
              return view('admin.rooms.facilities');

    }

    public function extra_facilities()
    {
              return view('admin.rooms.extra_facilities');

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
        //
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
