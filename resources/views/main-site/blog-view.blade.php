
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


@section('title', 'Blog Details')


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
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/blog_detail_bg.jpg">
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

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9">
            	<div class="single_post">
                    <div class="blog_img">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->name }} img">
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            <h2 class="blog_title">{{ $blog->name }}</h2>
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ti-calendar"></i> {{ $blog->created_at->format('g:i A -  j M, Y') }}</a></li>
                             </ul>
                             {!! $blog->content !!}
                        	<div class="blog_post_footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                      
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="social_icons text-md-right">
                                             <!-- Facebook Share -->
                                            <li>
                                                <a  class="sc_facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank">
                                                    <i class="ion-social-facebook"></i>
                                                </a>
                                            </li>
                                            
                                            <!-- Twitter Share -->
                                            <li>
                                                <a  class="sc_twitter" href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text=Check+this+out!" target="_blank">
                                                    <i class="ion-social-twitter"></i>
                                                </a>
                                            </li>

                                            
                                            <!-- WhatsApp Share -->
                                            <li>
                                                <a class="btn-success" href="https://api.whatsapp.com/send?text=Check+this+out!+{{ urlencode(Request::url()) }}" target="_blank">
                                                    <i class="ion-social-whatsapp"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
 
              
            </div>
        	<div class="col-lg-3 mt-3 mt-lg-0">
            	<div class="sidebar">
                	<div class="widget">
                    	<h5 class="widget_title">Search</h5>
                        <div class="search_form">
                            <form action="{{ route('blogs') }}" method="GET"> 
                                <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search..." type="text" required>
                                <button type="submit"  class="btn icon_search" value="Submit">
                                    <i class="ion-ios-search-strong"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                	<div class="widget">
                    	<h5 class="widget_title">Recent Posts</h5>
                        <ul class="widget_recent_post">
                            @forelse ($relatedBlogs as $relatedBlog)
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="{{ route('blog.view', $relatedBlog->id) }}"><img style="width:80px;" src="{{ asset('storage/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->name }} img"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">{{ $relatedBlog->name }}</a></h6>
                                        <p class="small m-0">{{ $relatedBlog->created_at->format('g:i A -  j M, Y') }}</p>
                                    </div>
                                </div>
                            </li>
                            @empty
                                <p>No related blogs found.</p>
                            @endforelse                        
                    	</ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->
@endsection



 