<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@extends('adminlte::page')

@section('title', 'Reservations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Reports</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{-- route('admin.reservations.index') --}}">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section>
          
        <form method="GET" action="#">
          <div class="row mb-3">
              <div class="col-md-4">
                  <label>Start Date</label>
                  <input type="date" name="start_date" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>End Date</label>
                  <input type="date" name="end_date" class="form-control">
              </div>
              <div class="col-md-4 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary w-100">Generate Report</button>
              </div>
          </div>
      </form>

      <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Total Revenue</h6>
                    <h4 class="text-success">LKR 1,200,000</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Total Bookings</h6>
                    <h4 class="text-primary">320</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Occupancy Rate</h6>
                    <h4 class="text-warning">75%</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Avg Revenue/Room</h6>
                    <h4 class="text-info">LKR 3,750</h4>
                </div>
            </div>
        </div>
    </div>

    


    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
          <div class="container" style="max-width: 100%">
              <div class="row">
                  <div class="col-md-4">
                      <h3 class="card-title">Report Results</h3>
                  </div>
                  <div class="col-md-8">
                      <div class="row">
                          <div class="col-md-7 offset-md-3">
                              <input class="form-control" type="search" placeholder="Search Reports" aria-label="Search">
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
          <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Total Rooms</th>
                      <th>Booked</th>
                      <th>Occupancy (%)</th>
                      <th>Revenue (LKR)</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2025-06-01</td>
                      <td>50</td>
                      <td>40</td>
                      <td>80%</td>
                      <td>100,000</td>
                      <td class="text-center">
                          <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                              <a href="#" class="btn btn-sm btn-info px-3">Details</a>
                              <i class="fas fa-file-download text-success fs-5" data-bs-toggle="tooltip" title="Download Report" style="cursor: pointer;"></i>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td>2025-06-02</td>
                      <td>50</td>
                      <td>35</td>
                      <td>70%</td>
                      <td>87,500</td>
                      <td class="text-center">
                          <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                              <a href="#" class="btn btn-sm btn-info px-3">Details</a>
                              <i class="fas fa-file-download text-success fs-5" data-bs-toggle="tooltip" title="Download Report" style="cursor: pointer;"></i>
                          </div>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
  
  
  


  
   
  
      </section>

    {{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection
