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

    </section>
{{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection


