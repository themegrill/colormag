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
			jQuery( '#cm-masthead .search-form-top' ).removeClass( 'show' );
			jQuery( '#cm-content' ).removeClass( 'backdrop' );
		};

		// For Search Icon Toggle effect added at the top.
		jQuery( '.search-top' ).click(
			function () {
				jQuery( this ).next( '#cm-masthead .search-form-top' ).toggleClass( 'show' );

				jQuery( '#cm-content' ).toggleClass( 'backdrop' );
				// Focus after some time to fix conflict with toggleClass.
				setTimeout(
					function () {
						jQuery( '#cm-masthead .search-form-top input' ).focus();
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
							if ( jQuery( '#cm-masthead .search-form-top' ).hasClass( 'show' ) ) {
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
		// Adds right icon to submenu.
		jQuery( '.cm-menu-primary-container .menu-item-has-children' ) ;

		// Adds down icon for menu with sub menu.
		jQuery( '.cm-menu-primary-container .cm-submenu-toggle' ).click(
			function () {
				jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
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
				if ( window.matchMedia( '(max-width: 768px)' ).matches && jQuery( '#cm-masthead .sticky-wrapper, #cm-masthead .headroom' ).length >= 1 ) {
					var screenHeight        = jQuery( window ).height();
					var availableMenuHeight = screenHeight - 88;
					var menu                = jQuery( '#cm-primary-nav' ).find( 'ul' ).first();

					menu.css( 'max-height', availableMenuHeight );
					menu.addClass( 'menu-scrollbar' );
				}
			}
		);

		// add widget block title class.
		jQuery( '.wp-block-group__inner-container h2' ).wrap( '<div class="block-title"></div>' );
		jQuery( '.wp-block-heading' ).wrap( '<div class="block-title"></div>' );

		// Magnific Popup Setting.
		if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {

			// Featured Image Popup Setting.
			jQuery( '.image-popup' ).magnificPopup( { type : 'image' } );

			// Magnific Popup for gallery.
			jQuery( '.gallery' ).find( 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"], a[href*=".ico"]' ).magnificPopup(
				{
					type    : 'image',
					gallery : { enabled : true }
				}
			);

			// Ticker news popup.
			jQuery( '.colormag-ticker-news-popup-link' ).magnificPopup(
				{
					type      : 'ajax',
					callbacks : {
						parseAjax : function ( mfpResponse ) {
							var setting      = jQuery.magnificPopup.instance,
							    content      = jQuery( setting.currItem.el[0] ),
							    fragment     = (
								    content.data( 'fragment' )
							    );
							mfpResponse.data = jQuery( mfpResponse.data ).find( fragment );
						}
					}
				}
			);

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

		// Adds placeholder in search input.
		jQuery( '.wp-block-search__input' ).attr("placeholder", "Search posts");

		// Menu reveal on scroll.
		if ( typeof jQuery.fn.headroom !== 'undefined' ) {
			var offset_value = jQuery( '#cm-primary-nav' ).offset().top;
			var wpAdminBar   = jQuery( '#wpadminbar' );
			var menuwidth    = jQuery( '.cm-primary-nav' ).width();

			if ( wpAdminBar.length ) {
				offset_value = wpAdminBar.height() + jQuery( '#cm-primary-nav' ).offset().top;
			}

			jQuery( '.cm-primary-nav' ).headroom(
				{
					'offset'    : offset_value,
					'tolerance' : 0,
					onPin       : function () {
						if ( wpAdminBar.length ) {
							jQuery( '.cm-primary-nav' ).css(
								{
									'top'      : wpAdminBar.height(),
									'position' : 'fixed',
									'width'    : menuwidth
								}
							);
						} else {
							jQuery( '.cm-primary-nav' ).css(
								{
									'top'      : 0,
									'position' : 'fixed',
									'width'    : menuwidth
								}
							);
						}
					},
					onTop       : function () {
						jQuery( '.cm-primary-nav' ).css(
							{
								'top'      : 0,
								'position' : 'relative'
							}
						);
					}
				}
			);
		}

		// BxSlider JS Settings.
		if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {

			// Category slider widget slider setting.
			jQuery( '.cm-slider-area-rotate' ).bxSlider(
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
						jQuery( '.cm-slider-area-rotate' ).css( 'visibility', 'visible' );
						jQuery( '.cm-slider-area-rotate' ).css( 'height', 'auto' );
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

		// Tabbed widget.
		if ( typeof jQuery.fn.easytabs !== 'undefined' ) {
			jQuery( '.cm-tabbed-widget' ).easytabs();
		}

		// Sticky sidebar JS setting.
		if ( typeof jQuery.fn.theiaStickySidebar !== 'undefined' && typeof ResizeSensor !== 'undefined' ) {
			// Calculate the whole height of sticky menu.
			var height = jQuery( '#site-navigation-sticky-wrapper' ).outerHeight();

			// Assign height value to 0 if it returns null.
			if ( height === null ) {
				height = 0;
			}

			// Apply sticky sidebar/content area JS setting.
			jQuery( '#cm-primary, #cm-secondary, #tertiary' ).theiaStickySidebar(
				{
					additionalMarginTop : 40 + height
				}
			);
		}

		/**
		 * Featured video playlist widget setting.
 		 */
		jQuery( '.video-player' ).each(
			function ( index ) {

				var playercontainer = jQuery( this );
				var itemid          = 'video-playlist-item-' + index;
				var playerframe     = jQuery( this ).find( '.player-frame' );

				playercontainer.attr( 'id', itemid );

				playerframe.video();

				update_video_status( playercontainer );

				playerframe.addVideoEvent(
					'ready',
					function () {
						playerframe.css( 'visibility', 'visible' ).fadeIn();
					}
				);

				playercontainer.on(
					'click',
					'.video-playlist-item',
					function () {
						var item             = jQuery( this );
						var iframe_id        = item.data( 'id' );
						var current_video_id = jQuery( '#' + iframe_id );
						var src              = item.data( 'src' );

						// Pause all videos if a item is clicked.
						playercontainer.find( '.player-frame' ).each(
							function () {
								jQuery( this ).pauseVideo().hide();
							}
						);

						if ( ! current_video_id.length ) {
							playercontainer.find( '.video-frame' ).append( '<iframe id="' + iframe_id + '" class="player-frame" src="' + src + '" frameborder="0" width="100%" height="434" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' );
							current_video_id = jQuery( '#' + iframe_id );
							current_video_id.video();

							current_video_id.addVideoEvent(
								'ready',
								function ( e, $current_video_id, video_type ) {
									current_video_id.playVideo();
								}
							);
						} else {
							current_video_id.playVideo();
						}

						current_video_id.css( 'visibility', 'visible' ).fadeIn();

						update_video_status( playercontainer );
					}
				);

			}
		);

		// Update Video status.
		function update_video_status( playercontainer ) {
			playercontainer.find( '.player-frame' ).each(
				function () {
					var frame     = jQuery( this ),
					    videoitem = jQuery( '[data-id="' + frame.attr( 'id' ) + '"]' );

					frame.addVideoEvent(
						'play',
						function ( e, $video, video_type ) {
							videoitem.removeClass( 'is-paused' ).addClass( 'is-playing' );
						}
					);

					frame.addVideoEvent(
						'pause',
						function ( e, $video, video_type ) {
							videoitem.removeClass( 'is-playing' ).addClass( 'is-paused' );
						}
					);

					frame.addVideoEvent(
						'finish',
						function ( e, $video, video_type ) {
							videoitem.removeClass( 'is-paused is-playing' );
						}
					);
				}
			);
		}

		// Google Maps Settings.
		if ( typeof google !== 'undefined' && typeof colormag_google_maps_widget_settings !== 'undefined' ) {

			// Create function to initialize Google Maps.
			function initMap() {

				// Float the value coming from wp_localize_script to be used for JS.
				var longitude = parseFloat( colormag_google_maps_widget_settings.longitude );
				var latitude  = parseFloat( colormag_google_maps_widget_settings.latitude );
				var zoom_size = parseInt( colormag_google_maps_widget_settings.zoom_size );

				// Add latitude and longitude to variable.
				var latitudelongitude = {
					lat : latitude,
					lng : longitude
				};

				var map = new google.maps.Map(
					document.getElementById( 'GoogleMaps' ),
					{
						zoom   : zoom_size,
						center : latitudelongitude
					}
				);

				var marker = new google.maps.Marker(
					{
						position : latitudelongitude,
						map      : map
					}
				);

			}

			// Call the function to display the Google Maps.
			initMap();

			// Add the dynamic width and height set in widget options.
			jQuery( '#GoogleMaps' ).css(
				{
					height : colormag_google_maps_widget_settings.height
				}
			);

		}

		/**
		 * Social share button.
		 */
		(
			function () {

				var facebookShare   = jQuery( '.share-buttons #facebook' )[0],
				    twitterShare    = jQuery( '.share-buttons #twitter' )[0],
				    pinterestshare  = jQuery( '.share-buttons #pinterest' )[0],
				    facebookWindow,
				    twitterWindow,
				    pinterestWindow;

				if ( facebookShare ) {
					jQuery( facebookShare ).click(
						function ( e ) {
							e.preventDefault();
							facebookWindow = window.open(
								'https://www.facebook.com/sharer/sharer.php?u=' + document.URL + '&p[title]=' + document.title,
								'facebook-popup',
								'height=350,width=600'
							);

							if ( facebookWindow.focus ) {
								facebookWindow.focus();
							}

							return false;
						}
					);
				}

				if ( twitterShare ) {
					jQuery( twitterShare ).click(
						function ( e ) {
							e.preventDefault();
							twitterWindow = window.open(
								'https://twitter.com/share?text=' + document.title + '&url=' + document.URL,
								'twitter-popup',
								'height=350,width=600'
							);

							if ( twitterWindow.focus ) {
								twitterWindow.focus();
							}

							return false;
						}
					);
				}

				if ( pinterestshare ) {
					jQuery( pinterestshare ).click(
						function ( e ) {
							e.preventDefault();
							var featuredImage = jQuery( '.cm-posts .cm-featured-image img' ).attr( 'src' ) ? jQuery( '.cm-posts .cm-featured-image img' ).attr( 'src' ) : '';

							pinterestWindow = window.open(
								'https://pinterest.com/pin/create/button/?url=' + document.URL + '&media=' + featuredImage + '&description=' + document.title,
								'pinterest-popup',
								'height=350,width=600'
							);

							if ( pinterestWindow.focus ) {
								pinterestWindow.focus();
							}

							return false;
						}
					);
				}

			}()
		);

	}
);
