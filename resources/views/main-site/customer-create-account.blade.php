
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


@section('title', 'Create Account')


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
            		<h1>Create Account</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Create Account</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->


<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        @include('partials.message-bag')

        <form method="post" action="{{ route('customer.account.store') }}">
        @csrf
        <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mx-auto">
            <div class="order_review">
            <div class="row">
                <!-- Name -->
                <div class="form-group col-md-12">
                <input class="form-control" required type="text" name="name" value="{{ old('name') }}" placeholder="Name *">
                </div>

                <!-- Email -->
                <div class="form-group col-md-12">
                <input class="form-control" required type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *">
                </div>

                <!-- Phone Number -->
                <div class="form-group col-md-12">
                <input class="form-control" required type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number *">
                </div>

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

                <!-- Submission -->
                <div class="form-group mb-0 mt-2 col-md-12">
                <button type="submit" class="btn btn-default btn-block">Create Account</button>
                </div>

                <!-- Login Link -->
                <div class="form-group mb-0 mt-2 col-md-12">
                If you have an account? <a href="#">Login here</a>
                </div>
            </div>
            </div>
        </div>
        </div>

        </form>
    </div>
</div>
<!-- END SECTION SHOP -->
 
@endsection



 