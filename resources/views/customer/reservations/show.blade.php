@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')

    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <h1 class="d-inline-block">Your Hotel Reservation has been</h1>
                <h1 class="confirmation-text d-inline-block"> Confirmed</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <p class="fst-italic"> Contact FourSeasons If you Need to Change in Basic Information
                    with {{ $reservation->booking_number }} Booking Number.
                </p>
            </div>
        </div>

    </div>
    <div class="container">
        <div
            style="background-image: url('{{ asset('images/hero/hero-2.jpg') }}'); background-size: cover; background-position: center; ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="confirm-text text-white ">
                            <h1>Booking No. {{ $reservation->booking_number }} Details</h1>
                            <p>
                                Check your Information Here !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <div class="container mt-4">
        <table class="table">
            <thead class="table-secondary">
            <tr>
                <th scope="col">Check In</th>
                <th scope="col">Check Out</th>
                <th scope="col">Room No.</th>
                <th scope="col">Room Type</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservation->roomReservations as $res)
                <tr>
                    <td>{{ $res->check_in }}</td>
                    <td>{{ $res->check_out }}</td>
                    <td>{{ $res->room->room_no }}</td>
                    <td>{{ $res->room->roomType->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <div class="container">

        <div class="row">
            <div class="col-12 mb-2 ">
                <p>Cancelation Policy</p>
            </div>
        </div>

        <div class="row">
            <div class="col mb-2">
                <h2> Pay attention </h2>
            </div>
        </div>

        <div class="row">
            <div class="col mb-2">
                <p>This booking represents the conclusive step in the hotel reservation process. It is considered final
                    and may only be canceled by the hotel in the event of unforeseen circumstances or natural
                    disasters.</p>

            </div>
        </div>
    </div>

@endsection
