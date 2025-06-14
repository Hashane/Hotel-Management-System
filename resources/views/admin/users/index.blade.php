@php use App\Enums\RoomType;use Spatie\Permission\Models\Role; @endphp

@extends('admin.layouts.admin')

@section('title', 'Users')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Users</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content vertical-align-items-center">
                    <div class="container" style="max-width: 100%">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Users List</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3" style="text-align: right;">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="search" placeholder="Search"
                                               aria-label="Search">
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
                    <table id="users" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->roles->first()?->name) ?? 'No Role' }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-3 py-1">
                                        <button type="button"
                                                class="btn btn-sm btn-success px-3 w-100" style="max-width: 160px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal"
                                                data-bs-user="{{ $user->id }}">
                                            <i class="fas fa-door-open me-1"></i> Edit
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-warning px-3 w-100"
                                                style="max-width: 160px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#assignRoleModal"
                                                data-bs-user="{{ $user->id }}"
                                                data-bs-roles="{{ $user->getRoleNames()->implode(',') }}">
                                            <i class="fas fa-user-tag me-1"></i> Assign Role
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <form method="POST"
                          action="{{ $user ? route('admin.users.update', ['user' => $user]) : '#' }}"
                          id="editUserForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="reservationId" class="form-label">User No.</label>
                                    <input type="text" id="reservationNo" class="form-control" readonly>
                                    <input type="hidden" name="room_reservation_id" id="editRoomUser" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="customerName" class="form-label">Name</label>
                                    <input type="text" name="name" id="customerName" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" name="start" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" name="end" id="endDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomType" class="form-label">Room Type</label>
                                        <x-room-type-dropdown
                                                :selected="$user->room->roomType->id ?? old('room_type_id')"
                                                name="type"
                                                class="custom-class"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="guests" class="form-label">Guests</label>
                                    <input type="number" name="guests" id="guests" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Assign Role Modal -->
        <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="assignRoleForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="assignRoleLabel">Assign Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="assignRoleUserId">

                            <div class="mb-3">
                                <label for="roles" class="form-label">Select Role</label>
                                <select name="role" id="assignRoleSelect" class="form-select" required>
                                    @foreach(Role::all() as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Assign</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

    {{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const assignRoleModal = document.getElementById('assignRoleModal');
            assignRoleModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-bs-user');
                const userRole = (button.getAttribute('data-bs-roles') || '').trim();

                // form action
                const form = assignRoleModal.querySelector('#assignRoleForm');
                form.action = `/admin/users/${userId}/assign-role`;

                form.querySelector('#assignRoleUserId').value = userId;

                const select = form.querySelector('#assignRoleSelect');
                for (const option of select.options) {
                    option.selected = (option.value === userRole);
                }
            });


            {{--// Check-In Modal--}}
            {{--const checkInModal = document.getElementById('checkInModal');--}}
            {{--if (checkInModal) {--}}
            {{--    checkInModal.addEventListener('show.bs.modal', function (event) {--}}
            {{--        const button = event.relatedTarget;--}}
            {{--        const reservationId = button.getAttribute('data-bs-user');--}}

            {{--        const form = document.getElementById('checkInForm');--}}
            {{--        const checkInBaseUrl = "{{ url('admin/users') }}";--}}

            {{--        form.action = `${checkInBaseUrl}/${reservationId}/check-in`;--}}
            {{--    });--}}
            {{--}--}}

            {{--// Check-Out Modal--}}
            {{--const checkOutModal = document.getElementById('checkOutModal');--}}
            {{--if (checkOutModal) {--}}
            {{--    checkOutModal.addEventListener('show.bs.modal', function (event) {--}}
            {{--        const button = event.relatedTarget;--}}
            {{--        const reservationId = button.getAttribute('data-bs-user');--}}

            {{--        const form = document.getElementById('checkOutForm');--}}
            {{--        const checkOutBaseUrl = "{{ url('admin/users') }}";--}}

            {{--        form.action = `${checkOutBaseUrl}/${reservationId}/check-out`;--}}
            {{--    });--}}
            {{--}--}}

            {{--// Add Charges Modal--}}
            {{--const addChargesModal = document.getElementById('addChargesModal');--}}
            {{--if (addChargesModal) {--}}
            {{--    addChargesModal.addEventListener('show.bs.modal', function (event) {--}}
            {{--        const button = event.relatedTarget;--}}
            {{--        const reservationId = button.getAttribute('data-bs-user');--}}

            {{--        const form = document.getElementById('addChargesForm');--}}
            {{--        const reservationExtraChargesBaseUrl = "{{ url('admin/users') }}";--}}

            {{--        form.action = `${reservationExtraChargesBaseUrl}/${reservationId}/add-charges`;--}}
            {{--    });--}}
            {{--}--}}

            {{--// Edit User Modal--}}
            {{--const editModal = document.getElementById('editUserModal');--}}
            {{--if (editModal) {--}}
            {{--    editModal.addEventListener('show.bs.modal', function (event) {--}}
            {{--        const button = event.relatedTarget;--}}

            {{--        // Set all form values--}}
            {{--        document.getElementById('reservationNo').value = button.getAttribute('data-id');--}}
            {{--        document.getElementById('editRoomUser').value = button.getAttribute('data-roomRes');--}}
            {{--        document.getElementById('customerName').value = button.getAttribute('data-name');--}}
            {{--        document.getElementById('startDate').value = button.getAttribute('data-checkin');--}}
            {{--        document.getElementById('endDate').value = button.getAttribute('data-checkout');--}}
            {{--        document.getElementById('guests').value = button.getAttribute('data-guests');--}}

            {{--        // Special handling for room type dropdown--}}
            {{--        const roomTypeValue = button.getAttribute('data-roomtype');--}}
            {{--        const roomTypeSelect = document.querySelector('select[name="type"]');--}}
            {{--        if (roomTypeSelect) {--}}
            {{--            roomTypeSelect.value = roomTypeValue;--}}
            {{--        }--}}
            {{--    });--}}
            {{--}--}}
        });
    </script>
@endpush
