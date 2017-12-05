/**
 * ColorMag Custom Elementor JS settings
 */
jQuery( document ).ready( function () {
	// Swiper JS settings
	if ( typeof Swiper !== 'undefined' ) {
		var mySwiper = new Swiper( '.tg-module-grid--style-7 .swiper-container', {
			loop       : true,
			nextButton : '.swiper-button-next',
			prevButton : '.swiper-button-prev'
		} );
	}
} );