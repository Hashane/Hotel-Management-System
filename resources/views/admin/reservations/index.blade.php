<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@extends('adminlte::page')

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
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <table id="reservations" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Name</th>
                            <th>Duration</th>
                            <th>Room Type</th>
                            <th>Guests</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1001</td>
                            <td>John Smith</td>
                            <td>2025-06-15 to 2025-06-18</td>
                            <td>Deluxe Room</td>
                            <td>2</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                                    <a href="#" class="btn btn-sm btn-warning px-3">Check In</a>
                                    <i class="fas fa-pencil-alt text-primary fs-5" data-bs-toggle="modal" data-bs-target="#editReservationModal" style="cursor: pointer;"></i>
                                    <i class="fas fa-plus text-success fs-5" data-bs-toggle="modal" data-bs-target="#addChargesModal" style="cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>Sarah Adams</td>
                            <td>2025-06-20 to 2025-06-25</td>
                            <td>Suite</td>
                            <td>3</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                                    <a href="#" 
                                    class="btn btn-sm btn-warning px-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#checkInModal" 
                                    onclick="setCheckInReservationId(1001)">
                                    Check In
                                 </a>
                                                                     <i class="fas fa-pencil-alt text-primary fs-5" data-bs-toggle="modal" data-bs-target="#editReservationModal" style="cursor: pointer;"></i>
                                    <i class="fas fa-plus text-success fs-5" data-bs-toggle="modal" data-bs-target="#addChargesModal" style="cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Check-In Confirmation Modal -->
<div class="modal fade" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="checkInModalLabel">Confirm Check-In</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="checkInForm" method="POST" action="/check-in-route"> <!-- change action accordingly -->
          @csrf
          <div class="modal-body">
            <p>Are you sure you want to check in this customer?</p>
            <!-- Optionally, add more details or hidden inputs -->
            <input type="hidden" name="reservation_id" id="checkInReservationId" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Yes, Check In</button>
          </div>
        </form>
      </div>
    </div>
  </div>

        <!-- Edit Reservation Modal -->
        <div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Reservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Reservation ID</label>
                                            <input type="text" class="form-control" placeholder="1001">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="John Smith">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Room Type</label>
                                            <input type="text" class="form-control" placeholder="Deluxe">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Occupancy</label>
                                            <input type="number" class="form-control" placeholder="2">
                                        </div>
                                    </div>
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
        <div class="modal fade" id="addChargesModal" tabindex="-1" aria-labelledby="addChargesModalLabel" aria-hidden="true">
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
