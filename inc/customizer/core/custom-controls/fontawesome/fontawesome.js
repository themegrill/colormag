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
