<?php

namespace App\Services\customer;

use App\Enums\ReservationStatus;
use App\Enums\RoomStatus;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\RoomType;
use App\Services\CartCostCalculator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use RuntimeException;

class ReservationService
{
    public function __construct(private CartService $cartService) {}

    public function store(array $data, $result)
    {
        $cartItems = $this->getCartItems();
        $rooms = $this->getRoomsFromCart($cartItems);

        $customer = Customer::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['first_name'].' '.$data['last_name'],
                'phone' => $data['phone'],
            ]
        );

        $reservation = Helper::makeReservation($customer, $result['totalAmount'], Helper::generateBookingNumber());
        $roomDataMap = Helper::mapRoomToData($cartItems);
        Helper::makeRoomReservation($rooms, $reservation, $roomDataMap);

        $rooms->each->update(['status' => RoomStatus::RESERVED->value]);

        $this->cartService->clear();

        return $reservation;
    }

    private function getCartItems(): array
    {
        $cartItems = $this->cartService->getCart();
        if (empty($cartItems)) {
            throw new RuntimeException('Cart is empty');
        }

        return $cartItems;
    }

    private function getRoomsFromCart(array $cartItems): Collection
    {
        $roomIds = array_unique(Arr::pluck($cartItems, 'room_id'));

        return Room::with('roomType.facilities', 'roomType.rateTypes')
            ->whereIn('id', $roomIds)
            ->get();
    }

    public function update(array $data, Reservation $reservation)
    {
        $customer = Customer::findOrFail($reservation->customer_id);

        $customer->update([
            'name' => $data['name'],
        ]);

        $roomType = RoomType::where('id', $data['type'])->first();
        $room = Room::where('room_type_id', $roomType->id)->where('status', RoomStatus::AVAILABLE->value)->first();

        $perNightCost = $room->default_rate->pivot->price;
        $totalRoomCost = Helper::calculateRoomCost(
            $perNightCost,
            $data['start'],
            $data['end'],
        );

        $settings = Helper::getSettings(['accommodation_tax', 'room_service_fee']);

        $taxPercentage = $settings['accommodation_tax'] ?? 0;
        $serviceCharges = $settings['room_service_fee'] ?? 0;

        $tax = ($totalRoomCost * $taxPercentage) / 100;
        $totalAmount = $totalRoomCost + $tax + $serviceCharges;

        RoomReservation::where('id', $data['room_reservation_id'])->update([
            'room_id' => $room->id,
            'price' => $totalRoomCost,
            'check_in' => $data['start'],
            'check_out' => $data['end'],
            'occupants' => $data['guests'],
        ]);

        $reservation->update([
            'amount' => $totalAmount,
            'status' => ReservationStatus::CONFIRMED->value,
        ]);
    }

    public function prepareReservation(): array
    {
        $cartItems = $this->getCartItems();
        $rooms = $this->getRoomsFromCart($cartItems);

        return app(CartCostCalculator::class)->calculate($cartItems, $rooms, false);
    }

    public function destroy($data, Reservation $reservation): void
    {
        $roomReservation = RoomReservation::findOrFail($data['room_reservation_id']);
        $roomReservation->room->status = ReservationStatus::CANCELLED->value;
        $roomReservation->delete();

        if ($reservation->roomReservations()->count() === 0) {
            $reservation->delete();
        }
    }
}
