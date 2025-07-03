<?php

namespace App\Helpers;

use App\Enums\ReservationStatus;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Helper
{
    public static function calculateRoomCost($perNightRate, $checkIn, $checkOut)
    {
        $totalDays = abs(Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut)));

        return $perNightRate * $totalDays;
    }

    public static function getSettings($keys)
    {
        return Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray();
    }

    public static function checkIfAbleToOccupy(collection $roomTypes, int $occupancy): bool
    {
        $totalRoomCapacity = 0;
        foreach ($roomTypes as $roomType) {
            $totalRoomCapacity += $roomType->capacity * $roomType->available_rooms_count;
        }
        if ($totalRoomCapacity < $occupancy) {
            return false;
        }

        return true;
    }

    public static function makeReservation(Customer $customer, $totalAmount, $bookingNumber)
    {
        return Reservation::create([
            'customer_id' => $customer->id,
            'status' => ReservationStatus::PENDING->value,
            'amount' => $totalAmount,
            'booking_number' => $bookingNumber,
        ]);
    }

    public static function makeRoomReservation(Collection $rooms, Reservation $reservation, array $roomDataMap): void
    {
        foreach ($rooms as $room) {
            $reservation->roomReservations()->create([
                'room_id' => $room->id,
                'price' => $room->default_rate->pivot->price,
                'check_in' => $roomDataMap[$room->id]['check_in'],
                'check_out' => $roomDataMap[$room->id]['check_out'],
                'occupants' => $roomDataMap[$room->id]['occupants'],
                'status' => ReservationStatus::PENDING->value,
            ]);
        }
    }

    public static function generateBookingNumber(): string
    {
        $prefix = 'BK';
        $date_time = date('YmdHis');
        $random_number = mt_rand(1000, 9999);

        return $prefix.$date_time.$random_number;
    }

    public static function mapRoomToData($cartItems): array
    {
        $map = [];

        foreach ($cartItems as $item) {
            $roomId = (int) $item['room_id'];
            $map[$roomId] = [
                'check_in' => $item['check_in'],
                'check_out' => $item['check_out'],
                'occupants' => $item['occupants'],
            ];
        }

        return $map;
    }
}
