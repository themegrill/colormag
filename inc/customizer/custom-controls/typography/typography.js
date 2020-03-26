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

	saveValue : function ( property, value ) {

		var control = this,
		    input   = control.container.find( '.typography-hidden-value' ),
		    val     = control.setting._value;

		val[property] = value;

		jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
		control.setting.set( val );

	}

} );
