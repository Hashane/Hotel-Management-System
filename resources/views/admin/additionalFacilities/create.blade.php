@php use App\Enums\RoomCategory; @endphp

@extends('admin.layouts.admin')

@section('title', 'Reservations')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1>Manage Room Types</h1>
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

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-5 col-sm-3 mt-4">
        <div class="nav flex-column nav-tabs " id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="vert-tabs-info-tab" data-toggle="pill" href="#vert-tabs-info" role="tab"
            aria-controls="vert-tabs-info" aria-selected="true">Information</a>
          <a class="nav-link" id="vert-tabs-prices-tab" data-toggle="pill" href="#vert-tabs-prices" role="tab"
            aria-controls="vert-tabs-prices" aria-selected="false">Prices</a>
          <a class="nav-link" id="vert-tabs-seo-tab" data-toggle="pill" href="#vert-tabs-seo" role="tab"
            aria-controls="vert-tabs-seo" aria-selected="false">SEO</a>
        </div>
      </div>


      <div class="col-7 col-sm-9">
        <div class="tab-content" id="vert-tabs-tabContent">
          {{-- *** INFORMATION *** --}}
          <div class="tab-pane text-left fade active show" id="vert-tabs-info" role="tabpanel"
            aria-labelledby="vert-tabs-info-tab">
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Facility Information</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <!-- Add New Room Modal -->
                    <div class="container mt-2">
                      {{-- <h4 class="mb-4">Room Type Information</h4> --}}
                      <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">

                          <div class="col-md-6">
                            <label class="form-label">Facility Name</label>
                            <input type="text" name="room_type_name" class="form-control" required>
                          </div>

                          <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
                              <option value="maintenance">Maintenance</option>
                            </select>
                          </div>

                          <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"
                              placeholder="Enter room details..."></textarea>
                          </div>

                        </div>

                        <div class="mt-4 text-end">
                          <button type="submit" class="btn btn-primary">Save Room</button>
                          <a href="#" class="btn btn-secondary">Cancel</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          {{-- *** PRICES *** --}}
          <div class="tab-pane fade" id="vert-tabs-prices" role="tabpanel" aria-labelledby="vert-tabs-prices-tab">
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Service Prices</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="container mt-2">
                      <form action="#" method="POST">
                        @csrf

                        {{-- Pre Tax Operating Cost --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Pre Tax Operating
                              Cost</label>
                          </div>
                          <div class="col-md-4">
                            <input type="number" name="operating_cost" class="form-control" required>
                          </div>
                        </div>

                        {{-- Pre Tax Retail Price --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Pre Tax Retail Price</label>
                          </div>
                          <div class="col-md-4">
                            <input type="number" name="retail_price" class="form-control" required>
                          </div>
                        </div>

                        {{-- Tax Rule --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Tax Rule</label>
                          </div>
                          <div class="col-md-4">
                            <input type="number" name="tax_rule" class="form-control" required>
                          </div>
                        </div>

                        {{-- Retail Price with Tax --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Retail Price with Tax</label>
                          </div>
                          <div class="col-md-4">
                            <input type="number" name="final_price" class="form-control" required>
                          </div>
                        </div>

                        {{-- Price Calculation Method --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Price Calculation
                              Method</label>
                          </div>
                          <div class="col-md-4">
                            <select name="price_method" class="form-select">
                              <option value="per_day">Per Day</option>
                              <option value="per_booking">Per Booking</option>
                            </select>
                          </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="row">
                          <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary">Save Room
                            </button>
                            <a href="#" class="btn btn-secondary">Cancel</a>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- *** SEO *** --}}
          <div class="tab-pane fade" id="vert-tabs-seo" role="tabpanel" aria-labelledby="vert-tabs-seo-tab">
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">SEO</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="container mt-2">
                      <form action="#" method="POST">
                        @csrf
                        {{-- Meta Title --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Meta Title</label>
                          </div>
                          <div class="col-md-4">
                            <input type="text" name="meta_title" class="form-control" required>
                          </div>
                        </div>

                        {{-- Meta Description --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Meta Description</label>
                          </div>
                          <div class="col-md-4">
                            <input type="text" name="meta_description" class="form-control" required>
                          </div>
                        </div>

                        {{-- Friendly URL --}}
                        <div class="row mb-3">
                          <div class="col-md-4">
                            <label class="form-label mb-0">Friendly URL</label>
                          </div>
                          <div class="col-md-4">
                            <input type="text" name="friendly_url" class="form-control" required>
                          </div>
                        </div>

                        {{-- Info Alert --}}
                        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                          <h5 class="mb-2">
                            <i class="icon fas fa-info"></i> Alert!
                          </h5>
                          <h6 class="mb-1 ms-4">The product link will look like this:</h6>
                          <h6 class="ms-4 fw-bold">
                            https://demo.qloapps.com/112-134-132-181/en/the-hotel-prime/15-xbfb.html
                          </h6>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="row">
                          <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary">Save Room
                            </button>
                            <a href="#" class="btn btn-secondary">Cancel</a>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
@endpush