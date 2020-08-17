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
				control.container.on( 'click', '.background-image-upload-button, .thumbnail-image img', function ( e ) {
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

				// Background repeat setting.
				control.container.on( 'change', '.background-repeat select', function () {
					control.saveValue( 'background-repeat', jQuery( this ).val() );
				} );

				// Background position setting.
				control.container.on( 'change', '.background-position select', function () {
					control.saveValue( 'background-position', jQuery( this ).val() );
				} );

				// Background size setting.
				control.container.on( 'change', '.background-size select', function () {
					control.saveValue( 'background-size', jQuery( this ).val() );
				} );

				// Background attachment setting.
				control.container.on( 'change', '.background-attachment select', function () {
					control.saveValue( 'background-attachment', jQuery( this ).val() );
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
