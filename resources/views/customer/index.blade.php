@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
    <body>
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Four Seasons – A Luxury Residence</h1>
                        <p>
                            Discover refined living at Four Seasons, a luxury residence designed for comfort and elegance.
                            Perfect for travelers seeking a peaceful, home-like stay with upscale amenities and
                            personalized service.
                        </p>
                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form" style="padding: 30px 40px 50px 40px;">
                        <h3>Booking Your Hotel</h3>
                        <form action="{{ route('rooms') }}" method="GET">
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
                                <input type="date" class="date-input" id="date-in" name="check_in" value="{{ request('check_in') }}" />
                                <i class="icon_calendar"></i>
                            </div>

                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="date" class="date-input" id="date-out" name="check_out" value="{{ request('check_out') }}" />
                                <i class="icon_calendar"></i>
                            </div>

                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div
            x-data="{ active: 0, slides: ['{{ asset('images/hero/hero-2.jpg') }}', '{{ asset('images/hero/hero-3.jpg') }}'] }"
            x-init="setInterval(() => active = (active + 1) % slides.length, 5000)"
            class="hero-slider">

            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="active === index"
                     x-transition:enter="transition-opacity duration-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="absolute inset-0 bg-cover bg-center"
                     :style="'background-image: url(' + slide + ')'">
                </div>
            </template>

            <!-- Controls -->
            <div class="absolute inset-x-0 bottom-4 flex justify-center space-x-3 z-10">
                <template x-for="(slide, index) in slides" :key="'dot-' + index">
                    <button @click="active = index"
                            :class="active === index ? 'bg-white' : 'bg-gray-400'"
                            class="w-3 h-3 rounded-full"></button>
                </template>
            </div>
        </div>

    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Intercontinental LA <br/>Westlake Hotel</h2>
                        </div>
                        <p class="f-para">
                            Sharon’s Residence is a leading residence passionate about travel and comfort.
                        </p>
                        <p class="s-para">
                            So when it comes to booking the perfect hotel, vacation rental,
                            resort, apartment, guest house, or tree house, we’ve got you
                            covered.
                        </p>
                        <a href="#" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('images/about/about-1.jpg') }} " alt=""/>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('images/about/about-2.jpg') }} " alt=""/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Travel Plan</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Catering Service</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Babysitting</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-024-towel"></i>
                        <h4>Laundry</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Hire Driver</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Bar & Drink</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div
                            class="hp-room-item"
                            x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b1.jpg') }}`"
                        >
                            <div class="hr-text">
                                <h3>Double Room</h3>
                                <h2>199$<span>/Pernight</span></h2>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div
                            class="hp-room-item"
                            x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b2.jpg') }}`"
                        >
                            <div class="hr-text">
                                <h3>Premium King Room</h3>
                                <h2>159$<span>/Pernight</span></h2>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div
                            class="hp-room-item"
                            x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b3.jpg') }}`"
                        >
                            <div class="hr-text">
                                <h3>Deluxe Room</h3>
                                <h2>198$<span>/Pernight</span></h2>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div
                            class="hp-room-item"
                            x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b4.jpg') }}`"
                        >
                            <div class="hr-text">
                                <h3>Family Room</h3>
                                <h2>299$<span>/Pernight</span></h2>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->
    </body>
@endsection
