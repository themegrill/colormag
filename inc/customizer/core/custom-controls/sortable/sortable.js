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
				// Enable/disable options when we click on the eye of Thundera.
				jQuery( this ).find( 'i.visibility' ).click(
					function () {
						jQuery( this ).toggleClass( 'dashicons-visibility-faint' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
					}
				);
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
				jQuery( this ).find( 'i.visibility' ).click(
					function () {
						jQuery( this ).toggleClass( 'dashicons-visibility-faint' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
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

