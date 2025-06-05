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
                    <form action="#">
                        <div class="select-option">
                            <label for="guest">Accommodation Type:</label>
                            <select id="guest">
                                <option value="">Standard</option>
                                <option value="">Long Stay Residence</option>
                            </select>
                        </div>
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="text" class="date-input" id="date-in"/>
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="text" class="date-input" id="date-out"/>
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
                                    <img src="{{ $room->image_url }}" alt="{{ $room->name }}" />
                                    <div class="ri-text">
                                        <h4>{{ $room->name }}</h4>
                                        <h3>{{ 2 }}$<span>/Per night</span></h3>
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
                                        <a href="#" class="primary-btn">More Details</a>
                                        <div class="row">
                                            <button class="col-sm-7 r-o-button" style="margin-right: 20px;">Select Occupancy</button>
                                            <button class="col-sm-4 r-o-button2">Book Now</button>
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
