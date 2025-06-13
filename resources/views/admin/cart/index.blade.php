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
        <!-- Cart details Card -->
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="card shadow-sm p-4">
                    <h5 class=" mb-4">Cart Details</h5>

                    <!-- Header Row -->
                    <div class="row fw-bold text-center border-bottom pb-2 mb-3">
                        <div class="col-1">Room</div>
                        <div class="col-2">Image</div>
                        <div class="col">Check-in</div>
                        <div class="col">Check-out</div>
                        <div class="col">Occupancy</div>
                        <div class="col">Amount</div>
                        <div class="col">Action</div>
                    </div>

                    <!-- Sample Item Rows -->
                    <div class="row text-center align-items-center border-bottom py-3">
                        <div class="col-1">101</div>
                        <div class="col-2">
                            <img src="https://via.placeholder.com/60x40" class="img-fluid rounded" alt="Room Image">
                        </div>
                        <div class="col">2025-06-10</div>
                        <div class="col">2025-06-15</div>
                        <div class="col">2 Adults</div>
                        <div class="col">$500</div>
                        <div class="col">
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row text-center align-items-center border-bottom py-3">
                        <div class="col-1">203</div>
                        <div class="col-2">
                            <img src="https://via.placeholder.com/60x40" class="img-fluid rounded" alt="Room Image">
                        </div>
                        <div class="col">2025-07-01</div>
                        <div class="col">2025-07-05</div>
                        <div class="col">1 Adult</div>
                        <div class="col">$300</div>
                        <div class="col">
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-end mt-4">
                        <h5>Total Amount: <span id="total-amount" class="text-primary">$800</span></h5>
                    </div>


                </div>
            </div>
        </div>

        <!-- Customer Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <!-- Title Row -->
                <div class="mb-3">
                    <h5 class="mb-0">Customer</h5>
                </div>

                <!-- Search + Buttons Row aligned right -->
                <div class="d-flex justify-content-end align-items-center flex-nowrap"
                     style="gap: 0.5rem; max-width: 600px; margin-left: auto;">
                    <input type="text" class="form-control" placeholder="Enter name or ID"
                           style="min-width: 220px; max-width: 220px; white-space: nowrap;">
                    <button class="btn btn-primary flex-shrink-0">Search</button>
                    <span class="mx-2 flex-shrink-0">or</span>
                    <button class="btn btn-success flex-shrink-0" data-bs-toggle="modal"
                            data-bs-target="#addCustomerModal">Add Customer
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Notes</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>+1 234 567 8901</td>
                        <td>VIP guest, prefers quiet rooms.</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal"
                                    data-bs-target="#assignModal">
                                <i class="bi bi-person-plus"></i> Assign
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>+1 987 654 3210</td>
                        <td>Allergic to pets, needs early check-in.</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal"
                                    data-bs-target="#assignModal">
                                <i class="bi bi-person-plus"></i> Assign
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Michael Lee</td>
                        <td>michael@example.com</td>
                        <td>+1 456 789 1234</td>
                        <td>Late check-out requested.</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal"
                                    data-bs-target="#assignModal">
                                <i class="bi bi-person-plus"></i> Assign
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- **** POP UP FORMS**** --}}
        <!-- Add Customer Form -->
        <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addCustomerModalLabel">Add Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">


                        <!-- Customer Info -->
                        <h6 class="fw-semibold mb-3">Customer Information</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" placeholder="+1 234 567 8901">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Special Notes</label>
                                <textarea class="form-control" rows="3" placeholder="Any additional info..."></textarea>
                            </div>
                        </div>

                        <!-- Card Info -->
                        <h6 class="fw-semibold mt-5 mb-3">Card Details <small class="text-muted">(optional)</small></h6>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Full Name on Card</label>
                                <input type="text" class="form-control" placeholder="John Doe">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Expiration Date</label>
                                <input type="text" class="form-control" placeholder="MM/YY">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">CVC</label>
                                <input type="text" class="form-control" placeholder="123">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Add Customer</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Cart FORM -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="cartModalLabel">Your Selected Rooms</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <!-- Header Row -->
                        <div class="row border-bottom pb-2 mb-3 fw-bold text-center">
                            <div class="col">Check-in</div>
                            <div class="col">Check-out</div>
                            <div class="col">Occupancy</div>
                            <div class="col">Amount</div>
                            <div class="col">Action</div>
                        </div>

                        <!-- Sample Row 1 -->
                        <div class="row border-bottom py-3 text-center align-items-center">
                            <div class="col">2025-06-10</div>
                            <div class="col">2025-06-15</div>
                            <div class="col">2 Adults</div>
                            <div class="col">$500</div>
                            <div class="col">
                                <button type="button" class="btn btn-danger btn-sm px-3">Delete</button>
                            </div>
                        </div>

                        <!-- Sample Row 2 -->
                        <div class="row border-bottom py-3 text-center align-items-center">
                            <div class="col">2025-07-01</div>
                            <div class="col">2025-07-05</div>
                            <div class="col">1 Adult</div>
                            <div class="col">$300</div>
                            <div class="col">
                                <button type="button" class="btn btn-danger btn-sm px-3">Delete</button>
                            </div>
                        </div>

                        <!-- Total Amount -->
                        <div class="d-flex justify-content-end mt-4 mb-4 pe-3">
                            <h5>Total Amount: <span id="total-amount">$800</span></h5>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-3 px-4" data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="button" class="btn btn-primary px-4" id="book-now-btn">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


