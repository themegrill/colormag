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
				this.container.on( 'colormag_settings_changed', control.onOptionChange );

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

						var $this          = $( this ),
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

							if ( is_loaded ) {
								parent_wrap.find( '.colormag-field-settings-modal' ).show();
							} else {

								var fields     = control.params.colormag_fields,
								    modal_wrap = $( ColorMagCustomizerControlGroup.group_modal_tmpl ),
								    device     = $( '#customize-footer-actions .active' ).attr( 'data-device' );

								parent_wrap.find( '.colormag-field-settings-wrap' ).append( modal_wrap );
								parent_wrap.find( '.colormag-fields-wrap' ).attr( 'data-control', control.params.name );
								control.colormag_render_field( parent_wrap, fields, control );
								parent_wrap.find( '.colormag-field-settings-modal' ).show();

								if ( 'mobile' == device ) {
									$( '.control-wrap.mobile' ).addClass( 'active' );
									$( '.responsive-switchers .preview-mobile' ).addClass( 'active' );
								} else if ( 'tablet' == device ) {
									$( '.control-wrap.tablet' ).addClass( 'active' );
									$( '.responsive-switchers .preview-tablet' ).addClass( 'active' );
								} else {
									$( '.control-wrap.desktop' ).addClass( 'active' );
									$( '.responsive-switchers .preview-desktop' ).addClass( 'active' );
								}

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

			},

			colormag_render_field : function ( wrap, fields, control_element ) {

				var control             = this;
				var colormag_field_wrap = wrap.find( '.colormag-fields-wrap' );
				var fields_html         = '';
				var control_types       = [];
				var field_values        = control.isJSONString( control_element.params.value ) ? JSON.parse( control_element.params.value ) : {};

				if ( 'undefined' != typeof fields.tabs ) {

					var counter = 0;
					fields_html += '<div id="' + control_element.params.name + '-tabs" class="colormag-group-tabs">';

					fields_html += '<ul class="colormag-group-list">';
					_.each(
						fields.tabs,
						function ( value, key ) {
							var li_class = '';

							if ( 0 === counter ) {
								li_class = "active";
							}

							fields_html += '<li class="' + li_class + '"><a href="#tab-' + key + '"><span>' + key + '</span></a></li>';
							counter ++;
						}
					);
					fields_html += '</ul>';

					fields_html += '<div class="colormag-tab-content" >';
					_.each(
						fields.tabs,
						function ( fields_data, key ) {

							var result = control.generateFieldHtml( fields_data, field_values );

							fields_html += '<div id="tab-' + key + '" class="tab">';
							fields_html += result.html;

							_.each(
								result.controls,
								function ( control_value, control_key ) {
									control_types.push(
										{
											key   : control_value.key,
											value : control_value.value,
											name  : control_value.name
										}
									);
								}
							);

							fields_html += '</div>';

						}
					);
					fields_html += '</div>';

					fields_html += '</div>';

					colormag_field_wrap.html( fields_html );

					$( '#' + control_element.params.name + '-tabs' ).tabs();

				} else {

					var result = control.generateFieldHtml( fields, field_values );

					fields_html += result.html;

					_.each(
						result.controls,
						function ( control_value, control_key ) {
							control_types.push(
								{
									key   : control_value.key,
									value : control_value.value,
									name  : control_value.name
								}
							);
						}
					);

					colormag_field_wrap.html( fields_html );

				}

				_.each(
					control_types,
					function ( control_type, index ) {

						switch ( control_type.key ) {

							case 'colormag-color':
								control.initColor( colormag_field_wrap, control_element, control_type.name );
								break;

						}

					}
				);

				wrap.find( '.colormag-field-settings-modal' ).data( 'loaded', true );

			},

			isJSONString : function ( string ) {

				try {
					JSON.parse( string );
				} catch ( e ) {
					return false;
				}

				return true;

			},

			generateFieldHtml : function ( fields_data, field_values ) {

				var fields_html   = '';
				var control_types = [];

				_.each(
					fields_data,
					function ( attr, index ) {

						var new_value   = (
							    wp.customize.control( attr.name ) ? wp.customize.control( attr.name ).params.value : ''
						    ),
						    control     = attr.control,
						    template_id = 'customize-control-' + control + '-content',
						    template    = wp.template( template_id ),
						    value       = new_value || attr.default,
						    dataAtts    = '',
						    input_attrs = '';

						attr.value = value;
						attr.title = attr.label;

						// Data attributes.
						_.each(
							attr.data_attrs,
							function ( value, name ) {
								dataAtts += ' data-' + name + ' ="' + value + '"';
							}
						);

						// Input attributes.
						_.each(
							attr.input_attrs,
							function ( value, name ) {
								input_attrs += name + ' ="' + value + '"';
							}
						);

						attr.dataAttrs  = dataAtts;
						attr.inputAttrs = input_attrs;

						control_types.push(
							{
								key   : control,
								value : value,
								name  : attr.name
							}
						);

						fields_html += "<li id='customize-control-" + attr.name + "' class='customize-control customize-control-" + attr.control + "' >";
						fields_html += template( attr );
						fields_html += '</li>';

					}
				);

				var result = new Object();

				result.controls = control_types;
				result.html     = fields_html;

				return result;

			},

			onOptionChange : function ( e, control, element, value, name ) {

				var control_id = $( '.hidden-field-' + name );
				control_id.val( value );

				var sub_control = wp.customize.control( name );
				sub_control.setting.set( value );

			},

			initColor : function ( wrap, control_elem, name ) {

				var control = this;
				var picker  = wrap.find( '.customize-control-colormag-color .colormag-color-picker-alpha' );

				picker.wpColorPicker(
					{
						change : function ( event, ui ) {

							if ( 'undefined' != typeof event.originalEvent || 'undefined' != typeof ui.color._alpha ) {
								var element = $( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[0],
								    name    = $( element ).parents( '.customize-control' ).attr( 'id' ),
								    name    = name.replace( 'customize-control-', '' );

								$( element ).val( ui.color.toString() );

								control.container.trigger(
									'colormag_settings_changed',
									[
										control,
										$( element ),
										ui.color.toString(),
										name
									]
								);
							}

						},

						clear : function ( event ) {

							var element = $( event.target ).closest( '.wp-picker-input-wrap' ).find( '.wp-color-picker' )[0],
							    name    = $( element ).parents( '.customize-control' ).attr( 'id' ),
							    name    = name.replace( 'customize-control-', '' );

							$( element ).val( '' );

							control.container.trigger(
								'colormag_settings_changed',
								[
									control,
									$( element ),
									'',
									name
								]
							);

							wp.customize.previewer.refresh();

						}
					}
				);
			},

		} );

	}
)( jQuery );
