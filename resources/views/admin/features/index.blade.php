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
  <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.features.create') }}'">
    <h6 class="mb-0"><i class="fas fa-plus me-1"></i> Add New Service</h6>
  </button>
</div>

<div class="card card-info shadow-sm mt-2">
  <div class="card-header">
    <h5 class="card-title mb-0">Assign Features to this Room Type</h5>
  </div>
  <div class="card-body">

    <div class="row">
      <div class="col-12">
        <div class="container mt-2">
          <div class="callout callout-info">
            <div class="d-flex align-items-start">
              <i class="icon fas fa-info fa-lg text-info me-3 mt-1"></i>
              <div>
                <h6 class="mb-0">
                  You can specify a value for each relevant feature regarding this room type.
                  Empty fields
                  will not be displayed.
                  You can either create a specific value, or select among the existing pre-defined
                  values
                  you've previously added.
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="container mt-2">
          {{-- Feature Form --}}
          <form action="#" method="POST">
            @csrf

            {{-- Header Row --}}
            <div class="container pt-2">
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
                <div class="col-md-2 text-center">
                  <h6>Action</h6>
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
            </div>

            {{-- Feature Rows --}}
            <div class="container">
              @foreach ($features as $index => $feature)
              <div class="row align-items-center border-bottom mt-2 pb-2">
                {{-- Checkbox --}}
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" name="features[]"
                    value="{{ strtolower(str_replace(' ', '_', $feature['name'])) }}" id="feature_{{ $index }}">
                </div>

                {{-- Feature Name --}}
                <div class="col-md-4">
                  <label class="form-check-label h6 mb-0" for="feature_{{ $index }}">
                    {{ $feature['name'] }}
                  </label>
                </div>

                {{-- Feature Image --}}
                <div class="col-md-3">
                  <h6 class="mb-0">
                    <img src="{{ asset('images/features/' . $feature['image']) }}" width="50"
                      alt="{{ $feature['name'] }}">
                  </h6>
                </div>

                {{-- Action Icon --}}
                <div class="col-md-2 text-center">
                  <i class="far fa-eye text-primary me-2" title="View"></i>
                  <i class="far fa-edit text-success me-2" title="Edit"></i>
                  <i class="far fa-trash-alt text-danger" title="Delete"></i>
                </div>
              </div>
              @endforeach
            </div>
          </form>
        </div>

        {{-- + Add New Feature link and Buttons --}}
        <div class="container mt-2">


          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">Save Room</button>
            <a href="#" class="btn btn-secondary">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
@push('scripts')
@endpush