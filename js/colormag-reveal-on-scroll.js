
var revealImagesOnScroll = ( function() {

	var images = document.querySelectorAll( 'img' );

	var hideImagesInitially = function() {
		images.forEach( el => {
			if( ! el.classList.contains( 'tg-image-to-reveal-' + imageStyle[0] ) ) {
				el.classList.add( 'tg-image-to-reveal-' + imageStyle[0] );
			}
			el.isRevealed = false;
		});
		images[images.length - 1].isLastItem = true;
	};

	var events = function() {
		window.addEventListener( 'scroll', revealCaller );
		window.addEventListener( 'load', revealCaller );
	};

	function revealCaller() {
		images.forEach( el => {
			if( el.isRevealed === false ) {
				revealIfScrolledTo( el );
			}
		});
	}

	function revealIfScrolledTo( el ) {
		if( window.scrollY + window.innerHeight > el.offsetTop ) {
            var scrollPercent = ( el.getBoundingClientRect().top / window.innerHeight ) * 100;
            if( scrollPercent < 70 ) {
                el.classList.add( 'tg-image-to-reveal-' + imageStyle[0] + '--is-revealed' );
                el.isRevealed = true;
                if( el.isLastItem ){
                    window.removeEventListener( 'scroll', revealCaller );
					window.removeEventListener( 'load', revealCaller );
                }
            }
        }
	}

	return {

		init: function() {
			hideImagesInitially();
			events();
		},

	};

}) ();

revealImagesOnScroll.init();
