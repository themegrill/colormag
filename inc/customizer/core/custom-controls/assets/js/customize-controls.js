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
				control.container.on( 'click', '.background-image-upload-button, .background-image-upload .placeholder, .thumbnail-image img', function ( e ) {
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

(
	function ( $ ) {

		wp.customize.controlConstructor['colormag-date'] = wp.customize.Control.extend( {

			ready: function() {
				'use strict';

				var control  = this,
					selector = control.selector,
					input    = $( selector ).find( 'input' );

				// Init the datepicker.
				input.datepicker(
					{
						dateFormat : 'yy-mm-dd',
						changeMonth: true,
						changeYear : true,
						showOn     : 'button',
						buttonText : '',
						beforeShow : function( input, obj ) {
							$( input ).after( $( input ).datepicker( 'widget' ) );
						}
					}
				);

				// Save the changes.
				input.on( 'change keyup paste', function() {
					control.setting.set( $( this ).val() );
				} );
			},
		} );
	}
)( jQuery );

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

				var control = this,
					isHueSlider = ( this.params.mode === 'hue' ),
					picker = this.container.find( '.colormag-color-picker-alpha' ),
					color = picker.val().replace( /\s+/g, '' );

				picker.wpColorPicker( {

					change : function ( event, ui ) {
						var current = ( isHueSlider ? ui.color.h() : picker.iris( 'color' ) );

						if ( jQuery( 'html' ).hasClass( 'colorpicker-ready' ) && color !== current.replace( /\s+/g, '' ) ) {
							control.setting.set( current );
						}
					},

					clear: function() {

						if ( ! control.setting.get() ) {
							control.setting.set( '' );
						}

						control.setting.set( '' );
					}

				} );

			}

		} );

	}
)( jQuery );

/**
 * Dimensions JS to handle the dimensions customize option.
 *
 * File `dimensions.js`.
 *
 * @package ColorMag
 */
( function ( $, api ) {
	api.controlConstructor[ 'colormag-dimensions' ] = api.Control.extend( {
		ready: function () {
			let control = this,
				$inputs = this.container.find( '.control input' ),
				$reset  = this.container.find( '.colormag-dimensions-reset' ),
				$select = this.container.find( '.dimension-unit' );

			// Listen for change, input, keyup, paste input events.
			$inputs.on( 'change input', function () {
				let $this    = $( this );

				if ( $this.closest( '.control' ).hasClass( 'linked' ) ) {
					control.update( {
						value: $this.val(),
						side: 'all'
					} );
					$inputs.val( $this.val() );
				} else {
					control.update( {
						value: $this.val(),
						side: $this.data( 'type' )
					} );
				}
			} );

			// Listen for change select event.
			$select.on( 'change', function () {
				control.update( {
					value: '',
					side: 'all'
				} );
				control.update( {
					value: $( this ).val(),
					side: 'unit'
				} );
				$inputs.val( '' );
			} );

			// Binding or link value across all inputs.
			control.container.find( '.colormag-binding' ).on( 'click', function ( e ) {
				e.preventDefault();

				var $this   = $( this ),
					$parent = $this.parent( '.control' );

				$this.toggleClass( 'active' );
				$parent.toggleClass( 'linked' );

				if ( $this.hasClass( 'active' ) ) {
					$parent.find( 'input' ).val( $parent.find( 'input' ).first().val() ).trigger( 'change' );
				}
			} );

			// Reset to defaults.
			$reset.on( 'click', function ( e ) {
				e.preventDefault();
				control.reset();
			} );

			// Update control setting.
			control.container.find( `input#colormag_dimensions_${control.id}` ).on( 'change', function () {
				control.setting.set( JSON.parse( $( this ).val() ) );
			} );
		},
		update: function ( {
							   value,
							   side = 'top'
						   } ) {
			var control = this,
				$input  = control.container.find( `input#colormag_dimensions_${control.id}` ),
				values  = JSON.parse( $input.val() );

			if ( 'all' === side ) {
				values = $.extend( values, {
					top: value,
					right: value,
					bottom: value,
					left: value
				} )
			} else {
				values[ side ] = value;
			}

			$input.val( JSON.stringify( values ) ).trigger( 'change' );
		},
		reset() {
			var control  = this,
				defaults = control.params.default;

			[ 'top', 'right', 'bottom', 'left', 'unit' ].forEach( function ( side ) {
				var value = defaults[ side ] ? defaults[ side ] : '';
				control.update( {
					value,
					side: side
				} );
				control.container.find( `[data-type="${side}"]` ).val( value );
			} );
		}
	} );
} )( jQuery, wp.customize );

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
wp.customize.controlConstructor[ 'colormag-editor' ] = wp.customize.Control.extend(
	{

		ready : function () {

			'use strict';

			var control = this,
				id      = 'editor_' + control.id;

			if ( wp.editor && wp.editor.initialize ) {
				wp.editor.initialize(
					id,
					{
						tinymce: {
							wpautop: true,
							setup: function (editor) {
								editor.on(
									'Paste Change input Undo Redo',
									function() {
										var content = editor.getContent();
										wp.customize.instance( control.id ).set( content );
									}
								)
							}
						},
						quicktags: true,
						mediaButtons: true
						}
				);
			}

		},

	}
);

/**
 * Control: FontAwesome.
 */
(
	function ( $ ) {

		wp.customize.controlConstructor['colormag-fontawesome'] = wp.customize.Control.extend(
			{
				ready: function () {
					'use strict';

					var control = this;

					control.initColorMagFontawesomeControl();
				},

				initColorMagFontawesomeControl: function() {
					var control       = this,
						selector      = control.selector,
						elSelector    = $( selector ).find( 'select' ),
						faData        = [],
						value         = control.setting._value,
						data          = window['ColorMagCustomizerControlFontawesome' + this.id],
						faDataCounter = 0,
						faSelect;

					$.each(
						data,
						function ( key, value ) {
							faData[ faDataCounter ] = {
								id: value,
								text: value
							};

							faDataCounter++;
						}
					);

					// Add HTML inside the option element.
					function formatState( state ) {

						if ( ! state.id ) {
							return state.text;
						}

						var $state = $(
							'<span><i class="fa fa-lg ' + state.text + '"></i> ' + state.text + '</span>'
						);

						return $state;
					};

					// Apply selectWoo.
					faSelect = elSelector.selectWoo(
						{
							data: faData,
							width: '100%',
							templateResult: formatState,
						}
					);

					faSelect.val( value ).trigger( 'change' );

					faSelect.on(
						'change',
						function () {
							control.setting.set( elSelector.val() );
						}
					);
				},
			}
		);
	}
)( jQuery );

/**
 * Background image control JS to handle the background customize option.
 *
 * File `background.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		$( window ).on(
			'load',
			function () {
				$( 'html' ).addClass( 'colorpicker-ready' );
			}
		);

		wp.customize.controlConstructor['colormag-gradient'] = wp.customize.Control.extend(
			{

				ready : function () {

					'use strict';

					var control = this;

					// Init controls.
					control.initColorControl();
					control.initColorStopControl();
					control.initColor2Control();
					control.initColorStop2Control();
					control.initGradientAngleControl();

					var selectedType = $( '.types select' ).find( ':selected' ).val();

					if ( 'radial' === selectedType ) {
						control.container.find( '.type > .type-linear' ).hide();
						control.container.find( '.type > .type-radial' ).show();
					}

					if ( 'linear' === selectedType ) {
						control.container.find( '.type > .type-radial' ).hide();
						control.container.find( '.type > .type-linear' ).show();
					}
					control.container.on(
						'change',
						'.types select',
						function () {
							if ( 'radial' === $( this ).find( ':selected' ).val() ) {
								control.container.find( '.type > .type-linear' ).hide();
								control.container.find( '.type > .type-radial' ).show();
							}

							if ( 'linear' === $( this ).find( ':selected' ).val() ) {
								control.container.find( '.type > .type-radial' ).hide();
								control.container.find( '.type > .type-linear' ).show();
							}

							control.saveValue( 'gradient-type', jQuery( '.types select' ).val() );
						}
					);
					control.container.on(
						'change',
						'.type-radial select',
						function () {
							control.saveValue( 'gradient-position', jQuery( '.type-radial select' ).val() );
						}
					);

				},

				initColorControl : function () {

					var control     = this,
						value       = control.setting._value,
						colorpicker = control.container.find( '.color .colormag-color-picker-alpha' );

					// Background color setting.
					colorpicker.wpColorPicker(
						{

							change : function () {
								if ( jQuery( 'html' ).hasClass( 'colorpicker-ready' ) ) {
									setTimeout(
										function () {
											control.saveValue( 'color', colorpicker.val() );
										},
										100
									);
								}
							},

							clear : function ( event ) {
								var element = jQuery( event.target ).closest( '.wp-picker-input-wrap' ).find( '.primary-color .wp-color-picker' )[0];

								if ( element ) {
									control.saveValue( 'color', '' );
								}
							}

							}
					);

				},

				initColorStopControl : function () {
					'use strict';

					var control = this,
						value   = control.setting._value;

					// Update the text value.
					this.container.find( '.color-stop input[type=range]' ).on( 'input change', function () {
						var value        = jQuery( this ).val(),
							input_number = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .value' );

						input_number.val( value );
						input_number.change();
					} );

					// Save changes.
					jQuery( '.color-stop .slider-wrapper' ).on(
						'input change',
						'input[type=number]',
						function () {
							var value = jQuery( this ).val();
							jQuery( this ).closest( '.color-stop .slider-wrapper' ).find( 'input[type=range]' ).val( value );
							control.saveValue( 'color-stop' , value );
						}
					);

				},

				initColor2Control : function () {

					var control     = this,
						value       = control.setting._value,
						colorpicker = control.container.find( '.color-2 .colormag-color-picker-alpha' );

					// Background color setting.
					colorpicker.wpColorPicker(
						{

							change : function () {
								if ( jQuery( 'html' ).hasClass( 'colorpicker-ready' ) ) {
									setTimeout(
										function () {
											control.saveValue( 'color-2', colorpicker.val() );
										},
										100
									);
								}
							},

							clear : function ( event ) {
								var element = jQuery( event.target ).closest( '.wp-picker-input-wrap' ).find( '.secondary-color .wp-color-picker' )[0];

								if ( element ) {
									control.saveValue( 'color-2', '' );
								}
							}

						}
					);

				},

				initColorStop2Control : function () {
					'use strict';

					var control = this,
						value   = control.setting._value;

					// Update the text value.
					this.container.find( '.color-stop-2 input[type=range]' ).on( 'input change', function () {
						var value        = jQuery( this ).val(),
							input_number = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .value' );

						input_number.val( value );
						input_number.change();
					} );

					// Save changes.
					jQuery( '.color-stop-2 .slider-wrapper' ).on(
						'input change',
						'input[type=number]',
						function () {
							var value = jQuery( this ).val();
							jQuery( this ).closest( '.color-stop-2 .slider-wrapper' ).find( 'input[type=range]' ).val( value );
							control.saveValue( 'color-stop-2' , value );
						}
					);

				},

				initGradientAngleControl : function () {
					'use strict';

					var control = this,
						value   = control.setting._value;

					// Update the text value.
					this.container.find( '.type-linear input[type=range]' ).on( 'input change', function () {
						var value        = jQuery( this ).val(),
							input_number = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .value' );

						input_number.val( value );
						input_number.change();
					} );

					// Save changes.
					jQuery( '.type-linear .slider-wrapper' ).on(
						'input change',
						'input[type=number]',
						function () {
							var value = jQuery( this ).val();
							jQuery( this ).closest( '.type-linear .slider-wrapper' ).find( 'input[type=range]' ).val( value );
							control.saveValue( 'gradient-angle' , value );
						}
					);

				},

					/**
					 * Saves the value.
					 */
				saveValue : function ( property, value ) {
					var control     = this,
						input       = jQuery( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .gradient-hidden-value' ),
						val         = control.setting._value;
					val[ property ] = value;
					jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
					control.setting.set( val );
				},

			}
		);

	}
)( jQuery );

