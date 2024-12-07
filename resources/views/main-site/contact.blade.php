
@extends('layouts.main-site')

@push('styles')
    
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="assets/color/theme-red.css">
@endpush

@push('scripts')
    <!-- Latest jQuery --> 
    <script src="assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="assets/js/scripts.js"></script>
@endpush


@section('title', 'Contact')

@section('header')
    <!-- START HEADER -->
        <header class="header_wrap fixed-top header_with_topbar light_skin main_menu_uppercase">
        <div class="container">
            @include('partials.nav')
        </div>
    </header>
    <!-- END HEADER -->
@endsection



@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="assets/images/contact2_bg.jpg">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h1>Contact</h1>
                    </div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START SECTION CONTACT -->
    <div class="section pb_20">
        <div class="container">
            <div class="row d-flex align-items-stretch">
                <div class="col-xl-3 col-md-6 animation d-flex" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="contact_wrap contact_style3 flex-fill">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Address</span>
                            @forelse($addresses as $address)
                                <p>{{ $address->address }}</p>
                            @empty
                                <p>No addresses available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 animation d-flex" data-animation="fadeInUp" data-animation-delay="0.3s">
                    <div class="contact_wrap contact_style3 flex-fill">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <span>Email Address</span>
                            <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a> <br>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 animation d-flex" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="contact_wrap contact_style3 flex-fill">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Phone</span>
                            @forelse($phoneNumbers as $phoneNumber)
                                <p>{{ $phoneNumber->phone_number }}</p>
                            @empty
                                <p>No phone numbers available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 animation d-flex" data-animation="fadeInUp" data-animation-delay="0.5s">
                    <div class="contact_wrap contact_style3 flex-fill">
                        <div class="contact_icon">
                            <i class="linearicons-clock"></i>
                        </div>
                        <div class="contact_text">
                            <span>Opening Hours</span>
                            @forelse($workingHours as $workingHour)
                                <p>{{ $workingHour->working_hours }}</p>
                            @empty
                                <p>No working hours available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END SECTION CONTACT -->

    <!-- START SECTION CONTACT -->
    <div class="section small_pt">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="divider center_icon"><i class="ti-pencil-alt"></i></div>
                    <div class="large_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="heading_s1">
                        <h2>Get In Touch</h2>
                    </div>
                    <p class="leads">Have a question or want to share your feedback? We'd love to hear from you! Reach out to us and let's start a conversation about your next great dining experience at {{ config('site.name') }}.</p>
                    <div class="rounded_input">
                        <form method="post" name="enq">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input required placeholder="Enter Name *" id="first-name" class="form-control" name="name" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input required placeholder="Enter Email *" id="email" class="form-control" name="email" type="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input required placeholder="Enter Phone No. *" id="phone" class="form-control" name="phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <input placeholder="Enter Subject" id="subject" class="form-control" name="subject">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea required placeholder="Message *" id="description" class="form-control" name="message" rows="4"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" title="Submit Your Message!" class="btn btn-default btn-radius" id="submitButton" name="submit" value="Submit">Send Message</button>
                                </div>
                                <div class="col-md-12">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form>     
                    </div>
                </div>
                
                <div class="col-lg-6 animation mt-4 mt-lg-0" data-animation="fadeInUp" data-animation-delay="0.3s">
                    <div class="map">
                        @if($firstRestaurantAddress)
                        <iframe 
                            src="https://maps.google.com/maps?q={{ urlencode($firstRestaurantAddress->address) }}&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->
@endsection



 