
@extends('layouts.main-site')

@push('styles')
    
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="/assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="/assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="/assets/color/theme-red.css">
@endpush

@push('scripts')
 
    <!-- Latest jQuery --> 
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="/assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="/assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="/assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="/assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="/assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="/assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="/assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="/assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="/assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="/assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="/assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="/assets/js/scripts.js"></script>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endpush


@section('title', 'Checkout')


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
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/checkout_bg.jpg">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                    <h1>Checkout</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<form method="post" action="{{ route('customer.proccess.checkout') }}">
    @csrf <!-- CSRF Token for Security -->

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            @include('partials.message-bag')

            <div class="row">
                <div class="col-lg-6">

                    <!-- Customer Info -->
                    <div class="row">
                        <!-- Name -->
                        <div class="form-group col-md-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input
                                id="name"
                                class="form-control"
                                type="text"
                                name="name"
                                value="{{ $user->first_name . ' ' . $user->last_name }}"
                                readonly
                            >
                        </div>

                        <!-- Email -->
                        <div class="form-group col-md-12">
                            <label for="email" class="form-label">Email Address</label>
                            <input
                                id="email"
                                class="form-control"
                                type="email"
                                name="email"
                                value="{{ $user->email }}"
                                readonly
                            >
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group col-md-12">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input
                                id="phone_number"
                                class="form-control"
                                type="tel"
                                name="phone_number"
                                value="{{ $user->phone_number }}"
                                readonly
                            >
                        </div>

                        <!-- Edit button -->
                        <div class="form-group col-md-12 mt-3">
                            <a href="" class="btn btn-default w-100">Edit My Details</a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="form-group col-md-12">
                            <input class="form-control" required type="text" name="address" value="{{ old('address') }}" placeholder="Address *">
                        </div>

                        <!-- City -->
                        <div class="form-group col-md-6">
                            <input class="form-control" required type="text" name="city" value="{{ old('city') }}" placeholder="City / Town *">
                        </div>

                        <!-- State -->
                        <div class="form-group col-md-6">
                            <input class="form-control" required type="text" name="state" value="{{ old('state') }}" placeholder="State *">
                        </div>

                        <!-- County (Optional) -->
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" name="county" value="{{ old('county') }}" placeholder="County (Optional)">
                        </div>

                        <!-- Postcode -->
                        <div class="form-group col-md-6">
                            <input class="form-control" required type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode / ZIP *">
                        </div>

                        <!-- Additional Information -->
                        <div class="form-group mb-0 mt-2 col-md-12">
                            <div class="heading_s1">
                                <h4>Additional Information</h4>
                            </div>
                            <textarea rows="4" class="form-control" name="additional_info" placeholder="e.g., allergies or any other information you want to provide">{{ old('additional_info') }}</textarea>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
</form>

@endsection
