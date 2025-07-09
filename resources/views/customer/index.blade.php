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
                            Discover refined living at Four Seasons, a luxury residence designed for comfort and
                            elegance.
                            Perfect for travelers seeking a peaceful, home-like stay with upscale amenities and
                            personalized service.
                        </p>
                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form" style="padding: 30px 40px 50px 40px;">
                        <h3>Booking Your Hotel</h3>
                        <form action="{{ route('rooms.index') }}" method="GET">
                            <div class="select-option">
                                <label for="room_type">Accommodation Type:</label>
                                <select id="room_type" name="room_type" class="r-o-select">
                                    <option value="any" {{ request('room_type')=='' ? 'selected' : '' }}>Any</option>
                                    <option value="1" {{ request('room_type')=='1' ? 'selected' : '' }}>Standard
                                    </option>
                                    <option value="2" {{ request('room_type')=='2' ? 'selected' : '' }}>Deluxe
                                    </option>
                                    <option value="3" {{ request('room_type')=='3' ? 'selected' : '' }}>Suite</option>
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
            </div>
        </div>
        <div x-data="{ active: 0, slides: ['{{ asset('images/hero/hero-2.jpg') }}', '{{ asset('images/hero/hero-3.jpg') }}'] }"
            x-init="setInterval(() => active = (active + 1) % slides.length, 5000)" class="hero-slider">




            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="active === index" x-transition:enter="transition-opacity duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="absolute inset-0 bg-cover bg-center" :style="'background-image: url(' + slide + ')'">
                </div>
            </template>

            <!-- Controls -->
            <div class="absolute inset-x-0 bottom-4 flex justify-center space-x-3 z-10">
                <template x-for="(slide, index) in slides" :key="'dot-' + index">
                    <button @click="active = index" :class="active === index ? 'bg-white' : 'bg-gray-400'"
                        class="w-3 h-3 rounded-full"></button>
                </template>
            </div>
        </div>

    </section>
    <!-- Hero Section End -->



    {{-- **** ROOM PAGE **** --}}
    <div class="container mt-4">
        <section class="hero-section">

            <div x-data="{ active: 0, slides: ['{{ asset('images/hero/hero-2.jpg') }}', '{{ asset('images/hero/hero-3.jpg') }}'] }"
                x-init="setInterval(() => active = (active + 1) % slides.length, 5000)" class="hero-slider">

                <!-- Slides -->
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="active === index" x-transition:enter="transition-opacity duration-1000"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="absolute inset-0 bg-cover bg-center" :style="'background-image: url(' + slide + ')'">
                    </div>
                </template>

                <!-- Controls -->
                <div class="absolute inset-x-0 bottom-4 flex justify-center space-x-3 z-10">
                    <template x-for="(slide, index) in slides" :key="'dot-' + index">
                        <button @click="active = index" :class="active === index ? 'bg-white' : 'bg-gray-400'"
                            class="w-3 h-3 rounded-full"></button>
                    </template>
                </div>
            </div>

        </section>
    </div>



    <div class="container d-flex justify-content-center">
        <div class="w-100">
            <div class="row">
                <div class="col-xl-4">

                    <!-- Booking section -->
                    <div class="row">
                        <div class="col-lg-12" style="padding: 0;">
                            <div class="booking-form" style="border: 1px solid #ebebeb; padding: 30px 40px 30px 40px;">
                                <h3>Booking Your Hotel</h3>
                                <form action="{{ route('rooms.index') }}" method="GET">


                                    <div class="check-date">
                                        <label for="date-in">Check In:</label>
                                        <input type="date" class="date-input" id="date-in" name="check_in"
                                            value="{{ request()->check_in ?? now()->toDateString() }}">
                                        <i class="icon_calendar"></i>
                                    </div>

                                    <div class="check-date">
                                        <label for="date-out">Check Out:</label>
                                        <p>
                                            <input type="date" class="date-input" id="date-out" name="check_out"
                                                value="{{ request()->check_out ?? now()->addDay()->toDateString() }}">
                                            <i class="icon_calendar"></i>
                                        </p>

                                    </div>


                                    <div class="select-option">
                                        <label for="date-out">Guest Count</label>
                                        <select name="occupants" class="r-o-select w-100" required>
                                            <option value="">GUEST COUNT</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Booking section -->

                    <!-- payment section -->
                    <div class="row">
                        <div class="col-lg-12"
                            style="border: 1px solid #ebebeb; padding: 30px 40px 30px 40px; margin-top: 20px">

                            <div class="row">
                                <h3>Payment Information</h3>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Total Room Cost</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price form-control-plaintext">Rs. 12,500.00</h6>
                                </div>
                            </div>

                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Service Charges</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price form-control-plaintext">Rs. 750.00</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <h6 style="font-weight: bolder">Total Amount</h6>
                                </div>
                                <div class="col-lg-7">
                                    <h5 class="payment-price form-control-plaintext" style="font-size: larger">
                                        Rs. 14,250.00
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end payment section -->

                    <!-- promotion section -->
                    <div class="row" style="margin-top: 20px">
                        <div class="col-lg-12 payment-card">
                            <div class="row">
                                <h6 style="font-weight: bolder">APPLY COUPON</h6>
                            </div>

                            <div class="row">
                                <p>Have a Coupon?</p>
                            </div>

                            <div class="row">
                                <div class="col-lg-7">
                                    <button class="payment-btn-payment">
                                    </button>
                                </div>

                                <div class="col-lg-5">
                                    <button class="payment-btn-promotion">
                                        Apply
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of promotion section -->

                    <div class="row">
                        <div class="col-lg-12 ">
                            <button class="proceed-btn btn-sm px-3 bg-primary mb-2 ">Proceed
                            </button>

                        </div>
                    </div>
                </div>

                <div class="col-8">

                    <!-- room Discip. section -->
                    <div class="row">
                        <div class="col-12">
                            <p style="color: black; letter-spacing: 0.05em; line-height: 1.8;">
                                Our Deluxe Ocean View Rooms offer stylish comfort with expansive views over the Indian
                                Ocean
                                from floor-to-ceiling windows. A calming space filled with shades of soft grey,
                                off-white
                                and azure blue,
                                these
                                rooms draw the beauty of Sri Lanka's natural environment in.
                            </p>
                        </div>
                    </div>
                    <!-- end room Discip. section -->

                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        {{-- <div class="bg-body-tertiary p-4 rounded mb-4"> --}}


                            <div class="row mb-2">
                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 fw-semibold me-2 text-dark">Size:</p>
                                    <p class="form-control-plaintext mb-0" style="width: auto;">
                                        {{ $roomType->size ?? '30 ft' }}
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 fw-semibold me-2 text-dark">Capacity:</p>
                                    <p class="form-control-plaintext mb-0" style="width: auto;">
                                        Max person {{ $roomType->capacity ?? 2 }}
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="mb-0 fw-semibold me-2 text-dark">Bed:</p>
                                    <p class="form-control-plaintext mb-0" style="width: auto;">
                                        {{ $roomType->bed_type ?? 'King Beds' }}
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 d-flex align-items-start">
                                    <p class="mb-0 fw-semibold me-2 text-dark">Facilities:</p>
                                    <div class="d-flex flex-wrap gap-3">
                                        @php
                                        // Fallback sample facilities if none exist
                                        $facilityList = $roomType->facilities ?? ['Wi‑Fi', 'Television',
                                        'Bathroom'];
                                        @endphp

                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach ($facilityList as $facility)
                                            @php
                                            $name = is_object($facility) ? $facility->name : $facility;
                                            $iconFile = strtolower(str_replace(' ', '_', $name)) . '.png';
                                            @endphp
                                            <img src="{{ asset('images/features/' . $iconFile) }}" alt="{{ $name }}"
                                                width="24" height="24" title="{{ $name }}" style="cursor: default;">
                                            @endforeach
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




    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Intercontinental <br />Four Seasons</h2>
                        </div>
                        <p class="f-para">
                            Four Seasons is a leading residence passionate about travel and comfort.
                        </p>
                        <p class="s-para">
                            So when it comes to booking the perfect hotel, vacation rental,
                            resort, apartment, guest house, or tree house, we've got you
                            covered.
                        </p>
                        <a href="#" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('images/about/about-1.jpg') }} " alt="" />
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('images/about/about-2.jpg') }} " alt="" />
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
                            Let us take care of your journey. From transportation to sightseeing, we offer customized
                            travel itineraries to ensure a stress-free and enjoyable trip for individuals and families.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Catering Service</h4>
                        <p>
                            Enjoy gourmet meals without stepping out. Our catering team delivers fresh, delicious food
                            directly to your room or event space, prepared with the finest ingredients.
                        </p>
                    </div>
                </div>


                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Babysitting</h4>
                        <p>
                            Our trusted and trained babysitters offer safe and engaging care for your little ones,
                            giving you the peace of mind to enjoy your time while they're in good hands.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-024-towel"></i>
                        <h4>Laundry</h4>
                        <p>
                            We provide convenient laundry and dry-cleaning services with quick turnaround times,
                            ensuring your clothes are clean, fresh, and ready when you need them.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Hire Driver</h4>
                        <p>
                            Need a ride? Our professional drivers are available on demand, offering safe and comfortable
                            transportation for city tours, airport transfers, or personal errands.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Bar & Drink</h4>
                        <p>
                            Relax and unwind at our well-stocked bar offering a wide selection of cocktails, wines, and
                            premium spirits served in a stylish and welcoming atmosphere.
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
                        <div class="hp-room-item" x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b1.jpg') }}`">
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
                        <div class="hp-room-item" x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b2.jpg') }}`">
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
                        <div class="hp-room-item" x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b3.jpg') }}`">
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
                        <div class="hp-room-item" x-data
                            x-init="$el.style.backgroundImage = `url('{{ asset('images/room/room-b4.jpg') }}`">
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