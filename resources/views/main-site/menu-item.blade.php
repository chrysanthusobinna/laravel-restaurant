
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
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="assets/images/product_bg.jpg">
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
                    <img src='assets/images/product_big_img1.jpg' alt="product_img1" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#">Nam neque pellentesque</a></h4>
                        <div class="product_price">
                            <span class="price">$39.00</span>
                        </div>
                        <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:80%"></div>
                                </div>
                                <span class="rating_num">(21)</span>
                            </div>
                        <div class="pr_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                        </div>
                        <ul class="product-meta">
                            <li>SKU: <a href="#">BE45VGRT</a></li>
                            <li>Category: <a href="#">Food</a></li>
                            <li>Tags: <a href="#" rel="tag">Lunch</a>, <a href="#" rel="tag">Fast Food</a></li>
                        </ul>
                    </div>
                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button class="btn btn-default btn-addtocart" type="button"><span>Add to cart</span></button>
                        </div>
                    </div>
                    <hr />
                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
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
            	<div class="tab-style4">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                      	</li>
                      	<li class="nav-item">
                        	<a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                      	</li>
                      	<li class="nav-item">
                        	<a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews (3)</a>
                      	</li>
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	<div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                        	<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                        	<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                      	</div>
                      	<div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                        	<table class="table table-bordered">
                                <tr>
                                    <td>Weight</td>
                                    <td>0.5 Kg</td>
                                </tr>
                                <tr>
                                    <td>Dimensions</td>
                                    <td>16 x 22 x 123 cm</td>
                                </tr>
                        	</table>
                      	</div>
                      	<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        	<div class="comments">
                            	<div class="heading_s1">
                            		<h5>Customer Reviews</h5>
                                </div>
                                <ul class="list_none comment_list">
                                    <li class="comment_info">
                                        <div class="d-flex">
                                            <div class="comment_user">
                                                <img src="assets/images/user1.jpg" alt="user1">
                                            </div>
                                            <div class="comment_content">
                                                <div class="d-sm-flex">
                                                    <div class="meta_data">
                                                        <h6><a href="#">Sarah Taylor</a></h6>
                                                        <div class="comment-time">MARCH 5, 2018, 6:05 PM</div>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width:80%"></div>
                                                            </div>
                                                            <span class="rating_num">4.0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>We denounce With righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire that the cannot foresee the pain and trouble.</p>
                                            </div>
                                        </div>
                                        <ul class="children">
                                            <li class="comment_info">
                                                <div class="d-flex">
                                                    <div class="comment_user">
                                                        <img src="assets/images/user2.jpg" alt="user2">
                                                    </div>
                                                    <div class="comment_content">
                                                        <div class="d-sm-flex align-items-md-center">
                                                            <div class="meta_data">
                                                                <h6><a href="#">John Becker</a></h6>
                                                                <div class="comment-time">april 8, 2018, 5:15 PM</div>
                                                            </div>
                                                            <div class="ml-auto">
                                                                <div class="rating_wrap">
                                                                    <div class="rating">
                                                                        <div class="product_rate" style="width:80%"></div>
                                                                    </div>
                                                                    <span class="rating_num">4.0</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>We denounce With righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire that the cannot foresee the pain and trouble.</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="comment_info">
                                        <div class="d-flex">
                                            <div class="comment_user">
                                                <img src="assets/images/user3.jpg" alt="user3">
                                            </div>
                                            <div class="comment_content">
                                                <div class="d-sm-flex">
                                                    <div class="meta_data">
                                                        <h6><a href="#">Daisy Lana</a></h6>
                                                        <div class="comment-time">april 15, 2018, 10:30 PM</div>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width:80%"></div>
                                                            </div>
                                                            <span class="rating_num">4.0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>We denounce With righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire that the cannot foresee the pain and trouble.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                        	</div>
                            <div class="review_form">
                                <div class="heading_s1">
                                    <h5>Add a review</h5>
                                </div>
                                <form class="row">
                                    <div class="form-group col-12">
                                        <div class="star_rating">
                                            <span data-value="1"><i class="far fa-star"></i></span>
                                            <span data-value="2"><i class="far fa-star"></i></span> 
                                            <span data-value="3"><i class="far fa-star"></i></span>
                                            <span data-value="4"><i class="far fa-star"></i></span>
                                            <span data-value="5"><i class="far fa-star"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                    </div>
                                   
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                      	</div>
                	</div>
                </div>
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
                	<h3>Releted Products</h3>
                </div>
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="10" data-responsive='{"0":{"items": "1"}, "575":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>
                	<div class="item">
                        <div class="single_product">
                            <div class="menu_product_img">
                                <img src="assets/images/menu_item1.jpg" alt="menu_item1">
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
                    <div class="item">
                        <div class="single_product">
                            <div class="menu_product_img">
                                <img src="assets/images/menu_item2.jpg" alt="menu_item2">
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
                    <div class="item">
                        <div class="single_product">
                            <div class="menu_product_img">
                                <img src="assets/images/menu_item3.jpg" alt="menu_item3">
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
                    <div class="item">
                        <div class="single_product">
                            <div class="menu_product_img">
                                <img src="assets/images/menu_item4.jpg" alt="menu_item4">
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
                    <div class="item">
                        <div class="single_product">
                            <div class="menu_product_img">
                                <img src="assets/images/menu_item5.jpg" alt="menu_item5">
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
<!-- END SECTION SHOP -->
@endsection



 