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

{{-- <div class="card shadow-sm mt-4">
  <div class="card-header">
    <h5 class="card-title mb-0">Room Types</h5>
  </div>
  <div class="card shadow-sm mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Add New Room Modal -->
          <div class="container mt-4">
            <h4 class="mb-4">Room Type Information</h4>
            <form action="#" method="POST">
              @csrf
              <div class="row g-3">

                <div class="col-md-6">
                  <label class="form-label">Room Type Name</label>
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

                <div class="col-md-4">
                  <label class="form-label">Size (sq ft)</label>
                  <input type="number" name="size" class="form-control" required>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Occupancy</label>
                  <input type="number" name="occupancy" class="form-control" required>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Bed Type</label>
                  <select name="bed" class="form-select" required>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="queen">Queen</option>
                    <option value="king">King</option>
                  </select>
                </div>

                <div class="col-12">
                  <label class="form-label d-block mb-2">Services</label>
                  <div class="row">
                    @php
                    $services = [
                    'Wi-Fi', 'Air Conditioning', 'Television', 'Mini Bar',
                    'Room Service', 'Laundry', 'Pool Access', 'Gym Access',
                    'Private Balcony', 'Sea View', 'Complimentary Breakfast', 'Safe Box'
                    ];
                    @endphp

                    @foreach($services as $service)
                    <div class="col-md-4 mb-2">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]"
                          value="{{ strtolower(str_replace(' ', '_', $service)) }}" id="service_{{ $loop->index }}">
                        <label class="form-check-label" for="service_{{ $loop->index }}">
                          {{ $service }}
                        </label>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Room</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </div>
</div> --}}

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-5 col-sm-3 mt-4">
        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="vert-tabs-info-tab" data-toggle="pill" href="#vert-tabs-info" role="tab"
            aria-controls="vert-tabs-info" aria-selected="true">Information</a>
          <a class="nav-link" id="vert-tabs-prices-tab" data-toggle="pill" href="#vert-tabs-prices" role="tab"
            aria-controls="vert-tabs-prices" aria-selected="false">Prices</a>
          <a class="nav-link" id="vert-tabs-seo-tab" data-toggle="pill" href="#vert-tabs-seo" role="tab"
            aria-controls="vert-tabs-seo" aria-selected="false">SEO</a>
          <a class="nav-link" id="vert-tabs-features-tab" data-toggle="pill" href="#vert-tabs-features" role="tab"
            aria-controls="vert-tabs-features" aria-selected="false">Features</a>
          <a class="nav-link" id="vert-tabs-rooms-tab" data-toggle="pill" href="#vert-tabs-rooms" role="tab"
            aria-controls="vert-tabs-rooms" aria-selected="false">Rooms</a>
        </div>
      </div>
      <div class="col-7 col-sm-9">
        <div class="tab-content" id="vert-tabs-tabContent">

          <div class="tab-pane text-left fade active show" id="vert-tabs-info" role="tabpanel"
            aria-labelledby="vert-tabs-info-tab">
            {{-- *** INFORMATION *** --}}
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Room Type Information</h5>
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
                            <label class="form-label">Room Type Name</label>
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

                          <div class="col-md-4">
                            <label class="form-label">Size (sq ft)</label>
                            <input type="number" name="size" class="form-control" required>
                          </div>

                          <div class="col-md-4">
                            <label class="form-label">Occupancy</label>
                            <input type="number" name="occupancy" class="form-control" required>
                          </div>

                          <div class="col-md-4">
                            <label class="form-label">Bed Type</label>
                            <select name="bed" class="form-select" required>
                              <option value="single">Single</option>
                              <option value="double">Double</option>
                              <option value="queen">Queen</option>
                              <option value="king">King</option>
                            </select>
                          </div>

                          <div class="col-12">
                            <label class="form-label d-block mb-2">Services</label>
                            <div class="row">
                              @php
                              $services = [
                              'Wi-Fi', 'Air Conditioning', 'Television', 'Mini Bar',
                              'Room Service', 'Laundry', 'Pool Access', 'Gym Access',
                              'Private Balcony', 'Sea View', 'Complimentary Breakfast', 'Safe Box'
                              ];
                              @endphp

                              @foreach($services as $service)
                              <div class="col-md-4 mb-2">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="services[]"
                                    value="{{ strtolower(str_replace(' ', '_', $service)) }}"
                                    id="service_{{ $loop->index }}">
                                  <label class="form-check-label" for="service_{{ $loop->index }}">
                                    {{ $service }}
                                  </label>
                                </div>
                              </div>
                              @endforeach
                            </div>
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


          <div class="tab-pane fade" id="vert-tabs-prices" role="tabpanel" aria-labelledby="vert-tabs-prices-tab">
            {{-- *** PRICES *** --}}
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Room Type Prices</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <!-- Add New Room Modal -->
                    <div class="container mt-2">
                      <form action="#" method="POST">
                        @csrf

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Pre Tax Operating Cost</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Pre Tax Retail Price</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Tax Rule</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Retail Price with Tax</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="onSaleCheckbox" name="on_sale">
                          <label class="form-check-label" for="onSaleCheckbox">
                            Display the "On Sale" icon on the Room Type page and within the Room Type listing text.
                          </label>
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

          <div class="tab-pane fade" id="vert-tabs-seo" role="tabpanel" aria-labelledby="vert-tabs-seo-tab">
            {{-- *** SEO *** --}}
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Room Type SEO</h5>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <!-- Add New Room Modal -->
                    <div class="container mt-2">
                      <form action="#" method="POST">
                        @csrf

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Meta Title</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Meta Discription</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-3 mb-0" style="min-width: 180px;">Friendly URL</label>
                            <input type="number" name="basic_price" class="form-control" required>
                          </div>
                        </div>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>

                          <h5 class="mb-2">
                            <i class="icon fas fa-info"></i> Alert!
                          </h5>

                          <h6 class="mb-1 ms-4">The product link will look like this:</h6>
                          <h6 class="ms-4 fw-bold">
                            https://demo.qloapps.com/112-134-132-181/en/the-hotel-prime/15-xbfb.html
                          </h6>
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

          <div class="tab-pane fade " id="vert-tabs-features" role="tabpanel" aria-labelledby="vert-tabs-features-tab">
            {{-- *** FEATURES *** --}}
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Assign Features to this Room Type</h5>
              </div>
              <div class="card-body">

                <div class="row">
                  <div class="col-12">
                    <div class="container mt-2">
                      <div class="callout callout-info">
                        <div class="d-flex align-items-start">
                          <i class="icon fas fa-info fa-lg text-info me-3 mt-1"></i>
                          <div>
                            <h6 class="mb-0">
                              You can specify a value for each relevant feature regarding this room type. Empty fields
                              will not be displayed.
                              You can either create a specific value, or select among the existing pre-defined values
                              you've previously added.
                            </h6>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>


                <div class="row">
                  <div class="col-12">

                    <div class="container mt-2">

                      {{-- Paragraph --}}

                      {{-- Feature Form --}}
                      <form action="#" method="POST">
                        @csrf

                        {{-- Header Row --}}
                        <div class="container pt-2">
                          <div class="row fw-bold border-bottom">
                            <div class="col-md-3 text-center">
                              <h6>Select</h6>
                            </div>
                            <div class="col-md-5">
                              <h6>Feature</h6>
                            </div>
                            <div class="col-md-4">
                              <h6>Feature Image</h6>
                            </div>
                          </div>

                          @php
                          $features = [
                          ['name' => 'Wi‑Fi', 'image' => 'wifi.png'],
                          ['name' => 'Fridge', 'image' => 'fridge.png'],
                          ['name' => 'Air Conditioner','image' => 'ac.png'],
                          ['name' => 'Television', 'image' => 'tv.png'],
                          ['name' => 'Mini Bar', 'image' => 'minibar.png'],
                          ];
                          @endphp
                        </div>



                        <div class="container">
                          @foreach ($features as $index => $feature)
                          <div class="row align-items-center border-bottom mt-2 pb-2">
                            <div class="col-md-3 d-flex justify-content-center align-items-center ">
                              <input class="form-check-input" type="checkbox" name="features[]"
                                value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}"
                                id="feature_{{ $index }}">
                            </div>
                            <div class="col-md-5">
                              <label class="form-check-label h6 mb-0" for="feature_{{ $index }}">
                                {{ $feature['name'] }}
                              </label>
                            </div>
                            <div class="col-md-4">
                              <h6 class="mb-0">
                                <img src="{{ asset('images/features/' . $feature['image']) }}" width="50"
                                  alt="{{ $feature['name'] }}">
                              </h6>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </form>
                    </div>

                    {{-- + Add New Feature link (bottom-right) --}}
                    <div class="container mt-2">
                      <div class="row">
                        <div class="col-12 text-end">
                          <h6><a href="#"
                              class="fw-bold text-primary text-decoration-none d-inline-flex align-items-center add-feature-link">
                              <i class="fas fa-plus me-2"></i> Add New Feature
                            </a>
                          </h6>

                        </div>
                      </div>

                      <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Save Room</button>
                        <a href="#" class="btn btn-secondary">Cancel</a>
                      </div>
                    </div>


                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="vert-tabs-rooms" role="tabpanel" aria-labelledby="vert-tabs-rooms-tab">
            {{-- *** ADD ROOMS *** --}}
            <div class="card card-info shadow-sm mt-4">
              <div class="card-header">
                <h5 class="card-title mb-0">Rooms</h5>
              </div>
              <div class="card-body">




                <div class="row">
                  <div class="col-12">

                    <div class="container mt-2">

                      <div class="row fw-bold border-bottom pb-2">
                        <div class="col-md-2">
                          <h6>Room No.</h6>
                        </div>
                        <div class="col-md-2">
                          <h6>Floor</h6>
                        </div>
                        <div class="col-md-2">
                          <h6>Status</h6>
                        </div>
                        <div class="col-md-4">
                          <h6>Extra Information</h6>
                        </div>
                        <div class="col-md-2 text-center">
                          <h6>Action</h6>
                        </div>
                      </div>

                      {{-- Example Room Row --}}
                      <div class="row align-items-center border-bottom py-2">
                        <div class="col-md-2">
                          <input type="text" name="room_no[]" class="form-control" placeholder="E.g. 101">
                        </div>
                        <div class="col-md-2">
                          <input type="number" name="floor[]" class="form-control" placeholder="1">
                        </div>
                        <div class="col-md-2">
                          <select name="status[]" class="form-select" style="font-size: small">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="maintenance">Maintenance</option>

                          </select>

                          </h6>

                        </div>
                        <div class="col-md-4">
                          <input type="text" name="extra_info[]" class="form-control" placeholder="Any notes...">
                        </div>
                        <div class="col-md-2 text-center">
                          {{-- <a href="#" class="text-primary me-2" title="Edit"><i class="fas fa-edit"></i></a> --}}
                          <a href="#" class="text-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </div>

                      {{-- Add more rows as needed --}}
                    </div>

                    {{-- + Add New Feature link (bottom-right) --}}
                    <div class="container mt-2">
                      <div class="row">
                        <div class="col-12 text-end">
                          <h6><a href="#"
                              class="fw-bold text-primary text-decoration-none d-inline-flex align-items-center add-feature-link">
                              <i class="fas fa-plus me-2"></i> Add More Rooms
                            </a>
                          </h6>

                        </div>
                      </div>

                      <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Save Room</button>
                        <a href="#" class="btn btn-secondary">Cancel</a>
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



    <div class="row">

      <div class="col-3">
        <table class="table table-bordered table-striped custom-table mt-4">

          <tbody>
            <tr>
              <td>
                Information
              </td>
            </tr>

            <tr>
              <td>
                Prices
              </td>
            </tr>

            <tr>
              <td>
                Information
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-9">
        {{-- *** INFORMATION *** --}}

        <div class="card card-info shadow-sm mt-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Room Type Information</h5>
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
                        <label class="form-label">Room Type Name</label>
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

                      <div class="col-md-4">
                        <label class="form-label">Size (sq ft)</label>
                        <input type="number" name="size" class="form-control" required>
                      </div>

                      <div class="col-md-4">
                        <label class="form-label">Occupancy</label>
                        <input type="number" name="occupancy" class="form-control" required>
                      </div>

                      <div class="col-md-4">
                        <label class="form-label">Bed Type</label>
                        <select name="bed" class="form-select" required>
                          <option value="single">Single</option>
                          <option value="double">Double</option>
                          <option value="queen">Queen</option>
                          <option value="king">King</option>
                        </select>
                      </div>

                      <div class="col-12">
                        <label class="form-label d-block mb-2">Services</label>
                        <div class="row">
                          @php
                          $services = [
                          'Wi-Fi', 'Air Conditioning', 'Television', 'Mini Bar',
                          'Room Service', 'Laundry', 'Pool Access', 'Gym Access',
                          'Private Balcony', 'Sea View', 'Complimentary Breakfast', 'Safe Box'
                          ];
                          @endphp

                          @foreach($services as $service)
                          <div class="col-md-4 mb-2">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="services[]"
                                value="{{ strtolower(str_replace(' ', '_', $service)) }}"
                                id="service_{{ $loop->index }}">
                              <label class="form-check-label" for="service_{{ $loop->index }}">
                                {{ $service }}
                              </label>
                            </div>
                          </div>
                          @endforeach
                        </div>
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


        {{-- *** PAYMENT *** --}}
        <div class="card card-info shadow-sm mt-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Room Type Prices</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <!-- Add New Room Modal -->
                <div class="container mt-2">
                  <form action="#" method="POST">
                    @csrf

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Pre Tax Operating Cost</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Pre Tax Retail Price</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Tax Rule</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Retail Price with Tax</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="onSaleCheckbox" name="on_sale">
                      <label class="form-check-label" for="onSaleCheckbox">
                        Display the "On Sale" icon on the Room Type page and within the Room Type listing text.
                      </label>
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


        {{-- *** SEO *** --}}
        <div class="card card-info shadow-sm mt-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Room Type SEO</h5>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <!-- Add New Room Modal -->
                <div class="container mt-2">
                  <form action="#" method="POST">
                    @csrf

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Meta Title</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Meta Discription</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label me-3 mb-0" style="min-width: 180px;">Friendly URL</label>
                        <input type="number" name="basic_price" class="form-control" required>
                      </div>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>

                      <h5 class="mb-2">
                        <i class="icon fas fa-info"></i> Alert!
                      </h5>

                      <h6 class="mb-1 ms-4">The product link will look like this:</h6>
                      <h6 class="ms-4 fw-bold">
                        https://demo.qloapps.com/112-134-132-181/en/the-hotel-prime/15-xbfb.html
                      </h6>
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




        {{-- *** FEATURES *** --}}
        <div class="card card-info shadow-sm mt-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Assign Features to this Room Type</h5>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-12">
                <div class="container mt-2">
                  <div class="callout callout-info">
                    <div class="d-flex align-items-start">
                      <i class="icon fas fa-info fa-lg text-info me-3 mt-1"></i>
                      <div>
                        <h6 class="mb-0">
                          You can specify a value for each relevant feature regarding this room type. Empty fields
                          will not be displayed.
                          You can either create a specific value, or select among the existing pre-defined values
                          you've previously added.
                        </h6>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>


            <div class="row">
              <div class="col-12">

                <div class="container mt-2">

                  {{-- Paragraph --}}

                  {{-- Feature Form --}}
                  <form action="#" method="POST">
                    @csrf

                    {{-- Header Row --}}
                    <div class="container pt-2">
                      <div class="row fw-bold border-bottom">
                        <div class="col-md-3 text-center">
                          <h6>Select</h6>
                        </div>
                        <div class="col-md-5">
                          <h6>Feature</h6>
                        </div>
                        <div class="col-md-4">
                          <h6>Feature Image</h6>
                        </div>
                      </div>

                      @php
                      $features = [
                      ['name' => 'Wi‑Fi', 'image' => 'wifi.png'],
                      ['name' => 'Fridge', 'image' => 'fridge.png'],
                      ['name' => 'Air Conditioner','image' => 'ac.png'],
                      ['name' => 'Television', 'image' => 'tv.png'],
                      ['name' => 'Mini Bar', 'image' => 'minibar.png'],
                      ];
                      @endphp
                    </div>



                    <div class="container">
                      @foreach ($features as $index => $feature)
                      <div class="row align-items-center border-bottom mt-2 pb-2">
                        <div class="col-md-3 d-flex justify-content-center align-items-center ">
                          <input class="form-check-input" type="checkbox" name="features[]"
                            value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}" id="feature_{{ $index }}">
                        </div>
                        <div class="col-md-5">
                          <label class="form-check-label h6 mb-0" for="feature_{{ $index }}">
                            {{ $feature['name'] }}
                          </label>
                        </div>
                        <div class="col-md-4">
                          <h6 class="mb-0">
                            <img src="{{ asset('images/features/' . $feature['image']) }}" width="50"
                              alt="{{ $feature['name'] }}">
                          </h6>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </form>
                </div>

                {{-- + Add New Feature link (bottom-right) --}}
                <div class="container mt-2">
                  <div class="row">
                    <div class="col-12 text-end">
                      <h6><a href="#"
                          class="fw-bold text-primary text-decoration-none d-inline-flex align-items-center add-feature-link">
                          <i class="fas fa-plus me-2"></i> Add New Feature
                        </a>
                      </h6>

                    </div>
                  </div>

                  <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Save Room</button>
                    <a href="#" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>


              </div>
            </div>

          </div>
        </div>


        {{-- *** ADD ROOMS *** --}}
        <div class="card card-info shadow-sm mt-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Rooms</h5>
          </div>
          <div class="card-body">




            <div class="row">
              <div class="col-12">

                <div class="container mt-2">

                  <div class="row fw-bold border-bottom pb-2">
                    <div class="col-md-2">
                      <h6>Room No.</h6>
                    </div>
                    <div class="col-md-2">
                      <h6>Floor</h6>
                    </div>
                    <div class="col-md-2">
                      <h6>Status</h6>
                    </div>
                    <div class="col-md-4">
                      <h6>Extra Information</h6>
                    </div>
                    <div class="col-md-2 text-center">
                      <h6>Action</h6>
                    </div>
                  </div>

                  {{-- Example Room Row --}}
                  <div class="row align-items-center border-bottom py-2">
                    <div class="col-md-2">
                      <input type="text" name="room_no[]" class="form-control" placeholder="E.g. 101">
                    </div>
                    <div class="col-md-2">
                      <input type="number" name="floor[]" class="form-control" placeholder="1">
                    </div>
                    <div class="col-md-2">
                      <select name="status[]" class="form-select" style="font-size: small">
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>

                      </select>

                      </h6>

                    </div>
                    <div class="col-md-4">
                      <input type="text" name="extra_info[]" class="form-control" placeholder="Any notes...">
                    </div>
                    <div class="col-md-2 text-center">
                      {{-- <a href="#" class="text-primary me-2" title="Edit"><i class="fas fa-edit"></i></a> --}}
                      <a href="#" class="text-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                    </div>
                  </div>

                  {{-- Add more rows as needed --}}
                </div>

                {{-- + Add New Feature link (bottom-right) --}}
                <div class="container mt-2">
                  <div class="row">
                    <div class="col-12 text-end">
                      <h6><a href="#"
                          class="fw-bold text-primary text-decoration-none d-inline-flex align-items-center add-feature-link">
                          <i class="fas fa-plus me-2"></i> Add More Rooms
                        </a>
                      </h6>

                    </div>
                  </div>

                  <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Save Room</button>
                    <a href="#" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>


              </div>
            </div>

          </div>
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




