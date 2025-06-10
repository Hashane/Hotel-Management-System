@extends('customer.layouts.customer')

@section('title', 'About Us')

@section('content')
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-5">
                    <!-- Contact Info Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Contact Info</h4>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td>432 Dambaduraya, Seeduwa, Sri Lanka</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone:</th>
                                        <td>(12) 345 67890</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td>FourSeasons@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fax:</th>
                                        <td>+(12) 345 67890</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cancellation Policy Card -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cancellation Policy</h4>
                            <p class="card-text">
                                Cancel / Rebook no later than 24 hours before, otherwise you
                                pay 80% of the cost.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Form) -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Enter Your Information</h4>
                            <form action="#" class="contact-form">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="First Name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Last Name"/>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="email" class="form-control" placeholder="Your Email"/>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Phone"/>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Send Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.0606825994123!2d-72.8735845851828!3d40.760690042573295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e85b24c9274c91%3A0xf310d41b791bcb71!2sWilliam%20Floyd%20Pkwy%2C%20Mastic%20Beach%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1578582744646!5m2!1sen!2sbd"
                            height="470"
                            style="border: 0; width: 100%;"
                            allowfullscreen=""
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
