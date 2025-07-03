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