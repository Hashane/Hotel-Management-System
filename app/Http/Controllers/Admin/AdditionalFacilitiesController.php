<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAdditionalFacilitiesRequest;
use App\Http\Requests\UpdateAdditionalFacilitiesRequest;
use App\Models\AdditionalFacility;

class AdditionalFacilitiesController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.additionalFacilities.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.additionalFacilities.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdditionalFacilitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdditionalFacility $additionalFacilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalFacility $additionalFacilities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdditionalFacilitiesRequest $request, AdditionalFacility $additionalFacilities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalFacility $additionalFacilities)
    {
        //
    }
}
