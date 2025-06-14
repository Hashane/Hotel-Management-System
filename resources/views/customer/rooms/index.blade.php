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
                            <label for="room_type">Accommodation Type:</label>
                            <select id="room_type" name="room_type" class="r-o-select">
                                <option value="any" {{ request('room_type') == '' ? 'selected' : '' }}>Any</option>
                                <option value="1" {{ request('room_type') == '1' ? 'selected' : '' }}>Standard</option>
                                <option value="2" {{ request('room_type') == '2' ? 'selected' : '' }}>Deluxe</option>
                                <option value="3" {{ request('room_type') == '3' ? 'selected' : '' }}>Suite</option>
                            </select>
                        </div>

                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="date" class="date-input" id="date-in" name="check_in"
                                   value="{{ request()->check_in ?? now()->toDateString() }}">
                            <i class="icon_calendar"></i>
                        </div>

                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="date" class="date-input" id="date-out" name="check_out"
                                   value="{{ request()->check_out ?? now()->addDay()->toDateString() }}">
                            <i class="icon_calendar"></i>
                        </div>

                        <button type="submit">Check Availability</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-10">
                @foreach ($rooms->chunk(2) as $roomChunk)
                    <div class="row">
                        @foreach ($roomChunk as $room)
                            <div class="col-lg-6">
                                <div class="room-item">
                                    <img class="room-img" src="{{ $room->image_url }}" alt="{{ $room->name }}"/>
                                    <div class="ri-text">
                                        <h4>{{ $room->name }}</h4>
                                        <h3>{{ $room->default_rate->pivot->price ?? 'N/A' }}$<span>/Per night</span>
                                        </h3>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="r-o">Size:</td>
                                                <td>{{ $room->size ?? '30 ft' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Capacity:</td>
                                                <td>Max person {{ $room->roomType->capacity ?? 2 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Bed:</td>
                                                <td>{{ $room->bed_type ?? 'King Beds' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Services:</td>
                                                <td>{{ implode(', ',(json_decode($room->roomType->facilities()->pluck('name'),true))) ?? 'Wifi, Television, Bathroom,...' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="primary-btn mb-3">More Details</a>
                                        <div class="row">
                                            <form action="{{ route('cart.add', $room) }}" method="POST"
                                                  class="d-flex justify-content-between w-100 gap-3">
                                                @csrf
                                                <input type="hidden" name="check_in" value="{{ request('check_in') }}">
                                                <input type="hidden" name="check_out"
                                                       value="{{ request('check_out') }}">
                                                <div class="w-50">
                                                    <select name="occupants" class="r-o-select w-100" required>
                                                        <option value="">Select Occupancy</option>
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
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Rooms Section End -->
@endsection
