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

				var targetContainer = $( this ).data( 'target' );
				var targetSection   = $( this ).data( 'section' );

				if ( targetSection ) {
					if ( 'panel' === targetContainer ) {
						wp.customize.panel( targetSection ).focus();
					} else {
						wp.customize.section( targetSection ).focus();
					}
				}
			} );

		} );
	}
)( jQuery );
