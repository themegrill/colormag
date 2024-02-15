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
