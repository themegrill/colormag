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
