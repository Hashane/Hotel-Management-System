@php use Carbon\Carbon; @endphp
@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Reports</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section>
        <form method="GET" action="{{ url()->current() }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="start_date">Start Date</label>
                    <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            class="form-control"
                            value="{{ old('start_date', isset($startDate) ? Carbon::parse($startDate)->format('Y-m-d') : '') }}"
                    >
                </div>
                <div class="col-md-4">
                    <label for="end_date">End Date</label>
                    <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            class="form-control"
                            value="{{ old('end_date', isset($endDate) ? Carbon::parse($endDate)->format('Y-m-d') : '') }}"
                    >
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Generate Stats</button>
                </div>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Revenue</h6>
                        <h4 class="text-success">LKR {{ number_format($revenue ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Bookings</h6>
                        <h4 class="text-primary">{{ $bookedRoomsCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Occupancy Rate</h6>
                        <h4 class="text-warning">{{ isset($occupancyPercent) ? number_format($occupancyPercent, 2) : 0 }}
                            %</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Avg Revenue/Room</h6>
                        <h4 class="text-info">
                            LKR
                            {{
                                $totalRooms && $totalRooms > 0
                                    ? number_format(($revenue ?? 0) / $totalRooms, 2)
                                    : '0.00'
                            }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Report Results</h3>

                <form method="GET" action="{{ url()->current() }}" class="d-flex w-50">
                    <input
                            class="form-control me-2"
                            type="search"
                            name="search"
                            placeholder="Search Reports"
                            aria-label="Search"
                            value="{{ request('search') }}"
                    >
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            <div class="card-body p-0">
                <table id="reportTable" class="table table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Rooms</th>
                        <th>Booked</th>
                        <th>Occupancy (%)</th>
                        <th>Revenue (LKR)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ isset($startDate) ? Carbon::parse($startDate)->format('d M Y') : '-' }}</td>
                        <td>{{ $totalRooms ?? 0 }}</td>
                        <td>{{ $bookedRoomsCount ?? 0 }}</td>
                        <td>{{ isset($occupancyPercent) ? number_format($occupancyPercent, 2) : '0.00' }}%</td>
                        <td>{{ isset($revenue) ? number_format($revenue, 2) : '0.00' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3>Reservations from {{ $startDate }} to {{ $endDate }}</h3>
            </div>
            <div class="card-body table-responsive">
                @if($reservations->isEmpty())
                    <p>No reservations found in this period.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Customer Name</th>
                            <th>Room(s)</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total Amount (LKR)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->booking_number }}</td>
                                <td>{{ $reservation->customer->name ?? 'N/A' }}</td>
                                <td>
                                    @foreach($reservation->roomReservations as $roomRes)
                                        {{ $roomRes->room->name ?? 'N/A' }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $reservation->roomReservations->min('check_in') }}
                                </td>
                                <td>
                                    {{ $reservation->roomReservations->max('check_out') }}
                                </td>
                                <td>{{ number_format($reservation->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <a href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
           class="btn btn-outline-success me-2">
            Export to Excel
        </a>

    </section>
@endsection
