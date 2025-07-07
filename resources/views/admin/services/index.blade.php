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


<div class="text-end">
  <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.services.create') }}'">
    <h6 class="mb-0"><i class="fas fa-plus me-1"></i> Add New Service</h6>
  </button>
</div>


<div class="card card-info shadow-sm mt-2">
  <div class="card-header">
    <h5 class="card-title mb-0">Services</h5>
  </div>
  <div class="card-body">

    {{-- Info Callout --}}
    <div class="row">
      <div class="col-12">
        <div class="container mt-2">
          <div class="callout callout-info">
            <div class="d-flex align-items-start">
              <i class="icon fas fa-info fa-lg text-info me-3 mt-1"></i>
              <div>
                <h6 class="mb-0">
                  You can specify a value for each relevant feature regarding this room type. Empty fields
                  will not be
                  displayed.
                  You can either create a specific value, or select among the existing pre-defined values
                  you've
                  previously added.
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Feature Form --}}
    <div class="row">
      <div class="col-12">
        <div class="container mt-2">
          <form action="#" method="POST">
            @csrf

            {{-- Header Row --}}
            <div class="container pt-2">
              <div class="row fw-bold border-bottom">
                <div class="col-md-1 text-center">
                  <h6>Select</h6>
                </div>
                <div class="col-md-3">
                  <h6>Name</h6>
                </div>
                <div class="col-md-2">
                  <h6>Base Price</h6>
                </div>
                <div class="col-md-2">
                  <h6>Final Price</h6>
                </div>
                <div class="col-md-2">
                  <h6>Feature Image</h6>
                </div>
                <div class="col-md-2">
                  <h6>Action</h6>
                </div>
              </div>
            </div>

            {{-- Feature Rows --}}
            <div class="container">
              @php
              $features = [
              ['name' => 'Wi‑Fi', 'image' => 'wifi.png', 'base_price' => '100.00', 'final_price' => '110.00'],
              ['name' => 'Fridge', 'image' => 'fridge.png', 'base_price' => '150.00', 'final_price' => '165.00'],
              ['name' => 'Air Conditioner','image' => 'ac.png', 'base_price' => '200.00', 'final_price' =>
              '220.00'],
              ['name' => 'Television', 'image' => 'tv.png', 'base_price' => '120.00', 'final_price' => '132.00'],
              ['name' => 'Mini Bar', 'image' => 'minibar.png', 'base_price' => '180.00', 'final_price' => '198.00'],
              ];
              @endphp

              @foreach ($features as $index => $feature)
              <div class="row align-items-center border-bottom mt-2 pb-2">
                {{-- Select --}}
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" name="features[]"
                    value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}" id="feature_{{ $index }}">
                </div>

                {{-- Feature Name --}}
                <div class="col-md-3">
                  <label class="form-check-label h6 mb-0" for="feature_{{ $index }}">
                    {{ $feature['name'] }}
                  </label>
                </div>

                {{-- Base Price --}}
                <div class="col-md-2">
                  <h6 class="mb-0">{{ $feature['base_price'] }}</h6>
                </div>

                {{-- Final Price --}}
                <div class="col-md-2">
                  <h6 class="mb-0">{{ $feature['final_price'] }}</h6>
                </div>

                {{-- Feature Image (only image shown) --}}
                <div class="col-md-2">
                  <h6 class="mb-0">
                    <img src="{{ asset('images/features/' . $feature['image']) }}" width="40"
                      alt="{{ $feature['name'] }}">
                  </h6>
                </div>

                {{-- Action Icons --}}
                <div class="col-md-2">
                  <i class="far fa-eye text-primary me-2" title="View" role="button" data-bs-toggle="modal"
                    data-bs-target="#viewFeatureModal"></i>
                  <i class="far fa-edit text-success me-2" data-bs-toggle="modal" data-bs-target="#editFeatureModal"
                    title="Edit"></i>
                  <i class="far fa-trash-alt text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                    title="Delete"></i>

                </div>
              </div>
              @endforeach
            </div>

            {{-- Submit --}}
            <div class="container mt-3">
              <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Save Room</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- View Feature Modal -->
