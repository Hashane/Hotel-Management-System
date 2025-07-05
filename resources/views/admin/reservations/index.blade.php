@php use App\Enums\ReservationStatus;use App\Enums\RoomCategory;use App\Enums\RoomReservationStatus; @endphp

@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Reservations</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{-- route('admin.reservations.index') --}}">Home</a></li>
            <li class="breadcrumb-item active">Reservations</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content vertical-align-items-center">
                    <div class="container" style="max-width: 100%">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Reservations List</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3" style="text-align: right;">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <input class="form-control" type="search" placeholder="Search"
                                               aria-label="Search">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-success w-100" type="submit">Search</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="reservations" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->booking_number }}</td>
                                <td>{{ $reservation->customer->name }}</td>
                                <td>
                                    <span class="badge bg-{{ ReservationStatus::tryFrom($reservation->status)?->color() }}">
                                        @php
                                            $status= str_replace("_", " ", ReservationStatus::tryFrom($reservation->status)?->label());
                                            $status = ucwords($status);
                                        @endphp
                                        {{ $status }}
                                    </span>
                                </td>
                                <td>{{ $reservation->amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No Reservations at the moment.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>

    {{--    {{ $reservations->links() }} --}}
@endsection
@push('scripts')
@endpush