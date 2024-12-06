 
<!-- START FOOTER -->
<footer class="footer_dark pattern_top background_bg overlay_bg_80" data-img-src="assets/images/footer_bg.jpg">
	<div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="index-6.html"><img src="assets/images/logo_light.png" alt="logo"></a>
                        </div>
                        <p>At {{ config('site.name') }}, we pride ourselves on bringing you the authentic flavors of West Africa. Our expertly crafted dishes and warm hospitality create a dining experience you won't forget.</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white social_style1 rounded_social">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
        		</div>
                <div class="col-xl-3 col-md-3 col-sm-12">
                	<div class="widget">
                        <h6 class="widget_title">Links</h6>
                        <ul class="widget_links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Our Menu</a></li>
                            <li><a href="#">About us</a> </li>
                            <li><a href="#">Contact us</a></li>
                            
                            @if($whatsAppNumber)
                            <li> <a href="https://wa.me/{{ $whatsAppNumber->phone_number }}" target="_blank" ><i class="fa fa-whatsapp"></i> Chat us on Whatsapp</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-12">
                	<div class="widget">
                        <h6 class="widget_title">Contact Info</h6>
                        <ul class="contact_info contact_info_light">
                            @if($firstRestaurantAddress) <li> <i class="ti-location-pin"></i> <p>{{ $firstRestaurantAddress->address }}</p></li> @endif

                            <li> <i class="ti-email"></i>  <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a> </li>
                        
                            @if($firstRestaurantAddress) <li> <i class="ti-mobile"></i> <p>{{ $firstRestaurantAddress->address }}</p> </li> @endif


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
            	<div class="bottom_footer border-top-tran">
                	<div class="row">
                        <div class="col-md-12">
                            <p class="mb-0 text-center"><script>document.write(new Date().getFullYear());</script> &copy;   All Rights Reserved | <span class="text_default">{{ config('site.name') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

