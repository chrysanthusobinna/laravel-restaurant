/*===================================
Author       : Templatemanja.
Template Name: Tashan Restaurant and Cafe HTML5 Template
Version      : 1.0
===================================*/

/*===================================*
PAGE JS
*===================================*/

(function($) {
	'use strict';
	
	/*===================================*
	01. LOADING JS
	/*===================================*/
	$(window).on('load', function() {
		setTimeout(function () {
			$("#preloader").delay(600).fadeOut(600).addClass('loaded');
		}, 700);
	});

	/*===================================*
	02. BACKGROUND IMAGE JS
	*===================================*/
	/*data image src*/
	$(".background_bg").each(function() {
		var attr = $(this).attr('data-img-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background-image', 'url(' + attr + ')');
		}
	});
	
	/*===================================*
	03. ANIMATION JS
	*===================================*/
	$(function() {
	
		function ckScrollInit(items, trigger) {
			items.each(function() {
				var ckElement = $(this),
					AnimationClass = ckElement.attr('data-animation'),
					AnimationDelay = ckElement.attr('data-animation-delay');
	
				ckElement.css({
					'-webkit-animation-delay': AnimationDelay,
					'-moz-animation-delay': AnimationDelay,
					'animation-delay': AnimationDelay,
					opacity: 0
				});
	
				var ckTrigger = (trigger) ? trigger : ckElement;
	
				ckTrigger.waypoint(function() {
					ckElement.addClass("animated").css("opacity", "1");
					ckElement.addClass('animated').addClass(AnimationClass);
				}, {
					triggerOnce: true,
					offset: '90%',
				});
			});
		}
	
		ckScrollInit($('.animation'));
		ckScrollInit($('.staggered-animation'), $('.staggered-animation-wrap'));
	
	});
	
	/*===================================*
	04. MENU JS
	*===================================*/
	//Main navigation scroll spy for shadow
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop();

	    if (scroll >= 150) {
	        $('header.fixed-top').addClass('nav-fixed');
	    } else {
	        $('header.fixed-top').removeClass('nav-fixed');
	    }

	});
	
	//Show Hide dropdown-menu Main navigation 
	$( document ).on('ready', function () {
		$( '.dropdown-menu a.dropdown-toggler' ).on( 'click', function ( e ) {
			//var $el = $( this );
			//var $parent = $( this ).offsetParent( ".dropdown-menu" );
			if ( !$( this ).next().hasClass( 'show' ) ) {
				$( this ).parents( '.dropdown-menu' ).first().find( '.show' ).removeClass( "show" );
			}
			var $subMenu = $( this ).next( ".dropdown-menu" );
			$subMenu.toggleClass( 'show' );
			
			$( this ).parent( "li" ).toggleClass( 'show' );
	
			$( this ).parents( 'li.nav-item.dropdown.show' ).on( 'hidden.bs.dropdown', function ( e ) {
				$( '.dropdown-menu .show' ).removeClass( "show" );
			} );
			
			return false;
		});
	});
	
	//Hide Navbar Dropdown After Click On Links
	var navBar = $(".header_wrap");
	var navbarLinks = navBar.find(".navbar-collapse ul li a.page-scroll");

    $.each( navbarLinks, function( i, val ) {

      var navbarLink = $(this);

        navbarLink.on('click', function () {
          navBar.find(".navbar-collapse").collapse('hide');
		  $("header").removeClass("active");
        });

    });
	
	//Main navigation Active Class Add Remove
	$('.navbar-toggler').on('click', function() {
		$("header").toggleClass("active");
		if($('.search-overlay').hasClass('open'))
		{
			$(".search-overlay").removeClass('open');
			$(".search_trigger").removeClass('open');
		}
	});
	
	$( document ).on('ready', function() {
		if ($('.header_wrap').hasClass("fixed-top") && !$('.header_wrap').hasClass("transparent_header") && !$('.header_wrap').hasClass("no-sticky")) {
			$(".header_wrap").before('<div class="header_sticky_bar d-none"></div>');
		}
	});
	
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop();

	    if (scroll >= 150) {
	        $('.header_sticky_bar').removeClass('d-none');
			$('header.no-sticky').removeClass('nav-fixed');
			
	    } else {
	        $('.header_sticky_bar').addClass('d-none');
	    }

	});
	
	var setHeight = function() {
		var height_header = $(".header_wrap").height();
		$('.header_sticky_bar').css({'height':height_header});
	};
	
	$(window).on('load', function() {
	  setHeight();
	});
	
	$(window).on('resize', function() {
	  setHeight();
	});
	
	$('.sidetoggle').on('click', function () {
		$(this).addClass('open');
		$('body,.sidebar_menu').addClass('active');
		$("body").append('<div id="header-overlay" class="header-overlay"></div>');
	});
	
	$('.account_trigger').on('click', function() {
		$('.account_box').addClass('show');
		$('body').toggleClass("cart_open");
		$(".account_box").after('<div id="header-overlay" class="header-overlay"></div>');
	});
	
	$(document).on('click', '#header-overlay, .sidemenu_close',function() {
		$('.sidetoggle').removeClass('open');
		$('.account_box').removeClass('show');
		$('body').removeClass('cart_open');
		$('body,.sidebar_menu').removeClass('active');
		$('#header-overlay').fadeOut('3000',function(){
			$('#header-overlay').remove();
		});  
		 return false;
	});
	/*===================================*
	05. SMOOTH SCROLLING JS
	*===================================*/
	// Select all links with hashes
		
	$(function() {
		
    	$('a.page-scroll[href*="#"]:not([href="#"])').on('click', function() {
		var headerstickHeight = $(".header_wrap").innerHeight();	
        // On-page links
		$('a.page-scroll.active').removeClass('active');
		$(this).closest('.page-scroll').addClass('active');
        if ( location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname ) {
          // Figure out element to scroll to
          var target = $(this.hash),
              speed= $(this).data("speed") || 800;
              target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
		  if($('.header_wrap').hasClass('fixed-top')){
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				
					$('html, body').animate({
					  scrollTop: target.offset().top - headerstickHeight
					}, speed);
			}
		  }
		  else {
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				
					$('html, body').animate({
					  scrollTop: target.offset().top
					}, speed);
			}
		  }
        }
    });	
	});
	
	/*===================================*
	06. SEARCH JS
	*===================================*/
    
	$(".close-search").on("click", function() {
		$(".search_wrap,.search_overlay").removeClass('open');
		$("body").removeClass('search_open');
	});
	
	var removeClass = true;
	$(".search_wrap").after('<div class="search_overlay"></div>');
	$(".search_trigger").on('click', function () {
		$(".search_wrap,.search_overlay").toggleClass('open');
		$("body").toggleClass('search_open');
		removeClass = false;
		if($('.navbar-collapse').hasClass('show'))
		{
			$(".navbar-collapse").removeClass('show');
			$(".navbar-toggler").addClass('collapsed');
			$(".navbar-toggler").attr("aria-expanded", false);
		}
	});
	$(".search_wrap form").on('click', function() {
		removeClass = false;
	});
	$("html").on('click', function () {
		if (removeClass) {
			$("body").removeClass('open');
			$(".search_wrap,.search_overlay").removeClass('open');
			$("body").removeClass('search_open');
		}
		removeClass = true;
	});
	
	/*===================================*
	07. SCROLLUP JS
	*===================================*/
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 150) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});
	
	$(".scrollup").on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	/*===================================*
	08. PARALLAX JS
	*===================================*/
	$(window).on('load', function() {
        $('.parallax_bg').parallaxBackground();
	});
	
	/*===================================*
	09. COUNTER JS
	*===================================*/
	var timer = $('.counter');
	if(timer.length) {
		timer.appear(function () {
		  timer.countTo();
	  });
	}
	
	/*===================================*
	10. MASONRY JS
	*===================================*/
	$( window ).on( "load", function() {
		var $grid_selectors  = $(".grid_container");
		var filter_selectors = ".grid_filter > li > a";
		if( $grid_selectors.length > 0 ) {
			$grid_selectors.imagesLoaded(function(){
				if ($grid_selectors.hasClass("masonry")){
					$grid_selectors.isotope({
						itemSelector: '.grid_item',
						percentPosition: true,
						layoutMode: "masonry",
						masonry: {
							columnWidth: '.grid-sizer'
						},
					});
				} 
				else {
					$grid_selectors.isotope({
						itemSelector: '.grid_item',
						percentPosition: true,
						layoutMode: "fitRows",
					});
				}
			});
		}
	
		//isotope filter
		$(document).on( "click", filter_selectors, function() {
			$(filter_selectors).removeClass("current");
			$(this).addClass("current");
			var dfselector = $(this).data('filter');
			if ($grid_selectors.hasClass("masonry")){
				$grid_selectors.isotope({
					itemSelector: '.grid_item',
					layoutMode: "masonry",
					masonry: {
						columnWidth: '.grid_item'
					},
					filter: dfselector
				});
			} 
			else {
				$grid_selectors.isotope({
					itemSelector: '.grid_item',
					layoutMode: "fitRows",
					filter: dfselector
				});
			}
			return false;
		});
		
		$('.portfolio_filter').on('change', function() {
			$grid_selectors.isotope({
			  filter: this.value
			});
		});

		$(window).on("resize", function () {
			setTimeout(function () {
				$grid_selectors.find('.grid_item').removeClass('animation').removeClass('animated'); // avoid problem to filter after window resize
				$grid_selectors.isotope('layout');
			}, 300);
		});
	});
	
	$('.link_container').each(function () {
		$(this).magnificPopup({
			delegate: '.image_popup',
			type: 'image',
			mainClass: 'mfp-zoom-in',
			removalDelay: 500,
			gallery: {
				enabled: true
			}
		});
	});
	
	/*===================================*
	11. SLIDER JS
	*===================================*/
	function carousel_slider() {
		$('.carousel_slider').each( function() {
			var $carousel = $(this);
			$carousel.owlCarousel({
				dots : $carousel.data("dots"),
				loop : $carousel.data("loop"),
				items: $carousel.data("items"),
				margin: $carousel.data("margin"),
				mouseDrag: $carousel.data("mouse-drag"),
				touchDrag: $carousel.data("touch-drag"),
				autoHeight: $carousel.data("autoheight"),
				center: $carousel.data("center"),
				nav: $carousel.data("nav"),
				rewind: $carousel.data("rewind"),
				navText: ['<i class="ion-arrow-left-c"></i>', '<i class="ion-arrow-right-c"></i>'],
				autoplay : $carousel.data("autoplay"),
				animateIn : $carousel.data("animate-in"),
				animateOut: $carousel.data("animate-out"),
				autoplayTimeout : $carousel.data("autoplay-timeout"),
				smartSpeed: $carousel.data("smart-speed"),
				responsive: $carousel.data("responsive")
			});	
		});
	}
	
	function slick_slider() {
		$('.slick_slider').each( function() {
			var $slick_carousel = $(this);
			$slick_carousel.slick({
				arrows: $slick_carousel.data("arrows"),
				dots: $slick_carousel.data("dots"),
				infinite: $slick_carousel.data("infinite"),
				centerMode: $slick_carousel.data("center-mode"),
				vertical: $slick_carousel.data("vertical"),
				fade: $slick_carousel.data("fade"),
				cssEase: $slick_carousel.data("css-ease"),
				autoplay: $slick_carousel.data("autoplay"),
				verticalSwiping: $slick_carousel.data("vertical-swiping"),
				autoplaySpeed: $slick_carousel.data("autoplay-speed"),
				speed: $slick_carousel.data("speed"),
				pauseOnHover: $slick_carousel.data("pause-on-hover"),
				draggable: $slick_carousel.data("draggable"),
				slidesToShow: $slick_carousel.data("slides-to-show"),
				slidesToScroll: $slick_carousel.data("slides-to-scroll"),
				asNavFor: $slick_carousel.data("as-nav-for"),
				focusOnSelect: $slick_carousel.data("focus-on-select"),
				responsive: $slick_carousel.data("responsive")
			});	
		});
	}
	
	$( document ).on('ready', function() {
		carousel_slider();
		slick_slider();
	});
	
	/*===================================*
	12. CONTACT FORM JS
	*===================================*/
	$("#submitButton").on("click", function(event) {
	    event.preventDefault();
	    var mydata = $("form").serialize();
	    $.ajax({
	        type: "POST",
	        dataType: "json",
	        url: "contact.php",
	        data: mydata,
	        success: function(data) {
	            if (data.type === "error") {
	                $("#alert-msg").removeClass("alert, alert-success");
	                $("#alert-msg").addClass("alert, alert-danger");
	            } else {
	                $("#alert-msg").addClass("alert, alert-success");
	                $("#alert-msg").removeClass("alert, alert-danger");
	                $("#first-name").val("Enter Name");
	                $("#email").val("Enter Email");
					$("#phone").val("Enter Phone Number");
	                $("#subject").val("Enter Subject");
	                $("#description").val("Enter Message");

	            }
	            $("#alert-msg").html(data.msg);
	            $("#alert-msg").show();
	        },
	        error: function(xhr, textStatus) {
	            alert(textStatus);
	        }
	    });
	});
	
	/*===================================*
	13. POPUP JS
	*===================================*/
	$('.content-popup').magnificPopup({
		type: 'inline',
		preloader: true,
		mainClass: 'mfp-zoom-in',
	});
	
	$('.image_gallery').each(function() { // the containers for all your galleries
		$(this).magnificPopup({
			delegate: 'a', // the selector for gallery item
			type: 'image',
			gallery: {
			  enabled: true,
			},
		});
	});
	
	$('.popup-ajax').magnificPopup({
		type: 'ajax',
		callbacks: {
			ajaxContentAdded: function() {
				carousel_slider();
			 }
		}
	});
	
	$('.video_popup, .iframe_popup').magnificPopup({
		type: 'iframe',
		removalDelay: 160,
		mainClass: 'mfp-zoom-in',
		preloader: false,
		fixedContentPos: false
	});
	
	/*===================================*
	14. Select dropdowns
	*===================================*/
	
	if ($('select').length) {
	// Traverse through all dropdowns
	$.each($('select'), function (i, val) {
		var $el = $(val);
		
		if ($el.val()===""){ 
			$el.addClass('first_null'); 
		}
		
		if (!$el.val()) {
			$el.addClass('not_chosen');
		}
		
		$el.on('change', function () {
			if (!$el.val())
				$el.addClass('not_chosen');
			else
				$el.removeClass('not_chosen');
		});
		
	  });
	}
	
	/*===================================*
	15. PROGRESS BAR JS
	*===================================*/
	$('.progress-bar').each(function(){
		var width = $(this).attr('aria-valuenow');
		$(this).appear(function() {
			$(this).css('width', width + '%');
			$(this).children('.count_pr').css('left', width + '%');
			$(this).find('.count').countTo({
				from: 0,
                to: width,
				time: 3000,
				refreshInterval: 50,
			});
		});
	});
	
	/*===================================*
     16.COUNTDOWN JS
    *===================================*/
    $('.countdown_time').each(function() {
        var endTime = $(this).data('time');
        $(this).countdown(endTime, function(tm) {
            $(this).html(tm.strftime('<div class="countdown_box"><div class="countdown-wrap"><span class="countdown days">%D </span><span class="cd_text">Days</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown hours">%H</span><span class="cd_text">Hours</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown minutes">%M</span><span class="cd_text">Minutes</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown seconds">%S</span><span class="cd_text">Seconds</span></div></div>'));
        });
    });
	
	/*===================================*
	17. Scroll To Fixed Item Js
	*===================================*/
	$(document).on('ready', function() {
		var fsi = $(".fixed_scroll_item");
		if ($(fsi).length > 0){
			$(fsi).stick_in_parent({
				offset_top: fsi.data('margintop')
			});
		}
	});
	
	/*===================================*
	18. RATING STAR JS
	*===================================*/
	$(document).on("ready", function(){
	  $('.star_rating span').on('click', function(){
			var onStar = parseFloat($(this).data('value'), 10); // The star currently selected
			var stars = $(this).parent().children('.star_rating span');
			for (var i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('selected');
			}
			for (i = 0; i < onStar; i++) {
				$(stars[i]).addClass('selected');
			}
		});
	});
			
	/*==============================================================
    19. FIT VIDEO JS
    ==============================================================*/
    if ($(".fit-videos").length > 0){
		$(".fit-videos").fitVids({ 
			customSelector: "iframe[src^='https://w.soundcloud.com']"
		});
	}
	
	/*==============================================================
    20. DROPDOWN JS
    ==============================================================*/
	if ($(".custome_select").length > 0){
		$(document).on('ready', function() {
			$(".custome_select").msDropdown();
		});
	}
	
	/*===================================*
	21. List Grid JS
	*===================================*/
	$('.shorting_icon').on('click',function() {
		if ($(this).hasClass('grid')) {
			$('.shop_container').removeClass('list').addClass('grid');
			$(this).addClass('active').siblings().removeClass('active');
		}
		else if($(this).hasClass('list')) {
			$('.shop_container').removeClass('grid').addClass('list');
			$(this).addClass('active').siblings().removeClass('active');
		}
		$(".shop_container").append('<div class="loading_pr"><div class="mfp-preloader"></div></div>');
		setTimeout(function(){
		  $('.loading_pr').remove();
		}, 800);
	});
	

	
	/*===================================*
	23. CHECKBOX CHECK THEN ADD CLASS JS
	*===================================*/
	$('.create-account,.different_address').hide();
	$('#createaccount:checkbox').change(function(){
		if($(this).is(":checked")) {
			$('.create-account').slideDown();
		} else {
			$('.create-account').slideUp();
		}
	});
	$('#differentaddress:checkbox').change(function(){
		if($(this).is(":checked")) {
			$('.different_address').slideDown();
		} else {
			$('.different_address').slideUp();
		}
	});
	
	/*===================================*
	24. DATEPICKER JS
	*===================================*/
	$(function() {
      $('.datepicker').datepicker({
        autoHide: true,
		format: 'mm/dd/yyyy',
        zIndex: 2048,
      });
    });
	
	/*===================================*
	25. TIMEPICKER JS
	*===================================*/
	if ($(".timepicker").length > 0){
		$('.timepicker').each( function() {
			var $timepicker = $(this);
			$timepicker.mdtimepicker({
				readOnly: false,
				theme: $timepicker.data("theme"),	 
			});
		});
	}
	
 
})(jQuery);