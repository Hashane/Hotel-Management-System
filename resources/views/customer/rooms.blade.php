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
                <!-- <section class="rooms-section"> -->
                <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-1.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Premium King Room</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 3</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button class="col-7 r-o-button">Select Ocupancy</button>
                                    <button class="col-4 r-o-button2">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-2.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Deluxe Room</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 5</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button type="button" class="col-sm-7 r-o-button" style="margin-right: 20px;">Select
                                        Ocupancy
                                    </button>
                                    <button class="col-sm-4 r-o-button2">Book Now</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-3.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Double Room</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 2</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button class="col-sm-7 r-o-button" style="margin-right: 20px;">Select Ocupancy
                                    </button>
                                    <button class="col-sm-4 r-o-button2">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-4.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Luxury Room</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 1</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button class="col-sm-7 r-o-button" style="margin-right: 20px;">Select Ocupancy
                                    </button>
                                    <button class="col-sm-4 r-o-button2">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-5.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Room With View</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 1</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button class="col-sm-7 r-o-button" style="margin-right: 20px;">Select Ocupancy
                                    </button>
                                    <button class="col-sm-4 r-o-button2">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="room-item">
                            <img class="room-img" src="{{ asset('images/room/room-6.jpg') }}" alt=""/>
                            <div class="ri-text">
                                <h4>Small View</h4>
                                <h3>159$<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 2</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                                <div class="row">
                                    <button class="col-sm-7 r-o-button" style="margin-right: 20px;">Select Ocupancy
                                    </button>
                                    <button class="col-sm-4 r-o-button2">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="room-pagination" style="margin-bottom: 20px;">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rooms Section End -->
@endsection
