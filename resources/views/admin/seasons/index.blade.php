@php use App\Enums\RoomCategory;use Spatie\Permission\Models\Role; @endphp

@extends('admin.layouts.admin')

@section('title', 'Seasons')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Seasons</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Seasons</li>
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
                                <h3 class="card-title">Seasons List</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3" style="text-align: right;">
                                        <div class="dropdown d-inline-block">
                                            <a href="#" class="btn btn-primary mb-3">Add
                                                Season</a>
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
                            <th>Name</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($seasons as $season)
                            <tr>
                                <td>{{ $season->name }}</td>
                                <td>{{ $season->start_date }}</td>
                                <td>{{ $season->end_date }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.seasons.destroy', $season) }}" method="POST"
                                          class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Delete this season?')"
                                                class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
