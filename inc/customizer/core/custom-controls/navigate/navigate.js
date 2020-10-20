/**
 * Background image control JS to handle the navigate customize option.
 *
 * File `navigate.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		$( window ).on( 'load', function () {

			$( '.tg-navigate a' ).on( 'click', function ( e ) {
				e.preventDefault();

				var targetSection = $( this ).data( 'section' );

				if ( targetSection ) {
					wp.customize.section( targetSection ).focus();
				}
			} );

		} );
	}
)( jQuery );
