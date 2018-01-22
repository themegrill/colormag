/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {

	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site Layout Option
	wp.customize( 'colormag_site_layout', function ( value ) {
		value.bind( function ( layout ) {
				var site_layout = layout;

				if ( site_layout === 'wide_layout' ) {
					$( 'body' ).addClass( 'wide' );
				} else if ( site_layout === 'boxed_layout' ) {
					$( 'body' ).removeClass( 'wide' );
				}
			}
		);
	} );

} )( jQuery );
