/**
 * Nesting customize panels and sections.
 */
(
	function ( $ ) {

		var _panelEmbed,
		    _panelIsContextuallyActive,
		    _panelAttachEvents,
		    _sectionEmbed,
		    _sectionIsContextuallyActive,
		    _sectionAttachEvents;

		wp.customize.bind(
			'pane-contents-reflowed',
			function () {
				var panels   = [],
				    sections = [];

				// Reflow sections.
				wp.customize.section.each(
					function ( section ) {
						if (
							'colormag_section' !== section.params.type ||
							'undefined' === typeof section.params.section
						) {
							return;
						}

						sections.push( section );
					}
				);

				sections.sort( wp.customize.utils.prioritySort ).reverse();

				$.each(
					sections,
					function ( i, section ) {
						var parentContainer = $(
							'#sub-accordion-section-' + section.params.section
						);

						parentContainer
							.children( '.section-meta' )
							.after( section.headContainer );
					}
				);

				// Reflow panels.
				wp.customize.panel.each(
					function ( panel ) {
						if (
							'colormag_panel' !== panel.params.type ||
							'undefined' === typeof panel.params.panel
						) {
							return;
						}

						panels.push( panel );
					}
				);

				panels.sort( wp.customize.utils.prioritySort ).reverse();

				$.each(
					panels,
					function ( i, panel ) {
						var parentContainer = $(
							'#sub-accordion-panel-' + panel.params.panel
						);

						parentContainer.children( '.panel-meta' ).after( panel.headContainer );
					}
				);
			}
		);

		// Extend Panel.
		_panelEmbed                = wp.customize.Panel.prototype.embed;
		_panelIsContextuallyActive = wp.customize.Panel.prototype.isContextuallyActive;
		_panelAttachEvents         = wp.customize.Panel.prototype.attachEvents;

		wp.customize.Panel = wp.customize.Panel.extend(
			{
				attachEvents         : function () {
					var panel;

					if (
						'colormag_panel' !== this.params.type ||
						'undefined' === typeof this.params.panel
					) {
						_panelAttachEvents.call( this );

						return;
					}

					_panelAttachEvents.call( this );

					panel = this;

					panel.expanded.bind(
						function ( expanded ) {
							var parent = wp.customize.panel( panel.params.panel );

							if ( expanded ) {
								parent.contentContainer.addClass( 'current-panel-parent' );
							} else {
								parent.contentContainer.removeClass( 'current-panel-parent' );
							}
						}
					);

					panel.container
					     .find( '.customize-panel-back' )
					     .off( 'click keydown' )
					     .on( 'click keydown',
						     function ( event ) {
							     if ( wp.customize.utils.isKeydownButNotEnterEvent( event ) ) {
								     return;
							     }

							     event.preventDefault(); // Keep this AFTER the key filter above.

							     if ( panel.expanded() ) {
								     wp.customize.panel( panel.params.panel ).expand();
							     }
						     }
					     );
				},
				embed                : function () {
					var panel = this,
					    parentContainer;

					if (
						'colormag_panel' !== this.params.type ||
						'undefined' === typeof this.params.panel
					) {
						_panelEmbed.call( this );

						return;
					}

					_panelEmbed.call( this );

					parentContainer = $(
						'#sub-accordion-panel-' + this.params.panel
					);

					parentContainer.append( panel.headContainer );
				},
				isContextuallyActive : function () {
					var panel       = this,
					    children,
					    activeCount = 0;

					if ( 'colormag_panel' !== this.params.type ) {
						return _panelIsContextuallyActive.call( this );
					}

					children = this._children( 'panel', 'section' );

					wp.customize.panel.each(
						function ( child ) {
							if ( ! child.params.panel ) {
								return;
							}

							if ( child.params.panel !== panel.id ) {
								return;
							}

							children.push( child );
						}
					);

					children.sort( wp.customize.utils.prioritySort );

					_( children ).each(
						function ( child ) {
							if ( child.active() && child.isContextuallyActive() ) {
								activeCount += 1;
							}
						}
					);

					return (
						0 !== activeCount
					);
				}
			}
		);

		// Extend Section.
		_sectionEmbed                = wp.customize.Section.prototype.embed;
		_sectionIsContextuallyActive = wp.customize.Section.prototype.isContextuallyActive;
		_sectionAttachEvents         = wp.customize.Section.prototype.attachEvents;

		wp.customize.Section = wp.customize.Section.extend(
			{
				attachEvents         : function () {
					var section = this;

					if (
						'colormag_section' !== this.params.type ||
						'undefined' === typeof this.params.section
					) {
						_sectionAttachEvents.call( section );

						return;
					}

					_sectionAttachEvents.call( section );

					section.expanded.bind(
						function ( expanded ) {
							var parent = wp.customize.section( section.params.section );

							if ( expanded ) {
								parent.contentContainer.addClass( 'current-section-parent' );
							} else {
								parent.contentContainer.removeClass(
									'current-section-parent'
								);
							}
						}
					);

					section.container
					       .find( '.customize-section-back' )
					       .off( 'click keydown' )
					       .on( 'click keydown',
						       function ( event ) {
							       if ( wp.customize.utils.isKeydownButNotEnterEvent( event ) ) {
								       return;
							       }

							       event.preventDefault(); // Keep this AFTER the key filter above.

							       if ( section.expanded() ) {
								       wp.customize.section( section.params.section ).expand();
							       }
						       }
					       );
				},
				embed                : function () {
					var section = this,
					    parentContainer;

					if (
						'colormag_section' !== this.params.type ||
						'undefined' === typeof this.params.section
					) {
						_sectionEmbed.call( section );

						return;
					}

					_sectionEmbed.call( section );

					parentContainer = $(
						'#sub-accordion-section-' + this.params.section
					);

					parentContainer.append( section.headContainer );
				},
				isContextuallyActive : function () {
					var section     = this,
					    children,
					    activeCount = 0;

					if ( 'colormag_section' !== this.params.type ) {
						return _sectionIsContextuallyActive.call( this );
					}

					children = this._children( 'section', 'control' );

					wp.customize.section.each(
						function ( child ) {
							if ( ! child.params.section ) {
								return;
							}

							if ( child.params.section !== section.id ) {
								return;
							}

							children.push( child );
						}
					);

					children.sort( wp.customize.utils.prioritySort );

					_( children ).each(
						function ( child ) {
							if ( 'undefined' !== typeof child.isContextuallyActive ) {
								if ( child.active() && child.isContextuallyActive() ) {
									activeCount += 1;
								}
							} else {
								if ( child.active() ) {
									activeCount += 1;
								}
							}
						}
					);

					return (
						0 !== activeCount
					);
				}
			}
		);
	}
)( jQuery );

