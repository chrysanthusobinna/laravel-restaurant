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
            background: linear-gradient(135deg, rgba(251, 251, 251, 0.18), rgba(111,66,193,.14));
            padding: 24px 24px;
        }
        .acct-name {
            font-weight: 800;
            font-size: 1.1rem;
        }
        .badge-status {
            font-size: .7rem;
            text-transform: uppercase;
            padding: .25rem .6rem;
            border-radius: 999px;
            letter-spacing: .05em;
        }
        .badge-status.pending {
            background: #fff3cd;
            color: #856404;
        }
        .badge-status.completed {
            background: #d1e7dd;
            color: #0f5132;
        }
        .badge-status.cancelled {
            background: #f8d7da;
            color: #842029;
        }
        .badge-type {
            font-size: .7rem;
            text-transform: uppercase;
            padding: .2rem .5rem;
            border-radius: 999px;
            background: #e9ecef;
            color: #495057;
        }
        .section-hd {
            font-weight: 700;
            font-size: .95rem;
            margin-bottom: .5rem;
        }
        .addr-card {
            border-radius: 12px;
            border: 1px solid #eef0f3;
            padding: 10px 12px;
            background: #fff;
            font-size: .9rem;
        }
        .muted {
            color: #6c757d;
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
@endpush

@section('title', 'Order Details')

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
            <!-- HERO: Order summary header -->
            <div class="acct-hero">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <div class="acct-name">
                            Order #{{ $order->order_no }}
                        </div>
                        <div class="text-dark-50 small mt-1">
                            Placed on {{ optional($order->created_at)->format('d M Y, H:i') }}
                        </div>
                        <div class="mt-2 d-flex flex-wrap gap-2">
                            @php $status = $order->status ?? 'pending'; @endphp
                            <span class="badge-status {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>
                            <span class="badge-type">
                                {{ ucfirst($order->order_type ?? 'online') }}
                            </span>
                            @if($order->status_online_pay)
                                <span class="badge-status {{ $order->status_online_pay === 'paid' ? 'completed' : 'pending' }}">
                                    {{ strtoupper($order->status_online_pay) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="text-md-end">
                        <div class="text-dark-50 small">Total</div>
                        <div style="font-size:1.4rem; font-weight:800;">
                            {!! $site_settings->currency_symbol ?? '£' !!}{{ number_format($order->total_price, 2) }}
                        </div>
                        @if($order->payment_method)
                            <div class="text-dark-50 small mt-1">
                                Payment: {{ strtoupper($order->payment_method) }}
                            </div>
                        @endif
                        <div class="mt-3 d-flex justify-content-md-end gap-2">
                            <a href="{{ route('customer.orders') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Back to Orders
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-shopping-bag me-1"></i> Return to Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BODY -->
            <div class="p-3 p-md-4">
                <div class="row gy-4">
                    <!-- Order items -->
                    <div class="col-lg-7">
                        <div class="section-hd">Items </div>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->menu_name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">
                                                {!! $site_settings->currency_symbol ?? '£' !!}{{ number_format($item->subtotal, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="2" class="text-end fw-semibold">Items Subtotal</td>
                                        <td class="text-end fw-semibold">
                                            {!! $site_settings->currency_symbol ?? '£' !!}
                                            {{ number_format($order->total_price - ($order->delivery_fee ?? 0), 2) }}
                                        </td>
                                    </tr>

                                    @if($order->delivery_fee)
                                        <tr>
                                            <td colspan="2" class="text-end">Delivery Fee</td>
                                            <td class="text-end">
                                                {!! $site_settings->currency_symbol ?? '£' !!}{{ number_format($order->delivery_fee, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Addresses & meta -->
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <div class="section-hd">Delivery / Pickup</div>

                            @if($order->order_type === 'pickup' && $order->pickupAddress)
                                <div class="addr-card">
                                    <div class="fw-semibold mb-1">Pickup Location</div>
                                    <div>{{ $order->pickupAddress->full_address ?? '' }}</div>
                                </div>
                            @elseif($order->deliveryAddressWithTrashed)
                                <div class="addr-card">
                                    <div class="fw-semibold mb-1">Delivery Address</div>
                                    <div>{{ $order->deliveryAddressWithTrashed->full_address ?? '' }}</div>
                     
                                </div>
                            @else
                                <div class="addr-card muted">
                                    No address information for this order.
                                </div>
                            @endif
                        </div>

                        @if($order->additional_info)
                        <div class="mb-3">
                            <div class="section-hd">Additional Information</div>
                            <div class="addr-card">
                                <hr class="my-2">
                                 <div>{{ $order->additional_info }}</div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
