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


<div class="card shadow-sm mt-4">
  <div class="card-header">
    <h5 class="card-title mb-0">Room Types</h5>
  </div>


</div>



<div class="card shadow-sm mt-4">
  <div class="card-header">
    <h5 class="card-title mb-0">Room Types</h5>
  </div>

  <div class=" d-flex justify-content-end align-items-center">

    <button type=" button" class="add-room-button btn btn-success" data-bs-toggle="modal"
      data-bs-target="#addRoomModal">
      <i class="fas fa-plus-circle me-1"></i> Add New Room Type
    </button>
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
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        @empty
        <tr>No Rooms</tr>
        @endforelse
      </tbody>
    </table>

  </div>



</div>

</div>





<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <table class="table table-bordered table-striped custom-table">
          <thead class="table-light">
            <tr>
              <th>New Room Type</th>
            </tr>
          </thead>
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

          </tbody>
        </table>
      </div>

      <div class="col-9">
        <div class="card shadow-sm mt-4">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <!-- Add New Room Modal -->
                <div class="container mt-4">
                  <h4 class="mb-4">Add New Room</h4>
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