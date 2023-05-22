var revealImagesOnScroll = ( function() {

	var images            = document.querySelectorAll( 'img' ),
		relatedPostFlyout = document.querySelector( '.related-posts-wrapper-flyout' ),
		isAutoLoadEnabled = 'infinite_scroll' === revealOnScrollData[1] ? true : false,
		imageStyle        = revealOnScrollData[0];

	var hideImagesInitially = function() {

		images.forEach( function( el ) {

			if ( ! el.classList.contains( 'tg-image-to-reveal-' + imageStyle ) ) {
				el.classList.add( 'tg-image-to-reveal-' + imageStyle );
			}

			el.isRevealed = false;
		});

		images[images.length - 1].isLastItem = true;
	};

	var events = function() {

		window.addEventListener( 'scroll', revealCaller );
		window.addEventListener( 'load', unHideClonedImages );
	};

	var unHideClonedImages = function() {

		var clonedImages = document.querySelectorAll( '.bx-clone img' );

		clonedImages.forEach( function( el ) {

			if ( el.classList.contains( 'tg-image-to-reveal-' + imageStyle ) ) {
				el.classList.remove( 'tg-image-to-reveal-' + imageStyle );
			}
		});

		revealCaller();
	}

	var revealCaller = function() {

		if ( isAutoLoadEnabled ) {
			images = document.querySelectorAll( 'img' );
		}

		images.forEach( function( el ) {

			if ( false === el.isRevealed || isAutoLoadEnabled ) {
				revealIfScrolledTo( el );
			}
		});
	}

	var revealIfScrolledTo = function( el ) {

		if ( window.scrollY + window.innerHeight > el.offsetTop ) {

			var scrollPercent = ( el.getBoundingClientRect().top / window.innerHeight ) * 100;

			if ( scrollPercent < 85 ) {

				el.classList.add( 'tg-image-to-reveal-' + imageStyle + '--is-revealed' );
				el.isRevealed = true;

			if ( el.isLastItem && ! isAutoLoadEnabled ) {

				window.removeEventListener( 'load', unHideClonedImages );

				if ( null === relatedPostFlyout  ) {
					window.removeEventListener( 'scroll', revealCaller );
					}
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
