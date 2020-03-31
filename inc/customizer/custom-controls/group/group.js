/**
 * Group control JS to handle the group customize option.
 *
 * File `group.js`.
 *
 * @package ColorMag
 */
(
	function ( $ ) {

		wp.customize.controlConstructor['colormag-group'] = wp.customize.Control.extend( {

			ready : function () {

				'use strict';

				var control = this;

				control.registerToggleEvents();

			},

			registerToggleEvents : function () {

				var control = this;

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

						var $this          = jQuery( this ),
						    parent_wrap    = $this.closest( '.customize-control-colormag-group' ),
						    is_loaded      = parent_wrap.find( '.colormag-field-settings-modal' ).data( 'loaded' ),
						    parent_section = parent_wrap.parents( '.control-section' );

						if ( $this.hasClass( 'open' ) ) {
							parent_wrap.find( '.colormag-field-settings-modal' ).hide();
						} else {

							/* Close popup when another popup is clicked */
							var get_open_popup = parent_section.find( '.colormag-group-toggle-icon.open' );
							if ( get_open_popup.length > 0 ) {
								get_open_popup.trigger( 'click' );
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

			}

		} );

	}
)( jQuery );
