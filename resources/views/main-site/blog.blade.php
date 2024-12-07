
@extends('layouts.main-site')

@push('styles')
    
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="assets/color/theme-red.css">
@endpush

@push('scripts')
 
    <!-- Latest jQuery --> 
    <script src="assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="assets/js/scripts.js"></script>
@endpush


@section('title', 'Blog')


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
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="assets/images/blog_bg.jpg">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
            		<h1>Blog</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

    <!-- START SECTION BLOG-->
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img1.jpg" alt="blog_small_img1">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">The Sanford Stadium project consists of three main areas</a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.3s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img2.jpg" alt="blog_small_img2">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">On the other hand we provide Inhence with righteous Career</a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img3.jpg" alt="blog_small_img3">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">A cheap and flexible solution for those who want a starter package </a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img4.jpg" alt="blog_small_img4">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">A cheap and flexible solution for those who want a starter package </a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img5.jpg" alt="blog_small_img5">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">A cheap and flexible solution for those who want a starter package </a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="blog_post blog_style1 box_shadow1">
                        <div class="blog_img">
                            <a href="#">
                                <img src="assets/images/blog_small_img6.jpg" alt="blog_small_img6">
                            </a>
                            <span class="post_date radius_all_10"><strong>02</strong> May</span>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-user"></i> By Admin</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <h5 class="blog_title"><a href="#">A cheap and flexible solution for those who want a starter package </a></h5>
                                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2 mt-md-4">
                    <ul class="pagination pagination_style1 justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="linearicons-arrow-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="linearicons-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    <!-- END SECTION BLOG-->
@endsection



 