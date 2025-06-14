<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;

    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Reservation::whereHas('roomReservations', function ($query) {
            $query->where('check_in', '<', $this->endDate)
                ->where('check_out', '>', $this->startDate);
        })->with('customer', 'roomReservations.room')->get();
    }

    public function headings(): array
    {
        return [
            'Booking Number',
            'Customer Name',
            'Rooms',
            'Check In',
            'Check Out',
            'Amount (LKR)',
        ];
    }

    public function map($reservation): array
    {
        $rooms = $reservation->roomReservations->map(fn ($r) => $r->room->name ?? 'N/A')->join(', ');

        return [
            $reservation->booking_number,
            $reservation->customer->name ?? 'N/A',
            $rooms,
            $reservation->roomReservations->min('check_in'),
            $reservation->roomReservations->max('check_out'),
            number_format($reservation->amount, 2),
        ];
    }
}
