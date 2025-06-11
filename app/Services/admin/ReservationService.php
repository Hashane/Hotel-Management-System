<?php

namespace App\Services\admin;

use App\Models\Reservation;

class ReservationService
{
    public function __construct(private readonly \App\Services\Customer\ReservationService $customerReservationService) {}

    public function update(array $data, Reservation $reservation): void
    {
        $this->customerReservationService->update($data, $reservation);
    }
}
