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

				// Background color setting.
				colorpicker.wpColorPicker( {

					change : function () {
						if ( jQuery( 'html' ).hasClass( 'colorpicker-ready' ) ) {
							setTimeout(
								function () {
									control.saveValue( 'background-color', colorpicker.val() );
								},
								100
							);
						}
					},

					clear : function ( event ) {
						var element = jQuery( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[0];

						if ( element ) {
							control.saveValue( 'background-color', '' );
						}
					}

				} );

				// Background image setting.
				control.container.on( 'click', '.background-image-upload-button', function ( e ) {
					var image = wp.media( { multiple : false } ).open().on( 'select', function () {

						// This will return the selected image from the Media Uploader, the result is an object.
						var uploadedImage = image.state().get( 'selection' ).first(),
						    previewImage  = uploadedImage.toJSON().sizes.full.url,
						    imageUrl,
						    imageID,
						    imageWidth,
						    imageHeight,
						    preview,
						    removeButton;

						if ( ! _.isUndefined( uploadedImage.toJSON().sizes.medium ) ) {
							previewImage = uploadedImage.toJSON().sizes.medium.url;
						} else if ( ! _.isUndefined( uploadedImage.toJSON().sizes.thumbnail ) ) {
							previewImage = uploadedImage.toJSON().sizes.thumbnail.url;
						}

						imageUrl    = uploadedImage.toJSON().sizes.full.url;
						imageID     = uploadedImage.toJSON().id;
						imageWidth  = uploadedImage.toJSON().width;
						imageHeight = uploadedImage.toJSON().height;

						// Show extra controls if the value has an image.
						if ( '' !== imageUrl ) {
							control.container.find( '.customize-control-content > .background-repeat, .customize-control-content > .background-position, .customize-control-content > .background-size, .customize-control-content > .background-attachment' ).show();
						}

						control.saveValue( 'background-image', imageUrl );
						preview      = control.container.find( '.placeholder, .thumbnail' );
						removeButton = control.container.find( '.background-image-upload-remove-button' );

						if ( preview.length ) {
							preview.removeClass().addClass( 'thumbnail thumbnail-image' ).html( '<img src="' + previewImage + '" alt="" />' );
						}

						if ( removeButton.length ) {
							removeButton.show();
						}
					} );

					e.preventDefault();
				} );

				control.container.on( 'click', '.background-image-upload-remove-button', function ( e ) {

					var preview,
					    removeButton;

					e.preventDefault();

					control.saveValue( 'background-image', '' );

					preview      = control.container.find( '.placeholder, .thumbnail' );
					removeButton = control.container.find( '.background-image-upload-remove-button' );

					// Hide unnecessary controls.
					control.container.find( '.customize-control-content > .background-repeat' ).hide();
					control.container.find( '.customize-control-content > .background-position' ).hide();
					control.container.find( '.customize-control-content > .background-size' ).hide();
					control.container.find( '.customize-control-content > .background-attachment' ).hide();

					if ( preview.length ) {
						preview.removeClass().addClass( 'placeholder' ).html( ColorMagCustomizerControlBackground.placeholder );
					}

					if ( removeButton.length ) {
						removeButton.hide();
					}
				} );

			},

			/**
			 * Saves the value.
			 */
			saveValue : function ( property, value ) {

				var control = this,
				    input   = jQuery( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .background-hidden-value' ),
				    val     = control.setting._value;

				val[property] = value;

				jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
				control.setting.set( val );

			}

		} );

	}
)( jQuery );

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
