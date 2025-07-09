@php use App\Enums\RoomCategory;use Spatie\Permission\Models\Role; @endphp

@extends('admin.layouts.admin')

@section('title', 'Seasons')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Seasons</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Rate Restrictions</li>
        </ol>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <h1 class="mb-4">Rate Restrictions</h1>
            <form action="{{ route('admin.rate-restrictions.store') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Room Type</th>
                        <th>Rate Plan</th>
                        <th>Date</th>
                        <th>Min Stay</th>
                        <th>Stop Sell</th>
                        <th>Closed to Arrival</th>
                        <th>Closed to Departure</th>
                    </tr>
                    </thead>
                    <tbody>
                    @empty($restrictions)
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Restrictions not defined yet.
                            </td>
                        </tr>
                    @endempty
                    @foreach ($period as $day)
                        <tr>
                            <td>{{ optional($restrictions[$day->toDateString()])->roomType->name }}</td>
                            <td>{{ optional( $restrictions[$day->toDateString()])->roomType->name }}</td>
                            <td>{{ $day->toDateString() }}</td>
                            <td>
                                <input type="number" name="restrictions[{{ $loop->index }}][min_stay]"
                                       class="form-control"
                                       value="{{ $restrictions[$day->toDateString()]->min_stay ?? '' }}">
                                <input type="hidden" name="restrictions[{{ $loop->index }}][date]"
                                       value="{{ $day->toDateString() }}">
                            </td>
                            <td><input type="checkbox"
                                       name="restrictions[{{ $loop->index }}][stop_sell]" {{ optional($restrictions[$day->toDateString()])->stop_sell ? 'checked' : '' }}>
                            </td>
                            <td><input type="checkbox"
                                       name="restrictions[{{ $loop->index }}][closed_to_arrival]" {{ optional($restrictions[$day->toDateString()])->closed_to_arrival ? 'checked' : '' }}>
                            </td>
                            <td><input type="checkbox"
                                       name="restrictions[{{ $loop->index }}][closed_to_departure]" {{ optional($restrictions[$day->toDateString()])->closed_to_departure ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary">Save Restrictions</button>
            </form>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
