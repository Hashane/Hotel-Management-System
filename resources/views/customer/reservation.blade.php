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
                                    <h6 class="payment-price">Rs. 0.00</h6>
                                </div>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Tax</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price">Rs. 0.00</h6>
                                </div>
                            </div>
                            <div class="row payment-detail-row">
                                <div class="col-lg-5">
                                    <p>Service Charges</p>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="payment-price">Rs. 0.00</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <h6 style="font-weight: bolder">Total Amount</h6>
                                </div>
                                <div class="col-lg-7">
                                    <h5 class="payment-price" style="font-size: larger">
                                        Rs. 0.00
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
                    <form action="{{ route('cart.index') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <h3>Enter your Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="first" placeholder="First Name" required/>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="last" placeholder="Last Name" required/>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="email" placeholder="Your Email" required/>
                            </div>
                            <div class="col-lg-5">
                                <input type="text" name="phone" placeholder="Phone" required/>
                            </div>
                            <div class="col-lg-12">
                                <textarea  name="message" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <h3>Bank Card Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="card" placeholder="Card Number"/>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="expiry" placeholder="Exp Date"/>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="cvc" placeholder="CVC"/>
                            </div>
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
