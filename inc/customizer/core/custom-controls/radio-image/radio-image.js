/**
 * Radio image control JS to handle the toggle of radio images.
 *
 * File `radio-image.js`.
 *
 * @package Colormag
 */
wp.customize.controlConstructor[ 'colormag-radio-image' ] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// Change the value.
		this.container.on( 'click', 'input', function () {
			control.setting.set( jQuery( this ).val() );
		} );

	}

} );
