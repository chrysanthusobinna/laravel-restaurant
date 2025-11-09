
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
    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                const input = $('#password');
                const icon = $(this);
                const type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                icon.toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>

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

<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">

        <form method="post" action="{{ route('customer.checkout.details.post') }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="order_review">
                        <h4 class="mb-4">Confirm Your Details</h4>
                        <hr>
                        @include('partials.message-bag')

                        <div class="row">
                            <!-- Full Name (read-only) -->
                            <div class="form-group col-md-12">
                                <label for="name">Full Name</label>
                                <input
                                    id="name"
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    value="{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}"
                                    readonly
                                >
                            </div>

                            <!-- Email (read-only) -->
                            <div class="form-group col-md-12">
                                <label for="email">Email Address</label>
                                <input
                                    id="email"
                                    class="form-control"
                                    type="email"
                                    name="email"
                                    value="{{ $user->email }}"
                                    readonly
                                >
                            </div>

                            <!-- Phone (read-only) -->
                            <div class="form-group col-md-12">
                                <label for="phone_number">Phone Number</label>
                                <input
                                    id="phone_number"
                                    class="form-control"
                                    type="tel"
                                    name="phone_number"
                                    value="{{ $user->phone_number }}"
                                    readonly
                                >
                            </div>

                            <!-- Note to update -->
                            <div class="form-group col-md-12">
                                <small class="text-muted">
                                    If these details are incorrect, please
                                    <a href="{{ route('customer.edit.profile') }}">click here to update your details</a>.
                                </small>
                            </div>

                            <!-- Confirm checkbox -->
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirm_details" name="confirm" value="1" required>
                                    <label class="form-check-label" for="confirm_details">
                                        I confirm these details are correct
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-default btn-block">Continue</button>
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
