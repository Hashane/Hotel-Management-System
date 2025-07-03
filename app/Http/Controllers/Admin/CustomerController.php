<?php

namespace App\Http\Controllers\Admin;

use App\Facades\JitTransaction;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;
use App\Services\Admin\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(public CustomerService $customerService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CustomerRequest $request)
    {
        $validated = $request->validated();
        $response = JitTransaction::run(function () use ($validated) {
            $this->customerService->store($validated);
        });

        if (! $response['success']) {
            return back()->withErrors($response['message']);
        }

        return redirect()->route('admin.carts.index')->with('success', $response['message']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
