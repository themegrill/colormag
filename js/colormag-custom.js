/**
 * ColorMag theme custom JS file.
 *
 * @package ColorMag
 */

jQuery( document ).ready(
	function () {

		/**
		 * Search.
		 */
		var hideSearchForm = function () {
			jQuery( '#cm-header .search-form-top' ).removeClass( 'show' );
		};

		// For Search Icon Toggle effect added at the top.
		jQuery( '.search-top' ).click(
			function () {
				jQuery( this ).next( '#cm-header .search-form-top' ).toggleClass( 'show' );

				// Focus after some time to fix conflict with toggleClass.
				setTimeout(
					function () {
						jQuery( '#cm-header .search-form-top input' ).focus();
					},
					200
				);

				// For esc key press.
				jQuery( document ).on(
					'keyup',
					function ( e ) {
						// On esc key press.
						if ( 27 === e.keyCode ) {
							// If search box is opened.
							if ( jQuery( '#cm-header .search-form-top' ).hasClass( 'show' ) ) {
								hideSearchForm();
							}
						}
					}
				);

				jQuery( document ).on(
					'click.outEvent',
					function ( e ) {
						if ( e.target.closest( '.cm-top-search' ) ) {
							return;
						}

						hideSearchForm();

						// Unbind current click event.
						jQuery( document ).off( 'click.outEvent' );
					}
				);
			}
		);

		/**
		 * Scroll to top JS setting.
		 */
		// Hides the scroll up button initially.
		jQuery( '#scroll-up' ).hide();

		// Scroll up settings.
		jQuery( window ).scroll(
			function () {
				if ( jQuery( this ).scrollTop() > 1000 ) {
					jQuery( '#scroll-up' ).fadeIn();
				} else {
					jQuery( '#scroll-up' ).fadeOut();
				}
			}
		);

		jQuery( 'a#scroll-up' ).click(
			function () {
				jQuery( 'body,html' ).animate(
					{
						scrollTop : 0
					},
					800
				);
				return false;
			}
		);

		/**
		 * Better responsive menu settings.
		 */
		// Adds right icon to submenu.
		jQuery( '.cm-menu-primary-container .menu-item-has-children' ).append( '<span class="cm-sub-toggle"> <i class="fa fa-angle-right"></i> </span>' );

		// Adds down icon for menu with sub menu.
		jQuery( '.cm-menu-primary-container .cm-sub-toggle' ).click(
			function () {
				jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
				jQuery( this ).children( '.fa-angle-right' ).first().toggleClass( 'fa-angle-down' );
			}
		);

		jQuery( document ).on(
			'click',
			'#cm-primary-nav ul li.menu-item-has-children > a',
			function ( event ) {
				var menuClass = jQuery( this ).parent( '.menu-item-has-children' );

				if ( ! menuClass.hasClass( 'focus' ) && jQuery( window ).width() <= 768 ) {
					menuClass.addClass( 'focus' );
					event.preventDefault();
					menuClass.children( '.sub-menu' ).css(
						{
							'display' : 'block'
						}
					);
				}
			}
		);

		/**
		 * Scrollbar on fixed responsive menu.
		 */
		jQuery( window ).on( 'load',
			function() {
				if ( window.matchMedia( '(max-width: 768px)' ).matches && jQuery( '#cm-header .sticky-wrapper' ).length >= 1 ) {
					var screenHeight        = jQuery( window ).height();
					var availableMenuHeight = screenHeight - 43;
					var menu                = jQuery( '#cm-primary-nav' ).find( 'ul' ).first();

					menu.css( 'max-height', availableMenuHeight );
					menu.addClass( 'menu-scrollbar' );
				}
			}
		);

		// Featured Image Popup Setting.
		if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
			jQuery( '.image-popup' ).magnificPopup( { type : 'image' } );
		}

		// Fitvids setting.
		if ( typeof jQuery.fn.fitVids !== 'undefined' ) {
			jQuery( '.fitvids-video' ).fitVids();
		}

		// Settings of the ticker.
		if ( typeof jQuery.fn.newsTicker !== 'undefined' ) {
			jQuery( '.newsticker' ).newsTicker(
				{
					row_height   : 20,
					max_rows     : 1,
					speed        : 1000,
					direction    : 'down',
					duration     : 4000,
					autostart    : 1,
					pauseOnHover : 1,
					start        : function () {
						jQuery( '.newsticker' ).css( 'visibility', 'visible' );
					}
				}
			);
		}

		// Settings of the sticky menu.
		if ( typeof jQuery.fn.sticky !== 'undefined' ) {
			var wpAdminBar = jQuery( '#wpadminbar' );

			if ( wpAdminBar.length ) {
				jQuery( '#cm-primary-nav' ).sticky(
					{
						topSpacing : wpAdminBar.height(),
						zIndex     : 999
					}
				);
			} else {
				jQuery( '#cm-primary-nav' ).sticky(
					{
						topSpacing : 0,
						zIndex     : 999
					}
				);
			}
		}

		// BxSlider JS Settings.
		if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {

			// Category slider widget slider setting.
			jQuery( '.widget_slider_area_rotate' ).bxSlider(
				{
					mode           : 'horizontal',
					speed          : 1500,
					auto           : true,
					pause          : 5000,
					adaptiveHeight : true,
					nextText       : '',
					prevText       : '',
					nextSelector   : '.slide-next',
					prevSelector   : '.slide-prev',
					pager          : false,
					tickerHover    : true,
					onSliderLoad   : function () {
						jQuery( '.widget_slider_area_rotate' ).css( 'visibility', 'visible' );
						jQuery( '.widget_slider_area_rotate' ).css( 'height', 'auto' );
					}
				}
			);

			// Post format gallery slider setting.
			jQuery( '.blog .gallery-images, .archive .gallery-images, .search .gallery-images, .single-post .gallery-images' ).bxSlider(
				{
					mode           : 'fade',
					speed          : 1500,
					auto           : true,
					pause          : 3000,
					adaptiveHeight : true,
					nextText       : '',
					prevText       : '',
					nextSelector   : '.slide-next',
					prevSelector   : '.slide-prev',
					pager          : false
				}
			);

		}

	}
);
