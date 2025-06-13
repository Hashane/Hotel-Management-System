@php use Carbon\Carbon; @endphp
@component('mail::message')
# Reservation Confirmed

Dear {{ $reservation->customer->name }},

We’re happy to confirm your reservation at **FourSeasons Hotel**.
Your booking number is: **{{ $reservation->booking_number }}**

Here are the details of your stay:

@foreach ($roomReservations as $roomReservation)
@component('mail::panel')
**Room:** {{ $roomReservation->room->name }}
<br>
**Type:** {{ $roomReservation->room->roomType->name }}
<br>
**Check-In:** {{ Carbon::parse($roomReservation->check_in)->format('l, F j, Y') }}
<br>
**Check-Out:** {{ Carbon::parse($roomReservation->check_out)->format('l, F j, Y') }}
<br>
**Guests:** {{ $roomReservation->occupants }}

@endcomponent
@endforeach

@if(count($roomReservations) > 1)
    Total rooms: {{ count($roomReservations) }}
@endif

### Additional Information
- Check-in time: 3:00 PM
- Early check-in subject to availability

If you need to make changes, please contact us:

**Email:** [support@fourseasons.com](mailto:support@fourseasons.com)
**Phone:** +94 (77) 123-4567

@component('mail::button', ['url' => url('/reservations?search=' . $reservation->booking_number)])
    View Reservation
@endcomponent

Thank you for choosing FourSeasons. We look forward to welcoming you.

Best regards,
**FourSeasons Hotel Team**
@endcomponent
