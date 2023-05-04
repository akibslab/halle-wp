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
	jQuery(window).load(function () {
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
	});

	$(".gallery-section .image")
		.mouseover(function () {
			$(this).attr("src", $(this).data("hover"));
		})
		.mouseout(function () {
			$(this).attr("src", $(this).data("src"));
		});
})(jQuery);
