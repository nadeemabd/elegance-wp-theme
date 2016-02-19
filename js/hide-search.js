/*
 * Toggles search on and off
 */
jQuery(document).ready(function ($) {
	$(".search-toggle").click(function () {
		var breakpoint = 1280;
//		if (window.matchMedia('(max-width: '+ breakpoint +'px)').matches) {
//			$("#search-container").slideToggle('slow', function () {
//				$('.search-toggle').toggleClass('active');
//			});
//		} else {
//			$("#search-container").animate({
//				width: 'toggle'
//			}, 500);
//
//		}
		var searchContainerBlock = $("#search-container-wrapper").css("display");

		if (searchContainerBlock == "block") {
			$("#search-container").slideToggle("slow");
		} else {
			$("#search-container").animate({
				width: "toggle"
			}, 500);

		}
		$(".search-toggle").toggleClass("active");
		$("#search-container .search-field").focus();
		// Optional return false to avoid the page "jumping" when clicked
		return false;
	});
});
