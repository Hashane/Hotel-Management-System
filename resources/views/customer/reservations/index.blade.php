@extends('customer.layouts.customer')

@section('title', 'My Reservations')

@section('content')
<div class="container my-4">

    <h2 class="mb-4">Your Reservations</h2>

    <div class="row mb-4">
        <form method="GET" action="{{ route('reservations.index') }}">
            <div class="col-md-9">
                <input class="form-control" name="search" type="search" placeholder="Search reservations by name, room type..." aria-label="Search">
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-success w-100" type="submit">Search</button>
            </div>
        </form>
    </div>

    <!-- Example reservation cards -->
    <div class="row g-4">
        @empty($reservation)
            <p class="mb-1"><strong>No Reservations Found.</strong></p>
        @else
            @foreach($reservation->roomReservations as $res)
                <!-- Reservation Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $res->room->name }}</h5>
                            <p class="mb-1"><strong>Name:</strong>  {{ $reservation->customer->name }}</p>
                            <p class="mb-1"><strong>Room No.:</strong> {{ $res->room->room_no }}</p>
                            <p class="mb-1"><strong>Guests: {{ $res->occupants }} </strong> </p>
                            <p class="mb-1"><strong>Check-in: {{ $res->check_in }} </strong> </p>
                            <p class="mb-3"><strong>Check-out: {{ $res->check_out }} </strong> </p>
                            <div class="d-flex justify-content-end gap-2">
                                <button
                                    class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editReservationModal"
                                    data-id="{{ $res->id }}"
                                    data-name="{{ $reservation->customer->name }}"
                                    data-checkin="{{ $res->check_in }}"
                                    data-checkout="{{ $res->check_out }}"
                                    data-roomtype="{{ $res->room->roomType->name }}"
                                    data-guests="{{ $res->occupants }}"
                                >
                                    Edit
                                </button>

                                <button
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-id="{{ $res->id }}"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endempty
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded shadow-sm">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto">Confirm Deletion</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteReservationForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <p class="mb-4 fs-5">Are you sure you want to delete this reservation?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center gap-3 pb-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Reservation Modal -->
<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editReservationForm">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="reservationId" class="form-label">Reservation ID</label>
                            <input type="text" id="reservationId" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="customerName" class="form-label">Name</label>
                            <input type="text" id="customerName" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="roomType" class="form-label">Room Type</label>
                            <input type="text" id="roomType" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="guests" class="form-label">Guests</label>
                            <input type="number" id="guests" class="form-control">
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

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editReservationModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const checkin = button.getAttribute('data-checkin');
                const checkout = button.getAttribute('data-checkout');
                const roomtype = button.getAttribute('data-roomtype');
                const guests = button.getAttribute('data-guests');

                document.getElementById('reservationId').value = id;
                document.getElementById('customerName').value = name;
                document.getElementById('startDate').value = checkin;
                document.getElementById('endDate').value = checkout;
                document.getElementById('roomType').value = roomtype;
                document.getElementById('guests').value = guests;
            });

            const deleteModal = document.getElementById('confirmDeleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');

                const form = deleteModal.querySelector('#deleteReservationForm');
                form.action = `/reservations/${id}`; // Adjust route as needed
            });
        });
    </script>

@endpush