<div class="modal fade" id="viewFeatureModal" tabindex="-1" aria-labelledby="viewFeatureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light border-bottom">
        <h6 class="modal-title fw-bold text-dark" id="viewFeatureModalLabel">Feature Details</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="container-fluid">

          {{-- General Information --}}
          <h5 class="fw-bold text-dark mb-2">General Information</h5>
          <div class="bg-body-tertiary p-4 rounded mb-4">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label h6">Feature Name</label>
                <p class="form-control-plaintext h6">Wi‑Fi</p>
              </div>
              <div class="col-md-6">
                <label class="form-label h6">Status</label>
                <p class="form-control-plaintext h6">Active</p>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <label class="form-label h6">Description</label>
                <p class="form-control-plaintext h6">
                  High-speed wireless internet access available in all rooms and public areas.
                </p>
              </div>
            </div>
          </div>

          {{-- Pricing Details --}}
          <h5 class="fw-bold text-dark mb-2">Pricing Details</h5>
          <div class="bg-body-tertiary p-4 rounded mb-4">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label h6">Pre-Tax Operating Cost</label>
                <p class="form-control-plaintext h6">Rs. 100.00</p>
              </div>
              <div class="col-md-6">
                <label class="form-label h6">Pre-Tax Retail Price</label>
                <p class="form-control-plaintext h6">Rs. 120.00</p>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label h6">Tax Rule</label>
                <p class="form-control-plaintext h6">10%</p>
              </div>
              <div class="col-md-6">
                <label class="form-label h6">Retail Price (Incl. Tax)</label>
                <p class="form-control-plaintext h6">Rs. 132.00</p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label class="form-label h6">Price Calculation Method</label>
                <p class="form-control-plaintext h6">Per Day</p>
              </div>
            </div>
          </div>


          {{-- SEO --}}
          <h5 class="fw-bold text-dark mb-3 mt-4">SEO</h5>
          <div class="bg-body-tertiary p-4 rounded mb-4">

            {{-- Meta Title --}}
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label h6 mb-1">Meta Title</label>
                <p class="form-control-plaintext h6 mb-0">Free Wi‑Fi Access in Every Room</p>
              </div>
            </div>

            {{-- Meta Description --}}
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label h6 mb-1">Meta Description</label>
                <p class="form-control-plaintext h6 mb-0">
                  Enjoy complimentary high-speed internet in all guest rooms and public areas during your stay.
                </p>
              </div>
            </div>

            {{-- Friendly URL --}}
            <div class="row">
              <div class="col-12">
                <label class="form-label h6 mb-1">Friendly URL</label>
                <p class="form-control-plaintext h6 mb-0">https://yourhotel.com/room-type/free-wifi</p>
              </div>
            </div>

          </div>



          {{-- Visuals --}}
          <h5 class="fw-bold text-dark mb-2">Visual Representation</h5>
          <div class="bg-body-tertiary p-4 rounded">
            <div class="row align-items-center">
              <div class="col-md-6 mb-3">
                <label class="form-label h6">Feature Image</label>
                <div class="border p-2 rounded" style="max-width: 150px;">
                  <img src="{{ asset('images/features/wifi.png') }}" alt="Wi‑Fi" class="img-fluid rounded">
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label h6">Cover Image</label>
                <p class="form-control-plaintext h6">Yes</p>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer border-top mt-4">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>


    </div>
  </div>
</div>

