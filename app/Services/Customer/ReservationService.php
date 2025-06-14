<?php

namespace App\Services\Customer;

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
                'phone' => $data['email'],
            ]
        );

        $reservation = Reservation::create([
            'customer_id' => $customer->id,
            'status' => ReservationStatus::BOOKED->value,
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
                'status' => ReservationStatus::BOOKED->value,
            ]);
        }

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

    private function generateBookingNumber(): string
    {
        $prefix = 'BK';
        $date_time = date('YmdHis');
        $random_number = mt_rand(1000, 9999);

        return $prefix.$date_time.$random_number;
    }

    private function mapRoomToData(): array
    {
        $cartItems = $this->getCartItems();

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
