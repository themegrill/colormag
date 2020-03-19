/**
 * Background image control JS to handle the background customize option.
 *
 * File `background.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		$( window ).on( 'load', function () {
			$( 'html' ).addClass( 'colorpicker-ready' );
		} );

		wp.customize.controlConstructor['colormag-background'] = wp.customize.Control.extend( {

			ready : function () {

				'use strict';

				var control = this;

				// Init background control.
				control.initColorMagBackgroundControl();

			},

			initColorMagBackgroundControl : function () {

				var control     = this,
				    value       = control.setting._value,
				    colorpicker = control.container.find( '.colormag-color-picker-alpha' );

				// Hide unnecessary controls by default and show only when background image is set.
				if ( _.isUndefined( value['background-image'] ) || '' === value['background-image'] ) {
					control.container.find( '.customize-control-content > .background-repeat' ).hide();
					control.container.find( '.customize-control-content > .background-position' ).hide();
					control.container.find( '.customize-control-content > .background-size' ).hide();
					control.container.find( '.customize-control-content > .background-attachment' ).hide();
				}

			}

		} );

	}
)( jQuery );
