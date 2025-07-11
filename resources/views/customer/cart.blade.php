@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
    <!-- cart Section Begin -->
    {{-- <div class="container" style="margin-top: 40px", style="display: inline-flex" > --}}
    @empty($items)
        <div class="container mt-5 d-flex justify-content-center align-items-start gap-4">
            <div class="col-md-8">

                <div class="card shadow-sm border-0 w-100">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="mb-0">Your Cart</h5>
                    </div>

                    <div class="card-body text-center">
                        <img src="https://lizotel.pt/optimal-html/assets/images/sad-icon.png"
                             alt="Empty Cart Illustration"
                             class="img-fluid mb-4" style="max-width: 200px;">

                        <h3 class="text-muted fw-bold">Your Cart is Empty</h3>
                        <p class="text-secondary">Add something to make me happy 🙂</p>

                        <a href="{{ route('rooms.index') }}" class="btn btn-primary mt-3 px-4">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>

            </div>
        </div>
    @endempty

    <div class="container d-flex" style="gap: 20px; align-items: flex-start; margin-top: 40px;">
        <div style="width: 60%;">
            <div class="row">
                @foreach($items as $key => $item)
                    <!-- room detail card section -->
                    <div class="col-lg-12">
                        <div class="room-item">
                            <div class="ri-text">
                                <div class="row mb-2">
                                    <div class="col-lg-5">
                                        <img class="cart-room-img" src="{{ $item['room']->image_url }}"
                                             alt="{{ $item['room']->name }}"/>
                                    </div>

                                    <div class="col-lg-7 mb-2">
                                        <div class="ri-text">
                                            <div class="row">
                                                <div class="col-10">
                                                    <h4>{{ $item['room']->name }}</h4>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <form action="{{ route('cart.remove', $key) }}" method="POST"
                                                          class="d-flex justify-content-between w-100 gap-3">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="w-50">
                                                            <button type="submit"><i
                                                                        class="fas fa-trash px-2 py-2 border rounded"
                                                                        style="color: red;"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <h3><span>{{ $item['room']->default_rate->pivot->price }}$/Pernight</span>
                                            </h3>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="r-o">Size:</td>
                                                    <td>30z</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Capacity:</td>
                                                    <td>Max persons {{ $item['room']->roomType->capacity }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Bed:</td>
                                                    <td>King Beds</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Services:</td>
                                                    <td>{{ implode(', ',(json_decode($item['room']->roomType->facilities()->pluck('name'),true))) ?? 'Wifi, Television, Bathroom,...' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-card">
                                    <div class="row">
                                        <div class=" col-lg-3" style="margin-top: 10px">
                                            <h4>{{ $item['check_in'] }}</h4>
                                            <p class="cart-detail">Check In</p>
                                        </div>
                                        <div class="col-lg-3" style="margin-top: 10px">
                                            <h4>{{ $item['check_out'] }}</h4>
                                            <p class="cart-detail">Check Out</p>
                                        </div>
                                        <div class="col-lg-3" style="margin-top: 10px">
                                            <h4>{{ $item['occupants'] }}</h4>
                                            <p class="cart-detail">Occupancy</p>
                                        </div>
                                        <div class="col-lg-3" style="margin-top: 10px">
                                            <h4>Rs.{{ $item['room_cost'] }}.00</h4>
                                            <p class="cart-detail">Total Room Price</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @empty(!$items)
            <div style="width: 35%; position: sticky; top: 40px; align-self: flex-start;">
                <div class="row">
                    <div class="col-lg-12" style="position: sticky; top: 40px; align-self: flex-start; z-index: 100;">

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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <button class="proceed-btn btn-sm px-3 bg-primary mb-2 "
                                onclick="window.location='{{ route('reservations.create') }}'">Proceed
                        </button>

                    </div>
                </div>
            </div>
        @endempty
    </div>
    <!-- cart Section End -->
@endsection
