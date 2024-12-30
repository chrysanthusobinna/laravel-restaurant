
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

 
@endpush


@section('title', 'Menus')


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
    <div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/menu_bg2.jpg">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h1>Menu</h1>
                    </div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Our Menu</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->


    <!-- START SECTION OUR MENU -->
<div class="section pb_70">
    <div class="container">
        @include('partials.message-bag')




        <form action="{{ route('menu') }}" method="GET" class="mb-4">

            <div class="form-group">
                <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search menu items..." value="{{ request('search') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-danger"  ><i class="linearicons-magnifier"></i> Search</button>
                  </div>
                </div>
              </div>
  
              @if (request('search'))
              <div class="alert alert-info">
                  We found 
                  <strong>
                      {{ $categories->sum(fn($category) => $category->menus->count()) }}
                  </strong> 
                  {{ $categories->sum(fn($category) => $category->menus->count()) === 1 ? 'result' : 'results' }} 
                  for your query: <em>"{{ request('search') }}"</em>.
                  <hr/>
                  <a href="{{ route('menu') }}" class="btn-sm btn btn-light">Return to menu</a>
              </div>
          @endif
              
        </form>

        @if ($categories->isNotEmpty())
        @foreach ($categories as $category)

    
            @if ($category->menus->isNotEmpty())
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="heading_tab_header animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <div class="heading_s1">
                            <h2>{{ $category->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    @foreach ($category->menus as $menu)
                        <div class="d-flex col-lg-3 col-sm-6">
                            <div class="single_product">
                                <a href="{{ route('menu.item', $menu->id) }}">
                                    <div class="menu_product_img">
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }} img">
                                    </div>
                                </a>
                                <div class="menu_product_info">
                                    <div class="title">
                                        <h5><a href="{{ route('menu.item', $menu->id) }}">{{ $menu->name }}</a></h5>
                                    </div>
                                    <p>{!! $site_settings->currency_symbol !!}{{ number_format($menu->price, 2) }}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

            @endif
        @endforeach
    @else
        <p>No categories found.</p>
    @endif
            
 

    </div>
</div>
<!-- END SECTION OUR MENU -->

 
@endsection



 