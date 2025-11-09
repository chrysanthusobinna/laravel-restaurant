
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
                const targetInput = $($(this).data('target'));
                const type = targetInput.attr('type') === 'password' ? 'text' : 'password';
                targetInput.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
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

<!-- START: Edit My Profile -->
<style>
    /* Minimal styles only for the header card; no input styling */
    .acct {
        --radius: 16px;
        --shadow: 0 12px 30px rgba(0,0,0,.08);
        --muted: #6c757d;
    }
    .acct-card {
        border: 0; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; background: #fff;
    }
    .acct-hero {
        background: linear-gradient(135deg, rgba(13,110,253,.18), rgba(111,66,193,.14));
        padding: 28px 24px;
    }
    .acct-avatar {
        width: 84px; height: 84px; border-radius: 50%; object-fit: cover;
        border: 4px solid #fff; box-shadow: 0 6px 16px rgba(0,0,0,.12); background: #e9ecef;
    }
    .acct-name { font-weight: 800; font-size: 1.25rem; line-height: 1.1; }
    .acct-sub { color: var(--muted); }
    .g-gap { gap: 1.25rem; }
</style>

<div class="section acct">
    <div class="container">
        @include('partials.message-bag')

        <div class="acct-card">
            <!-- HERO: avatar + name only -->
            <div class="acct-hero">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between g-gap">
                    <div class="d-flex align-items-center g-gap">
                        <!-- Always show auto-generated avatar -->
                        <img
                            class="acct-avatar"
                            src="https://ui-avatars.com/api/?name={{ urlencode(trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) }}&size=192&background=E9ECEF&color=495057"
                            alt="User avatar"
                        />
                        <div>
                            <div class="acct-name">
                                {{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Your name' }}
                            </div>
                            <div class="acct-sub">
                                {{ $user->email ?? 'no-email@domain.com' }}
                                <span class="mx-2">•</span>
                                <span>Member since {{ optional($user->created_at)->format('d M Y') ?? '—' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM BODY -->
            <div class="p-3 p-md-4">
                <form method="POST" action="{{ route('customer.update.profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" name="first_name" type="text" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" name="last_name" type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input id="middle_name" name="middle_name" type="text" class="form-control" value="{{ old('middle_name', $user->middle_name) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input id="phone_number" name="phone_number" type="text" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" name="address" type="text" class="form-control" value="{{ old('address', $user->address) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap mt-4">
                        <button type="submit" class="btn btn-danger">Save Changes</button>
                        <a href="{{ route('customer.account') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>


            
        </div><!-- /acct-card -->
    </div>
</div>
<!-- END: Edit My Profile -->

@endsection
