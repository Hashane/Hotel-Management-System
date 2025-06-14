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
                    @forelse ($cartItems as $key => $cartItem)
                        <form action="{{ route('admin.carts.destroy', ['cart' => $cartItem->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="row border-bottom py-3 text-center align-items-center">
                                <div class="col">{{ $priceBreakdown['items'][$key]['room']->room_no }}</div>
                                <div class="col-2">
                                    <img src="{{ $priceBreakdown['items'][$key]['room']->image }}"
                                         class="img-fluid rounded" alt="Room Image">
                                </div>
                                <div class="col">{{ $cartItem->check_in }}</div>
                                <div class="col">{{ $cartItem->check_out }}</div>
                                <div class="col">{{ $cartItem->occupants }}</div>
                                <div class="col">{{ $priceBreakdown['items'][$key]['room_cost'] }}</div>
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @empty
                        <p>Cart is Empty.</p>
                    @endforelse

                    <!-- Total Amount -->
                    <div class="d-flex justify-content-end mt-4 mb-4 pe-3">
                        <div class="text-end">
                            <p class="mb-1"><strong>Room Cost:</strong>
                                Rs. {{ number_format($priceBreakdown['totalRoomCost'], 2) }}</p>
                            <p class="mb-1"><strong>Service Charges:</strong>
                                Rs. {{ number_format($priceBreakdown['serviceCharges'], 2) }}</p>
                            <p class="mb-1"><strong>Tax ({{ $priceBreakdown['taxPercentage'] }}%):</strong>
                                Rs. {{ number_format($priceBreakdown['tax'], 2) }}</p>
                            <hr class="my-2">
                            <h5 class="mb-0"><strong>Total Amount:</strong> Rs. <span
                                        id="total-amount">{{ number_format($priceBreakdown['totalAmount'], 2) }}</span>
                            </h5>
                        </div>
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
                    <form action="#" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control" placeholder="Enter name or ID"
                               style="min-width: 220px; max-width: 220px; white-space: nowrap;">
                        <button type="submit" class="btn btn-primary flex-shrink-0">Search</button>
                    </form>
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
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>VIP guest, prefers quiet rooms.</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#assignModal"
                                        data-id="{{ $customer->id }}"
                                        data-name="{{ $customer->name }}"
                                        {{ $cartItems->count() == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-user-plus"></i> Assign
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr> No Customers matching that criteria.</tr>
                    @endforelse
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
    </section>
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to assign this room to <strong id="assign-customer-name">...</strong>?
                </div>
                <div class="modal-footer">
                    <form id="assign-form" action="{{ route('admin.carts.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" id="assign-customer-id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Yes, Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const assignModal = document.getElementById('assignModal');

            assignModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const customerId = button.getAttribute('data-id');
                const customerName = button.getAttribute('data-name');

                assignModal.querySelector('#assign-customer-name').textContent = customerName;
                assignModal.querySelector('#assign-customer-id').value = customerId;
            });
        });
    </script>

@endpush


