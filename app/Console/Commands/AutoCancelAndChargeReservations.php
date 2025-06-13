<?php

namespace App\Console\Commands;

use App\Enums\ReservationStatus;
use App\Models\RoomReservation;
use App\Services\admin\PaymentService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoCancelAndChargeReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:auto-cancel-and-charge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel no show reservations and charge customers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        RoomReservation::whereDate('check_in', $today)
            ->whereNull('checked_in_at')
            ->where('status', ReservationStatus::PENDING->value)
            ->whereHas('reservation', fn ($q) => $q->where('status', ReservationStatus::BOOKED->value))
            ->get()
            ->each(function ($roomReservation) {

                $roomReservation->status = ReservationStatus::CANCELLED->value;
                $roomReservation->save();

                Log::info("Room {$roomReservation->room_id} in Reedservation {$roomReservation->reservation_id} cancelled due to no-show.");

                $reservation = $roomReservation->reservation()->with('roomReservations')->first();

                if ($reservation->roomReservations->every(fn ($room) => $room->status === ReservationStatus::CANCELLED->value)) {
                    $reservation->status = ReservationStatus::CANCELLED->value;
                    $reservation->save();

                    $result = PaymentService::chargeNoShowFee($roomReservation);
                    if ($result) {
                        $roomReservation->no_show_fee_charged = 1;
                        $roomReservation->save();
                    }

                    Log::info("All rooms in Reservation {$reservation->id} are cancelled. Marked reservation as cancelled.");
                }
            });

        return Command::SUCCESS;
    }
}
