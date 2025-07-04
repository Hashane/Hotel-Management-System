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
            <div class="booking-form">
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
            @foreach ($roomTypes->chunk(3) as $roomChunk)
            <div class="row">
                @foreach ($roomChunk as $roomType)
                <div class="col-lg-4">
                    <div class="room-item">
                        <img class="room-img" src="{{ $roomType->image_url }}" alt="{{ $roomType->name }}" />
                        <div class="ri-text">
                            <h4>{{ $roomType->name }} - {{ $roomType->available_rooms_count }}</h4>
                            <h3>{{ $roomType->rateTypes[0]->pivot->price ?? 'N/A' }}$<span>/Per night</span>
                            </h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{ $roomType->size ?? '30 ft' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max person {{ $roomType->capacity ?? 2 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>{{ $roomType->bed_type ?? 'King Beds' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Facilities:</td>
                                        <td>{{ implode(', ',(json_decode($roomType->facilities()->pluck('name'),true)))
                                            ?? 'Wifi, Television, Bathroom,...'
                                            }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn mb-3">More Details</a>
                            <div class="row">
                                <form action="{{ route('cart.add', ['roomType' => $roomType]) }}" method="POST"
                                    class="d-flex justify-content-between w-100 gap-3">
                                    @csrf
                                    <input type="hidden" name="check_in" value="{{ request('check_in') }}">
                                    <input type="hidden" name="check_out" value="{{ request('check_out') }}">
                                    <div class="w-50">
                                        <select name="occupants" class="r-o-select w-100" required>
                                            <option value="">GUEST COUNT</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>

                                    <div class="w-50">
                                        <button type="submit" class="r-o-button3 w-100">Book Now</button>
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
                <div class="room-pagination" style="margin-bottom: 20px;">
                    {{ $roomTypes->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Rooms Section End -->
@endsection