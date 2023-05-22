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
