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

  <div class="card-body">

    <table class="table table-bordered table-striped custom-table">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Adults</th>
          <th>Children</th>
          <th>Total Rooms</th>
          <th>Basic Price (LKR)</th>
          <th>Final Price (LKR)</th>
          <th>Show at Front</th>
          <th>Payment Type</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><img src="#" alt="Room 1" width="80" height="50"></td>
          <td>Sea View, Double Bed</td>
          <td>2</td>
          <td>1</td>
          <td>13</td>
          <td>Rs. 8,500.00</td>
          <td>Rs. 9,900.00</td>
          <td>Yes</td>
          <td>Online</td>
          <td class="text-center">
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td><img src="#" alt="Room 2" width="80" height="50"></td>
          <td>Balcony View, Single Bed</td>
          <td>4</td>
          <td>2</td>
          <td>15</td>
          <td>Rs. 6,000.00</td>
          <td>Rs. 7,200.00</td>
          <td>No</td>
          <td>Cash</td>
          <td class="text-center">
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td><img src="#" alt="Room 3" width="80" height="50"></td>
          <td>Garden View, Double Bed</td>
          <td>2</td>
          <td>0</td>
          <td>20</td>
          <td>Rs. 5,500.00</td>
          <td>Rs. 6,500.00</td>
          <td>Yes</td>
          <td>Card</td>
          <td class="text-center">
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td><img src="#" alt="Room 4" width="80" height="50"></td>
          <td>View Side, Single Bed</td>
          <td>4</td>
          <td>3</td>
          <td>17</td>
          <td>Rs. 7,000.00</td>
          <td>Rs. 8,500.00</td>
          <td>No</td>
          <td>Online</td>
          <td class="text-center">
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <td>5</td>
          <td><img src="#" alt="Room 5" width="80" height="50"></td>
          <td>Balcony View, Double Bed</td>
          <td>2</td>
          <td>1</td>
          <td>19</td>
          <td>Rs. 9,000.00</td>
          <td>Rs. 10,800.00</td>
          <td>Yes</td>
          <td>Card</td>
          <td class="text-center">
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>

</div>



</div>

{{-- {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
            // Check-In Modal
            const checkInModal = document.getElementById('checkInModal');
            if (checkInModal) {
                checkInModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('checkInForm');
                    const checkInBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${checkInBaseUrl}/${reservationId}/check-in`;
                });
            }

            // Check-Out Modal
            const checkOutModal = document.getElementById('checkOutModal');
            if (checkOutModal) {
                checkOutModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('checkOutForm');
                    const checkOutBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${checkOutBaseUrl}/${reservationId}/check-out`;
                });
            }

            // Add Charges Modal
            const addChargesModal = document.getElementById('addChargesModal');
            if (addChargesModal) {
                addChargesModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-bs-reservation');

                    const form = document.getElementById('addChargesForm');
                    const reservationExtraChargesBaseUrl = "{{ url('admin/reservations') }}";

                    form.action = `${reservationExtraChargesBaseUrl}/${reservationId}/add-charges`;
                });
            }

            // Edit Reservation Modal
            const editModal = document.getElementById('editReservationModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    // Set all form values
                    document.getElementById('reservationNo').value = button.getAttribute('data-id');
                    document.getElementById('editRoomReservation').value = button.getAttribute('data-roomRes');
                    document.getElementById('customerName').value = button.getAttribute('data-name');
                    document.getElementById('startDate').value = button.getAttribute('data-checkin');
                    document.getElementById('endDate').value = button.getAttribute('data-checkout');
                    document.getElementById('guests').value = button.getAttribute('data-guests');

                    // Special handling for room type dropdown
                    const roomTypeValue = button.getAttribute('data-roomtype');
                    const roomTypeSelect = document.querySelector('select[name="type"]');
                    if (roomTypeSelect) {
                        roomTypeSelect.value = roomTypeValue;
                    }
                });
            }
        });
</script>
@endpush