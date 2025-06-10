<?php

namespace App\Services\Customer;

use App\Enums\ReservationStatus;
use App\Enums\RoomStatus;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    public function __construct(private CartService $cartService)
    {
    }
    public function store(array $data, $result)
    {
        DB::beginTransaction();

        $cartItems = $this->getCartItems();
        $rooms = $this->getRoomsFromCart($cartItems);

        $customer = Customer::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'phone' => $data['email'],
            ]
        );

        $reservation = Reservation::create([
            'customer_id' => $customer->id,
            'status' => ReservationStatus::CONFIRMED->value,
            'amount' => $result['totalAmount'],
            'booking_number' => $this->generateBookingNumber(),
        ]);

        $roomDataMap = $this->mapRoomToData();

        foreach ($rooms as $room) {
            $reservation->roomReservations()->create([
                'room_id' => $room->id,
                'price' => $room->default_rate->pivot->price,
                'check_in' => $roomDataMap[$room->id]['check_in'],
                'check_out' => $roomDataMap[$room->id]['check_out'],
                'occupants' => $roomDataMap[$room->id]['occupants'],
            ]);
        }

        $rooms->each->update(['status' => RoomStatus::RESERVED->value]);

        $this->cartService->clear();

        DB::commit();

        return $reservation;
    }

    public function prepareReservation(): array
    {
        $cartItems = $this->getCartItems();
        $rooms = $this->getRoomsFromCart($cartItems);
        return $this->cartService->calculateCosts($cartItems, $rooms, false);
    }

    private function getCartItems():array{
        $cartItems = $this->cartService->getCart();
        if (empty($cartItems)) {
            throw new \RuntimeException('Cart is empty');
        }
        return $cartItems;
    }

    private function getRoomsFromCart(array $cartItems): Collection
    {
        $roomIds = array_unique(Arr::pluck($cartItems, 'room-id'));
        return Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();
    }

    private function generateBookingNumber(): string
    {
        $prefix = "BK";
        $date_time = date('YmdHis');
        $random_number = mt_rand(1000, 9999);
        $booking_number = $prefix . $date_time . $random_number;

        return $booking_number;
    }

    private function mapRoomToData(): array
    {
        $cartItems = $this->getCartItems();

        $map = [];

        foreach ($cartItems as $item) {
            $roomId = (int) $item['room-id'];
            $map[$roomId] = [
                'check_in' => $item['check-in'],
                'check_out' => $item['check-out'],
                'occupants' => $item['occupants'],
            ];
        }

        return $map;
    }

}
