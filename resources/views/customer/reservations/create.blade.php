@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <!-- payment section -->
                        <div class="col-lg-12 payment-card">
                            <div class="row">
                                <h4>Payment Information</h4>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Total Room Cost</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price">Rs. {{$totalRoomCost}}.00</h6>
                                </div>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Tax {{$taxPercentage}}%</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price">Rs. {{$tax}}.00</h6>
                                </div>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Service Charges</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price">Rs. {{$serviceCharges}}.00</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <h6 style="font-weight: bolder">Total Amount</h6>
                                </div>
                                <div class="col-lg-7">
                                    <h5 class="payment-price" style="font-size: larger">
                                        Rs. {{ $totalAmount }}.00
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- end payment section -->
                    </div>

                    <div class="row" style="margin-top: 20px">
                        <!-- content info section -->
                        <div class="col-lg-12 payment-card">
                            <div class="contact-text">
                                <h3 style="margin-top: 20px">Contact Info</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua.
                                </p>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="c-o">Address:</td>
                                        <td>432 Dambaduraya, Seeduwa, Sri Lanka</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Phone:</td>
                                        <td>(12) 345 67890</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Email:</td>
                                        <td>FourSeasons@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Fax:</td>
                                        <td>+(12) 345 67890</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end of content info section -->

                    <div class="row" style="margin-top: 20px">
                        <!-- cancelation policy section -->
                        <div class="col-lg-12 payment-card">
                            <div class="contact-text">
                                <h3 style="margin-top: 20px">Cancelation Policy</h3>
                                <p>
                                    Cancel /Rebook No Later Than 24 Hours Before, Otherwise You
                                    Pay 80% Of The Cost.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end of cancelation policy section -->
                </div>

                <div class="col-lg-7 offset-lg-1">
                    <form action="{{ route('reservations.store') }}" method="POST" class="contact-form">
                        @csrf

                        {{--                        @if ($errors->any())--}}
                        {{--                            <div class="alert alert-danger">--}}
                        {{--                                <ul class="mb-0">--}}
                        {{--                                    @foreach ($errors->all() as $error)--}}
                        {{--                                        <li>{{ $error }}</li>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}

                        <div class="row">
                            <h3>Enter your Information</h3>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                       placeholder="First Name" required/>
                                @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-lg-6">
                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                       placeholder="Last Name" required/>
                                @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-lg-7">
                                <input type="text" name="email" value="{{ old('email') }}" placeholder="Your Email"
                                       required/>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-lg-5">
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone"
                                       required/>
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit">Make Reservation</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
