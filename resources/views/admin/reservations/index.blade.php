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
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Reservations List</h3>
                    <a href="{{-- route('admin.reservations.create') --}}" class="btn btn-primary btn-sm">Add Reservation</a>
                </div>
                <div class="card-body">
                    <table id="reservations" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($reservations)
                        @foreach($reservations as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->email }}</td>
                                <td>{{ $r->date }}</td>
                                <td>{{ $r->time }}</td>
                                <td>
                                    <a href="{{-- route('admin.reservations.edit', $r) --}}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{-- route('admin.reservations.destroy', $r) --}}" method="POST" class="d-inline" onsubmit="return confirm('Delete this?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
{{--    {{ $reservations->links() }} --}}{{-- Laravel pagination links --}}
@endsection

