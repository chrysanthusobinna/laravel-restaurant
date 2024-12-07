
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
@endpush


@section('title', 'Home')


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
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="heading_tab_header animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="heading_s1">
                        <h2>from Our Menu</h2>
                    </div>
                    <div class="tab-style1">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabmenubar" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <ul id="tabmenubar" class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Breakfast-tab" data-toggle="tab" href="#Breakfast" role="tab" aria-controls="Breakfast" aria-selected="true">Breakfast</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Lunch-tab" data-toggle="tab" href="#Lunch" role="tab" aria-controls="Lunch" aria-selected="false">Lunch</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Breakfast" role="tabpanel" aria-labelledby="Breakfast-tab">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product">
                                    <div class="menu_product_img">
                                        <img src="/assets/images/menu_item1.jpg" alt="menu_item1">
                                        <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div>
                                    </div>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="#">Nam neque pellentesque</a></h5>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
                                    </div>
                                    <div class="menu_footer">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <div class="price">
                                            <span>$39</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product">
                                    <div class="menu_product_img">
                                        <img src="/assets/images/menu_item2.jpg" alt="menu_item2">
                                        <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div>
                                    </div>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="#">Nam neque pellentesque</a></h5>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
                                    </div>
                                    <div class="menu_footer">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <div class="price">
                                            <span>$39</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product">
                                    <div class="menu_product_img">
                                        <img src="/assets/images/menu_item3.jpg" alt="menu_item3">
                                        <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div>
                                    </div>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="#">Nam neque pellentesque</a></h5>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
                                    </div>
                                    <div class="menu_footer">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <div class="price">
                                            <span>$39</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Lunch" role="tabpanel" aria-labelledby="Lunch-tab">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product">
                                    <div class="menu_product_img">
                                        <img src="/assets/images/menu_item5.jpg" alt="menu_item5">
                                        <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div>
                                    </div>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="#">Nam neque pellentesque</a></h5>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
                                    </div>
                                    <div class="menu_footer">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <div class="price">
                                            <span>$39</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product">
                                    <div class="menu_product_img">
                                        <img src="/assets/images/menu_item7.jpg" alt="menu_item7">
                                        <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div>
                                    </div>
                                    <div class="menu_product_info">
                                        <div class="title">
                                            <h5><a href="#">Nam neque pellentesque</a></h5>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
                                    </div>
                                    <div class="menu_footer">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <div class="price">
                                            <span>$39</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION OUR MENU -->

 
@endsection



 