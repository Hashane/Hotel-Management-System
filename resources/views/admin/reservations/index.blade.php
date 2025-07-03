@php use App\Enums\RoomCategory; @endphp

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

<div class="card shadow-sm mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Reservations List</h5>
    </div>

    <div class="card-header d-flex justify-content vertical-align-items-center">
        <div class="container" style="max-width: 100%">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3" style="text-align: right;">
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
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
        <table id="reservations" class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Room</th>
                    <th>Guests</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->booking_number }}</td>
                    <td>{{ $reservation->customer->name }}</td>
                    @foreach($reservation->roomReservations as $index => $roomReservation)
                    @if($index === 1)
                <tr></tr>
                <td>{{ $reservation->booking_number }}</td>
                <td>{{ $reservation->customer->name }}</td>
                @endif
                <td>{{ $roomReservation->check_in }} to {{ $roomReservation->check_out }}</td>
                <td>#{{$roomReservation->room->room_no}}
                    - {{ $roomReservation->room->roomType->name }}</td>
                <td>{{ $roomReservation->occupants }}</td>
                <td>
                    @php
                    $status = $reservation->status;

                    $statusLabels = [
                    1 => ['label' => 'Confirmed', 'class' => 'primary'],
                    2 => ['label' => 'Cancelled', 'class' => 'danger'],
                    3 => ['label' => 'Pending Payment', 'class' => 'warning'],
                    4 => ['label' => 'Checked In', 'class' => 'success'],
                    5 => ['label' => 'Checked Out', 'class' => 'secondary'],
                    ];
                    @endphp

                    <span class="badge bg-{{ $statusLabels[$status]['class'] }}">
                        {{ $statusLabels[$status]['label'] }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                        @if(!$roomReservation->checked_in_at)
                        <!-- Not checked in yet -->
                        <button type="button" class="btn btn-sm btn-success px-3 w-100" style="max-width: 160px;"
                            data-bs-toggle="modal" data-bs-target="#checkInModal"
                            data-bs-reservation="{{ $reservation->id }}">
                            <i class="fas fa-door-open me-1"></i> Check In
                        </button>

                        @elseif($roomReservation->checked_in_at && !$roomReservation->checked_out_at)
                        <!-- Checked in but not yet checked out -->
                        <button type="button" class="btn btn-sm btn-danger px-3 w-100" style="max-width: 160px;"
                            data-bs-toggle="modal" data-bs-target="#checkOutModal"
                            data-bs-reservation="{{ $reservation->id }}">
                            <i class="fas fa-door-closed me-1"></i> Check Out
                        </button>

                        @else
                        <!-- Already checked out -->
                        <button type="button" class="btn btn-sm btn-secondary px-3 w-100" style="max-width: 160px;"
                            disabled>
                            <i class="fas fa-door-closed me-1"></i> Checked Out
                        </button>
                        @endif

                        <i class="fas fa-pencil-alt text-primary fs-5" data-bs-toggle="modal"
                            data-bs-target="#editReservationModal" style="cursor: pointer;"
                            data-id="{{ $reservation->booking_number }}" data-roomRes="{{ $roomReservation->id }}"
                            data-name="{{ $reservation->customer->name }}"
                            data-checkin="{{ $roomReservation->check_in }}"
                            data-checkout="{{ $roomReservation->check_out }}"
                            data-roomtype="{{ $roomReservation->room->roomType->id}}"
                            data-guests="{{ $roomReservation->occupants }}">
                        </i>
                        <i class="fas fa-plus text-success fs-5" data-bs-toggle="modal"
                            data-bs-target="#addChargesModal" data-bs-reservation="{{ $reservation->id }}"
                            style="cursor: pointer;"></i>
                    </div>
                </td>
                @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




{{-- {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
            // Check-In Modal
            const checkInModal = document.getElementById('checkInModal');
            if (checkInModal) {
                checkInModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('checkInForm');
                    const checkInBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${checkInBaseUrl}/${reservationId}/check-in`;
                });
            }

            // Check-Out Modal
            const checkOutModal = document.getElementById('checkOutModal');
            if (checkOutModal) {
                checkOutModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('checkOutForm');
                    const checkOutBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${checkOutBaseUrl}/${reservationId}/check-out`;
                });
            }

            // Add Charges Modal
            const addChargesModal = document.getElementById('addChargesModal');
            if (addChargesModal) {
                addChargesModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('addChargesForm');
                    const reservationExtraChargesBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${reservationExtraChargesBaseUrl}/${reservationId}/add-charges`;
                });
            }

            // Edit Reservation Modal
            const editModal = document.getElementById('editReservationModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    // Set all form values
                    document.getElementById('reservationNo').value = button.getAttribute('data-id');
                    document.getElementById('editRoomReservation').value = button.getAttribute('data-roomRes');
                    document.getElementById('customerName').value = button.getAttribute('data-name');
                    document.getElementById('startDate').value = button.getAttribute('data-checkin');
                    document.getElementById('endDate').value = button.getAttribute('data-checkout');
                    document.getElementById('guests').value = button.getAttribute('data-guests');

                    // Special handling for room type dropdown
                    const roomTypeValue = button.getAttribute('data-roomtype');
                    const roomTypeSelect = document.querySelector('select[name="type"]');
                    if (roomTypeSelect) {
                        roomTypeSelect.value = roomTypeValue;
                    }
                });
            }
        });
</script>
@endpush