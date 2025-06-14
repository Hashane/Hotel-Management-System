@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
    <h1>Billing</h1>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Reservations</li>
    </ol>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <div class="container my-4">
            <!-- Guest & Reservation Details -->
            <div class="card mb-4 w-100">
                <div class="card-header">
                    <h5 class="mb-0">Guest & Reservation Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p><strong>Name:</strong> {{ $reservation->customer->name }}</p>
                        <p><strong>Email:</strong> {{ $reservation->customer->email }}</p>
                        <p><strong>Phone:</strong> {{ $reservation->customer->phone }}</p>
                    </div>

                    @foreach($reservation->roomReservations as $roomReservation)
                        <div class="border rounded p-3 mb-2">
                            <p><strong>Room ID:</strong> {{ $roomReservation->room->room_no }}</p>
                            <p><strong>Check-In:</strong> {{ $roomReservation->check_in }}</p>
                            <p><strong>Check-Out:</strong> {{ $roomReservation->check_out }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Charges Summary -->
            <div class="card mb-4 w-100">
                <div class="card-header">
                    <h5 class="mb-0">Charges Summary</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.bill-details')
                    <form method="POST" action="{{ route('admin.billings.pay',['bill'=> $bill->id]) }}">
                        @csrf
                        <div class="row mt-4 align-items-end">
                            <div class="col-md-4">
                                <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="">Select</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                            <div class="col-md-8 text-end">
                                <button type="submit" class="btn btn-success px-5">Make Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


