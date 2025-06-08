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
      
 
        <!-- CART PAGE ---- MOVE -->

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
<!-- Customer Card -->
<div class="card shadow-sm mt-4">
    <div class="card-header">
        <!-- Title Row -->
        <div class="mb-3">
          <h5 class="mb-0">Customer</h5>
        </div>
      
        <!-- Search + Buttons Row aligned right -->
        <div class="d-flex justify-content-end align-items-center flex-nowrap" style="gap: 0.5rem; max-width: 600px; margin-left: auto;">
          <input type="text" class="form-control" placeholder="Enter name or ID" style="min-width: 220px; max-width: 220px; white-space: nowrap;">
          <button class="btn btn-primary flex-shrink-0">Search</button>
          <span class="mx-2 flex-shrink-0">or</span>
          <button class="btn btn-success flex-shrink-0" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add Customer</button>
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
          <!-- Example rows -->
          <tr>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td>+1 234 567 8901</td>
            <td>VIP guest, prefers quiet rooms.</td>
            <td class="text-center">
              <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal" data-bs-target="#assignModal">
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
              <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal" data-bs-target="#assignModal">
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
              <button class="btn btn-sm btn-warning px-3" data-bs-toggle="modal" data-bs-target="#assignModal">
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
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary me-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary px-4" id="book-now-btn">Book Now</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          

  <!-- Cart Button -->

<div class="card">
<div>
    <button type="button" class="btn btn-primary position-relative float-end me-3" data-bs-toggle="modal" data-bs-target="#cartModal">
        <i class="bi bi-cart3"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>
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
                
                        <form class="form-horizontal d-flex flex-column flex-grow-1">
                            <!-- Card Body: takes remaining height -->
                            <div class="card-body flex-grow-1">
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

<!-- Assign Confirmation Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
  <h5 class="modal-title fw-bold" id="assignModalLabel">Confirm Assignment</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  Are you sure you want to assign this customer?
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
  <button type="button" class="btn btn-success">Confirm</button>
</div>

</div>
</div>
</div>   



    </section>
{{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection


