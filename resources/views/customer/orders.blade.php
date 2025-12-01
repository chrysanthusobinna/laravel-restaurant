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
            border: 0;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            background: #fff;
        }
        .acct-hero {
            background: linear-gradient(135deg, rgba(13,110,253,.18), rgba(111,66,193,.14));
            padding: 28px 24px;
        }
        .acct-avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 6px 16px rgba(0,0,0,.12);
            background: #e9ecef;
        }
        .acct-name {
            font-weight: 800;
            font-size: 1.25rem;
            line-height: 1.1;
        }
        .acct-sub {
            color: var(--muted);
        }
        .acct-hd {
            font-weight: 800;
            font-size: 1.05rem;
            margin-bottom: .75rem;
        }
        .acct-ql .btn {
            border-radius: 999px;
            padding: .45rem .9rem;
            font-weight: 600;
            border: 1px solid var(--border);
            background: #fff;
        }
        .acct-ql .btn:hover {
            background: var(--soft);
        }
        .g-gap { gap: 1.25rem; }

        /* Orders table */
        .orders-card {
            border-radius: 14px;
            border: 1px solid #eef0f3;
            padding: 16px 18px;
            background: #fff;
        }
        .orders-filters .nav-link {
            border-radius: 999px;
            padding: .25rem .9rem;
            font-size: .9rem;
        }
        .orders-filters .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }
        .order-status-badge {
            padding: .15rem .55rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .order-status-pending   { background: #fff3cd; color: #856404; }
        .order-status-completed { background: #d1e7dd; color: #0f5132; }
        .order-status-cancelled { background: #f8d7da; color: #842029; }

        @media (max-width: 575.98px) {
            .orders-table thead {
                display: none;
            }
            .orders-table tbody tr {
                display: block;
                margin-bottom: 12px;
                border: 1px solid #eef0f3;
                border-radius: 10px;
                padding: 10px 12px;
            }
            .orders-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 4px 0;
                border-bottom: 0;
            }
            .orders-table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6c757d;
                margin-right: 8px;
            }
        }
    </style>
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

@section('title', 'My Orders')

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
<div class="section acct">
    <div class="container">
        @include('partials.message-bag')

        <div class="acct-card">
            <!-- HERO -->
            <div class="acct-hero">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between g-gap">
                    <div class="d-flex align-items-center g-gap">
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

            <!-- BODY -->
            <div class="p-3 p-md-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <div class="acct-hd mb-0">My Orders</div>

                    <!-- Filter pills -->
                    <ul class="nav orders-filters">
                        @php
                            $filters = [
                                'all'       => 'All',
                                'pending'   => 'Pending',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ];
                        @endphp
                        @foreach($filters as $key => $label)
                            <li class="nav-item">
                                <a
                                    href="{{ route('customer.orders', $key === 'all' ? null : $key) }}"
                                    class="nav-link {{ ($filter ?? 'all') === $key ? 'active' : '' }}"
                                >
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="orders-card">

                    @if ($orders->isEmpty())
                        <div class="text-center py-4"  >
                            @if ($filter === 'all')
                                <strong>You don't have any orders yet.</strong>
                            @else
                                <strong>You don't have any {{ ucfirst($filter) }} orders yet.</strong>
                            @endif
                 
                        </div>

                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 orders-table">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td data-label="Order No">
                                                <a href="{{ route('customer.order.details', $order->id) }}"><span class="fw-semibold">#{{ $order->order_no }}</span></a>
                                            </td>
                                            <td data-label="Date">
                                                {{ optional($order->created_at)->format('d M Y, H:i') }}
                                            </td>
                                            <td data-label="Type">
                                                <span class="text-capitalize">
                                                    {{ $order->order_type ?? 'online' }}
                                                </span>
                                            </td>
                                            <td data-label="Amount">
                                                <span class="fw-semibold">
                                                    {!! $site_settings->currency_symbol ?? '£' !!}{{ number_format($order->total_price, 2) }}
                                                </span>
                                            </td>
                                            <td data-label="Status">
                                                @php
                                                    $status = $order->status ?? 'pending';
                                                    $statusClass = match($status) {
                                                        'completed' => 'order-status-completed',
                                                        'cancelled' => 'order-status-cancelled',
                                                        default     => 'order-status-pending',
                                                    };
                                                @endphp
                                                <span class="order-status-badge {{ $statusClass }}">
                                                    {{ $status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Bottom action buttons -->
                <div class="acct-ql d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('customer.edit.profile') }}" class="btn btn-sm">
                        <i class="fas fa-user-edit me-2"></i>Edit Account
                    </a>
                    <a href="{{ route('customer.change.password') }}" class="btn btn-sm">
                        <i class="fas fa-key me-2"></i>Change Password
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-sm">
                        <i class="fas fa-shopping-bag me-2"></i>Return to Shopping
                    </a>
                    <a href="{{ route('customer.orders') }}" class="btn btn-sm">
                        <i class="fas fa-file-invoice-dollar me-2"></i>My Orders
                    </a>
                    <a href="{{ route('auth.logout') }}" class="btn btn-sm">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
