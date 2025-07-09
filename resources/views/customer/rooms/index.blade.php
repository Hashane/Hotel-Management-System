@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="{{ route('home')}}">Home</a>
                        <span>Rooms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->


<!-- Rooms Section Begin -->
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="booking-form mb-5">
                <h3>Booking Your Hotel</h3>
                <form action="{{ route('rooms.index') }}" method="GET">
                    <div class="select-option">
                        <label for="room_category">Accommodation Category:</label>
                        <select id="room_category" name="room_category" class="r-o-select">
                            @php
                            $selectedRoomType = old('room_category', request('room_category', 'any'));
                            @endphp
                            <option value="any" {{ $selectedRoomType=='any' ? 'selected' : '' }}>Any</option>
                            <option value="1" {{ $selectedRoomType=='1' ? 'selected' : '' }}>Standard</option>
                            <option value="2" {{ $selectedRoomType=='2' ? 'selected' : '' }}>Deluxe</option>
                            <option value="3" {{ $selectedRoomType=='3' ? 'selected' : '' }}>Suite</option>
                        </select>
                        <x-input-error :messages="$errors->get('room_category')" class="mt-2" />
                    </div>

                    <div class="check-date">
                        <label for="date-in">Check In:</label>
                        <input type="date" class="date-input" id="date-in" name="check_in"
                            value="{{ old('check_in', request('check_in', now()->toDateString())) }}">
                        <i class="icon_calendar"></i>
                        <x-input-error :messages="$errors->get('check_in')" class="mt-2" />
                    </div>

                    <div class="check-date">
                        <label for="date-out">Check Out:</label>
                        <input type="date" class="date-input" id="date-out" name="check_out"
                            value="{{ old('check_out', request('check_out', now()->toDateString())) }}">
                        <i class="icon_calendar"></i>
                        <x-input-error :messages="$errors->get('check_out')" class="mt-2" />
                    </div>

                    <button type="submit">Check Availability</button>
                </form>
            </div>
        </div>

        <div class="col-lg-10">
            @if(isset($message))
            <div class="alert alert-warning">{{ $message }}</div>
            @else
            @foreach ($roomTypes->chunk(3) as $roomChunk)
            <div class="row">
                @foreach ($roomChunk as $roomType)
                <div class="col-lg-4 mb-4">
                    <div class="room-item">

                        <img class="room-img" src="{{ $roomType->image_url ?? asset('images/default-room.jpg') }}"
                            alt="{{ $roomType->name }}" />


                        <div class="ri-text">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>{{ $roomType->name }} - {{ $roomType->available_rooms_count ?? 0 }}</h5>

                                </div>
                            </div>

                            <div class="row mt-2 mb-2">
                                <div class="col d-flex align-items-baseline">
                                    <h4 class="mb-0 me-2">
                                        {{ $roomType->rateTypes[0]->pivot->price ?? 'N/A' }} $
                                    </h4>
                                    <h6 class="mb-0"><span>/Per night</span></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 me-2">Size:</p>
                                    <p class="mb-0">
                                        {{ $roomType->size ?? '30 ft' }}
                                    </p>
                                </div>

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 me-2">Capacity:
                                    </p>
                                    <p class="mb-0" style="letter-spacing: 0.05em; line-height: 1.8;">
                                        Max person {{ $roomType->capacity ?? 2 }}
                                    </p>
                                </div>

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 me-2">Bed:</p>
                                    <p class="mb-0" style="letter-spacing: 0.05em; line-height: 1.8;">
                                        {{ $roomType->bed_type ?? 'King Bed' }}
                                    </p>
                                </div>

                                <div class="col-md-12 d-flex align-items-start">
                                    <p class="mb-0 me-2">
                                        Facilities:
                                    </p>
                                    <p class="mb-0" style="letter-spacing: 0.05em; line-height: 1.8;">
                                        {{
                                        $roomType->facilities()->pluck('name')->implode(', ') ??
                                        'Wifi, Television, Bathroom,...'
                                        }}
                                    </p>
                                </div>
                            </div>





                            <div class="col-md-12">
                                <a href="#" class="primary-btn mb-3 mt-3"
                                    onclick="window.location='{{ route('rooms.show') }}'">More Details</a>
                            </div>

                            <div class="row">
                                <form action="{{ route('cart.add', ['roomType' => $roomType]) }}" method="POST"
                                    class="w-100">
                                    @csrf
                                    <input type="hidden" name="check_in" value="{{ request('check_in') }}">
                                    <input type="hidden" name="check_out" value="{{ request('check_out') }}">

                                    <div class="row g-3">
                                        <div class="col-md-6 col-12">
                                            <select name="occupants" class="r-o-select w-100" required>
                                                <option value="">GUEST COUNT</option>
                                                @for ($i = 1; $i <= ($roomType->capacity ?? 3); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <button type="submit" class="r-o-button3 w-100">Book Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach

            <div class="col-lg-12">
                <div class="room-pagination mb-4">
                    {{ $roomTypes->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Rooms Section End -->
@endsection