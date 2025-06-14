@php use App\Enums\RoomType; @endphp

@extends('admin.layouts.app')

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
                            <th>Room Type</th>
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
                                <td>{{ $roomReservation->room->roomType->name }}</td>
                                <td>{{ $roomReservation->occupants }}</td>
                                <td> @if($roomReservation->checked_in_at)
                                        <i class="fas fa-check-circle text-success" title="Checked In"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger" title="Not Checked In"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                                        <button type="button"
                                                class="btn btn-sm btn-warning px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#checkInModal"
                                                data-bs-customer="{{ $reservation->customer->id }}"
                                                data-bs-roomreservation="{{ $roomReservation->id }}">
                                            <i class="fas fa-sign-in-alt me-1"></i> Check In
                                        </button>
                                        <i class="fas fa-pencil-alt text-primary fs-5" data-bs-toggle="modal"
                                           data-bs-target="#editReservationModal"
                                           style="cursor: pointer;"
                                           data-id="{{ $reservation->booking_number }}"
                                           data-roomRes="{{ $roomReservation->id }}"
                                           data-name="{{ $reservation->customer->name }}"
                                           data-checkin="{{ $roomReservation->check_in }}"
                                           data-checkout="{{ $roomReservation->check_out }}"
                                           data-roomtype="{{ $roomReservation->room->roomType->id}}"
                                           data-guests="{{ $roomReservation->occupants }}">
                                        </i>
                                        <i class="fas fa-plus text-success fs-5" data-bs-toggle="modal"
                                           data-bs-target="#addChargesModal" style="cursor: pointer;"></i>
                                    </div>
                                </td>
                                @endforeach
                                </tr>
                            @endforeach
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
                    <form method="POST" action="{{route('admin.customers.check-in')}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="customerId" name="customer_id">
                            <input type="hidden" id="reservationId" name="room_reservation_id">

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
                                        <x-room-type-dropdown
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

                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <input type="text" class="form-control" placeholder="Enter service">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" placeholder="Enter amount">
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
                    document.getElementById('customerId').value = button.getAttribute('data-bs-customer');
                    document.getElementById('reservationId').value = button.getAttribute('data-bs-roomreservation');
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
