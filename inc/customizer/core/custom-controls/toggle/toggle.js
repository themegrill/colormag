/**
 * Switch toggle control JS to handle the toggle of custom customize controls.
 *
 * File `toggle.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-toggle'] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this,
		    value   = control.setting._value;

		// Save the value.
		this.container.on( 'change', 'input', function () {
			value = jQuery( this ).is( ':checked' ) ? true : false;

			control.setting.set( value );
		} );

	}

} );
