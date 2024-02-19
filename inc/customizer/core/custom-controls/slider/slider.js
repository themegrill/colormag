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
