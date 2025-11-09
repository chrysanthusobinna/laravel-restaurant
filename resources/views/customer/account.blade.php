
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

 

 <!-- START: Customer Account -->
<style>
    .acct {
        --radius: 16px;
        --shadow: 0 12px 30px rgba(0,0,0,.08);
        --muted: #6c757d;
        --border: #eef0f3;
        --soft: #f8f9fb;
        --accent: #0d6efd;
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

    .acct-hd { font-weight: 800; font-size: 1.05rem; margin-bottom: .75rem; }

    .info-tiles {
        display: grid; gap: 12px;
        grid-template-columns: 1fr;
    }
    @media (min-width: 768px) {
        .info-tiles { grid-template-columns: 1fr 1fr; }
    }
    .tile {
        border: 1px solid var(--border); border-radius: 12px; padding: 14px 16px; background: #fff;
    }
    .tile .label {
        font-size: .74rem; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: .25rem;
    }
    .tile .value {
        font-weight: 700; display: inline-flex; align-items: center; gap: .5rem;
    }

    .acct-ql .btn {
        border-radius: 999px; padding: .45rem .9rem; font-weight: 600;
        border: 1px solid var(--border); background: #fff;
    }
    .acct-ql .btn:hover { background: var(--soft); }

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
                                <span>
                                    Member since {{ optional($user->created_at)->format('d M Y') ?? '—' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- BODY: Account Details -->
            <div class="p-3 p-md-4">
                <div class="acct-hd">Account Details</div>

                <div class="info-tiles">
                    <div class="tile">
                        <div class="label">First name</div>
                        <div class="value">{{ $user->first_name ?? '—' }}</div>
                    </div>
                    <div class="tile">
                        <div class="label">Last name</div>
                        <div class="value">{{ $user->last_name ?? '—' }}</div>
                    </div>
                    <div class="tile">
                        <div class="label">Middle name</div>
                        <div class="value">{{ $user->middle_name ?? '—' }}</div>
                    </div>
                    <div class="tile">
                        <div class="label">Email</div>
                        <div class="value"><i class="far fa-envelope me-1"></i>{{ $user->email ?? '—' }}</div>
                    </div>
                    <div class="tile"  style="grid-column: 1 / -1;">
                        <div class="label">Phone</div>
                        <div class="value"><i class="fas fa-phone me-1"></i>{{ $user->phone_number ?? '—' }}</div>
                    </div>
                    <div class="tile" style="grid-column: 1 / -1;">
                        <div class="label">Default address</div>
                        <div class="value"><i class="fas fa-map-marker-alt me-1"></i>{{ $user->address ?? '—' }}</div>
                    </div>
                </div>

                <!-- Bottom action buttons -->
                <div class="acct-ql d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('customer.edit.profile') }}" class="btn btn-sm"><i class="fas fa-user-edit me-2"></i>Edit Account</a>
                    <a href="{{ route('customer.change.password') }}" class="btn btn-sm"><i class="fas fa-key me-2"></i>Change Password</a>
                    <a href="{{ route('home') }}" class="btn btn-sm"><i class="fas fa-shopping-bag me-2"></i>Return to Shopping</a>
                    <a href="" class="btn btn-sm"><i class="fas fa-file-invoice-dollar me-2"></i>My Orders</a>
                    <a href="{{ route('auth.logout') }}" class="btn btn-sm"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Customer Account -->


@endsection
