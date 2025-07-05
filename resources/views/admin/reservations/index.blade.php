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
                            <th>Duration</th>
                            <th>Room</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reservations as $reservation)
                            @foreach($reservation->roomReservations as $index => $roomReservation)
                                <tr>
                                    {{-- Only show booking number and customer name in the first roomReservation row --}}
                                    @if($index === 0)
                                        <td rowspan="{{ $reservation->roomReservations->count() }}">{{ $reservation->booking_number }}</td>
                                        <td rowspan="{{ $reservation->roomReservations->count() }}">{{ $reservation->customer->name }}</td>
                                    @endif

                                    <td>{{ $roomReservation->check_in }} to {{ $roomReservation->check_out }}</td>
                                    <td>#{{ $roomReservation->room->room_no }}
                                        - {{ $roomReservation->room->roomType->name }}</td>
                                    <td>{{ $roomReservation->occupants }}</td>
                                    <td>
                    <span class="badge bg-{{ RoomReservationStatus::tryFrom($roomReservation->status)?->color() }}">
                        {{ RoomReservationStatus::tryFrom($roomReservation->status)?->label() }}
                    </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                                            @if(!$roomReservation->checked_in_at)
                                                <button type="button"
                                                        class="btn btn-sm btn-success px-3 w-50"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#checkInModal"
                                                        data-bs-reservation="{{ $reservation->id }}">
                                                    Check In
                                                </button>
                                            @elseif($roomReservation->checked_in_at && !$roomReservation->checked_out_at)
                                                <button type="button"
                                                        class="btn btn-sm btn-danger px-3 w-50"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#checkOutModal"
                                                        data-bs-reservation="{{ $reservation->id }}">
                                                    Check Out
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-sm btn-secondary px-3 w-50"
                                                        disabled>
                                                    Checked Out
                                                </button>
                                            @endif

                                            <i class="fas fa-pencil-alt text-primary fs-5" data-bs-toggle="modal"
                                               data-bs-target="#editReservationModal"
                                               style="cursor: pointer;"
                                               data-id="{{ $reservation->booking_number }}"
                                               data-roomRes="{{ $roomReservation->id }}"
                                               data-name="{{ $reservation->customer->name }}"
                                               data-checkin="{{ $roomReservation->check_in }}"
                                               data-checkout="{{ $roomReservation->check_out }}"
                                               data-roomtype="{{ $roomReservation->room->roomType->id }}"
                                               data-guests="{{ $roomReservation->occupants }}">
                                            </i>

                                            <i class="fas fa-plus text-success fs-5" data-bs-toggle="modal"
                                               data-bs-target="#addChargesModal"
                                               data-bs-reservation="{{ $reservation->id }}"
                                               style="cursor: pointer;"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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

        <!-- Check-In Confirmation Modal -->
        <div class="modal fade" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkInModalLabel">Check In Guest</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="checkInForm" method="POST" action="">
                        @csrf
                        <div class="modal-body">
                            <p>Are you sure you want to check in this guest?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm Check-In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Check-Out Confirmation Modal -->
        <div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="checkOutModalLabel">Check Out Guest</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="checkOutForm" method="POST" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="checkout_date" class="form-label">Check-Out Date</label>
                                <input type="date" class="form-control" id="checkout_date" name="checkout_date"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="checkout_time" class="form-label">Check-Out Time</label>
                                <input type="time" class="form-control" id="checkout_time" name="checkout_time"
                                       required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm Check-Out</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Edit Reservation Modal -->
        <div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editReservationModalLabel">Edit Reservation</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    @php
                        $reservation = $reservation ?? null;
                    @endphp
                    <form method="POST"
                          action="{{ $reservation ? route('admin.reservations.update', ['reservation' => $reservation]) : '#' }}"
                          id="editReservationForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="reservationId" class="form-label">Reservation No.</label>
                                    <input type="text" id="reservationNo" class="form-control" readonly>
                                    <input type="hidden" name="room_reservation_id" id="editRoomReservation" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="customerName" class="form-label">Name</label>
                                    <input type="text" name="name" id="customerName" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" name="start" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" name="end" id="endDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomType" class="form-label">Room Type</label>
                                        <x-room-category-dropdown
                                                :selected="$roomReservation->room->roomType->id ?? old('room_type_id')"
                                                name="type"
                                                class="custom-class"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="guests" class="form-label">Guests</label>
                                    <input type="number" name="guests" id="guests" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Charges Modal -->
        <div class="modal fade" id="addChargesModal" tabindex="-1" aria-labelledby="addChargesModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Additional Charges</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="addChargesForm" method="POST" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <select name="service" class="form-control">
                                            @foreach($serviceTypes as $serviceType)
                                                <option value="{{$serviceType->id}}">{{$serviceType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="form-control"
                                               placeholder="Enter amount">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Charges</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
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