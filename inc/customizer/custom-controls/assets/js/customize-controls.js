/**
 * Radio buttonset control JS to handle the toggle of radio buttonsets.
 *
 * File `buttonset.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor[ 'colormag-buttonset' ] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// Change the value.
		this.container.on( 'click', 'input', function () {
			control.setting.set( jQuery( this ).val() );
		} );

	}

} );

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

/**
 * Dropdown categories control JS to handle the dropdown categories customize control.
 *
 * File `dropdown-categorie.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor[ 'colormag-dropdown-categories' ] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// Change the value.
		this.container.on( 'change', 'select', function () {
			control.setting.set( jQuery( this ).val() );
		} );

	}

} );

/**
 * Editor control JS to handle the editor rendering within customize control.
 *
 * File `editor.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor[ 'colormag-editor' ] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this,
		    id      = 'editor_' + control.id;

		wp.editor.initialize( id, {
			tinymce      : {
				wpautop : true
			},
			quicktags    : true,
			mediaButtons : true
		} );

	},

	onChangeActive : function ( active, args ) {

		'use strict';

		var control = this,
		    id      = 'editor_' + control.id,
		    element = control.container.find( 'textarea' ),
		    editor;

		editor = tinyMCE.get( id );

		if ( editor ) {

			editor.onChange.add( function ( ed ) {
				var content;

				ed.save();
				content = editor.getContent();
				element.val( content ).trigger( 'change' );
				wp.customize.instance( control.id ).set( content );
			} );

		}

	}

} );

/**
 * Radio image control JS to handle the toggle of radio images.
 *
 * File `radio-image.js`.
 *
 * @package ColorMag
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

/**
 * Slider control JS to handle the range of the inputs.
 *
 * File `slider.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-slider'] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// Update the text value.
		jQuery( 'input[type=range]' ).on( 'input change', function () {
			var value        = jQuery( this ).attr( 'value' ),
			    input_number = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .value' );

			input_number.val( value );
			input_number.change();
		} );

		// Handle the reset button.
		jQuery( '.colormag-slider-reset' ).click( function () {
			var wrapper       = jQuery( this ).closest( '.slider-wrapper' ),
			    input_range   = wrapper.find( 'input[type=range]' ),
			    input_number  = wrapper.find( '.colormag-range-value .value' ),
			    default_value = input_range.data( 'reset_value' );

			input_range.val( default_value );
			input_number.val( default_value );
			input_number.change();
		} );

		// Save changes.
		this.container.on( 'input change', 'input[type=number]', function () {
			var value = jQuery( this ).val();
			jQuery( this ).closest( '.slider-wrapper' ).find( 'input[type=range]' ).val( value );
			control.setting.set( value );
		} );

	}

} );

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
