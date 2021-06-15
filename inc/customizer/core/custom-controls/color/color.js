/**
 * Color picker control JS to handle color picker rendering within customize control.
 *
 * File `color.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		$( window ).on( 'load', function () {
			$( 'html' ).addClass( 'colorpicker-ready' );
		} );

		wp.customize.controlConstructor[ 'colormag-color' ] = wp.customize.Control.extend( {

			ready : function () {

				'use strict';

				var control = this;

				this.container.find( '.colormag-color-picker-alpha' ).wpColorPicker( {

					change : function ( event, ui ) {
						var color = ui.color.toString();

						if ( jQuery( 'html' ).hasClass( 'colorpicker-ready' ) ) {
							control.setting.set( color );
						}
					}

				} );

			}

		} );

	}
)( jQuery );
