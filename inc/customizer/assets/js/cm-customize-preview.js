/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 *
 */

colormagGenerateCSS( 'colormag_site_title_color', '.cm-site-title a', 'color' );
colormagGenerateCSS( 'colormag_site_title_hover_color', '.cm-site-title a:hover', 'color' );
colormagGenerateCSS( 'colormag_site_tagline_color', '.cm-site-description', 'color' );
colormagGenerateTypographyCSS( 'colormag_base_typography', 'body, button, input, select, textarea, blockquote p, .entry-meta, .more-link, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, .cm-secondary .widget, .error-404 .widget, .cm-entry-summary p' );
colormagGenerateTypographyCSS( 'colormag_headings_typography', 'h1, h2, h3 ,h4, h5, h6' );
colormagGenerateTypographyCSS( 'colormag_h1_typography', 'h1' );
colormagGenerateTypographyCSS( 'colormag_h2_typography', 'h2' );
colormagGenerateTypographyCSS( 'colormag_h3_typography', 'h3' );
colormagGenerateTypographyCSS( 'colormag_h4_typography', 'h4' );
colormagGenerateTypographyCSS( 'colormag_h5_typography', 'h5' );
colormagGenerateTypographyCSS( 'colormag_h6_typography', 'h6' );
colormagGenerateTypographyCSS( 'colormag_blog_post_title_typography', '.cm-entry-title' );
colormagGenerateTypographyCSS( 'colormag_site_title_typography', '.cm-site-title' );
colormagGenerateTypographyCSS( 'colormag_site_tagline_typography', '.cm-site-description' );
colormagGenerateTypographyCSS( 'colormag_primary_menu_typography', '.cm-primary-nav ul li a' );
colormagGenerateTypographyCSS( 'colormag_primary_sub_menu_typography', '.cm-primary-nav ul li ul li a' );
colormagGenerateSliderCSS( 'colormag_primary_menu_top_border_width', '#cm-primary-nav', 'border-top-width' );
colormagGenerateCSS( 'colormag_button_color', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span, .wp-block-button__link', 'color' );
colormagGenerateCSS( 'colormag_button_hover_color', '.cm-entry-button span:hover,.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .more-link span:hover, .wp-block-button__link:hover', 'color' );
colormagGenerateCSS( 'colormag_button_background_color', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link, .wp-block-button__link', 'background-color' );
colormagGenerateCSS( 'colormag_button_background_hover_color', '.cm-entry-button span:hover,.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .more-link:hover, .wp-block-button__link:hover', 'background-color' );
colormagGenerateDimensionCSS( 'colormag_button_dimension_padding', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'padding' );
colormagGenerateSliderCSS( 'colormag_button_border_radius', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-radius' );
colormagGenerateSliderWidthCss( 'colormag_sidebar_width', '.cm-secondary', '.cm-primary', 'width' );

( function ( $ ) {

	// Site title.
	wp.customize(
		'blogname',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-title a' ).text( to );
				}
			);
		}
	);

	// Site description.
	wp.customize(
		'blogdescription',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-description' ).text( to );
				}
			);
		}
	);

	// Header display type.
	wp.customize(
		'colormag_header_display_type',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'type_two' ) {
						$( 'body' ).removeClass( 'header_display_type_two' ).addClass( 'header_display_type_one' );
					} else if ( display_type === 'type_three' ) {
						$( 'body' ).removeClass( 'header_display_type_one' ).addClass( 'header_display_type_two' );
					} else if ( display_type === 'type_one' ) {
						$( 'body' ).removeClass( 'header_display_type_one header_display_type_two' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'colormag_container_layout',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var site_layout = layout;

					if ( 'wide' === site_layout ) {
						$( 'body' ).removeClass( 'boxed' ).addClass( 'wide' );
					} else if ( 'boxed' === site_layout ) {
						$( 'body' ).removeClass( 'wide' ).addClass( 'boxed' );
					}
				}
			);
		}
	);

	// Footer copyright alignment.
	wp.customize(
		'colormag_footer_bar_alignment',
		function ( value ) {
			value.bind(
				function ( alignment ) {
					var alignment_type = alignment;

					if ( alignment_type === 'left' ) {
						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-2 cm-footer-bar-style-3' ).addClass( 'cm-footer-bar-style-1' );
					} else if ( alignment_type === 'right' ) {
						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-1 cm-footer-bar-style-3' ).addClass( 'cm-footer-bar-style-2' );
					} else if ( alignment_type === 'center' ) {
						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-1 cm-footer-bar-style-2' ).addClass( 'cm-footer-bar-style-3' );
					}
				}
			);
		}
	);

	// Footer Main Area Display Type.
	wp.customize(
		'colormag_main_footer_layout',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'layout-2' ) {
						$( '#cm-footer' ).removeClass( 'colormag-footer--classic-bordered' ).addClass( 'colormag-footer--classic' );
					} else if ( display_type === 'layout-3' ) {
						$( '#cm-footer' ).removeClass( 'colormag-footer--classic' ).addClass( 'colormag-footer--classic-bordered' );
					} else if ( display_type === 'layout-1' ) {
						$( '#cm-footer' ).removeClass( 'colormag-footer--classic colormag-footer--classic-bordered' );
					}
				}
			);
		}
	);

} )( jQuery );
