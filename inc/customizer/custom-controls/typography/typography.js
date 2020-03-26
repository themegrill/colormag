/**
 * Typography control JS to handle the typography customize option.
 *
 * File `typography.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor['colormag-typography'] = wp.customize.Control.extend( {

	ready : function () {

		'use strict';

		var control = this;

		// On customizer load, render the available font options.
		control.renderFontSelector();
		control.renderVariantSelector();

	},

	renderFontSelector : function () {

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
							id   : font.family.replace( /&quot;/g, '&#39' ),
							text : font.label
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
							id   : font.family,
							text : font.label
						}
					);
				}
			);
		}

		// Combine fonts and build the final data.
		data = [
			{
				text     : fonts.standardfontslabel,
				children : standardFonts
			},
			{
				text     : fonts.googlefontslabel,
				children : googleFonts
			}
		];

		// Format custom fonts as an array.
		if ( ! _.isUndefined( fonts.custom ) ) {
			_.each(
				fonts.custom,
				function ( font ) {
					customFonts.push(
						{
							id   : font.family,
							text : font.label
						}
					);
				}
			);

			// Merge on `data` array.
			data.push(
				{
					text     : fonts.customfontslabel,
					children : customFonts
				}
			);
		}

		// Instantiate selectWoo with the data.
		fontSelect = jQuery( selector ).selectWoo(
			{
				data  : data,
				width : '100%'
			}
		);

		// Set the initial value.
		if ( value['font-family'] ) {
			fontSelect.val( value['font-family'].replace( /'/g, '"' ) ).trigger( 'change' );
		}

		// When the font option value changes.
		fontSelect.on(
			'change',
			function () {

				// Set the value.
				control.saveValue( 'font-family', jQuery( this ).val() );

				// Render new list of selected font options.
				control.renderVariantSelector();

			}
		);

	},

	getFonts : function () {

		var control = this;

		if ( ! _.isUndefined( ColorMagCustomizerControlTypography ) ) {
			return ColorMagCustomizerControlTypography;
		}

		return {
			google   : [],
			standard : []
		};

	},

	renderVariantSelector : function () {

		var control    = this,
		    value      = control.setting._value,
		    fontFamily = value['font-family'],
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
					if ( value['font-weight'] === variant.id ) {
						isValid = true;
					}

					data.push(
						{
							id   : variant.id,
							text : variant.label
						}
					);
				}
			);

			if ( ! isValid ) {
				value['font-weight'] = 'regular';
			}

			if ( jQuery( selector ).hasClass( 'select2-hidden-accessible' ) ) {
				jQuery( selector ).selectWoo( 'destroy' );
				jQuery( selector ).empty();
			}

			// Instantiate selectWoo with the data.
			variantSelector = jQuery( selector ).selectWoo(
				{
					data  : data,
					width : '100%'
				}
			);

			variantSelector.val( value['font-weight'] ).trigger( 'change' );
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

	getVariants : function ( fontFamily ) {
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

	saveValue : function ( property, value ) {

		var control = this,
		    input   = control.container.find( '.typography-hidden-value' ),
		    val     = control.setting._value;

		val[property] = value;

		jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
		control.setting.set( val );

	}

} );
