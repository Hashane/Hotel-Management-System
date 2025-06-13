<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\AdminCartRequest;
use App\Models\AdminCart;

class AdminCartController
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
    public function store(AdminCartRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(AdminCart $adminCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminCart $adminCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCartRequest $AdminCartRequest, AdminCart $adminCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminCart $adminCart)
    {
        //
    }
}
