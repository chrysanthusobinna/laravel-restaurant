
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        const csrfToken = "{{ csrf_token() }}";
        const addToCartUrl = "{{ route('customer.cart.add') }}";
        const removeFromCartUrl = "{{ route('customer.cart.remove') }}";
        const updateCartUrl = "{{ route('customer.cart.update') }}"; 
    </script>
    <script src="{{ asset('/assets/js/customer-cart-menu-route.js') }}"></script>

 
@endpush


@section('title', 'Menu Details')


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
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/product_bg.jpg">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
            		<h1>Product Detail</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
		<div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <img src='{{ asset('storage/' . $menu->image) }}' alt="product_img1" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#">{{ $menu->name }}</a></h4>
                        <div class="product_price"> 
                            <span class="price">{!! $site_settings->currency_symbol !!}{{ number_format($menu->price, 2) }}</span> 
                        </div>
                        <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:100%"></div>
                                </div>
                                
                            </div>
                            <br/>
                            <hr/>
                        <div class="pr_desc">
                            <p>{{ $menu->description  }}</p>
                        </div>
                        <ul class="product-meta">
                            <li>Category:  {{ $menu->category->name }}</li>
                        </ul>
                    </div>
                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity {{ $quantity==0? 'd-none':'' }}"  >
                                <input type="button" value="-" class="minus">
                                <input type="text" min="0" name="quantity" value="{{ $quantity }}" title="Qty" class="qty quantity-input" size="4" data-id="{{ $menu->id }}">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button data-id="{{ $menu->id }}"
                                data-name="{{ $menu->name }}"
                                data-price="{{ $menu->price }}" 
                                data-img_src="{{ asset('storage/' . $menu->image) }}"                                            
                                type="button"  class="{{ $quantity==0 ? '':'d-none' }} btn btn-default rounded-0 add-to-cart"  >Add To Cart</button>


                                <button onclick="window.location.href='{{ route('customer.checkout') }}'" type="button" class="{{ $quantity == 0 ? 'd-none' : '' }} btn checkout-btn btn-secondary rounded-0">Proceed To CheckOut</button>

                        </div>
                    </div>
                    <hr />
                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <!-- Facebook Share -->
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank">
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            
                            <!-- Twitter Share -->
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text=Check+this+out!" target="_blank">
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>

                            
                            <!-- WhatsApp Share -->
                            <li>
                                <a href="https://api.whatsapp.com/send?text=Check+this+out!+{{ urlencode(Request::url()) }}" target="_blank">
                                    <i class="ion-social-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="medium_divider clearfix"></div>
            </div>
        </div>
   
        <div class="row">
        	<div class="col-12">
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="heading_s1">
                	<h3>Releted</h3>
                </div>
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="10" data-responsive='{"0":{"items": "1"}, "575":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>

                        @forelse ($relatedMenus as $relatedMenu)
                            <div class="item">
                                <div class="single_product">
                                    <a href="{{ route('menu.item', $relatedMenu->id) }}">
                                        <div class="menu_product_img">
                                            <img src="{{ asset('storage/' . $relatedMenu->image) }}" alt="{{ $relatedMenu->name }} img">
                                        </div>
                                    </a>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="{{ route('menu.item', $relatedMenu->id) }}">{{ $relatedMenu->name }}</a></h5>
                                        </div>
                                        <p>{!! $site_settings->currency_symbol !!}{{ number_format($relatedMenu->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No related menus found.</p>
                        @endforelse
                     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
@endsection



 