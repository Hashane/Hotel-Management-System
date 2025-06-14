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
            <form>
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
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr>
                                <td>Bill No:</td>
                                <td class="text-end">#{{ $bill['id'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Room Price:</td>
                                <td class="text-end">LKR {{ number_format($bill['totalRoomCost'], 2) }}</td>
                            </tr>
                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-end">LKR {{ number_format($bill['subtotal'], 2) }}</td>
                            </tr>
                            <tr>
                                <td>Discount:</td>
                                <td class="text-end">LKR {{ number_format($bill['discount'] ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Tax:</td>
                                <td class="text-end">LKR {{ number_format($bill['tax'], 2) }}</td>
                            </tr>
                            <tr>
                                <td>Service Charges:</td>
                                <td class="text-end">LKR {{ number_format($bill['serviceCharges'], 2) }}</td>
                            </tr>
                            @if ($reservation->extraCharges->count())
                                <tr>
                                    <td colspan="2"><strong>Additional Charges:</strong></td>
                                </tr>
                                @foreach ($reservation->extraCharges as $charge)
                                    <tr>
                                        <td class="ps-4">{{ $charge->serviceType->name}}</td>
                                        <td class="text-end">LKR {{ number_format($charge->amount, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="fw-semibold">Total Additional Charges:</td>
                                    <td class="text-end fw-semibold">
                                        LKR {{ number_format($reservation->extraCharges->sum('amount'), 2) }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>Additional Charges:</td>
                                    <td class="text-end">LKR 0.00</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Late Checkout Fee:</td>
                                <td class="text-end">LKR {{ number_format($bill['lateCheckoutFee'] ?? 0, 2) }}</td>
                            </tr>
                            <tr class="fw-bold border-top">
                                <td>Total Amount:</td>
                                <td class="text-end">LKR {{ number_format($bill['total'], 2) }}</td>
                            </tr>
                            </tbody>

                        </table>

                        <!-- Payment Method + Button in One Row -->
                        <div class="row mt-4 align-items-end">
                            <div class="col-md-4">
                                <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                                <select class="form-select" id="payment_method">
                                    <option value="">Select</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                            <div class="col-md-8 text-end">
                                <button type="button" class="btn btn-success px-5" data-bs-toggle="modal"
                                        data-bs-target="#paymentReceiptModal">Make Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- Payment Receipt Modal -->
        <div class="modal fade" id="paymentReceiptModal" tabindex="-1" aria-labelledby="paymentReceiptModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-sm">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="paymentReceiptModalLabel">Payment Receipt</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Company / Hotel Header -->
                        <div class="mb-4 text-center">
                            <h3 class="fw-bold">Sunshine Hotel</h3>
                            <p class="mb-0 text-muted">123 Main Street, Colombo, Sri Lanka</p>
                            <p class="mb-0 text-muted">Phone: +94 11 234 5678 | Email: info@sunshinehotel.lk</p>
                            <hr class="my-3"/>
                        </div>

                        <!-- Reservation Details -->
                        <section class="mb-4">
                            <h6 class="text-uppercase text-secondary fw-semibold mb-3">Reservation Details</h6>
                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Name:</strong> John Doe</div>
                                <div class="col-md-6"><strong>Email:</strong> john@example.com</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Phone:</strong> +94 77 123 4567</div>
                                <div class="col-md-6"><strong>Room ID:</strong> RM102</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Check-In Date:</strong> 2025-06-10</div>
                                <div class="col-md-6"><strong>Check-Out Date:</strong> 2025-06-14</div>
                            </div>
                        </section>

                        <!-- Payment Details -->
                        <section>
                            <h6 class="text-uppercase text-secondary fw-semibold mb-3">Payment Details</h6>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Room Price</span>
                                    <span>LKR 15,000.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax</span>
                                    <span>LKR 1,350.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Service Charges</span>
                                    <span>LKR 750.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Additional Charges</span>
                                    <span>LKR 2,000.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Late Checkout Fee</span>
                                    <span>LKR 1,500.00</span>
                                </div>
                                <hr/>
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total Amount</span>
                                    <span>LKR 20,600.00</span>
                                </div>
                            </div>

                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <div><strong>Payment Method:</strong> Cash</div>
                                <button type="button" class="btn btn-success">Check Out</button>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection


