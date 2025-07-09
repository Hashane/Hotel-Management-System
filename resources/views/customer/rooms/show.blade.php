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



<body>


    {{-- **** ROOM PAGE **** --}}
    <div class="container">
        <div class="container justify-content-center mt-4" style="padding: 0">
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
    </div>





    <div class="container">
        <div class="container d-flex justify-content-center">
            <div class="w-100">
                <div class="row mt-4">
                    <div class="col-xl-4">

                        <!-- Booking section -->
                        <div class="row ms-2 me-2">
                            <div class="col-lg-12" style="padding: 0;">
                                <div class="booking-form"
                                    style="border: 1px solid #ebebeb; padding: 20px 30px 20px 30px;">
                                    <h4>Booking Your Hotel</h4>
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
                        <div class="row ms-2 me-2">
                            <div class="col-lg-12"
                                style="border: 1px solid #ebebeb; padding: 20px 30px 20px 30px; margin-top: 20px">

                                <div class="row">
                                    <h4>Payment Information</h4>
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
                        <div class="row ms-2 me-2" style="margin-top: 20px">
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

                        <div class="row ms-2 me-2">
                            <div class="col-lg-12 mt-4" style="padding:0">
                                <button class="proceed-btn mb-2 ">Proceed
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="col-8">

                        <!-- room Discip. section -->
                        <div class="row">
                            <div class="col-12">
                                <p style="color: black; letter-spacing: 0.05em; line-height: 1.8;">
                                    Our Deluxe Ocean View Rooms offer stylish comfort with expansive views over the
                                    Indian
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

                        <!-- Room Details Section -->
                        <div class="row mt-4">
                            <div class="col-12">

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <p style="letter-spacing: 0.05em; line-height: 1.8;">
                                            <span class="me-2 fw-semibold">Size:</span>{{ $roomType->size ?? '30 ft' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <p style="letter-spacing: 0.05em; line-height: 1.8;">
                                            <span class="me-2 fw-semibold">Capacity:</span>Max person {{
                                            $roomType->capacity ?? 2 }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <p style="letter-spacing: 0.05em; line-height: 1.8;">
                                            <span class="me-2 fw-semibold">Bed:</span>{{ $roomType->bed_type ?? 'King
                                            Beds' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        @php
                                        $facilityList = $roomType->facilities ?? ['Wi‑Fi', 'Television', 'Bathroom'];
                                        $facilitiesText = implode(', ', collect($facilityList)->map(function($f) {
                                        return is_object($f) ? $f->name : $f;
                                        })->toArray());
                                        @endphp
                                        <p style="letter-spacing: 0.05em; line-height: 1.8;">
                                            <span class="me-2 fw-semibold">Features:</span>{{ $facilitiesText }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end room details card-->

                        <!-- service section card -->

                        <div class="row mt-4 ms-2 me-2"
                            style="border: 1px solid #ebebeb; padding: 20px 10px 20px 10px;">
                            <div class="col-2 d-flex justify-content-center ">
                                <img class="service-img" src="images/hero/hero-2.jpg" alt="">
                            </div>

                            <div class="col-10 ps-2">
                                <div class="col-lg-12">

                                    <div class="row">
                                        <h6>Serive Name</h6>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <p style="color: black; letter-spacing: 0.05em; line-height: 1.8;">
                                                Our Deluxe Ocean View Rooms offer stylish comfort with expansive
                                                views
                                                over
                                                the
                                                Indian
                                                Ocean
                                                from
                                                floor-to-ceiling windows. </p>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-7 d-flex align-items-center">
                                            <h4>Rs. 1500.00</h4>
                                            <h6>/Per night</h6>
                                        </div>
                                        <div class="col-5 text-end">
                                            <button class="select-btn   ">Select </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end service section card-->

                    </div>






                </div>
            </div>
        </div>
    </div>






</body>
@endsection