@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
    <!-- cart Section Begin -->
    {{-- <div class="container" style="margin-top: 40px", style="display: inline-flex" > --}}
   
        <div class="container d-flex" style="gap: 20px; align-items: flex-start; margin-top: 40px;">
        <div  style="width: 60%;">
            <div class="row">
                @foreach($items as $item)
                <!-- room detail card section -->
                <div class="col-lg-12">
                    <div class="room-item">
                        <div class="ri-text">
                            <div class="row mb-2">
                                <div class="col-lg-5">
                                    <img class="cart-room-img" src="{{ $item['room']->image_url }}" alt="{{ $item['room']->name }}"/>
                                    <button type="button" class="delete-btn btn-sm px-3">Delete</button>
                                </div>

                                <div class="col-lg-7 mb-2">
                                    <div class="ri-text">
                                        <h4>Premium King Room</h4>
                                        <h3><span>{{ $item['room']->default_rate->pivot->price }}$/Pernight</span></h3>
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
                                        <h4>{{ $item['check-in'] }}</h4>
                                        <p class="cart-detail">Check In</p>
                                    </div>
                                    <div class="col-lg-3" style="margin-top: 10px">
                                        <h4>{{ $item['check-out'] }}</h4>
                                        <p class="cart-detail">Check Out</p>
                                    </div>
                                    <div class="col-lg-3" style="margin-top: 10px">
                                        <h4>{{ $item['occupants'] }}</h4>
                                        <p class="cart-detail">Occupancy</p>
                                    </div>
                                    <div class="col-lg-3" style="margin-top: 10px">
                                        <h4>Rs. 2200</h4>
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
            <button type="button" class="delete-btn btn-sm px-3">Update</button>

        </div>
     
    </div>
        
        
    </div>
    <!-- cart Section End -->
@endsection
