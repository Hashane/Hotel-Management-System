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
            <h1 class="mb-4">Seasonal Rates</h1>
            <form method="POST" action="{{ route('admin.seasonal-room-rates.store') }}">
                @csrf
                <table class="table table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th>Room Type</th>
                        @foreach ($seasons as $season)
                            <th>
                                {{ $season->name }}<br>
                                <small class="text-muted">{{ $season->start_date }}
                                    - {{ $season->end_date }}</small>
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roomTypes as $roomType)
                        <tr>
                            <td><strong>{{ $roomType->name }}</strong></td>
                            @foreach ($seasons as $season)
                                <td>
                                    <input
                                            type="number" step="0.01" min="0"
                                            name="rates[{{ $roomType->id }}][{{ $season->id }}]"
                                            value="{{ old("rates.{$roomType->id}.{$season->id}", $roomType->getSeasonalRoomRate($season->id)) }}"
                                            class="form-control" placeholder="$ Rate" required>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save Seasonal Rates</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