/**
 * Group control JS to handle the group customize option.
 *
 * File `group.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		wp.customize.controlConstructor[ 'colormag-group' ] = wp.customize.Control.extend(
			{

				ready: function () {

					'use strict';

					let control = this;

					control.registerToggleEvents();
					this.container.on( 'colormag_settings_changed', control.onOptionChange );

				},

				registerToggleEvents: function () {

					let control = this;

					/* Close popup when click outside on customize sidebar area */
					$( '.wp-full-overlay-sidebar-content' ).click(
						function ( e ) {
							if ( ! $( e.target ).closest( '.colormag-field-settings-modal' ).length ) {
								$( '.colormag-group-toggle-icon.open' ).trigger( 'click' );
							}
						}
					);

					control.container.on(
						'click',
						'.colormag-group-wrap .colormag-group-toggle-icon',
						function ( e ) {

							e.preventDefault();
							e.stopPropagation();

							let $this          = $( this ),
								parent_wrap    = $this.closest( '.customize-control-colormag-group' ),
								is_loaded      = parent_wrap.find( '.colormag-field-settings-modal' ).data( 'loaded' ),
								parent_section = parent_wrap.parents( '.control-section' );

							if ( $this.hasClass( 'open' ) ) {
								parent_wrap.find( '.colormag-field-settings-modal' ).hide();
							} else {

								/* Close popup when another popup is clicked */
								let get_open_popup = parent_section.find( '.colormag-group-toggle-icon.open' );
								if ( get_open_popup.length > 0 ) {
									get_open_popup.trigger( 'click' );
								}

								if ( is_loaded ) {
									parent_wrap.find( '.colormag-field-settings-modal' ).show();
								} else {

									let fields     = control.params.colormag_fields,
										modal_wrap = $( ColorMagCustomizerControlGroup.group_modal_tmpl ),
										device     = $( '#customize-footer-actions .active' ).attr( 'data-device' );

									parent_wrap.find( '.colormag-field-settings-wrap' ).append( modal_wrap );
									parent_wrap.find( '.colormag-fields-wrap' ).attr( 'data-control', control.params.name );
									control.colormag_render_field( parent_wrap, fields, control );
									parent_wrap.find( '.colormag-field-settings-modal' ).show();

									if ( 'mobile' === device ) {
										$( '.control-wrap.mobile' ).addClass( 'active' );
										$( '.responsive-switchers .preview-mobile' ).addClass( 'active' );

										$( '.control-wrap.tablet, .control-wrap.desktop' ).removeClass( 'active' );
										$( '.responsive-switchers .preview-tablet, .responsive-switchers .preview-desktop' ).removeClass( 'active' );
									} else if ( 'tablet' === device ) {
										$( '.control-wrap.tablet' ).addClass( 'active' );
										$( '.responsive-switchers .preview-tablet' ).addClass( 'active' );

										$( '.control-wrap.mobile, .control-wrap.desktop' ).removeClass( 'active' );
										$( '.responsive-switchers .preview-mobile, .responsive-switchers .preview-desktop' ).removeClass( 'active' );
									} else {
										$( '.control-wrap.desktop' ).addClass( 'active' );
										$( '.responsive-switchers .preview-desktop' ).addClass( 'active' );

										$( '.control-wrap.mobile, .control-wrap.tablet' ).removeClass( 'active' );
										$( '.responsive-switchers .preview-mobile, .responsive-switchers .preview-tablet' ).removeClass( 'active' );
									}

								}

							}

							$this.toggleClass( 'open' );

						}
					);

					control.container.on(
						'click',
						'.colormag-group-wrap > .customizer-text',
						function ( e ) {

							e.preventDefault();
							e.stopPropagation();

							$( this ).find( '.colormag-group-toggle-icon' ).trigger( 'click' );

						}
					);

				},

				colormag_render_field: function ( wrap, fields, control_element ) {

					let control = this;
					let colormag_field_wrap = wrap.find( '.colormag-fields-wrap' );
					let fields_html = '';
					let control_types = [];
					let field_values = control.isJSONString( control_element.params.value ) ? JSON.parse( control_element.params.value ) : {};

					if ( 'undefined' != typeof fields.tabs ) {

						let counter = 0;
						fields_html += '<div id="' + control_element.params.name + '-tabs" class="colormag-group-tabs">';

						fields_html += '<ul class="colormag-group-list">';
						_.each(
							fields.tabs,
							function ( value, key ) {
								let li_class = '';

								if ( 0 === counter ) {
									li_class = "active";
								}

								fields_html += '<li class="' + li_class + '"><a href="#tab-' + key.replace( ' ', '-' ) + '"><span>' + key + '</span></a></li>';
								counter++;
							}
						);
						fields_html += '</ul>';

						fields_html += '<div class="colormag-tab-content" >';
						_.each(
							fields.tabs,
							function ( fields_data, key ) {

								let result = control.generateFieldHtml( fields_data, field_values );

								fields_html += '<div id="tab-' + key.replace( ' ', '-' ) + '" class="tab">';
								fields_html += result.html;

								_.each(
									result.controls,
									function ( control_value, control_key ) {
										control_types.push(
											{
												key: control_value.key,
												value: control_value.value,
												name: control_value.name
											}
										);
									}
								);

								fields_html += '</div>';

							}
						);
						fields_html += '</div>';

						fields_html += '</div>';

						colormag_field_wrap.html( fields_html );

						$( '#' + control_element.params.name + '-tabs' ).tabs();

					} else {

						let result = control.generateFieldHtml( fields, field_values );

						fields_html += result.html;

						_.each(
							result.controls,
							function ( control_value, control_key ) {
								control_types.push(
									{
										key: control_value.key,
										value: control_value.value,
										name: control_value.name
									}
								);
							}
						);

						colormag_field_wrap.html( fields_html );

					}

					_.each(
						control_types,
						function ( control_type, index ) {

							switch ( control_type.key ) {

								case 'colormag-color':
									control.initColorControl( colormag_field_wrap, control_element, control_type.name );
									break;

								case 'colormag-background':
									control.initBackgroundControl( control_element, control_type, control_type.name );
									break;

								case 'colormag-typography':
									control.initTypographyControl( control_element, control_type, control_type.name );
									break;

							}

						}
					);

					wrap.find( '.colormag-field-settings-modal' ).data( 'loaded', true );

				},

				isJSONString: function ( string ) {

					try {
						JSON.parse( string );
					} catch ( e ) {
						return false;
					}

					return true;

				},

				generateFieldHtml: function ( fields_data, field_values ) {

					let fields_html = '';
					let control_types = [];

					_.each(
						fields_data,
						function ( attr, index ) {

							let new_value   = (
									wp.customize.control( attr.name ) ? wp.customize.control( attr.name ).params.value : ''
								),
								control     = attr.control,
								template_id = 'customize-control-' + control + '-content',
								template    = wp.template( template_id ),
								value       = new_value || attr.default,
								dataAtts    = '',
								input_attrs = '';

							attr.value = value;
							attr.title = attr.label;

							// Data attributes.
							_.each(
								attr.data_attrs,
								function ( value, name ) {
									dataAtts += ' data-' + name + ' ="' + value + '"';
								}
							);

							// Input attributes.
							_.each(
								attr.input_attrs,
								function ( value, name ) {
									input_attrs += name + ' ="' + value + '"';
								}
							);

							attr.dataAttrs = dataAtts;
							attr.inputAttrs = input_attrs;

							control_types.push(
								{
									key: control,
									value: value,
									name: attr.name
								}
							);

							let responsive_switchers = '',
								controlsType         = [
									'colormag-typography'
								];

							if ( (
								'colormag-typography' === attr.control
							) && controlsType.includes( attr.control ) ) {
								attr.languages = ColorMagCustomizerControlTypographySubsets;
							}

							if ( controlsType.includes( attr.control ) ) {
								responsive_switchers = 'has-responsive-switchers';
							}


							attr.suffix = window[ attr.name ].suffix;
							attr.default_suffix = window[ attr.name ].default_suffix;
							attr.input_attrs = window[ attr.name ].input_attrs;

							fields_html += '<li id="customize-control-' + attr.name + '" class="customize-control ' + responsive_switchers + ' customize-control-' + attr.control + '" >';
							fields_html += template( attr );
							fields_html += '</li>';

						}
					);

					let result = new Object();

					result.controls = control_types;
					result.html = fields_html;

					return result;

				},

				onOptionChange: function ( e, control, element, value, name ) {

					let control_id = $( '.hidden-field-' + name );
					control_id.val( value );

					let sub_control = wp.customize.control( name );
					sub_control.setting.set( value );

				},

				initColorControl: function ( wrap, control_elem, name ) {

					let control = this;
					let colorpicker = wrap.find( '.customize-control-colormag-color .colormag-color-picker-alpha' );

					colorpicker.wpColorPicker(
						{
							change: function ( event, ui ) {

								if ( 'undefined' != typeof event.originalEvent || 'undefined' != typeof ui.color._alpha ) {

									let element = $( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[ 0 ];
									name = $( element ).parents( '.customize-control' ).attr( 'id' );
									let picker = $( '#' + name + '.customize-control-colormag-color .colormag-color-picker-alpha' );
									name = name.replace( 'customize-control-', '' );
									let current = picker.iris( 'color' );

									$( element ).val( current );

									control.container.trigger(
										'colormag_settings_changed',
										[
											control,
											$( element ),
											current,
											name
										]
									);
								}

							},

							clear: function ( event ) {

								let element = $( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[ 0 ];
								name = $( element ).parents( '.customize-control' ).attr( 'id' );
								name = name.replace( 'customize-control-', '' );

								$( element ).val( '' );

								control.container.trigger(
									'colormag_settings_changed',
									[
										control,
										$( element ),
										'',
										name
									]
								);

								wp.customize.previewer.refresh();

							}
						}
					);
				},

				initBackgroundControl: function ( control, control_atts, name ) {

					let input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .background-hidden-value' ),
						value            = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						colorpicker      = control.container.find( '.colormag-color-picker-alpha' ),
						controlContainer = control.container.find( '#customize-control-' + control_name );

					// Hide unnecessary controls if the value doesn't have an image.
					if ( _.isUndefined( value[ 'background-image' ] ) || '' === value[ 'background-image' ] ) {
						controlContainer.find( '.customize-control-content > .background-repeat' ).hide();
						controlContainer.find( '.customize-control-content > .background-position' ).hide();
						controlContainer.find( '.customize-control-content > .background-size' ).hide();
						controlContainer.find( '.customize-control-content > .background-attachment' ).hide();
					}

					// Background color setting.
					colorpicker.wpColorPicker(
						{
							change: function () {

								if ( $( 'html' ).hasClass( 'colorpicker-ready' ) ) {
									let $this = $( this );

									setTimeout(
										function () {
											control.saveBackgroundValue( 'background-color', colorpicker.val(), $this, name );
										},
										100
									);
								}

							},

							clear: function ( event ) {

								let element = $( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[ 0 ];

								if ( element ) {
									control.saveBackgroundValue( 'background-color', '', $( element ), name );
								}

								wp.customize.previewer.refresh();

							}
						}
					);

					// Background image setting..
					controlContainer.on(
						'click',
						'.background-image-upload-button, .thumbnail-image img',
						function ( e ) {
							let upload_img_btn = $( this );
							let image = wp.media( { multiple: false } ).open().on(
								'select',
								function () {

									// This will return the selected image from the Media Uploader, the result is an object.
									let uploadedImage = image.state().get( 'selection' ).first(),
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

									imageUrl = uploadedImage.toJSON().sizes.full.url;
									imageID = uploadedImage.toJSON().id;
									imageWidth = uploadedImage.toJSON().width;
									imageHeight = uploadedImage.toJSON().height;

									// Show extra controls if the value has an image.
									if ( '' !== imageUrl ) {
										controlContainer.find( '.customize-control-content > .background-repeat, .customize-control-content > .background-position, .customize-control-content > .background-size, .customize-control-content > .background-attachment' ).show();
									}

									control.saveBackgroundValue( 'background-image', imageUrl, upload_img_btn, name );
									preview = controlContainer.find( '.placeholder, .thumbnail' );
									removeButton = controlContainer.find( '.background-image-upload-remove-button' );

									if ( preview.length ) {
										preview.removeClass().addClass( 'thumbnail thumbnail-image' ).html( '<img src="' + previewImage + '" alt="" />' );
									}

									if ( removeButton.length ) {
										removeButton.show();
									}
								}
							);

							e.preventDefault();
						}
					);

					controlContainer.on(
						'click',
						'.background-image-upload-remove-button',
						function ( e ) {

							let preview,
								removeButton;

							e.preventDefault();

							control.saveBackgroundValue( 'background-image', '', $( this ) );

							preview = controlContainer.find( '.placeholder, .thumbnail' );
							removeButton = controlContainer.find( '.background-image-upload-remove-button' );

							// Hide unnecessary controls.
							controlContainer.find( '.customize-control-content > .background-repeat' ).hide();
							controlContainer.find( '.customize-control-content > .background-position' ).hide();
							controlContainer.find( '.customize-control-content > .background-size' ).hide();
							controlContainer.find( '.customize-control-content > .background-attachment' ).hide();

							if ( preview.length ) {
								preview.removeClass().addClass( 'placeholder' ).html( ColorMagCustomizerControlBackground.placeholder );
							}

							if ( removeButton.length ) {
								removeButton.hide();
							}
						}
					);

					// Background repeat setting.
					controlContainer.on(
						'change',
						'.background-repeat select',
						function () {
							control.saveBackgroundValue( 'background-repeat', $( this ).val(), $( this ), name );
						}
					);

					// Background position setting.
					controlContainer.on(
						'change',
						'.background-position select',
						function () {
							control.saveBackgroundValue( 'background-position', $( this ).val(), $( this ), name );
						}
					);

					// Background size setting.
					controlContainer.on(
						'change',
						'.background-size select',
						function () {
							control.saveBackgroundValue( 'background-size', $( this ).val(), $( this ), name );
						}
					);

					// Background attachment setting.
					controlContainer.on(
						'change',
						'.background-attachment select',
						function () {
							control.saveBackgroundValue( 'background-attachment', $( this ).val(), $( this ), name );
						}
					);

				},

				saveBackgroundValue: function ( property, value, element, name ) {

					let control = this,
						input   = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .background-hidden-value' ),
						val     = JSON.parse( input.val() );

					val[ property ] = value;

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

				initTypographyControl: function ( control, control_atts, name ) {

                    let value            = control.setting._value,
                        control_name     = control_atts.name,
                        controlContainer = control.container.find( '#customize-control-' + control_name );

					control_atts.input_attrs = window[ control_atts.name ].input_attrs;

					// On customizer load, render the available font options.
					control.renderTypographyFontSelector( $( this ), name, control_atts );
					control.renderTypographyVariantSelector( $( this ), name, control_atts );
					control.renderTypographySubsetSelector( $( this ), name, control_atts );

					// Font style setting.
					controlContainer.on(
						'change',
						'.font-style select',
						function () {
							control.saveTypographyValue( 'font-style', $( this ).val(), $( this ), name );
						}
					);

					// Text transform setting.
					controlContainer.on(
						'change',
						'.text-transform select',
						function () {
							control.saveTypographyValue( 'text-transform', $( this ).val(), $( this ), name );
						}
					);

					// Text decoration setting.
					controlContainer.on(
						'change',
						'.text-decoration select',
						function () {
							control.saveTypographyValue( 'text-decoration', $( this ).val(), $( this ), name );
						}
					);

					// Font size setting.
					controlContainer.on(
						'change keyup paste input',
						'.font-size input',
						function () {
							let inputValue     = jQuery( this ),
								value          = inputValue.val(),
								maxVal         = inputValue.attr( 'max' ),
								minVal         = inputValue.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								wrapper        = jQuery( this ).closest( '.slider-wrapper' ),
								range          = wrapper.find( 'input[type=range]' ),
								input          = wrapper.find( 'input[type=number]' ),
								device         = input.data( 'device' ),
								selector       = wrapper.find( '.colormag-font-size-' + device + '-warning' ),
								setRangeValue  = range.val( value ),
								sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							range.css( 'background', sliderValue );

							let maxValInt = parseFloat( maxVal ),
								minValInt = parseFloat( minVal ),
								valInt    = parseFloat( value );

							if ( minValInt > valInt || maxValInt < valInt ) {
								selector.html( "Value must be between " + minVal + " and " + maxVal );
								selector.addClass( "warning-visible" );
								inputValue.addClass( "invalid-color" );
							} else {
								selector.removeClass( "warning-visible" );
								inputValue.removeClass( "invalid-color" );
							}

							control.saveTypographyFontSize( $( this ), name, control_atts );
						}
					);

					// Font size progress bar setting.
					controlContainer.find( '.font-size .control-wrap' ).each(
						function () {
							let device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );
							let slider         = jQuery( this ).closest( '.font-size' ).find( '.' + device + ' ' + 'input[type=range]' ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

							let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							slider.css( 'background', sliderValue );

						}
					);

					// Line height progress bar setting.
					control.container.find( '.line-height .control-wrap' ).each(
						function () {
							let device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );
							let slider         = jQuery( this ).closest( '.line-height' ).find( '.' + device + ' ' + 'input[type=range]' ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

							let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							slider.css( 'background', sliderValue );

						}
					);

					// Letter spacing progress bar setting.
					control.container.find( '.letter-spacing .control-wrap' ).each(
						function () {
							let device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );
							let slider         = jQuery( this ).closest( '.letter-spacing' ).find( '.' + device + ' ' + 'input[type=range]' ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

							let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							slider.css( 'background', sliderValue );

						}
					);

					// Font size unit setting.
					controlContainer.on(
						'change keyup paste input',
						'.font-size select',
						function () {

							var wrapper = jQuery( this ).closest( '.control-wrap' ),
								  slider  = wrapper.find( '.range input' );

							wrapper.find( '.size input' ).val( '' );
							wrapper.find( '.range input' ).val( '' );

							let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA 0%, #ebebeb 0%, #ebebeb 100%)`;
							slider.css( 'background', sliderValue );

							control.saveTypographyFontSizeUnit( $( this ), name, control_atts );

						}
					);

					// Line height setting.
					controlContainer.on(
						'change keyup paste input',
						'.line-height input',
						function () {
							let inputValue     = jQuery( this ),
								value          = inputValue.val(),
								maxVal         = inputValue.attr( 'max' ),
								minVal         = inputValue.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								wrapper        = jQuery( this ).closest( '.slider-wrapper' ),
								range          = wrapper.find( 'input[type=range]' ),
								input          = wrapper.find( 'input[type=number]' ),
								device         = input.data( 'device' ),
								selector       = wrapper.find( '.colormag-line-height-' + device + '-warning' ),
								setRangeValue  = range.val( value ),
								sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							range.css( 'background', sliderValue );

							let maxValInt = parseFloat( maxVal ),
								minValInt = parseFloat( minVal ),
								valInt    = parseFloat( value );

							if ( minValInt > valInt || maxValInt < valInt ) {
								selector.html( "Value must be between " + minVal + " and " + maxVal );
								selector.addClass( "warning-visible" );
								inputValue.addClass( "invalid-color" );
							} else {
								selector.removeClass( "warning-visible" );
								inputValue.removeClass( "invalid-color" );
							}

							control.saveTypographyLineHeight( $( this ), name, control_atts );
						}
					);

					// Line height unit setting.
					controlContainer.on(
						'change keyup paste input',
						'.line-height select',
						function () {

							let wrapper = jQuery( this ).closest( '.control-wrap' ),
								slider   = wrapper.find( '.range input' );

							wrapper.find( '.size input' ).val( '' );
							wrapper.find( '.range input' ).val( '' );

							let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA 0%, #ebebeb 0%, #ebebeb 100%)`;
							slider.css( 'background', sliderValue );

							control.saveTypographyLineHeightUnit( $( this ), name, control_atts );

						}
					);

					// Letter spacing setting.
					controlContainer.on(
						'change keyup paste input',
						'.letter-spacing input',
						function () {
							let inputValue     = jQuery( this ),
								value          = inputValue.val(),
								maxVal         = inputValue.attr( 'max' ),
								minVal         = inputValue.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								wrapper        = jQuery( this ).closest( '.slider-wrapper' ),
								range          = wrapper.find( 'input[type=range]' ),
								input          = wrapper.find( 'input[type=number]' ),
								device         = input.data( 'device' ),
								selector       = wrapper.find( '.colormag-letter-spacing-' + device + '-warning' ),
								setRangeValue  = range.val( value ),
								sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

							range.css( 'background', sliderValue );

							let maxValInt = parseFloat( maxVal ),
								minValInt = parseFloat( minVal ),
								valInt    = parseFloat( value );

							if ( minValInt > valInt || maxValInt < valInt ) {
								selector.html( "Value must be between " + minVal + " and " + maxVal );
								selector.addClass( "warning-visible" );
								inputValue.addClass( "invalid-color" );
							} else {
								selector.removeClass( "warning-visible" );
								inputValue.removeClass( "invalid-color" );
							}

							control.saveTypographyLetterSpacing( $( this ), name, control_atts );
						}
					);

					// Letter spacing unit setting.
					controlContainer.on(
						'change keyup paste input',
						'.letter-spacing select',
						function () {
							control.saveTypographyLetterSpacingUnit( $( this ), name, control_atts );
						}
					);

					// On font size range input change.
					this.container.find( '.font-size input[type=range]' ).on(
						'input change',
						function () {

							let slider         = jQuery( this ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
								sliderValue    = `linear - gradient( to right, #0073AA 0 % , #0073AA ${convertedValue} % , #ebebeb ${convertedValue} % , #ebebeb 100 % )`;

							slider.css( 'background', sliderValue );

							input_number.val( value );
							input_number.change();
						}
					);

					// On line height range input change.
					this.container.find( '.line-height input[type=range]' ).on(
						'input change',
						function () {

							let slider         = jQuery( this ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
								sliderValue    = `linear - gradient( to right, #0073AA 0 % , #0073AA ${convertedValue} % , #ebebeb ${convertedValue} % , #ebebeb 100 % )`;

							slider.css( 'background', sliderValue );

							input_number.val( value );
							input_number.change();
						}
					);

					// On letter spacing range input change.
					this.container.find( '.letter-spacing input[type=range]' ).on(
						'input change',
						function () {

							let slider         = jQuery( this ),
								value          = slider.val(),
								maxVal         = slider.attr( 'max' ),
								minVal         = slider.attr( 'min' ),
								convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
								input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
								sliderValue    = `linear - gradient( to right, #0073AA 0 % , #0073AA ${convertedValue} % , #ebebeb ${convertedValue} % , #ebebeb 100 % )`;

							slider.css( 'background', sliderValue );

							input_number.val( value );
							input_number.change();
						}
					);

					// Reset value.
					function resetControlValues(controlType) {
						control.container.find( `.${controlType} .control-wrap` ).each( function () {
							const wrapper      = jQuery( this ),
								  slider       = wrapper.find( '.range input' ),
								  input        = wrapper.find( '.size input' ),
								  unit         = wrapper.find( '.unit-wrapper select' ),
								  defaultValue = slider.data( 'reset_value' ),
								  defaultUnit  = slider.data( 'reset_unit' );

							if ( defaultUnit ) {
								let attr = control_atts.input_attrs.attributes_config[ controlType ][ defaultUnit ];

								if ( attr ) {
									jQuery( this ).find( 'input' ).each(
										function () {
											jQuery( this ).attr( 'min', attr.min );
											jQuery( this ).attr( 'max', attr.max );
											jQuery( this ).attr( 'step', attr.step );
										}
									)
								}
							}

							unit.val(defaultUnit);
							slider.val(defaultValue);
							input.val(defaultValue);
							input.change();
						});
					}

					control.container.on('click', '.colormag-font-size-reset', function () {
						resetControlValues('font-size');
					});

					control.container.on('click', '.colormag-line-height-reset', function () {
						resetControlValues('line-height');
					});

					control.container.on('click', '.colormag-letter-spacing-reset', function () {
						resetControlValues('letter-spacing');
					});


				},

				renderTypographyFontSelector: function ( element, name, control_atts ) {

					let control       = this,
						selector      = control.selector + ' .font-family select',
						standardFonts = [],
						googleFonts   = [],
						customFonts   = [],
						input         = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						value         = JSON.parse( input.val() ),
						fonts         = control.getTypographyFonts(),
						fontSelect;

					// Format standard fonts as an array.
					if ( ! _.isUndefined( fonts.standard ) ) {
						_.each(
							fonts.standard,
							function ( font ) {
								standardFonts.push(
									{
										id: font.family.replace( /&quot;/g, '&#39' ),
										text: font.label
									}
								);
							}
						);
					}

					// Format Google fonts as an array.
					if ( ! _.isUndefined( fonts.google ) ) {
						_.each(
							fonts.google,
							function ( font ) {
								googleFonts.push(
									{
										id: font.family,
										text: font.label
									}
								);
							}
						);
					}

					// Combine fonts and build the final data.
					data = [
						{
							text: fonts.standardfontslabel,
							children: standardFonts
						},
						{
							text: fonts.googlefontslabel,
							children: googleFonts
						}
					];

					// Format custom fonts as an array.
					if ( ! _.isUndefined( fonts.custom ) ) {
						_.each(
							fonts.custom,
							function ( font ) {
								customFonts.push(
									{
										id: font.family,
										text: font.label
									}
								);
							}
						);

						// Merge on `data` array.
						data.push(
							{
								text: fonts.customfontslabel,
								children: customFonts
							}
						);
					}

					// Instantiate selectWoo with the data.
					fontSelect = $( selector ).selectWoo(
						{
							data: data,
							width: '100%'
						}
					);

					// Set the initial value.
					if ( value[ 'font-family' ] ) {
						fontSelect.val( value[ 'font-family' ].replace( /'/g, '"' ) ).trigger( 'change' );
					}

					// When the font option value changes.
					fontSelect.on(
						'change',
						function () {

							// Set the value.
							control.saveTypographyValue( 'font-family', $( this ).val(), $( this ), name );

							// Render new list of selected font options.
							control.renderTypographyVariantSelector( $( this ), name, control_atts );
							control.renderTypographySubsetSelector( $( this ), name, control_atts );

						}
					);

				},

				getTypographyFonts: function () {

					let control = this;

					if ( ! _.isUndefined( ColorMagCustomizerControlTypography ) ) {
						return ColorMagCustomizerControlTypography;
					}

					return {
						google: [],
						standard: []
					};

				},

				renderTypographyVariantSelector: function ( element, name, control_atts ) {

					let control    = this,
						input      = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						value      = JSON.parse( input.val() ),
						fontFamily = value[ 'font-family' ],
						variants   = control.getTypographyVariants( fontFamily ),
						selector   = control.selector + ' .font-weight select',
						data       = [],
						isValid    = false,
						variantSelector;

					if ( false !== variants ) {

						$( control.selector + ' .font-weight' ).show();
						_.each(
							variants,
							function ( variant ) {
								if ( value[ 'font-weight' ] === variant.id ) {
									isValid = true;
								}

								data.push(
									{
										id: variant.id,
										text: variant.label
									}
								);
							}
						);

						if ( ! isValid ) {
							value[ 'font-weight' ] = 'regular';
						}

						if ( $( selector ).hasClass( 'select2-hidden-accessible' ) ) {
							$( selector ).selectWoo( 'destroy' );
							$( selector ).empty();
						}

						// Instantiate selectWoo with the data.
						variantSelector = $( selector ).selectWoo(
							{
								data: data,
								width: '100%'
							}
						);

						variantSelector.val( value[ 'font-weight' ] ).trigger( 'change' );
						variantSelector.on(
							'change',
							function () {
								control.saveTypographyValue( 'font-weight', $( this ).val(), $( this ), name );
							}
						);

					} else {

						$( control.selector + ' .font-weight' ).hide();

					}

				},

				getTypographyVariants: function ( fontFamily ) {

					let control = this,
						fonts   = control.getTypographyFonts();

					let variants = false;
					_.each(
						fonts.standard,
						function ( font ) {
							if ( fontFamily && font.family === fontFamily.replace( /'/g, '"' ) ) {
								variants = font.variants;

								return variants;
							}
						}
					);

					_.each(
						fonts.google,
						function ( font ) {
							if ( font.family === fontFamily ) {
								variants = font.variants;

								return variants;
							}
						}
					);

					// For custom fonts.
					if ( ! _.isUndefined( fonts.custom ) ) {
						_.each(
							fonts.custom,
							function ( font ) {
								if ( font.custom === fontFamily ) {
									variants = font.variants;

									return variants;
								}
							}
						);
					}

					return variants;

				},

				renderTypographySubsetSelector: function ( element, name, control_atts ) {

					let control    = this,
						input      = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						value      = JSON.parse( input.val() ),
						fontFamily = value[ 'font-family' ],
						subsets    = control.getTypographySubsets( fontFamily ),
						selector   = control.selector + ' .subsets select',
						data       = [],
						validValue = value.subsets,
						subsetSelector;

					if ( false !== subsets ) {

						$( control.selector + ' .subsets' ).show();
						_.each(
							subsets,
							function ( subset ) {
								if ( _.isObject( validValue ) ) {
									if ( -1 === validValue.indexOf( subset.id ) ) {
										validValue = _.reject(
											validValue,
											function ( subValue ) {
												return subValue === subset.id;
											}
										);
									}
								}

								data.push(
									{
										id: subset.id,
										text: subset.label
									}
								);
							}
						);

					} else {

						$( control.selector + ' .subsets' ).hide();

					}

					if ( $( selector ).hasClass( 'select2-hidden-accessible' ) ) {
						$( selector ).selectWoo( 'destroy' );
						$( selector ).empty();
					}

					// Instantiate selectWoo with the data.
					subsetSelector = $( selector ).selectWoo(
						{
							data: data,
							width: '100%'
						}
					);

					subsetSelector.val( validValue ).trigger( 'change' );
					subsetSelector.on(
						'change',
						function () {
							control.saveTypographyValue( 'subsets', $( this ).val(), $( this ), name );
						}
					);

				},

				getTypographySubsets: function ( fontFamily ) {

					let control = this,
						subsets = false,
						fonts   = control.getTypographyFonts();

					_.each(
						fonts.google,
						function ( font ) {
							if ( font.family === fontFamily ) {
								subsets = font.subsets;

								return subsets;
							}
						}
					);

					return subsets;

				},

				saveTypographyFontSize: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'font-size': {
								'desktop': {
									'size': val[ 'font-size' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'font-size' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'font-size' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.font-size .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'input[type=number]' ).val();
							let device = $( this ).find( 'input[type=number]' ).data( 'device' );

							if ( ! newValue[ 'font-size' ][ device ] ) {
								newValue[ 'font-size' ][ device ] = {};
							}

							newValue[ 'font-size' ][ device ][ 'size' ] = controlValue;
						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

				saveTypographyFontSizeUnit: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'font-size': {
								'desktop': {
									'size': val[ 'font-size' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'font-size' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'font-size' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'font-size' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.font-size .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'select' ).val();
							let device = $( this ).find( 'select' ).data( 'device' );

							if ( ! newValue[ 'font-size' ][ device ] ) {
								newValue[ 'font-size' ][ device ] = {};
							}

							control_atts.input_attrs = window[ control_atts.name ].input_attrs;

							if ( controlValue ) {
								let attr = control_atts.input_attrs.attributes_config[ 'font-size' ][ controlValue ];

								if ( attr ) {
									jQuery( this ).find( 'input' ).each(
										function () {
											jQuery( this ).attr( 'min', attr.min );
											jQuery( this ).attr( 'max', attr.max );
											jQuery( this ).attr( 'step', attr.step );
										}
									)
								}
							}

							newValue[ 'font-size' ][ device ][ 'unit' ] = controlValue;
						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) );

				},

				saveTypographyLineHeight: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'line-height': {
								'desktop': {
									'size': val[ 'line-height' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'line-height' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'line-height' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.line-height .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'input[type=number]' ).val();
							let device = $( this ).find( 'input[type=number]' ).data( 'device' );

							if ( ! newValue[ 'line-height' ][ device ] ) {
								newValue[ 'line-height' ][ device ] = {};
							}

							newValue[ 'line-height' ][ device ][ 'size' ] = controlValue;

						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

				saveTypographyLineHeightUnit: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'line-height': {
								'desktop': {
									'size': val[ 'line-height' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'line-height' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'line-height' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'line-height' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.line-height .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'select' ).val();
							let device = $( this ).find( 'select' ).data( 'device' );

							if ( ! newValue[ 'line-height' ][ device ] ) {
								newValue[ 'line-height' ][ device ] = {};
							}

							control_atts.input_attrs = window[ control_atts.name ].input_attrs;

							if ( controlValue ) {
								let attr = control_atts.input_attrs.attributes_config[ 'line-height' ][ controlValue ];

								if ( attr ) {
									jQuery( this ).find( 'input' ).each(
										function () {
											jQuery( this ).attr( 'min', attr.min );
											jQuery( this ).attr( 'max', attr.max );
											jQuery( this ).attr( 'step', attr.step );
										}
									)
								}
							}

							newValue[ 'line-height' ][ device ][ 'unit' ] = controlValue;

						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) );

				},

				saveTypographyLetterSpacing: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'letter-spacing': {
								'desktop': {
									'size': val[ 'letter-spacing' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'letter-spacing' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'letter-spacing' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.letter-spacing .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'input[type=number]' ).val();
							let device = $( this ).find( 'input[type=number]' ).data( 'device' );

							if ( ! newValue[ 'letter-spacing' ][ device ] ) {
								newValue[ 'letter-spacing' ][ device ] = {};
							}

							newValue[ 'letter-spacing' ][ device ][ 'size' ] = controlValue;

						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

				saveTypographyLetterSpacingUnit: function ( element, name, control_atts ) {

					let control          = this,
						input            = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val              = JSON.parse( input.val() ),
						control_name     = control_atts.name,
						controlContainer = control.container.find( '#customize-control-' + control_name ),
						newValue         = {
							'letter-spacing': {
								'desktop': {
									'size': val[ 'letter-spacing' ][ 'desktop' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'desktop' ][ 'unit' ]

								},
								'tablet': {
									'size': val[ 'letter-spacing' ][ 'tablet' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'tablet' ][ 'unit' ]
								},
								'mobile': {
									'size': val[ 'letter-spacing' ][ 'mobile' ][ 'size' ],
									'unit': val[ 'letter-spacing' ][ 'mobile' ][ 'unit' ]
								}
							}
						};

					controlContainer.find( '.letter-spacing .control-wrap' ).each(
						function () {
							let controlValue = $( this ).find( 'select' ).val();
							let device = $( this ).find( 'select' ).data( 'device' );

							if ( ! newValue[ 'letter-spacing' ][ device ] ) {
								newValue[ 'letter-spacing' ][ device ] = {};
							}

							newValue[ 'letter-spacing' ][ device ][ 'unit' ] = controlValue;

						}
					);

					// Extend/Update the `val` object to include `newValue`'s new data as an object.
					$.extend( val, newValue );

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

				saveTypographyValue: function ( property, value, element, name ) {

					let control = this,
						input   = $( '#customize-control-' + control.id.replace( '[', '-' ).replace( ']', '' ) + ' .typography-hidden-value' ),
						val     = JSON.parse( input.val() );

					val[ property ] = value;

					$( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );

					name = $( element ).parents( '.customize-control' ).attr( 'id' );
					name = name.replace( 'customize-control-', '' );

					control.container.trigger(
						'colormag_settings_changed',
						[
							control,
							element,
							val,
							name
						]
					);

				},

			}
		);

	}
)( jQuery );

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
wp.customize.controlConstructor[ 'colormag-slider' ] = wp.customize.Control.extend( {

	ready: function () {

		'use strict';

		let control        = this,
			slider         = this.container.find( '.colormag-progress' ),
			inputValue     = this.container.find( '.size input' ),
			value          = inputValue.val(),
			maxVal         = slider.attr( 'max' ),
			minVal         = slider.attr( 'min' ),
			convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

		if ( value === '' ) {
			let sliderValue = `linear-gradient(to right, #ebebeb 0%, #ebebeb ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;
			slider.css( 'background', sliderValue );
		} else {
			let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;
			slider.css( 'background', sliderValue );
		}

		// Size setting.
		control.container.on( 'change keyup paste input', '.size input', function () {
			let inputValue     = jQuery( this ),
				value          = inputValue.val(),
				maxVal         = inputValue.attr( 'max' ),
				minVal         = slider.attr( 'min' ),
				convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
				wrapper     = jQuery( this ).closest( '.slider-wrapper' ),
				range = wrapper.find( 'input[type=range]' ),
				selector = wrapper.find( '.colormag-warning' ),
				setRangeValue  = range.val( value ),
				sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

			range.css( 'background', sliderValue );

			let maxValInt      = parseFloat( maxVal ),
				minValInt      = parseFloat( minVal ),
				valInt         = parseFloat( value );

			if ( minValInt > valInt || maxValInt < valInt ) {
				selector.html("Value must be between " + minVal + " and " + maxVal) ;
				selector.addClass( "warning-visible" );
				inputValue.addClass( "invalid-color" );
			} else {
				selector.removeClass( "warning-visible" );
				inputValue.removeClass( "invalid-color" );
			}

			control.updateSize();
		} );

		// Range setting.
		control.container.on( 'change keyup paste input', '.range input', function () {
			control.updateSize();
		} );

		// Unit setting.
		control.container.on( 'change', '.unit-wrapper select', function () {

			// On unit change update the attribute.
			control.container.find( '.slider-label' ).each(
				function () {
					var controlValue = jQuery( this ).find( '.unit-wrapper select' ).val();

					if ( controlValue ) {
						var attr = control.params.input_attrs.attributes_config[ controlValue ];

						if ( attr ) {
							jQuery( this ).find( 'input' ).each(
								function () {
									jQuery( this ).attr( 'min', attr.min );
									jQuery( this ).attr( 'max', attr.max );
									jQuery( this ).attr( 'step', attr.step );
								}
							)
						}
					}
				}
			);

			// Update the slider.
			let wrapper = jQuery( this ).closest( '.slider-label' ),
				slider   = wrapper.find( '.range input' );

			wrapper.find( '.size input' ).val( '' );
			wrapper.find( '.range input' ).val( '' );

			let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA 0%, #ebebeb 0%, #ebebeb 100%)`;
			slider.css( 'background', sliderValue );

			control.updateUnit();

		} );

		this.container.find( 'input[type=range]' ).on( 'input change', function () {

			let slider         = jQuery( this ),
				value          = slider.val(),
				maxVal         = slider.attr( 'max' ),
				minVal         = slider.attr( 'min' ),
				convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
				input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
				sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

			slider.css( 'background', sliderValue );

			input_number.val( value );
			input_number.change();
		} );

		// Handle the reset button.
		this.container.find( '.colormag-slider-reset' ).click( function () {

			let wrapper       = jQuery( this ).closest( 'li' ).children( '.slider-label' ),
				input_range   = wrapper.find( 'input[type=range]' ),
				input_number  = wrapper.find( '.colormag-range-value input' ),
				unitSelect    = wrapper.find( '.unit-wrapper select' ),
				default_value = input_range.data( 'reset_value' ),
				default_unit  = input_range.data( 'reset_unit' );

			if ( default_unit ) {
				var attr = control.params.input_attrs.attributes_config[ default_unit ];

				if ( attr ) {
					wrapper.find( 'input' ).each(
						function () {
							jQuery( this ).attr( 'min', attr.min );
							jQuery( this ).attr( 'max', attr.max );
							jQuery( this ).attr( 'step', attr.step );
						}
					)
				}
			}

			unitSelect.val(default_unit ? default_unit : 'px').change(); // Trigger change event for unitSelect
			input_range.val(default_value).change(); // Trigger change event for input_range
			input_number.val(default_value).change(); // Trigger change event for input_number

			// Save the unitSelect, input_range, and input_number values (optional)
			var selectedUnit = unitSelect.val();
			var inputRangeValue = input_range.val();
			var inputValue = input_number.val();
		} );
	},

	updateSize: function () {

		let control     = this,
			val         = control.setting.get(),
			hiddenValue = control.container.find( '.slider-hidden-value' ),
			newValue    = {
				'size': {}
			};

		control.container.find( '.size .input-wrapper' ).each(
			function () {
				let controlValue = jQuery( this ).find( 'input' ).val();

				newValue[ 'size' ] = controlValue;
			}
		);

		// Extend/Update the `val` object to include `newValue`'s new data as an object.
		val = jQuery.extend( val, newValue );

		jQuery( hiddenValue ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
		control.setting.set( val );

	},

	updateUnit: function () {

		let control     = this,
			val         = control.setting._value,
			hiddenValue = control.container.find( '.slider-hidden-value' ),
			newValue    = {
				'unit': {}
			};

		control.container.find( '.unit-wrapper .input-wrapper' ).each(
			function () {
				let controlValue = jQuery( this ).find( 'select' ).val();

				newValue[ 'unit' ] = controlValue;
			}
		);

		// Extend/Update the `val` object to include `newValue`'s new data as an object.
		val = jQuery.extend( val, newValue );

		jQuery( hiddenValue ).attr( 'value', JSON.stringify( val ) );
		control.setting.set( val );

	},

} );

/**
 * Sortable control JS to handle the sortable feature of custom customize controls.
 *
 * File `sortable.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-sortable'] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// Set the sortable container.
		control.sortableContainer = control.container.find( 'ul.sortable' ).first();

		control.unsortableContainer = control.container.find( 'ul.unsortable' ).first();

		control.unsortableContainer.find( 'li' ).each(
			function () {
				jQuery( this ).find( '.switch' ).on( 'click', function() {
					jQuery( this ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
				} )
			}
		).click(
			function () {
				// Update value on click.
				control.updateValue();
			}
		);

		// Init sortable.
		control.sortableContainer.sortable(
			{
				// Update value when we stop sorting.
				stop : function () {
					control.updateValue();
				}
			}
		).disableSelection().find( 'li' ).each(
			function () {
				// Enable/disable options when we click on the eye of Thundera.
				jQuery( this ).find( '.switch' ).click(
					function () {
						jQuery( this ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
					}
				);
			}
		).click(
			function () {
				// Update value on click.
				control.updateValue();
			}
		);

	},

	updateValue : function () {

		'use strict';

		var control    = this,
			sortable = [],
			unsortable =[],
			newValue   = [];

		this.sortableContainer.find( 'li' ).each(
			function () {
				if ( ! jQuery( this ).is( '.invisible' ) ) {
					sortable.push( jQuery( this ).data( 'value' ) );
				}
			}
		);

		this.unsortableContainer.find( 'li' ).each(
			function (i) {
				if ( ! jQuery( this ).is( '.invisible' ) ) {
					unsortable.push( jQuery( this ).data( 'value' ) );
				}
			}
		);

		newValue = unsortable.concat(sortable);

		control.setting.set( newValue );

	}


} );

/**
 * Switch toggle control JS to handle the toggle of custom customize controls.
 *
 * File `toggle.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-toggle'] = wp.customize.Control.extend(
	{

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

	}
);

/**
 * Typography control JS to handle the typography customize option.
 *
 * File `typography.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor[ 'colormag-typography' ] = wp.customize.Control.extend(
	{

		ready: function () {

			'use strict';

			const control = this;

			// Font size progress bar setting.
			control.container.find( '.font-size .control-wrap' ).each(
				function () {
					let device         = jQuery( this ).find( 'input[type=number]' ).data( 'device' ),
						slider         = jQuery( this ).closest( '.font-size' ).find( '.' + device + ' ' + 'input[type=range]' ),
						value          = slider.val(),
						maxVal         = slider.attr( 'max' ),
						minVal         = slider.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

					let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					slider.css( 'background', sliderValue );

				}
			);

			// Line height progress bar setting.
			control.container.find( '.line-height .control-wrap' ).each(
				function () {
					let device         = jQuery( this ).find( 'input[type=number]' ).data( 'device' ),
						slider         = jQuery( this ).closest( '.line-height' ).find( '.' + device + ' ' + 'input[type=range]' ),
						value          = slider.val(),
						maxVal         = slider.attr( 'max' ),
						minVal         = slider.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

					let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					slider.css( 'background', sliderValue );

				}
			);

			// Letter spacing progress bar setting.
			control.container.find( '.letter-spacing .control-wrap' ).each(
				function () {
					let device         = jQuery( this ).find( 'input[type=number]' ).data( 'device' ),
						slider         = jQuery( this ).closest( '.letter-spacing' ).find( '.' + device + ' ' + 'input[type=range]' ),
						value          = slider.val(),
						maxVal         = slider.attr( 'max' ),
						minVal         = slider.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100;

					let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					slider.css( 'background', sliderValue );

				}
			);

			// On customizer load, render the available font options.
			control.renderFontSelector();
			control.renderVariantSelector();
			control.renderSubsetSelector();

			// Font style setting.
			control.container.on(
				'change',
				'.font-style select',
				function () {
					control.saveValue( 'font-style', jQuery( this ).val() );
				}
			);

			// Text transform setting.
			control.container.on(
				'change',
				'.text-transform select',
				function () {
					control.saveValue( 'text-transform', jQuery( this ).val() );
				}
			);

			// Text decoration setting.
			control.container.on(
				'change',
				'.text-decoration select',
				function () {
					control.saveValue( 'text-decoration', jQuery( this ).val() );
				}
			);

			// Font size setting.
			control.container.on(
				'change keyup',
				'.font-size .size input',
				function () {
					let inputValue     = jQuery( this ),
						value          = inputValue.val(),
						maxVal         = inputValue.attr( 'max' ),
						minVal         = inputValue.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
						wrapper     = jQuery( this ).closest( '.slider-wrapper' ),
						range = wrapper.find( 'input[type=range]' ),
						input = wrapper.find( 'input[type=number]' ),
						device         = input.data( 'device' ),
						selector = wrapper.find( '.colormag-font-size-' + device + '-warning' ),
						setRangeValue  = range.val( value ),
						sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					range.css( 'background', sliderValue );

					let maxValInt      = parseFloat( maxVal ),
						minValInt      = parseFloat( minVal ),
						valInt         = parseFloat( value );

					if ( minValInt > valInt || maxValInt < valInt ) {
						selector.html("Value must be between " + minVal + " and " + maxVal) ;
						selector.addClass( "warning-visible" );
						inputValue.addClass( "invalid-color" );
					} else {
						selector.removeClass( "warning-visible" );
						inputValue.removeClass( "invalid-color" );
					}

					control.updateFontSize();
				}
			);

			// Range setting.
			control.container.on(
				'change keyup paste input',
				'.font-size .range input',
				function () {
					control.updateFontSize();
				}
			);

			// On font size range input change.
			this.container.find( '.font-size input[type=range]' ).on(
				'input change',
				function () {

					var slider       = jQuery( this ),
						value        = slider.val(),
						input_number = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' );

					input_number.val( value );
					input_number.change();
				}
			);

			// On line height range input change.
			this.container.find( '.line-height input[type=range]' ).on(
				'input change',
				function () {

					var slider         = jQuery( this ),
						value          = slider.val(),
						maxVal         = slider.attr( 'max' ),
						minVal         = slider.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
						input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
						sliderValue    = `linear - gradient( to right, #0073AA 0 % , #0073AA ${convertedValue} % , #ebebeb ${convertedValue} % , #ebebeb 100 % )`;

					slider.css( 'background', sliderValue );

					input_number.val( value );
					input_number.change();
				}
			);

			// On letter spacing range input change.
			this.container.find( '.letter-spacing input[type=range]' ).on(
				'input change',
				function () {

					var slider         = jQuery( this ),
						value          = slider.val(),
						maxVal         = slider.attr( 'max' ),
						minVal         = slider.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
						input_number   = jQuery( this ).closest( '.slider-wrapper' ).find( '.colormag-range-value .input-wrapper input' ),
						sliderValue    = `linear - gradient( to right, #0073AA 0 % , #0073AA ${convertedValue} % , #ebebeb ${convertedValue} % , #ebebeb 100 % )`;

					slider.css( 'background', sliderValue );

					input_number.val( value );
					input_number.change();
				}
			);

			// Font size unit setting.
			control.container.on( 'change', '.font-size-unit', function () {

				// On unit change update the attribute.
				control.container.find( '.font-size .control-wrap' ).each(
					function () {
						let controlValue = jQuery( this ).find( '.unit-wrapper .font-size-unit' ).val();

						if ( controlValue ) {
							let attr = control.params.input_attrs.attributes_config[ 'font-size' ][ controlValue ];

							if ( attr ) {
								jQuery( this ).find( 'input' ).each(
									function () {
										jQuery( this ).attr( 'min', attr.min );
										jQuery( this ).attr( 'max', attr.max );
										jQuery( this ).attr( 'step', attr.step );
									}
								)
							}
						}
					}
				);

				let wrapper = jQuery( this ).closest( '.control-wrap' ),
					slider   = wrapper.find( '.range input' );

				wrapper.find( '.size input' ).val( '' );
				wrapper.find( '.range input' ).val( '' );

				let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA 0%, #ebebeb 0%, #ebebeb 100%)`;
				slider.css( 'background', sliderValue );

				control.updateFontSizeUnit();

			} );

			// Reset value.
			function resetControlValues( controlType ) {
				control.container.find( `.${controlType} .control-wrap` ).each( function () {
					const wrapper      = jQuery( this ),
						  slider       = wrapper.find( '.range input' ),
						  input        = wrapper.find( '.size input' ),
						  unit         = wrapper.find( '.unit-wrapper select' ),
						  defaultValue = slider.data( 'reset_value' ),
						  defaultUnit  = slider.data( 'reset_unit' );

					if ( defaultUnit ) {
						let attr = control.params.input_attrs.attributes_config[ controlType ][ defaultUnit ];

						if ( attr ) {
							jQuery( this ).find( 'input' ).each(
								function () {
									jQuery( this ).attr( 'min', attr.min );
									jQuery( this ).attr( 'max', attr.max );
									jQuery( this ).attr( 'step', attr.step );
								}
							)
						}
					}

					unit.val(defaultUnit ? defaultUnit : 'px').change(); // Trigger change event for unit
					slider.val(defaultValue).change(); // Trigger change event for slider
					input.val(defaultValue).change(); // Trigger change event for inputValue

					// Save the unit, slider, and inputValue values (optional)
					var selectedUnit = unit.val();
					var inputRangeValue = slider.val();
					var inputValue = input.val();
				} );
			}

			control.container.on('click', '.colormag-font-size-reset', function () {
				resetControlValues('font-size');
			});

			control.container.on('click', '.colormag-line-height-reset', function () {
				resetControlValues('line-height');
			});

			control.container.on('click', '.colormag-letter-spacing-reset', function () {
				resetControlValues('letter-spacing');
			});

			// Line height setting.
			control.container.on(
				'change keyup paste input',
				'.line-height input',
				function () {
					let inputValue     = jQuery( this ),
						value          = inputValue.val(),
						maxVal         = inputValue.attr( 'max' ),
						minVal         = inputValue.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
						wrapper        = jQuery( this ).closest( '.slider-wrapper' ),
						range = wrapper.find( 'input[type=range]' ),
						input = wrapper.find( 'input[type=number]' ),
						device         = input.data( 'device' ),
						selector = wrapper.find( '.colormag-line-height-' + device + '-warning' ),
						setRangeValue  = range.val( value ),
						sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					range.css( 'background', sliderValue );

					let maxValInt      = parseFloat( maxVal ),
						minValInt      = parseFloat( minVal ),
						valInt         = parseFloat( value );

					if ( minValInt > valInt || maxValInt < valInt ) {
						selector.html("Value must be between " + minVal + " and " + maxVal) ;
						selector.addClass( "warning-visible" );
						inputValue.addClass( "invalid-color" );
					} else {
						selector.removeClass( "warning-visible" );
						inputValue.removeClass( "invalid-color" );
					}

					control.updateLineHeight();
				}
			);

			// Line height unit setting.
			control.container.on(
				'change',
				'.line-height-unit',
				function () {

					control.container.find( '.line-height .control-wrap' ).each(
						function () {
							var unitValue = jQuery( this ).find( '.unit-wrapper .line-height-unit' ).val();

							if ( unitValue ) {
								var attr = control.params.input_attrs.attributes_config[ 'line-height' ][ unitValue ];

								if ( attr ) {
									jQuery( this ).find( 'input' ).each(
										function () {
											jQuery( this ).attr( 'min', attr.min );
											jQuery( this ).attr( 'max', attr.max );
											jQuery( this ).attr( 'step', attr.step );
										}
									)
								}
							}
						}
					);

					let wrapper = jQuery( this ).closest( '.control-wrap' ),
						slider   = wrapper.find( '.range input' );

					wrapper.find( '.size input' ).val( '' );
					wrapper.find( '.range input' ).val( '' );

					let sliderValue = `linear-gradient(to right, #0073AA 0%, #0073AA 0%, #ebebeb 0%, #ebebeb 100%)`;
					slider.css( 'background', sliderValue );

					control.updateLineHeightUnit();

				}
			);

			// Letter spacing unit setting.
			control.container.on(
				'change keyup paste input',
				'.letter-spacing-unit',
				function () {

					control.updateLetterSpacingUnit();
				}
			);

			// Letter spacing setting.
			control.container.on(
				'change keyup paste input',
				'.letter-spacing input',
				function () {
					var inputValue     = jQuery( this ),
						value          = inputValue.val(),
						maxVal         = inputValue.attr( 'max' ),
						minVal         = inputValue.attr( 'min' ),
						convertedValue = ( value - minVal ) / ( maxVal - minVal ) * 100,
						wrapper     = jQuery( this ).closest( '.slider-wrapper' ),
						range = wrapper.find( 'input[type=range]' ),
						input = wrapper.find( 'input[type=number]' ),
						device         = input.data( 'device' ),
						selector = wrapper.find( '.colormag-letter-spacing-' + device + '-warning' ),
						setRangeValue  = range.val( value ),
						sliderValue    = `linear-gradient(to right, #0073AA 0%, #0073AA ${convertedValue}%, #ebebeb ${convertedValue}%, #ebebeb 100%)`;

					range.css( 'background', sliderValue );

					let maxValInt      = parseFloat( maxVal ),
						minValInt      = parseFloat( minVal ),
						valInt         = parseFloat( value );

					if ( minValInt > valInt || maxValInt < valInt ) {
						selector.html("Value must be between " + minVal + " and " + maxVal) ;
						selector.addClass( "warning-visible" );
						inputValue.addClass( "invalid-color" );
					} else {
						selector.removeClass( "warning-visible" );
						inputValue.removeClass( "invalid-color" );
					}

					control.updateLetterSpacing();
				}
			);
		},

		renderFontSelector: function () {

			var control       = this,
				selector      = control.selector + ' .font-family select',
				standardFonts = [],
				googleFonts   = [],
				customFonts   = [],
				value         = control.setting._value,
				fonts         = control.getFonts(),
				fontSelect;

			// Format standard fonts as an array.
			if ( ! _.isUndefined( fonts.standard ) ) {
				_.each(
					fonts.standard,
					function ( font ) {
						standardFonts.push(
							{
								id: font.family.replace( /&quot;/g, '&#39' ),
								text: font.label
							}
						);
					}
				);
			}

			// Format Google fonts as an array.
			if ( ! _.isUndefined( fonts.google ) ) {
				_.each(
					fonts.google,
					function ( font ) {
						googleFonts.push(
							{
								id: font.family,
								text: font.label
							}
						);
					}
				);
			}

			// Combine fonts and build the final data.
			data = [
				{
					text: fonts.standardfontslabel,
					children: standardFonts
				},
				{
					text: fonts.googlefontslabel,
					children: googleFonts
				}
			];

			// Format custom fonts as an array.
			if ( ! _.isUndefined( fonts.custom ) ) {
				_.each(
					fonts.custom,
					function ( font ) {
						customFonts.push(
							{
								id: font.family,
								text: font.label
							}
						);
					}
				);

				// Merge on `data` array.
				data.push(
					{
						text: fonts.customfontslabel,
						children: customFonts
					}
				);
			}

			// Instantiate selectWoo with the data.
			fontSelect = jQuery( selector ).selectWoo(
				{
					data: data,
					width: '100%'
				}
			);

			// Set the initial value.
			if ( value[ 'font-family' ] ) {
				fontSelect.val( value[ 'font-family' ].replace( /'/g, '"' ) ).trigger( 'change' );
			}

			// When the font option value changes.
			fontSelect.on(
				'change',
				function () {

					// Set the value.
					control.saveValue( 'font-family', jQuery( this ).val() );

					// Render new list of selected font options.
					control.renderVariantSelector();
					control.renderSubsetSelector();

				}
			);

		},

		getFonts: function () {

			var control = this;

			if ( ! _.isUndefined( ColorMagCustomizerControlTypography ) ) {
				return ColorMagCustomizerControlTypography;
			}

			return {
				google: [],
				standard: []
			};

		},

		renderVariantSelector: function () {

			var control    = this,
				value      = control.setting._value,
				fontFamily = value[ 'font-family' ],
				variants   = control.getVariants( fontFamily ),
				selector   = control.selector + ' .font-weight select',
				data       = [],
				isValid    = false,
				variantSelector;

			if ( false !== variants ) {

				jQuery( control.selector + ' .font-weight' ).show();
				_.each(
					variants,
					function ( variant ) {
						if ( value[ 'font-weight' ] === variant.id ) {
							isValid = true;
						}

						data.push(
							{
								id: variant.id,
								text: variant.label
							}
						);
					}
				);

				if ( ! isValid ) {
					value[ 'font-weight' ] = 'regular';
				}

				if ( jQuery( selector ).hasClass( 'select2-hidden-accessible' ) ) {
					jQuery( selector ).selectWoo( 'destroy' );
					jQuery( selector ).empty();
				}

				// Instantiate selectWoo with the data.
				variantSelector = jQuery( selector ).selectWoo(
					{
						data: data,
						width: '100%'
					}
				);

				variantSelector.val( value[ 'font-weight' ] ).trigger( 'change' );
				variantSelector.on(
					'change',
					function () {
						control.saveValue( 'font-weight', jQuery( this ).val() );
					}
				);

			} else {

				jQuery( control.selector + ' .font-weight' ).hide();

			}

		},

		getVariants: function ( fontFamily ) {

			var control = this,
				fonts   = control.getFonts();

			var variants = false;
			_.each(
				fonts.standard,
				function ( font ) {
					if ( fontFamily && font.family === fontFamily.replace( /'/g, '"' ) ) {
						variants = font.variants;

						return variants;
					}
				}
			);

			_.each(
				fonts.google,
				function ( font ) {
					if ( font.family === fontFamily ) {
						variants = font.variants;

						return variants;
					}
				}
			);

			// For custom fonts.
			if ( ! _.isUndefined( fonts.custom ) ) {
				_.each(
					fonts.custom,
					function ( font ) {
						if ( font.custom === fontFamily ) {
							variants = font.variants;

							return variants;
						}
					}
				);
			}

			return variants;

		},

		renderSubsetSelector: function () {

			var control    = this,
				value      = control.setting._value,
				fontFamily = value[ 'font-family' ],
				subsets    = control.getSubsets( fontFamily ),
				selector   = control.selector + ' .subsets select',
				data       = [],
				validValue = value.subsets,
				subsetSelector;

			if ( false !== subsets ) {

				jQuery( control.selector + ' .subsets' ).show();
				_.each(
					subsets,
					function ( subset ) {
						if ( _.isObject( validValue ) ) {
							if ( -1 === validValue.indexOf( subset.id ) ) {
								validValue = _.reject(
									validValue,
									function ( subValue ) {
										return subValue === subset.id;
									}
								);
							}
						}

						data.push(
							{
								id: subset.id,
								text: subset.label
							}
						);
					}
				);

			} else {

				jQuery( control.selector + ' .subsets' ).hide();

			}

			if ( jQuery( selector ).hasClass( 'select2-hidden-accessible' ) ) {
				jQuery( selector ).selectWoo( 'destroy' );
				jQuery( selector ).empty();
			}

			// Instantiate selectWoo with the data.
			subsetSelector = jQuery( selector ).selectWoo(
				{
					data: data,
					width: '100%'
				}
			);

			subsetSelector.val( validValue ).trigger( 'change' );
			subsetSelector.on(
				'change',
				function () {
					control.saveValue( 'subsets', jQuery( this ).val() );
				}
			);

		},

		getSubsets: function ( fontFamily ) {

			var control = this,
				subsets = false,
				fonts   = control.getFonts();

			_.each(
				fonts.google,
				function ( font ) {
					if ( font.family === fontFamily ) {
						subsets = font.subsets;

						return subsets;
					}
				}
			);

			return subsets;

		},

		saveValue: function ( property, value ) {

			var control = this,
				input   = control.container.find( '.typography-hidden-value' ),
				val     = control.setting._value;

			val[ property ] = value;

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateFontSize: function () {

			var control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'font-size': {
						'desktop': {
							'size': val[ 'font-size' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'font-size' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'font-size' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.font-size .control-wrap' ).each(
				function () {
					var controlValue = jQuery( this ).find( 'input[type=number]' ).val();
					var device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );

					newValue[ 'font-size' ][ device ][ 'size' ] = controlValue;

				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateFontSizeUnit: function () {

			let control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'font-size': {
						'desktop': {
							'size': val[ 'font-size' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'font-size' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'font-size' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'font-size' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.font-size .control-wrap' ).each(
				function () {
					let controlValue = jQuery( this ).find( '.unit-wrapper .font-size-unit' ).val();
					let device = jQuery( this ).find( '.unit-wrapper .font-size-unit' ).data( 'device' );

					newValue[ 'font-size' ][ device ][ 'unit' ] = controlValue;
					newValue[ 'font-size' ][ device ][ 'size' ] = '';

				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateLineHeight: function () {

			var control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'line-height': {
						'desktop': {
							'size': val[ 'line-height' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'line-height' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'line-height' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.line-height .control-wrap' ).each(
				function () {
					var controlValue = jQuery( this ).find( 'input[type=number]' ).val();
					var device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );

					newValue[ 'line-height' ][ device ][ 'size' ] = controlValue;
				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateLineHeightUnit: function () {

			var control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'line-height': {
						'desktop': {
							'size': val[ 'line-height' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'line-height' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'line-height' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'line-height' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.line-height .control-wrap' ).each(
				function () {
					var unitValue = jQuery( this ).find( '.unit-wrapper .line-height-unit' ).val();
					var device = jQuery( this ).find( '.unit-wrapper .line-height-unit' ).data( 'device' );

					newValue[ 'line-height' ][ device ][ 'unit' ] = unitValue;

				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateLetterSpacing: function () {

			var control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'letter-spacing': {
						'desktop': {
							'size': val[ 'letter-spacing' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'letter-spacing' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'letter-spacing' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.letter-spacing .control-wrap' ).each(
				function () {
					var controlValue = jQuery( this ).find( 'input[type=number]' ).val();
					var device = jQuery( this ).find( 'input[type=number]' ).data( 'device' );

					newValue[ 'letter-spacing' ][ device ][ 'size' ] = controlValue;
				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

		updateLetterSpacingUnit: function () {

			var control  = this,
				val      = control.setting._value,
				input    = control.container.find( '.typography-hidden-value' ),
				newValue = {
					'letter-spacing': {
						'desktop': {
							'size': val[ 'letter-spacing' ][ 'desktop' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'desktop' ][ 'unit' ]

						},
						'tablet': {
							'size': val[ 'letter-spacing' ][ 'tablet' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'tablet' ][ 'unit' ]
						},
						'mobile': {
							'size': val[ 'letter-spacing' ][ 'mobile' ][ 'size' ],
							'unit': val[ 'letter-spacing' ][ 'mobile' ][ 'unit' ]
						}
					}
				};

			control.container.find( '.letter-spacing .control-wrap' ).each(
				function () {
					var unitValue = jQuery( this ).find( '.unit-wrapper .letter-spacing-unit' ).val();
					var device = jQuery( this ).find( '.unit-wrapper .letter-spacing-unit' ).data( 'device' );

					newValue[ 'letter-spacing' ][ device ][ 'unit' ] = unitValue;

				}
			);

			// Extend/Update the `val` object to include `newValue`'s new data as an object.
			jQuery.extend( val, newValue );

			jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
			control.setting.set( val );

		},

	}
);
