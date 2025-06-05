@extends('layouts.guest')

@section('title', 'About Us')

@section('content')
    <!-- cart Section Begin -->
    <div class="container" style="margin-top: 40px">
        <div class="row">
            <!-- room detail card section -->
            <div class="col-lg-8">
                <div class="room-item">
                    <div class="ri-text">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="img/room/room-1.jpg" alt="" />
                            </div>
                            <div class="col-md-7">
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
                                </div>
                            </div>
                        </div>

                        <div class="summary-card">
                            <div class="row">
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Check In</p>
                                </div>
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Check Out</p>
                                </div>
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Occupancy</p>
                                </div>
                            </div>
                        </div>

                        <div class="summary-card">
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Total Room Price</p>
                                </div>
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>+</h4>
                                </div>
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Extra Cahrges</p>
                                </div>
                                <div class="col-md-3" style="margin-top: 10px">
                                    <h4>14 Mar 2025</h4>
                                    <p class="cart-detail">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

                <!-- promotion section -->
                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-12 payment-card">
                        <div class="row">
                            <h6 style="font-weight: bolder">APPLY COUPON</h6>
                        </div>

                        <div class="row">
                            <p>Have a Coupnon</p>
                        </div>

                        <div class="row">
                            <button
                                class="col-sm-7 r-o-button"
                                style="margin-right: 20px"
                            ></button>
                            <button class="col-sm-4 r-o-button2">Apply</button>
                        </div>
                    </div>
                </div>
                <!-- end of promotion section -->
            </div>
        </div>
    </div>
    <!-- cart Section End -->
@endsection
