/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 *
 */
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
