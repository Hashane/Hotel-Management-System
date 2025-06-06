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
                    <div class="container" style="max-width: 90%">
                        <div class="row">
                            <div class="col-md-4">
                             <h3 class="card-title">Reservations List</h3>
                            </div>
                            
                            
                           
                            <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                                      <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                                    </div>

                                    <div class="col-md-2">
                                     <button class="btn btn-outline-success" type="submit">Search</button>
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
                        <a href="#" class="btn btn-sm btn-warning px-3">Check In</a>
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
    </section>
{{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection



{{-- ***  edit form --}}
<<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered and larger -->
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


{{-- ***  add form (additional charges) --}}
<!-- Add Charges Modal -->
<div class="modal fade" id="addChargesModal" tabindex="-1" aria-labelledby="addChargesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Centered -->
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





{{-- ROOM RESERVATION PAGE --}}






<div class="container my-4">
    <div class="row g-4">

        <!-- Filter Form -->
        <div class="col-lg-7">
            <div class="card card-info shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filter Rooms</h5>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Check In</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" placeholder="Check In Date">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Check Out</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" placeholder="Check Out Date">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Occupancy</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="No. of Guests">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Room Type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Room Type (e.g., Deluxe)">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary px-4">Search</button>
                    </div>
                </form>
            </div>
        </div>
                <!-- end of Filter Form -->


        <!-- Room Overview -->
        <div class="col-lg-5">
            <div class="card card-danger shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Room Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Total Rooms</h6>
                                <h4 class="fw-bold text-dark">60</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Available</h6>
                                <h4 class="fw-bold text-success">24</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Partially Available</h6>
                                <h4 class="fw-bold text-warning">10</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Booked</h6>
                                <h4 class="fw-bold text-danger">26</h4>
                            </div>
                        </div>
                        <!-- Add 2 more cards if needed -->
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Checked In</h6>
                                <h4 class="fw-bold text-primary">12</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light border rounded p-3 text-center">
                                <h6 class="text-muted mb-1">Under Maintenance</h6>
                                <h4 class="fw-bold text-secondary">3</h4>
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
                {{-- Example rows (to be dynamically generated later) --}}
                <tr>
                    <td>101</td>
                    <td>2025-06-10 to 2025-06-14</td>
                    <td>Deluxe</td>
                    <td>2 Guests</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success px-3">Add to Cart</button>
                    </td>
                </tr>
                <tr>
                    <td>203</td>
                    <td>2025-06-11 to 2025-06-15</td>
                    <td>Suite</td>
                    <td>3 Guests</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success px-3">Add to Cart</button>
                    </td>
                </tr>
                <tr>
                    <td>405</td>
                    <td>2025-06-12 to 2025-06-17</td>
                    <td>Standard</td>
                    <td>1 Guest</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success px-3">Add to Cart</button>
                    </td>
                </tr>
                {{-- End example rows --}}
            </tbody>
        </table>
    </div>
</div>

  <!-- end of Filtered Room Results Table -->