<!-- Add New Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="#" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomModalLabel">Add New Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Room Type Name</label>
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
              <textarea name="description" class="form-control" rows="4" placeholder="Enter room details..."></textarea>
            </div>

            <div class="col-md-4">
              <label class="form-label">Size (sq ft)</label>
              <input type="number" name="size" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Occupancy</label>
              <input type="number" name="occupancy" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Bed Type</label>
              <select name="bed" class="form-select" required>
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="queen">Queen</option>
                <option value="king">King</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label d-block mb-2">Services</label>
              <div class="row">
                @php
                $services = [
                'Wi-Fi', 'Air Conditioning', 'Television', 'Mini Bar',
                'Room Service', 'Laundry', 'Pool Access', 'Gym Access',
                'Private Balcony', 'Sea View', 'Complimentary Breakfast', 'Safe Box'
                ];
                @endphp

                @foreach($services as $service)
                <div class="col-md-4 mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                      value="{{ strtolower(str_replace(' ', '_', $service)) }}" id="service_{{ $loop->index }}">
                    <label class="form-check-label" for="service_{{ $loop->index }}">
                      {{ $service }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Basic Price (LKR)</label>
              <input type="number" name="basic_price" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Total Rooms</label>
              <input type="number" name="total_rooms" class="form-control" required>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Room</button>
        </div>
      </form>
    </div>
  </div>


</div>
@endsection
@push('scripts')
@endpush