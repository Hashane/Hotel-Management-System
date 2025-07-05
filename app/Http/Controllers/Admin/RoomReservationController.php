<?php

namespace App\Http\Controllers\Admin;

use App\Facades\JitTransaction;
use App\Models\ExtraCharge;
use App\Models\Reservation;
use App\Models\RoomReservation;
use App\Models\ServiceType;
use App\Services\Admin\BillingService;
use App\Services\Admin\RoomReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RoomReservationController
{
    public function __construct(public RoomReservationService $roomReservationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
        ]);

        $search = $request->input('search');
        $query = Reservation::with(['customer', 'roomReservations', 'roomReservations.room.roomType'])
            ->when($search, fn ($query) => $query->search($search));

        $reservations = $query->paginate(10);

        $serviceTypes = ServiceType::all();

        return view('admin.reservations.check-ins', compact('reservations', 'serviceTypes'));
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
    public function show(RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomReservation $roomReservation)
    {
        //
    }

    public function checkIn(RoomReservation $roomReservation)
    {
        $response = JitTransaction::run(function () use ($roomReservation) {
            $this->roomReservationService->checkIn($roomReservation);
        });

        if (! $response['success']) {
            return redirect()->back()->with('success', 'Check-in failed.');
        }

        return redirect()->back()->with('success', 'Guest checked in successfully.');
    }

    public function checkOut(RoomReservation $roomReservation, Request $request)
    {
        $validated = $request->validate([
            'checkout_date' => ['required', 'date', 'date_format:Y-m-d'],
            'checkout_time' => ['required', 'date_format:H:i'],
        ]);

        $response = JitTransaction::run(function () use ($validated, $roomReservation) {
            $reservation = $this->roomReservationService->checkOut($roomReservation, $validated);

            return app(BillingService::class)->createBill($reservation); // Todo test
        });

        if ($response['success']) {
            $bill = $response['data'];

            return redirect()->route('admin.billings.show', $bill);
        } else {
            return redirect()->back()->with('success', 'Check-out failed.');
        }
    }

    public function addCharges(RoomReservation $reservation, Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'service' => ['required', 'string'],
                'amount' => ['required', 'numeric', 'min:1'],
            ]);

            $extraCharge = ExtraCharge::create([
                'service_type_id' => $validated['service'],
                'amount' => $validated['amount'],
            ]);

            // Attach to reservation
            $reservation->extraCharges()->attach($extraCharge->id);

            DB::commit();

            return redirect()->back()->with('success', 'Charges added successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Charges adding failed.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
