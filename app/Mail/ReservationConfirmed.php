<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public Reservation $reservation;

    public Collection $roomReservations;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->roomReservations = $this->reservation->roomReservations;
    }

    public function build()
    {
        return $this->subject('Your Hotel Reservation Has Been Confirmed')
            ->markdown('emails.reservations.confirmed');
    }
}
