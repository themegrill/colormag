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
