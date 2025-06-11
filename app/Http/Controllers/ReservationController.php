<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ReservationRequest;
use App\Jobs\SendReservationConfirmationEmail;
use App\Models\Reservation;
use App\Services\Customer\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Mockery\Exception;

class ReservationController
{
    public function __construct(public ReservationService $reservationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
        ]);

        $search = $request->input('search');
        $query = Reservation::with(['customer', 'roomReservations', 'roomReservations.room.roomType'])->where('booking_number', "$search");

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
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $result = $this->reservationService->prepareReservation();
            $reservation = $this->reservationService->store($validated, $result);

            $reservation = $reservation->load(['customer', 'roomReservations', 'roomReservations.room']);
            SendReservationConfirmationEmail::dispatch($reservation);

            DB::commit();

            return redirect()->route('reservations.show', $reservation)
                ->with('success', 'Reservation confirmed!');

        } catch (\Exception $exception) {
            DB::rollBack();

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
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $this->reservationService->update($validated, $reservation);

            DB::commit();

            return redirect()->back()->with('success', 'Reservation updated');

        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('reservations.edit', $reservation)
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation, Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'room_reservation_id' => ['required', 'string', Rule::exists('room_reservations', 'id')],
            ]);

            $this->reservationService->destroy($validated, $reservation);

            DB::commit();

            return redirect()->back()->with('success', 'Reservation deleted!');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Deletion failed');
        }
    }
}
