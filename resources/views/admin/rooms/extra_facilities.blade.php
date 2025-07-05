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



<div class="content">
  <div class="container-fluid">
    <div class="card card-info shadow-sm mt-4">
      <div class="card-header">
        <h5 class="card-title mb-0">Assign Features to this Room Type</h5>
      </div>
      <div class="card-body">
        {{-- Info Callout --}}
        <div class="container mt-2">
          <div class="callout callout-info">
            <div class="d-flex align-items-start">
              <i class="icon fas fa-info fa-lg text-info me-3 mt-1"></i>
              <div>
                <h6 class="mb-0">
                  You can specify a value for each relevant feature regarding this room type. Empty fields will
                  not be
                  displayed.
                  You can either create a specific value, or select among the existing pre-defined values you've
                  previously
                  added.
                </h6>
              </div>
            </div>
          </div>
        </div>

        {{-- Feature Form --}}
        <div class="container">
          <form action="#" method="POST">
            @csrf

            {{-- Table Header --}}
            <div class="container pt-2">
              <div class="row fw-bold border-bottom pb-2">
                <div class="col-md-1 text-center">
                  <h6>Select</h6>
                </div>
                <div class="col-md-2">
                  <h6>Name</h6>
                </div>
                <div class="col-md-2">
                  <h6>Option</h6>
                </div>
                <div class="col-md-3">
                  <h6>Price</h6>
                </div>
                <div class="col-md-2">
                  <h6>Tax</h6>
                </div>
                <div class="col-md-2">
                  <h6>Calculate Per Day</h6>
                </div>
              </div>

              {{-- Feature Rows --}}
              @php
              $features = ['Extra Bed', 'Crib', 'Breakfast', 'Dinner'];
              @endphp

              @foreach ($features as $index => $feature)
              <div class="row align-items-center border-bottom py-2">

                {{-- Checkbox --}}
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" name="features[]"
                    value="{{ strtolower(str_replace(' ', '_', $feature)) }}" id="feature_{{ $index }}">
                </div>


                {{-- Name --}}
                <div class="col-md-2">
                  <label class="form-check-label h6 mb-0" for="feature_{{ $index }}">
                    {{ $feature }}
                  </label>
                </div>

                {{-- Option Dropdown (Only for Extra Bed) --}}
                <div class="col-md-2">
                  @if (strtolower($feature) === 'extra bed')
                  <select name="options[]" class="form-select" style="font-size: small">

                    <option value="1_extra_bed">1 Extra Bed</option>
                    <option value="2_extra_beds">2 Extra Beds</option>


                  </select>
                  @else
                  <input type="text" class="form-control" placeholder="N/A" disabled>
                  @endif
                </div>

                {{-- Price (Wider) --}}
                <div class="col-md-3">
                  <input type="number" step="0.01" name="prices[]" class="form-control" placeholder="0.00">
                </div>

                {{-- Tax Rule (Smaller) --}}
                <div class="col-md-2">
                  <input type="number" step="0.01" name="tax_rules[]" class="form-control" placeholder="%">
                </div>

                {{-- Per Day Calculation (Smaller) --}}
                <div class="col-md-2">
                  <select name="per_day_calc[]" class="form-select" style="font-size: small">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
              </div>
              @endforeach
            </div>

            <div class="container mt-3">
              <div class="row">
                <div class="col-12 text-end">
                  <h6>
                    <a href="#"
                      class="fw-bold text-primary text-decoration-none d-inline-flex align-items-center add-feature-link">
                      <i class="fas fa-plus me-2"></i> Add New Service
                    </a>
                  </h6>
                </div>
              </div>

              <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Save Room</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
              </div>
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

</div>

</div>



@endsection
@push('scripts')
@endpush