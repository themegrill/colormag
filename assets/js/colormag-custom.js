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

		// NewsTicker JS Settings.
		if ( typeof jQuery.fn.newsTicker !== 'undefined' ) {

			/* global colormag_ticker_settings */
			if ( typeof colormag_ticker_settings !== 'undefined' ) {

				// Settings of the ticker.
				var breaking_news_slide_effect = colormag_ticker_settings.breaking_news_slide_effect;
				var breaking_news_duration     = parseInt( colormag_ticker_settings.breaking_news_duration, 10 );
				var breaking_news_speed        = parseInt( colormag_ticker_settings.breaking_news_speed, 10 );

				jQuery( '.newsticker' ).newsTicker(
					{
						row_height   : 20,
						max_rows     : 1,
						direction    : breaking_news_slide_effect,
						speed        : breaking_news_speed,
						duration     : breaking_news_duration,
						autostart    : 1,
						pauseOnHover : 1,
						start        : function () {
							jQuery( '.newsticker' ).css( 'visibility', 'visible' );
						}
					}
				);

			}

			// Breaking news widget.
			var breaking_news_widget_init = function ( breaking_news_slider, breaking_news_slider_up, breaking_news_slider_down, breaking_news_slider_direction, breaking_news_slider_duration, breaking_news_slider_row_height, breaking_news_slider_max_row ) {
				jQuery( breaking_news_slider ).newsTicker(
					{
						row_height : breaking_news_slider_row_height,
						max_rows   : breaking_news_slider_max_row,
						duration   : breaking_news_slider_duration,
						direction  : breaking_news_slider_direction,
						prevButton : jQuery( breaking_news_slider_up ),
						nextButton : jQuery( breaking_news_slider_down ),
						start      : function () {
							jQuery( '.cm-breaking-news-slider-widget' ).css(
								{
									'visibility' : 'visible',
								}
							);
						}
					}
				);
			};

			var breaking_news_widget_wrapper = jQuery( '.cm-breaking-news' );
			jQuery( breaking_news_widget_wrapper ).each(
				function () {
					var breaking_news_slider            = jQuery( this ).children( '.cm-breaking-news-slider-widget' );
					var breaking_news_slider_up         = jQuery( this ).children( '.fa-arrow-up' );
					var breaking_news_slider_down       = jQuery( this ).children( '.fa-arrow-down' );
					var breaking_news_slider_direction  = jQuery( this ).children( '.cm-breaking-news-slider-widget' ).data( 'direction' );
					var breaking_news_slider_duration   = jQuery( this ).children( '.cm-breaking-news-slider-widget' ).data( 'duration' );
					var breaking_news_slider_row_height = jQuery( this ).children( '.cm-breaking-news-slider-widget' ).data( 'rowheight' );
					var breaking_news_slider_max_row    = jQuery( this ).children( '.cm-breaking-news-slider-widget' ).data( 'maxrows' );

					breaking_news_widget_init( breaking_news_slider, breaking_news_slider_up, breaking_news_slider_down, breaking_news_slider_direction, breaking_news_slider_duration, breaking_news_slider_row_height, breaking_news_slider_max_row );
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

		// Adds search icon to search widget.
		jQuery( '.wp-element-button' ).wrap( '<button class="search-icon" type="submit"></button>' );

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
			var category_init = function ( category_slider, category_mode, category_speed, category_pause, category_auto, category_hover ) {
				jQuery( category_slider ).bxSlider(
					{
						mode           : category_mode,
						speed          : category_speed,
						auto           : category_auto,
						pause          : category_pause,
						autoHover      : category_hover,
						adaptiveHeight : true,
						nextText       : '<div class="cm-category-slide-next"><i class="fa fa-angle-right"></i></div>',
						prevText       : '<div class="cm-category-slide-prev"><i class="fa fa-angle-left"></i></div>',
						pager          : false,
						tickerHover    : true,
						onSliderLoad   : function () {
							jQuery( '.cm-slider-area-rotate' ).css( 'visibility', 'visible' );
							jQuery( '.cm-slider-area-rotate' ).css( 'height', 'auto' );
						}
					}
				);
			};

			var category_slider_wrapper = jQuery( '.cm-featured-category-slider ' );
			jQuery( category_slider_wrapper ).each(
				function () {
					var category_slider = jQuery( this ).children( '.cm-slider-area-rotate' );
					var category_mode   = jQuery( this ).children( '.cm-slider-area-rotate' ).data( 'mode' );
					var category_speed  = jQuery( this ).children( '.cm-slider-area-rotate' ).data( 'speed' );
					var category_pause  = jQuery( this ).children( '.cm-slider-area-rotate' ).data( 'pause' );
					var category_auto   = jQuery( this ).children( '.cm-slider-area-rotate' ).data( 'auto' );
					var category_hover  = jQuery( this ).children( '.cm-slider-area-rotate' ).data( 'hover' );

					category_init( category_slider, category_mode, category_speed, category_pause, category_auto, category_hover );
				}
			);

			// Style 5 widget JS Setting.
			var style5_slider_init = function ( style5_slider, style5_speed, style5_pause, style5_auto, style5_hover ) {
				jQuery( style5_slider ).bxSlider(
					{
						minSlides      : 1,
						maxSlides      : 2,
						slideWidth     : 390,
						slideMargin    : 20,
						speed          : style5_speed,
						pause          : style5_pause,
						auto           : style5_auto,
						autoHover      : style5_hover,
						adaptiveHeight : true,
						nextText       : '<div class="slide-next"><i class="fa fa-angle-right"></i></div>',
						prevText       : '<div class="slide-prev"><i class="fa fa-angle-left"></i></div>',
						pager          : false,
						captions       : false,
						onSliderLoad   : function () {
							jQuery( '.cm-featured-posts--style-5 .cm-highlighted-post' ).css( 'visibility', 'visible' );
							jQuery( '.cm-featured-posts--style-5 .cm-highlighted-post' ).css( 'height', 'auto' );
						}
					}
				);
			};

			var style5_slider_wrapper = jQuery( '.cm-posts' );
			jQuery( style5_slider_wrapper ).each(
				function () {
					var style5_slider = jQuery( this ).children( '.cm-featured-posts--style-5 .cm-highlighted-post' );
					var style5_speed  = jQuery( this ).children( '.cm-featured-posts--style-5 .cm-highlighted-post' ).data( 'speed' );
					var style5_pause  = jQuery( this ).children( '.cm-featured-posts--style-5 .cm-highlighted-post' ).data( 'pause' );
					var style5_auto   = jQuery( this ).children( '.cm-featured-posts--style-5 .cm-highlighted-post' ).data( 'auto' );
					var style5_hover  = jQuery( this ).children( '.cm-featured-posts--style-5 .cm-highlighted-post' ).data( 'hover' );

					style5_slider_init( style5_slider, style5_speed, style5_pause, style5_auto, style5_hover );
				}
			);

			// Style 6 widget JS Setting.
			var style6_slider_init = function ( style6_slider_class, style6_pager_class, style6_mode, style6_speed, style6_pause, style6_auto, style6_hover ) {
				jQuery( style6_slider_class ).bxSlider(
					{
						mode         : style6_mode,
						speed        : style6_speed,
						pause        : style6_pause,
						auto         : style6_auto,
						pagerCustom  : style6_pager_class,
						autoHover    : style6_hover,
						controls     : false,
						nextText     : '',
						prevText     : '',
						nextSelector : '',
						prevSelector : '',
						captions     : false,
						onSliderLoad : function () {
							jQuery( '.thumbnail-big-sliders' ).css( 'visibility', 'visible' );
							jQuery( '.thumbnail-big-sliders' ).css( 'height', 'auto' );
						}
					}
				);
			};

			var style6_slider_wrapper = jQuery( '.cm-thumbnail-slider-news' );
			jQuery( style6_slider_wrapper ).each(
				function () {
					var style6_slider_class = jQuery( this ).children( '.thumbnail-big-sliders' );
					var style6_pager_class  = jQuery( this ).children( '.cm-thumbnail-slider' );
					var style6_mode         = jQuery( this ).children( '.thumbnail-big-sliders' ).data( 'mode' );
					var style6_speed        = jQuery( this ).children( '.thumbnail-big-sliders' ).data( 'speed' );
					var style6_pause        = jQuery( this ).children( '.thumbnail-big-sliders' ).data( 'pause' );
					var style6_auto         = jQuery( this ).children( '.thumbnail-big-sliders' ).data( 'auto' );
					var style6_hover        = jQuery( this ).children( '.thumbnail-big-sliders' ).data( 'hover' );

					style6_slider_init( style6_slider_class, style6_pager_class, style6_mode, style6_speed, style6_pause, style6_auto, style6_hover );
				}
			);

			// Style 7 widget JS Setting.
			var style7_slider_init = function ( style7_slider, style7_speed ) {
				jQuery( style7_slider ).bxSlider(
					{
						minSlides    : 5,
						maxSlides    : 8,
						slideWidth   : 150,
						slideMargin  : 12,
						ticker       : true,
						speed        : style7_speed,
						tickerHover  : true,
						useCSS       : false,
						onSliderLoad : function () {
							jQuery( '.cm-image-ticker-news' ).css( 'visibility', 'visible' );
							jQuery( '.cm-image-ticker-news' ).css( 'height', 'auto' );
						}
					}
				);
			};

			var style7_slider_wrapper = jQuery( '.cm-featured-posts--style-7' );
			jQuery( style7_slider_wrapper ).each(
				function () {
					var style7_slider = jQuery( this ).children( '.cm-image-ticker-news' );
					var style7_speed  = jQuery( this ).children( '.cm-image-ticker-news' ).data( 'speed' );

					style7_slider_init( style7_slider, style7_speed );
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

			// Related post carousel.
			jQuery( window ).on( 'load colormagAjaxSinglePostLoaded', function() {

				jQuery( '.related-post-carousel' ).bxSlider(
					{
						minSlides    : 1,
						maxSlides    : 2,
						auto         : true,
						slideWidth   : 390,
						slideMargin  : 20,
						moveSlides   : 1,
						shrinkItems  : true,
						speed        : 3000,
						autoHover    : true,
						nextText     : '<div class="slide-next"><i class="fa fa-angle-right"></i></div>',
						prevText     : '<div class="slide-prev"><i class="fa fa-angle-left"></i></div>',
						pager        : false,
						captions     : false,
						onSliderLoad : function () {
							jQuery( '.related-post-carousel' ).css( 'visibility', 'visible' );
							jQuery( '.related-post-carousel' ).css( 'height', 'auto' );
						}
					}
				);
			});
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

		// Scroll Reading Progress JS Setting.
		if ( typeof jQuery.fn.prognroll !== 'undefined' ) {
			jQuery( 'body' ).prognroll(
				{
					height : 5,
					color  : colormag_progress_bar_indicator_color.bg_color,
					custom : false,
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

/**
 * Flyout related posts featured JS setting.
 */
jQuery(
	function () {

		// Flyout related post.
		var related_posts_flyout_wrapper = jQuery( '#related-posts-wrapper-flyout' );

		function colormag_flyout_posts_window_scroll() {
			var primary_height = jQuery( '#cm-primary' ).outerHeight();
			var window_height  = jQuery( this ).scrollTop() + jQuery( this ).height();
			var window_bottom  = jQuery( document ).height() - window_height;

			if ( window_height > window_bottom ) {
				related_posts_flyout_wrapper.addClass( 'flyout' );
			} else {
				related_posts_flyout_wrapper.removeClass( 'flyout' );
			}
		}

		jQuery( window ).on( 'scroll', colormag_flyout_posts_window_scroll );

		jQuery( '#flyout-related-post-close' ).click(
			function () {
				related_posts_flyout_wrapper.removeClass( 'flyout' );

				jQuery( window ).off( 'scroll', colormag_flyout_posts_window_scroll );
			}
		);

	}
);
