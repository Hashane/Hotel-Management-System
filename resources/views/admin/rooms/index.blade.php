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
        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.rooms.create') }}'">
            <h6 class="mb-0"><i class="fas fa-plus me-1"></i> Add New Rooms Type</h6>
        </button>
    </div>


    <div class="card card-info shadow-sm mt-2">
        <div class="card-header">
            <h5 class="card-title mb-0">Room Types</h5>
        </div>


        <div class="card-body">

            <table class="table table-bordered table-striped custom-table">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Adults</th>
                    <th>Total Rooms</th>
                    <th>Basic Price (LKR)</th>
                    {{-- <th>Status</th>--}}
                    {{-- <th>Payment Type</th>--}}
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roomTypes as $roomType)
                    <tr>
                        <td>{{ $roomType->id }}</td>
                        <td>{{ $roomType->name }}</td>
                        <td>{{ $roomType->name }}</td>
                        <td>{{ $roomType->capacity }}</td>
                        <td>{{ $roomType->roomCount }}</td>
                        <td>{{ $roomType->rateTypes[0]->pivot->price }}</td>
                        <td class="text-center">
                            <i class="far fa-eye text-primary me-2" data-bs-toggle="modal"
                               data-bs-target="#viewRoomTypeModal"
                               title="View"></i>
                            <i class="far fa-edit text-success me-2" data-bs-toggle="modal"
                               data-bs-target="#editRoomTypeModal"
                               title="Edit Room Type" role="button"></i>
                            <i class="far fa-trash-alt text-danger" data-bs-toggle="modal"
                               data-bs-target="#confirmDeleteModal"
                               title="Delete"></i>
                        </td>
                    </tr>
                @empty
                    <tr>No Rooms</tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Room Type Modal -->
    <div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-labelledby="editRoomTypeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold text-dark" id="editRoomTypeModalLabel">
                        <i class="fas fa-bed me-2"></i>Edit Room Type
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">

                        <!-- General Information -->
                        <h5 class="fw-bold text-dark mb-2">General Information</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Name</label>
                                    <input type="text" name="name" class="form-control" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Status</label>
                                    <select name="status" class="form-select">
                                        <option selected>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label h6">Description</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="form-label h6">Size (sq ft)</label>
                                    <input type="number" name="size" class="form-control" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label h6">Occupancy</label>
                                    <input type="number" name="occupancy" class="form-control" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label h6">Bed Type</label>
                                    <input type="text" name="bed_type" class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Details -->
                        <h5 class="fw-bold text-dark mb-2">Pricing Details</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Pre-Tax Operating Cost</label>
                                    <input type="number" name="pre_tax_operating" class="form-control" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Pre-Tax Retail Price</label>
                                    <input type="number" name="pre_tax_retail" class="form-control" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Tax Rule (%)</label>
                                    <input type="number" name="tax_rule" class="form-control" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Retail Price (Incl. Tax)</label>
                                    <input type="number" name="retail_price_with_tax" class="form-control" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center pt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="on_sale_icon"
                                               id="onSaleIconCheckbox">
                                        <label class="form-check-label h6" for="onSaleIconCheckbox">
                                            Display the "On Sale" icon on the Room Type page and within the Room Type
                                            listing text.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO -->
                        <h5 class="fw-bold text-dark mb-2">SEO</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="mb-3">
                                <label class="form-label h6">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label h6">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3"></textarea>
                            </div>
                            <div>
                                <label class="form-label h6">Friendly URL</label>
                                <input type="text" name="friendly_url" class="form-control" value="">
                            </div>
                        </div>

                        <!-- Features -->
                        <h5 class="fw-bold text-dark mb-2">Features</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row fw-bold border-bottom">
                                <div class="col-md-3 text-center">
                                    <h6>Select</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Name</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Logo</h6>
                                </div>
                            </div>
                            <!-- Feature loop assumed to be inserted here -->
                        </div>

                        <!-- Rooms -->
                        <h5 class="fw-bold text-dark mb-2">Rooms</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
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
                                <div class="col-md-5">
                                    <h6>Extra Info</h6>
                                </div>
                                <div class="col-md-1 text-center">
                                    <h6>Action</h6>
                                </div>
                            </div>

                            <div class="row align-items-center border-bottom py-2">
                                <div class="col-md-2">
                                    <input type="text" name="room_no[]" class="form-control" placeholder="E.g. 101">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="floor[]" class="form-control" placeholder="1">
                                </div>
                                <div class="col-md-2">
                                    <select name="status[]" class="form-select">
                                        <option value="available">Available</option>
                                        <option value="occupied">Occupied</option>
                                        <option value="maintenance">Maintenance</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="extra_info[]" class="form-control"
                                           placeholder="Any notes...">
                                </div>
                                <div class="col-md-1 text-center">
                                    <a href="#" class="text-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Services Section -->
                        <h5 class="fw-bold text-dark mb-3">Services</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
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
                                </div>

                                @php
                                    $services = [
                                    ['name' => 'Wi‑Fi', 'image' => 'wifi.png', 'base_price' => '100.00', 'final_price' => '110.00'],
                                    ['name' => 'Fridge', 'image' => 'fridge.png', 'base_price' => '150.00', 'final_price' => '165.00'],
                                    ['name' => 'Air Conditioner', 'image' => 'ac.png', 'base_price' => '200.00', 'final_price' => '220.00'],
                                    ['name' => 'Television', 'image' => 'tv.png', 'base_price' => '120.00', 'final_price' => '132.00'],
                                    ['name' => 'Mini Bar', 'image' => 'minibar.png', 'base_price' => '180.00', 'final_price' => '198.00'],
                                    ];
                                @endphp

                                <div class="container">
                                    @foreach ($services as $index => $service)
                                        <div class="row align-items-center border-bottom mt-2 pb-2">
                                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                <input class="form-check-input" type="checkbox" name="services[]"
                                                       value="{{ strtolower(str_replace(' ', '_', $service['name'])) }}"
                                                       id="service_{{ $index }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-check-label h6 mb-0" for="service_{{ $index }}">
                                                    {{ $service['name'] }}
                                                </label>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-0">{{ $service['base_price'] }}</h6>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-0">{{ $service['final_price'] }}</h6>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-0">
                                                    <img src="{{ asset('images/features/' . $service['image']) }}"
                                                         width="40"
                                                         alt="{{ $service['name'] }}">
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- Additional Facilities -->
                        <h5 class="fw-bold text-dark mb-3">Additional Facilities</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="container mt-2">

                                <div class="row fw-bold border-bottom pb-2">
                                    <div class="col-md-2 text-center">
                                        <h6>Select</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Name</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Base Price</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Final Price</h6>
                                    </div>
                                </div>

                                @php
                                    $facilities = [
                                    ['name' => 'Single Bed', 'base_price' => '100.00', 'final_price' => '110.00'],
                                    ['name' => 'Parking', 'base_price' => '150.00', 'final_price' => '165.00'],
                                    ['name' => 'Air Conditioner', 'base_price' => '200.00', 'final_price' => '220.00'],
                                    ['name' => 'Television', 'base_price' => '120.00', 'final_price' => '132.00'],
                                    ['name' => 'Mini Bar', 'base_price' => '180.00', 'final_price' => '198.00'],
                                    ];
                                @endphp

                                @foreach ($facilities as $index => $facility)
                                    <div class="row align-items-center border-bottom mt-2 pb-2">
                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                            <input class="form-check-input" type="checkbox"
                                                   name="additional_facilities[]"
                                                   value="{{ strtolower(str_replace(' ', '_', $facility['name'])) }}"
                                                   id="facility_{{ $index }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-check-label h6 mb-0" for="facility_{{ $index }}">
                                                {{ $facility['name'] }}
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="mb-0">{{ $facility['base_price'] }}</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="mb-0">{{ $facility['final_price'] }}</h6>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- iamges Section -->
                        <h5 class="fw-bold text-dark mb-3">Visual Representation</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="container mt-2">

                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label h6">Add Image</label>
                                                <input type="file" id="fileInput" name="file" class="d-none">
                                                <button type="button"
                                                        class="btn btn-outline-primary d-inline-flex align-items-center ms-4"
                                                        onclick="document.getElementById('fileInput').click();">
                                                    <i class="fas fa-file me-2"></i> Add File
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Image List Header -->
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

                                                <!-- Feature Image Rows -->
                                        <div class="container">
                                            @foreach ($features as $index => $feature)
                                                <div class="row align-items-center border-bottom mt-2 pb-2">
                                                    <div class="col-md-4">
                                                        <h6 class="mb-0">
                                                            <img src="{{ asset('images/features/' . $feature['image']) }}"
                                                                 width="50"
                                                                 alt="{{ $feature['name'] }}">
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="cover_image"
                                                               value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}"
                                                               id="cover_{{ $index }}">
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <button type="button" class="btn btn-link text-danger p-0"
                                                                title="Delete">
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
                    <button type="button" class="btn btn-success">Save Room</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- View Room Type Modal -->
    <div class="modal fade" id="viewRoomTypeModal" tabindex="-1" aria-labelledby="viewRoomTypeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-light border-bottom">
                    <h6 class="modal-title fw-bold text-dark" id="viewRoomTypeModalLabel">Room Type Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">

                        <!-- General Information -->
                        <h5 class="fw-bold text-dark mb-2">General Information</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Name</label>
                                    <p class="form-control-plaintext h6">Deluxe Room</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Status</label>
                                    <p class="form-control-plaintext h6">Active</p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label h6">Description</label>
                                <p class="form-control-plaintext h6">Spacious room with sea view and modern
                                    furnishings.</p>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label h6">Size (sq ft)</label>
                                    <p class="form-control-plaintext h6">400</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label h6">Occupancy</label>
                                    <p class="form-control-plaintext h6">2 Adults</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label h6">Bed Type</label>
                                    <p class="form-control-plaintext h6">King Size</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Details -->
                        <h5 class="fw-bold text-dark mb-2">Pricing Details</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Pre-Tax Operating Cost</label>
                                    <p class="form-control-plaintext h6">Rs. 5,000</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Pre-Tax Retail Price</label>
                                    <p class="form-control-plaintext h6">Rs. 7,000</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label h6">Tax Rule (%)</label>
                                    <p class="form-control-plaintext h6">15%</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Retail Price (Incl. Tax)</label>
                                    <p class="form-control-plaintext h6">Rs. 8,050</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label h6">On Sale Icon</label>
                                    <p class="form-control-plaintext h6">Yes</p>
                                </div>
                            </div>
                        </div>

                        <!-- SEO -->
                        <h5 class="fw-bold text-dark mb-3">SEO</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="mb-3">
                                <label class="form-label h6">Meta Title</label>
                                <p class="form-control-plaintext h6">Deluxe Sea View Room</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label h6">Meta Description</label>
                                <p class="form-control-plaintext h6">Experience luxury in our deluxe room with a
                                    panoramic sea view.</p>
                            </div>
                            <div>
                                <label class="form-label h6">Friendly URL</label>
                                <p class="form-control-plaintext h6">/room-types/deluxe-room</p>
                            </div>
                        </div>

                        <!-- Features -->
                        <h5 class="fw-bold text-dark mb-2">Features</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row fw-bold border-bottom">
                                <div class="col-md-4 text-center">
                                    <h6>Select</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Name</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Logo</h6>
                                </div>
                            </div>
                            <div class="row align-items-center border-bottom py-2">
                                <div class="col-md-4 text-center mb-4"><input class="form-check-input" type="checkbox"
                                                                              checked disabled>
                                </div>
                                <div class="col-md-4">
                                    <p class="form-control-plaintext h6">Wi-Fi</p>
                                </div>
                                <div class="col-md-4"><img alt="wifi" src="{{ asset('images/features/wifi.png') }}"
                                                           width="40">
                                </div>
                            </div>
                        </div>

                        <!-- Rooms -->
                        <h5 class="fw-bold text-dark mb-2">Rooms</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row fw-bold border-bottom pb-2">
                                <div class="col-md-2">
                                    <h6>Room No.</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Floor</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Status</h6>
                                </div>
                                <div class="col-md-5">
                                    <h6>Extra Info</h6>
                                </div>
                            </div>
                            <div class="row border-bottom py-2">
                                <div class="col-md-2">
                                    <p class="form-control-plaintext">101</p>
                                </div>
                                <div class="col-md-2">
                                    <p class="form-control-plaintext">1</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext">Available</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="form-control-plaintext">Near elevator</p>
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <h5 class="fw-bold text-dark mb-3">Services</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row fw-bold border-bottom pb-2">
                                <div class="col-md-1 text-center">
                                    <h6>Select</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Name</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Base Price</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Final Price</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Feature Image</h6>
                                </div>
                            </div>
                            <div class="row align-items-center border-bottom mt-2 pb-2">
                                <div class="col-md-1 text-center mb-4"><input class="form-check-input" type="checkbox"
                                                                              checked disabled>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext h6">Wi-Fi</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext h6">100.00</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext h6">110.00</p>
                                </div>
                                <div class="col-md-2"><img alt="wifi" src="{{ asset('images/features/wifi.png') }}"
                                                           width="40">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Facilities -->
                        <h5 class="fw-bold text-dark mb-3">Additional Facilities</h5>
                        <div class="bg-body-tertiary p-4 rounded mb-4">
                            <div class="row fw-bold border-bottom pb-2">
                                <div class="col-md-2 text-center">
                                    <h6>Select</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Name</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Base Price</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Final Price</h6>
                                </div>
                            </div>
                            <div class="row align-items-center border-bottom mt-2 pb-2">
                                <div class="col-md-2 text-center mb-4"><input class="form-check-input" type="checkbox"
                                                                              checked disabled>
                                </div>
                                <div class="col-md-4">
                                    <p class="form-control-plaintext h6">Parking</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext h6">150.00</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control-plaintext h6">165.00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Representation -->
                        <h5 class="fw-bold text-dark mb-2">Visual Representation</h5>
                        <div class="bg-body-tertiary p-4 rounded">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label h6">Feature Image</label>
                                    <div class="border p-2 rounded" style="max-width: 150px;">
                                        <img src="{{ asset('images/features/sample-room.jpg') }}" alt="Room"
                                             class="img-fluid rounded">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label h6">Cover Image</label>
                                    <p class="form-control-plaintext h6">Yes</p>
                                </div>
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

    <!-- Add New Room Modal -->
    {{-- <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
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


    </div> --}}
@endsection
@push('scripts')
@endpush