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

        $checkIns = [];
        $checkOuts = [];

        $cartItems = $this->getCartItems();
        $rooms = $this->getRoomsFromCart($cartItems);

        foreach ($cartItems as $cartItem) {
            $checkIns [] = $cartItem['check-in'];
            $checkOuts [] = $cartItem['check-out'];
        }

        $customer = Customer::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'phone' => $data['email'],
            ]
        );

        $reservation = Reservation::create([
            'customer_id' => $customer->id,
            'check_in' => min($checkIns),
            'check_out' => max($checkOuts),
            'status' => ReservationStatus::CONFIRMED->value,
            'amount' => $result['totalAmount'],
        ]);

        foreach ($rooms as $room) {
            $reservation->roomReservations()->create([
                'room_id' => $room->id,
                'price' => $room->default_rate->pivot->price,
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
}
