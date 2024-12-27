
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


            <form action="{{ route('blogs') }}" method="GET" class="mb-5">

                <div class="form-group">
                    <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search blogs..." value="{{ request('search') }}">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-danger"  ><i class="linearicons-magnifier"></i> Search</button>
                      </div>
                    </div>
                  </div>
      
                  @if (request('search'))
                  <div class="alert alert-info mt-3">
                    <strong>Search Results:</strong>
                    We found <strong>{{ $blogs->total() }}</strong> 
                    {{ $blogs->total() === 1 ? 'result' : 'results' }} for your query 
                    <em>"{{ request('search') }}"</em>.
                    <hr/>
                    <a href="{{ route('blogs') }}" class="btn-sm btn btn-light">Return to Blogs</a>
                </div>
              @endif
                  
            </form>
 
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="d-flex col-lg-4 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                        <div class="blog_post blog_style1 box_shadow1">
                            <div class="blog_img">
                                <a href="{{ route('blog.view', $blog->id) }}">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="blog_small_img1">
                                </a>
                                <span class="post_date">
                                    <strong>{{ $blog->created_at->format('d') }}</strong> {{ $blog->created_at->format('M') }}
                                </span>
                            </div>
                            <div class="blog_content">
                                <div class="blog_text">
                                    <h5 class="blog_title"><a href="#">{{ $blog->name }}</a></h5>
                                    <p>{{ Str::limit(strip_tags($blog->content), 50) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @if(!request('search'))
                        <div class="col-12">                   
                            <div class="alert alert-warning text-center" role="alert">
                                No blogs found.
                            </div>
                        </div>
                    @endif
                @endforelse
            </div>

            {{ $blogs->links('vendor.pagination.custom') }}
           
            
        </div>
    </div> 
    <!-- END SECTION BLOG-->
@endsection



 