/**
 * Description of controls via tooltip.
 */
(
	function ( $ ) {

		wp.customize.bind(
			'ready',
			function () {
				wp.customize.control.each(
					function ( ctrl, i ) {
						var description = ctrl.container.find( '.customize-control-description' );

						if ( description.length ) {
							var title, li_wrapper, tooltip;
							title      = ctrl.container.find( '.customize-control-title' );
							li_wrapper = description.closest( 'li' );
							tooltip    = description.text().replace(
								/[u00A0-u9999<>&]/gim,
								function ( i ) {
									return '&#' + i.charCodeAt( 0 ) + ';';
								}
							);

							// Remove the description from displaying below the controller's label.
							description.remove();

							// Add the help icon in description of customize controls.
							li_wrapper.append( '<i class="colormag-control-tooltip dashicons dashicons-editor-help" title="' + tooltip + '"></i>' );
						}
					}
				);
			}
		);

	}
)( jQuery );

/**
 * Responsive devices mode click event.
 */
jQuery( document ).ready(
	function ( $ ) {

		// Responsive switcher button click.
		$( '.customize-control' ).on(
			'click',
			'.responsive-switchers button',
			function ( event ) {

				// Set up variables.
				var self           = $( this ),
				    devices        = $( '.responsive-switchers' ),
				    device         = $( event.currentTarget ).data( 'device' ),
				    control        = $( '.customize-control.has-responsive-switchers' ),
				    body           = $( '.wp-full-overlay' ),
				    footer_devices = $( '.wp-full-overlay-footer .devices' );

				// Switching the button class.
				devices.find( 'button' ).removeClass( 'active' );
				devices.find( 'button.preview-' + device ).addClass( 'active' );

				// Switching the control class.
				control.find( '.control-wrap' ).removeClass( 'active' );
				control.find( '.control-wrap.' + device ).addClass( 'active' );

				// Switching wrapper class.
				body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + device );

				// Switching panel footer buttons.
				footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
				footer_devices.find( 'button.preview-' + device ).addClass( 'active' ).attr( 'aria-pressed', true );

			}
		);

		// If panel footer buttons clicked.
		$( '.wp-full-overlay-footer .devices' ).on(
			'click',
			'button',
			function ( event ) {

				// Set up variables.
				var self    = $( this ),
				    devices = $( '.customize-control.has-responsive-switchers .responsive-switchers' ),
				    device  = $( event.currentTarget ).data( 'device' ),
				    control = $( '.customize-control.has-responsive-switchers' );

				// Switching the button class.
				devices.find( 'button' ).removeClass( 'active' );
				devices.find( 'button.preview-' + device ).addClass( 'active' );

				// Switching the control class.
				control.find( '.control-wrap' ).removeClass( 'active' );
				control.find( '.control-wrap.' + device ).addClass( 'active' );

			}
		);

	}
);
