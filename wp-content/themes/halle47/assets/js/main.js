(function ($) {
	"use strict";

	$(".site-header .logo-box .mobile_bar").on("click", function () {
		$(".mobile_menu").addClass("open");
	});
	$(".mobile_menu .mobile_menu_top .mobile_cross").on("click", function () {
		$(".mobile_menu").removeClass("open");
	});

	$(window).on("scroll", function () {
		var scroll = $(window).scrollTop();
		if (scroll < 250) {
			$(".site-header .logo-box .mobile_bar.bar-2").removeClass("sticky");
		} else {
			$(".site-header .logo-box .mobile_bar.bar-2").addClass("sticky");
		}
	});

	// Start Isotope
	function isotopeActive() {
		var $grid = $(".grid").isotope({
			// main isotope options
			itemSelector: ".grid-item",
			percentPosition: true,
			// set layoutMode
			layoutMode: "masonry",
			// options for masonry layout mode
			masonry: {
				columnWidth: ".grid-sizer",
				gutter: ".gutter-sizer",
				// fitWidth: true,
			},
		});
	}


	function aboutCarouselActive() {
		$('.about-carousel').owlCarousel({
		    loop:false,
		    margin:10,
		    nav:false,
		    dots:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		});

		lightbox.option({
	      'resizeDuration': 200,
	      'wrapAround': true
	    })
	}

	function memoryCarouselActive() {
		$('.memory-carousel').owlCarousel({
		    loop:false,
		    margin:10,
		    nav:false,
		    dots:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		})
	}

	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/news.default",isotopeActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/about.default",aboutCarouselActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/memory.default",memoryCarouselActive
		);
	});
		
	

	$(".gallery-section .image")
	.mouseover(function () {
		$(this).attr("src", $(this).data("hover"));
	})
	.mouseout(function () {
		$(this).attr("src", $(this).data("src"));
	});

})(jQuery);
