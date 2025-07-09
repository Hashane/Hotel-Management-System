<?php

namespace App\Http\Controllers\Admin;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.seasons.index', [
            'seasons' => Season::orderBy('start_date')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Season::create($data);

        return redirect()->route('admin.seasons.index')->with('success', 'Season created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Display the specified resource.
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Season $season)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $season->update($data);

        return redirect()->route('admin.seasons.index')->with('success', 'Season updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        $season->delete();

        return back()->with('success', 'Season deleted.');
    }
}
