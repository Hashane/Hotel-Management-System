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
            <h1>Room Rate Calendar</h1>

            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label>Room Type</label>
                    <select name="room_type_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($roomTypes as $room)
                            <option value="{{ $room->id }}" {{ $selectedRoom == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Rate Plan</label>
                    <select name="rate_plan_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($ratePlans as $plan)
                            <option value="{{ $plan->id }}" {{ $selectedRate == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ $start->toDateString() }}" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ $end->toDateString() }}" class="form-control">
                </div>

                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary">Load Rates</button>
                </div>
            </form>

            @if($selectedRoom && $selectedRate)
                <form method="POST" action="{{ route('admin.rate-calendar.update') }}">
                    @csrf
                    <input type="hidden" name="room_type_id" value="{{ $selectedRoom }}">
                    <input type="hidden" name="rate_plan_id" value="{{ $selectedRate }}">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($start->copy()->daysUntil($end) as $day)
                            <tr>
                                <td>{{ $day->toDateString() }}</td>
                                <td>
                                    <input type="hidden" name="rates[{{ $loop->index }}][date]"
                                           value="{{ $day->toDateString() }}">
                                    <input type="number" step="0.01" name="rates[{{ $loop->index }}][price]"
                                           class="form-control" value="{{ $rates[$day->toDateString()]->price ?? '' }}"
                                           required>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-success">Update Rates</button>
                </form>
            @endif
        </div>
    </section>
@endsection
@push('scripts')
@endpush
