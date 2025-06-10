<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ReservationRequest;
use App\Models\Reservation;
use App\Services\Customer\CartService;
use App\Services\Customer\ReservationService;
use Illuminate\Http\Request;

class ReservationController
{
    public function __construct(public ReservationService $reservationService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
        ]);

        $query = Reservation::with(['customer', 'roomReservations','roomReservations.room.roomType']);

        if ($search = $request->input('search')) {
            $query->where('booking_number', "$search");
        }

        $reservation = $query->first();

        return view('customer.reservations.index', compact('reservation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $result = $this->reservationService->prepareReservation();
            return view('customer.reservations.create', $result);
        } catch (\Exception $exception) {
            return redirect()->route('cart.index')
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        try {
            $validated = $request->validated();
            $result = $this->reservationService->prepareReservation();
            $reservation = $this->reservationService->store($validated, $result);
            $reservation = $reservation->load('roomReservations');

            return redirect()->route('reservations.show',$reservation)
                ->with('success', 'Reservation confirmed!');

        } catch (\Exception $exception) {
            return redirect()->route('reservations.create')
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('customer.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
