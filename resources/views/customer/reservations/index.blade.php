<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('customer.layouts.customer')

@section('title', 'My Reservations')

@section('content')
<div class="container my-4">

    <h2 class="mb-4">Your Reservations</h2>

    <div class="row mb-4">
        <div class="col-md-9">
            <input class="form-control" type="search" placeholder="Search reservations by name, room type..." aria-label="Search">
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-success w-100" type="submit">Search</button>
        </div>
    </div>

    <!-- Example reservation cards -->
    <div class="row g-4">
        <!-- Reservation Card -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Deluxe Room</h5>
                    <p class="mb-1"><strong>Name:</strong> John Smith</p>
                    <p class="mb-1"><strong>Reservation ID:</strong> 1001</p>
                    <p class="mb-1"><strong>Duration:</strong> June 15 - June 18, 2025</p>
                    <p class="mb-3"><strong>Guests:</strong> 2</p>
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editReservationModal">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="setDeleteReservationId(1001)">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Another reservation card -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Suite</h5>
                    <p class="mb-1"><strong>Name:</strong> Sarah Adams</p>
                    <p class="mb-1"><strong>Reservation ID:</strong> 1002</p>
                    <p class="mb-1"><strong>Duration:</strong> June 20 - June 25, 2025</p>
                    <p class="mb-3"><strong>Guests:</strong> 3</p>
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editReservationModal">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="setDeleteReservationId(1002)">Delete</button>
                    </div>
                </div>
            </div>
        </div>
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
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Reservation ID</label>
                            <input type="text" class="form-control" placeholder="1001" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="John Smith">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Room Type</label>
                            <input type="text" class="form-control" placeholder="Deluxe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Guests</label>
                            <input type="number" class="form-control" placeholder="2">
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
