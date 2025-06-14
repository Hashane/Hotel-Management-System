@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
    <h1>Add Reservations</h1>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Add Reservations</li>
    </ol>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <!-- Cart FORM -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="cartModalLabel">Your Selected Rooms</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">

                        <div class="row border-bottom pb-2 mb-3 fw-bold text-center">
                            <div class="col">Check-in</div>
                            <div class="col">Check-out</div>
                            <div class="col">Occupancy</div>
                            <div class="col">Amount</div>
                            <div class="col">Action</div>
                        </div>

                        @forelse ($cartItems as $cartItem)
                            <form action="{{ route('admin.carts.destroy', ['cart' => $cartItem->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="row border-bottom py-3 text-center align-items-center">
                                    <div class="col">{{ $cartItem->check_in }}</div>
                                    <div class="col">{{ $cartItem->check_out }}</div>
                                    <div class="col">{{ $cartItem->occupants }}</div>
                                    <div class="col">{{ $cartItem->check_in }}</div>
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
                                    Rs. {{ $cartItems->count() != 0 ? number_format($priceBreakdown['totalRoomCost'], 2) : '' }}
                                </p>
                                <p class="mb-1"><strong>Service Charges:</strong>
                                    Rs. {{ $cartItems->count() != 0 ? number_format($priceBreakdown['serviceCharges'], 2) : '' }}
                                </p>
                                <p class="mb-1"><strong>Tax ({{ $priceBreakdown['taxPercentage'] }}%):</strong>
                                    Rs. {{ $cartItems->count() != 0 ? number_format($priceBreakdown['tax'], 2) : '' }}
                                </p>
                                <hr class="my-2">
                                <h5 class="mb-0"><strong>Total Amount:</strong> Rs. <span
                                            id="total-amount">{{ $cartItems->count() != 0 ? number_format($priceBreakdown['totalAmount'], 2) : '' }}</span>
                                </h5>
                            </div>
                        </div>


                        <!-- Action Buttons -->
                        <form action="{{ route('admin.carts.book') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-3 px-4" data-bs-dismiss="modal">Cancel
                                </button>
                                <button type="submit" class="btn btn-primary px-4"
                                        id="book-now-btn" {{ $cartItems->count() == 0 ? 'disabled' : '' }}>Book Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Cart Button (Bottom Right) -->

        <div class="card  mt-4" style="background-color: transparent; border: none; box-shadow: none;">
            <div>
                <button type="button" class="btn btn-primary position-relative float-end me-3" data-bs-toggle="modal"
                        data-bs-target="#cartModal">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          id="cart-count">{{ count($cartItems) }}</span>
                </button>
            </div>
        </div>


        <div class="card shadow-sm mt-4">
            <div class="px-3 px-md-4" style="margin-top: 1rem">
                <div class="row g-4">

                    <!-- Filter Form -->
                    <div class="col-lg-6 d-flex">
                        <div class="card card-info shadow-sm flex-fill d-flex flex-column">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Filter Rooms</h5>
                            </div>

                            <form method='GET' action="{{ route('admin.reservations.create') }}"
                                  class="form-horizontal d-flex flex-column flex-grow-1">
                                @csrf
                                <!-- Card Body: takes remaining height -->
                                <div class="card-body flex-grow-1">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check In</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="check_in" class="form-control"
                                                   value="{{ old('check_in', request()->check_in ?? now()->format('Y-m-d')) }}"
                                                   placeholder="Check In Date">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Check Out</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="check_out" class="form-control"
                                                   value="{{ old('check_out', request()->check_out ?? now()->addDay()->format('Y-m-d')) }}"
                                                   placeholder="Check Out Date">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Occupancy</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="occupants"
                                                   value="{{ old('occupants', request()->occupants ?? 2) }}"
                                                   class="form-control"
                                                   placeholder="No. of Guests">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Room Type</label>
                                        <div class="col-sm-9">
                                            <x-room-type-dropdown
                                                    selected="{{ old('room_type',request()->room_type) }}">
                                            </x-room-type-dropdown>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bottom-Aligned Button -->
                                <div class="card-footer bg-white border-top-0 text-end">
                                    <button type="submit" class="btn btn-primary px-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end of Filter Form -->


                    <!-- Room Overview -->
                    <div class="col-lg-6 d-flex">
                        <div class="card card-danger shadow-sm flex-fill">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Room Overview</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Overview Stats -->
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Total Rooms</h6>
                                            <h4 class="fw-bold text-dark">{{ $data['totalRoomsCount'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Available</h6>
                                            <h4 class="fw-bold text-success">{{ $data['availableRoomsCount'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Partially Available</h6>
                                            <h4 class="fw-bold text-warning">{{ $data['partiallyAvailableRoomsCount'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Booked</h6>
                                            <h4 class="fw-bold text-danger">{{ $data['confirmedBookingsCount'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Checked In</h6>
                                            <h4 class="fw-bold text-primary">{{ $data['checkedInRoomsCount'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light border rounded p-3 text-center">
                                            <h6 class="text-muted mb-1">Under Maintenance</h6>
                                            <h4 class="fw-bold text-secondary">{{ $data['underMaintenanceRoomsCount'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- end of Room Overview -->


        <!-- Filtered Room Results Table -->
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtered Room Results</h5>
            </div>
            <div class="card-body">
                {{-- Show warning if rooms exist but cannot fulfill occupancy --}}
                @if(!$data['canBeOccupied'] && $data['filteredRooms']->count())
                    <div class="alert alert-warning mb-3">
                        The hotel cannot accommodate {{ request('occupants') }} occupants with the currently
                        available rooms.
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                    <tr>
                        <th>Room Number</th>
                        <th>Duration</th>
                        <th>Room Type</th>
                        <th>Occupancy</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['filteredRooms'] as $room)
                        <tr>
                            <form action="{{ route('admin.carts.store') }}" method="POST">
                                @csrf
                                <td>{{ $room->room_no }}</td>
                                <td>{{ $room->check_in ?? '2025-06-10' }} to {{ $room->check_out ?? '2025-06-14' }}</td>
                                <td>{{ $room->roomType->name }}</td>
                                <td>
                                    <input type="number"
                                           name="occupants"
                                           value="{{ $room->roomType->capacity }}"
                                           min="1"
                                           max="{{ $room->roomType->capacity }}"
                                           class="form-control form-control-sm"
                                           style="width: 80px;">
                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                    <input type="hidden" name="check_in"
                                           value="{{ request()->check_in ?? now()->toDateString() }}">
                                    <input type="hidden" name="check_out"
                                           value="{{ request()->check_out ?? now()->addDay()->toDateString() }}">
                                </td>
                                <td class="text-center">
                                    <button type="submit"
                                            class="btn btn-sm btn-success px-3" {{ $cartItems->contains('room_id', $room->id) ? 'disabled' : '' }}>
                                        Add to Cart
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No available rooms</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $data['filteredRooms']->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection


