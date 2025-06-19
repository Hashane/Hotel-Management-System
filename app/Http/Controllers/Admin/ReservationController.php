<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FilterReservationRequest;
use App\Http\Requests\Customer\ReservationRequest;
use App\Models\Cart;
use App\Models\ExtraCharge;
use App\Models\Reservation;
use App\Models\ServiceType;
use App\Services\Admin\AdminCartService;
use App\Services\Admin\BillingService;
use App\Services\Admin\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $query = Reservation::with(['customer', 'roomReservations', 'roomReservations.room.roomType'])
            ->when($search, fn ($query) => $query->search($search));

        $reservations = $query->paginate(10);

        $serviceTypes = ServiceType::all();

        return view('admin.reservations.index', compact('reservations', 'serviceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request) {}

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

            return redirect()->back()->with('success', 'Reservation updated!');

        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('reservations.edit', $reservation)
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation, Request $request) {}

    public function checkOut(Reservation $reservation, Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'checkout_date' => ['required', 'date', 'date_format:Y-m-d'],
                'checkout_time' => ['required', 'date_format:H:i'],
            ]);

            $this->reservationService->checkOut($reservation, $validated);

            $bill = app(BillingService::class)->createBill($reservation);
            DB::commit();

            return redirect()->route('admin.billings.show', $bill);

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Check-out failed.');
        }
    }

    public function addCharges(Reservation $reservation, Request $request)
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
    public function create(FilterReservationRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->reservationService->getReservationData($validated);
            $cartItems = Cart::unconfirmed()->get();
            $priceBreakdown = app(AdminCartService::class)->calculateCost($cartItems->toArray());

            return view('admin.reservations.create', compact('data', 'cartItems', 'priceBreakdown'));
        } catch (\Exception $exception) {
            return redirect()->route('admin.reservations.create')
                ->with('error', $exception->getMessage());
        }
    }

    public function checkIn(Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $this->reservationService->checkIn($reservation);
            DB::commit();

            return redirect()->back()->with('success', 'Guest checked in successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('success', 'Check-in failed.');
        }
    }
}
