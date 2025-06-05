@extends('layouts.app')

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
                                        <td>856 Cordia Extension Apt. 356, Lake, US</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Phone:</td>
                                        <td>(12) 345 67890</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Email:</td>
                                        <td>info.colorlib@gmail.com</td>
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
                                <p style="font-weight: bolder">Free Cancellation</p>
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
                    <form action="#" class="contact-form">
                        <div class="row">
                            <h3>Enter your Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="First Name" />
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Last Name" />
                            </div>
                            <div class="col-lg-7">
                                <input type="text" placeholder="Your Email" />
                            </div>
                            <div class="col-lg-5">
                                <input type="text" placeholder="Phone" />
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </form>

                    <form action="#" class="contact-form">
                        <div class="row">
                            <h3>Bank Card Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Card Number" />
                            </div>
                            <div class="col-lg-3">
                                <input type="text" placeholder="Exp Date" />
                            </div>
                            <div class="col-lg-3">
                                <input type="text" placeholder="CVC" />
                            </div>

                            <div class="col-lg-12">
                                <button type="submit">Make Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.0606825994123!2d-72.8735845851828!3d40.760690042573295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e85b24c9274c91%3A0xf310d41b791bcb71!2sWilliam%20Floyd%20Pkwy%2C%20Mastic%20Beach%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1578582744646!5m2!1sen!2sbd"
                    height="470"
                    style="border: 0"
                    allowfullscreen=""
                ></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