<!-- Edit Feature Modal -->
<div class="modal fade" id="editFeatureModal" tabindex="-1" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light border-bottom">
        <h6 class="modal-title fw-bold text-dark" id="editFeatureModalLabel">Edit Feature</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="container-fluid">

            {{-- General Information --}}
            <h5 class="fw-bold text-dark mb-2">General Information</h5>
            <div class="bg-body-tertiary p-4 rounded mb-4">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label h6">Feature Name</label>
                  <input type="text" name="feature_name" class="form-control" value="Wi‑Fi">
                </div>
                <div class="col-md-6">
                  <label class="form-label h6">Status</label>
                  <select name="status" class="form-select">
                    <option selected>Active</option>
                    <option>Inactive</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label class="form-label h6">Description</label>
                  <textarea name="description" class="form-control"
                    rows="3">High-speed wireless internet access available in all rooms and public areas.</textarea>
                </div>
              </div>
            </div>


            {{-- Pricing Details --}}
            <h5 class="fw-bold text-dark mb-2">Pricing Details</h5>
            <div class="bg-body-tertiary p-4 rounded mb-4">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label h6">Pre-Tax Operating Cost</label>
                  <input type="number" name="pre_tax_operating" class="form-control" value="100.00">
                </div>
                <div class="col-md-6">
                  <label class="form-label h6">Pre-Tax Retail Price</label>
                  <input type="number" name="pre_tax_retail" class="form-control" value="120.00">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label h6">Tax Rule (%)</label>
                  <input type="number" name="tax_rule" class="form-control" value="10">
                </div>
                <div class="col-md-6">
                  <label class="form-label h6">Retail Price (Incl. Tax)</label>
                  <input type="number" name="retail_price_with_tax" class="form-control" value="132.00">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label class="form-label h6">Price Calculation Method</label>
                  <select name="price_calculation_method" class="form-select">
                    <option selected>Per Day</option>
                    <option>Per Booking</option>
                  </select>
                </div>
              </div>
            </div>


            {{-- SEO --}}
            <h5 class="fw-bold text-dark mb-3 mt-4">SEO</h5>
            <div class="bg-body-tertiary p-4 rounded mb-4">
              <div class="row mb-3">
                <div class="col-12">
                  <label class="form-label h6">Meta Title</label>
                  <input type="text" name="meta_title" class="form-control" value="Free Wi‑Fi Access in Every Room">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12">
                  <label class="form-label h6">Meta Description</label>
                  <textarea name="meta_description" class="form-control"
                    rows="3">Enjoy complimentary high-speed internet in all guest rooms and public areas during your stay.</textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label class="form-label h6">Friendly URL</label>
                  <input type="text" name="friendly_url" class="form-control"
                    value="https://yourhotel.com/room-type/free-wifi">
                </div>
              </div>
            </div>



            {{-- *** IMAGES *** --}}
            <h5 class="fw-bold text-dark mb-2">Pricing Details</h5>
            <div class="bg-body-tertiary p-4 rounded mb-4">
              <div class="row mb-3">
                <div class="col-12">
                  <div class="container mt-2">

                    <div class="row g-3 mb-4">
                      <div class="col-md-6">
                        <label class="form-label h6">Room Type Name</label>
                        <input type="file" id="fileInput" name="file" class="d-none">
                        <button type="button" class="btn btn-outline-primary d-inline-flex align-items-center ms-4"
                          onclick="document.getElementById('fileInput').click();">
                          <h6 class="mb-0"><i class="fas fa-file m-0"></i> Add File </h6>
                        </button>
                      </div>
                    </div>

                    {{-- image Form --}}
                    <div class="container">
                      {{-- Header Row --}}
                      <div class="container pt-2">
                        <div class="row fw-bold border-bottom">
                          <div class="col-md-4">
                            <h6>Feature Image</h6>
                          </div>
                          <div class="col-md-4 text-center">
                            <h6>Cover</h6>
                          </div>
                          <div class="col-md-4 text-center">
                            <h6>Action</h6>
                          </div>
                        </div>
                      </div>

                      @php
                      $features = [
                      ['name' => 'Wi‑Fi', 'image' => 'wifi.png'],
                      ['name' => 'Fridge', 'image' => 'fridge.png'],
                      ['name' => 'Air Conditioner', 'image' => 'ac.png'],
                      ['name' => 'Television', 'image' => 'tv.png'],
                      ['name' => 'Mini Bar', 'image' => 'minibar.png'],
                      ];
                      @endphp

                      {{-- Feature Rows --}}
                      <div class="container">
                        @foreach ($features as $index => $feature)
                        <div class="row align-items-center border-bottom mt-2 pb-2">
                          <div class="col-md-4">
                            <h6 class="mb-0">
                              <img src="{{ asset('images/features/' . $feature['image']) }}" width="50"
                                alt="{{ $feature['name'] }}">
                            </h6>
                          </div>
                          <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" name="features[]"
                              value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}"
                              id="feature_{{ $index }}">
                          </div>
                          <div class="col-md-4 text-center">
                            <button type="button" class="btn btn-link text-danger p-0" title="Delete">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </div>
                        @endforeach
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer border-top">
            <button type="submit" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-light border-bottom">
        <h6 class="modal-title fw-bold" id="confirmDeleteModalLabel">Confirm Delete</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
        <div class="modal-body">
          <div class="container-fluid">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
          </div>
          <div class="modal-footer border-top">
            <button type="button" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>


      </form>


    </div>
  </div>
</div>

@endsection
@push('scripts')
@endpush