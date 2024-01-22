/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 *
 */

colormagGenerateCSS( 'colormag_site_title_color', '.cm-site-title a', 'color' )
colormagGenerateCSS( 'colormag_site_title_hover_color', '.cm-site-title a:hover', 'color' )
colormagGenerateCSS( 'colormag_site_tagline_color', '.cm-site-description', 'color' )
colormagGenerateCSS( 'colormag_headings_color', 'h1, h2, h3, h4, h5, h6, .dark-skin h1, .dark-skin h2, .dark-skin h3, .dark-skin h4, .dark-skin h5, .dark-skin h6', 'color' )
colormagGenerateCSS( 'colormag_h1_color', '.dark-skin h1', 'color' )
colormagGenerateCSS( 'colormag_h2_color', '.dark-skin h2', 'color' )
colormagGenerateCSS( 'colormag_h3_color', '.dark-skin h3', 'color' )
colormagGenerateCSS( 'colormag_link_color', '.cm-entry-summary a, .mzb-featured-categories .mzb-post-title a, .mzb-tab-post .mzb-post-title a, .mzb-post-list .mzb-post-title a, .mzb-featured-posts .mzb-post-title a, .mzb-featured-categories .mzb-post-title a', 'color' )
colormagGenerateCSS( 'colormag_link_hover_color', '.post .cm-entry-summary a:hover, .mzb-featured-categories .mzb-post-title a:hover, .mzb-tab-post .mzb-post-title a:hover, .mzb-post-list .mzb-post-title a:hover, .mzb-featured-posts .mzb-post-title a:hover, .mzb-featured-categories .mzb-post-title a:hover', 'color' )
colormagGenerateCSS( 'colormag_button_color', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span, .wp-block-button__link', 'color' )
colormagGenerateCSS( 'colormag_button_background_color', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link, .wp-block-button__link', 'background-color' )
colormagGenerateCSS( 'colormag_top_bar_border_bottom_color', '.cm-top-bar', 'border-bottom-color' )
colormagGenerateCSS( 'colormag_button_border_color', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-color' )
colormagGenerateCSS( 'colormag_button_border_style', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-style' )
colormagGenerateCSS( 'colormag_sidebar_widget_title_color', '.cm-secondary .cm-widget-title span,.cm-secondary .wp-block-heading, #cm-tertiary .cm-widget-title span', 'color' )
colormagGenerateCSS( 'colormag_footer_copyright_text_color', '.cm-footer-bar-area .cm-footer-bar__2', 'color' )
colormagGenerateCSS( 'colormag_footer_copyright_link_text_color', '.cm-footer-bar-area .cm-footer-bar__2 a', 'color' )
colormagGenerateCSS( 'colormag_footer_menu_color', '.cm-footer-bar-area .cm-footer-bar__1 ul li a', 'color' )
colormagGenerateCSS( 'colormag_footer_menu_hover_color', '.cm-footer-bar-area .cm-footer-bar__1 ul li a:hover', 'color' )



colormagGenerateBackgroundCSS( 'colormag_inside_container_background', '.cm-content' )
colormagGenerateBackgroundCSS( 'colormag_outside_container_background', 'body' )

colormagGenerateDimensionCSS( 'colormag_button_dimension_padding', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'padding' );
colormagGenerateDimensionCSS( 'colormag_primary_menu_padding', '.cm-primary-nav', 'padding' );

colormagGenerateSliderCSS( 'colormag_container_width', '.inner-wrap, .cm-container', 'max-width' );
colormagGenerateSliderCSS( 'colormag_button_border_radius', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-radius' );
colormagGenerateSliderCSS( 'colormag_button_border_width', '.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-width' );
colormagGenerateSliderCSS( 'colormag_site_logo_height', '.cm-site-branding img', 'height' );
colormagGenerateSliderCSS( 'colormag_top_bar_border_bottom_size', '.cm-top-bar', 'border-bottom-width' );

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
