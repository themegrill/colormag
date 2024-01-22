/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/**
 *
 * @param {string} controlId
 * @param {string} selector
 * @param {string||array} cssProperty
 * @param {null} unit
 */
function colormagGenerateCSS( controlId, selector, cssProperty, unit = null ) {

	wp.customize( controlId, function( value ) {

		value.bind( function ( newValue ) {
			var cssText = '';

			jQuery( `style#${controlId}` ).remove();

			if ( null !== unit ) {

				if ( Array.isArray( cssProperty ) ) {

					cssProperty.forEach( function ( property ) {
						cssText += `${ property } : ${ newValue + unit };`;
					} );
				} else {
					cssText += `${ cssProperty } :  ${ newValue + unit };`;
				}
			} else {
				cssText += `${ cssProperty }: ${ newValue };`;
			}

			jQuery( 'head' ).append( `<style id="${ controlId }">${ selector }{ ${ cssText } }</style>` );
		} );
	} );
}

/**
 * Control that returns either true or false.
 *
 * @param {string} controlId
 * @param {string} selector
 * @param {string} classes
 * @param {boolean} removeOnTrue
 */
function colormagAddRemoveCSSClasses(  controlId, selector, classes, removeOnTrue = false  ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( newValue ) {

			if ( removeOnTrue ) {

				if ( newValue ) {
					jQuery( selector ).removeClass( classes );
				} else {
					jQuery( selector ).addClass( classes );
				}
			} else {

				if ( newValue ) {
					jQuery( selector ).addClass( classes );
				} else {
					jQuery( selector ).removeClass( classes );
				}
			}
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 */
function colormagGenerateDimensionCSS( controlId, selector, cssProperty  ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( dimension ) {
			var topCSS = ( '' !== dimension.top ) ? dimension.top : 0,
				rightCSS = ( '' !== dimension.right ) ? dimension.right : 0,
				bottomCSS = ( '' !== dimension.bottom ) ? dimension.bottom : 0,
				leftCSS = ( '' !== dimension.left ) ? dimension.left : 0,
				unit = ( '' !== dimension.unit ) ? dimension.unit : 'px';

			jQuery( `style#${controlId}` ).remove();

			jQuery( 'head' ).append(
				`<style id="${ controlId }">${selector}{ ${ cssProperty } : ${ topCSS + unit + ' ' + rightCSS + unit + ' ' + bottomCSS + unit + ' ' + leftCSS + unit } }</style>`
			);
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 */
function colormagGenerateSliderCSS( controlId, selector, cssProperty  ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( slider ) {
			var sizeCSS = ( '' !== slider.size ) ? slider.size : 0;
			var unit = ( '' !== slider.unit ) ? slider.unit : 'px';

			jQuery( `style#${controlId}` ).remove();

			jQuery( 'head' ).append(
				`<style id="${ controlId }">${selector}{ ${ cssProperty } : ${ sizeCSS + unit  } }</style>`
			);
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 */
function colormagGenerateBackgroundCSS( controlId, selector ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( background ) {
			var css;

			jQuery( 'style#' + controlId ).remove();

			css = `${selector}{background-color: ${background['background-color']};background-image: url( ${background['background-image']} );background-attachment: ${background['background-attachment']};background-position: ${background['background-position']};background-size: ${background['background-size']};background-repeat: ${background['background-repeat']};}`;

			jQuery( 'head' ).append( `<style id="${ controlId }">${ css }</style>` );
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 */
function colormagGenerateTypographyCSS( controlId, selector ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( typography ) {
			var	link              = '',
				fontFamily        = '',
				fontWeight        = '',
				fontStyle         = '',
				fontTransform     = '',
				desktopFontSize   = '',
				tabletFontSize    = '',
				mobileFontSize    = '',
				desktopLineHeight = '',
				tabletLineHeight  = '',
				mobileLineHeight  = '',
				desktopLetterSpacing = '',
				tabletLetterSpacing  = '',
				mobileLetterSpacing  = '';

			if ( 'object' == typeof typography ) {

				if ( undefined !== typography['font-size'] ) {

					if ( undefined !== typography['font-size']['desktop']['size'] && '' !== typography['font-size']['desktop']['size'] ) {
						desktopFontSize = typography['font-size']['desktop']['size'] + typography['font-size']['desktop']['unit'];
					}

					if ( undefined !== typography['font-size']['tablet']['size'] && '' !== typography['font-size']['tablet']['size'] ) {
						tabletFontSize = typography['font-size']['tablet']['size'] + typography['font-size']['tablet']['unit'];
					}

					if ( undefined !== typography['font-size']['mobile']['size'] && '' !== typography['font-size']['mobile']['size'] ) {
						mobileFontSize = typography['font-size']['mobile']['size'] + typography['font-size']['mobile']['unit'];
					}
				}

				if ( undefined !== typography['line-height'] ) {

					if ( undefined !== typography['line-height']['desktop']['size'] && '' !== typography['line-height']['desktop']['size'] ) {
						const desktopLineHeightUnit = ('-' !== typography['line-height']['desktop']['unit']) ? typography['line-height']['desktop']['unit'] : '';
						desktopLineHeight = typography['line-height']['desktop']['size'] + desktopLineHeightUnit;
					}

					if ( undefined !== typography['line-height']['tablet']['size'] && '' !== typography['line-height']['tablet']['size'] ) {
						const tabletLineHeightUnit = ('-' !== typography['line-height']['tablet']['unit']) ? typography['line-height']['tablet']['unit'] : '';
						tabletLineHeight = typography['line-height']['tablet']['size'] + tabletLineHeightUnit;
					}

					if ( undefined !== typography['line-height']['mobile']['size'] && '' !== typography['line-height']['mobile']['size'] ) {
						const mobileLineHeightUnit = ('-' !== typography['line-height']['mobile']['unit']) ? typography['line-height']['mobile']['unit'] : '';
						mobileLineHeight = typography['line-height']['mobile']['size'] + mobileLineHeightUnit;
					}
				}

				if ( undefined !== typography['letter-spacing'] ) {

					if ( undefined !== typography['letter-spacing']['desktop']['size'] && '' !== typography['letter-spacing']['desktop']['size'] ) {
						const desktopLetterSpacingUnit = ('-' !== typography['letter-spacing']['desktop']['unit']) ? typography['letter-spacing']['desktop']['unit'] : '';
						desktopLetterSpacing           = typography['letter-spacing']['desktop']['size'] + desktopLetterSpacingUnit;
					}

					if ( undefined !== typography['letter-spacing']['tablet']['size'] && '' !== typography['letter-spacing']['tablet']['size'] ) {
						const tabletLetterSpacingUnit = ('-' !== typography['letter-spacing']['tablet']['unit']) ? typography['letter-spacing']['tablet']['unit'] : '';
						tabletLetterSpacing           = typography['letter-spacing']['tablet']['size'] + tabletLetterSpacingUnit;
					}

					if ( undefined !== typography['letter-spacing']['mobile']['size'] && '' !== typography['letter-spacing']['mobile']['size'] ) {
						const mobileLetterSpacingUnit = ('-' !== typography['letter-spacing']['mobile']['unit']) ? typography['letter-spacing']['mobile']['unit'] : '';
						mobileLetterSpacing           = typography['letter-spacing']['mobile']['size'] + mobileLetterSpacingUnit;
					}
				}

				if ( undefined !== typography['font-family'] && '' !== typography['font-family'] ) {
					fontFamily = typography['font-family'].split(",")[0];
					fontFamily = fontFamily.replace(/'/g, '');

					if ( fontFamily.includes( 'default' ) || fontFamily.includes( '-apple-system' )  ) {
						fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
					} else if ( fontFamily.includes( 'Monaco' ) ) {
						fontFamily = 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace';
					} else {
						link = `<link id="${ controlId }" href="https://fonts.googleapis.com/css?family=${ fontFamily }" rel="stylesheet">`;
					}
				}

				if ( undefined !== typography['font-weight'] && '' !== typography['font-weight'] ) {

					if ( colormagIsNumeric( typography['font-weight'] ) ) {
						fontWeight = parseInt( typography['font-weight'] );
					} else {
						fontWeight = 'regular' != typography['font-weight'] ? typography['font-weight'] : 'normal';
					}
				}

				if ( undefined !== typography['font-style'] && '' !== typography['font-style'] ) {
					fontStyle = typography['font-style'];
				}

				if ( undefined !== typography['text-transform'] && '' !== typography['text-transform'] ) {
					fontTransform = typography['text-transform'];
				}

				jQuery( 'style#' + controlId ).remove();
				jQuery('link#' + controlId).remove();

				jQuery('head').append(
					`<style id="${ controlId }">
					${ selector } {
						font-family: ${ fontFamily };
						font-weight: ${ fontWeight };
						font-style: ${ fontStyle };
						text-transform: ${ fontTransform };
						font-size: ${ desktopFontSize };
						line-height: ${ desktopLineHeight };
						letter-spacing: ${ desktopLetterSpacing };
					}
					@media (max-width: 768px) {
						${ selector } {
							font-size: ${ tabletFontSize };
							line-height: ${ tabletLineHeight };
							letter-spacing: ${ tabletLetterSpacing };
						}
					}
					@media (max-width: 600px) {
						${ selector }{
							font-size: ${ mobileFontSize };
							line-height:${ mobileLineHeight };
							letter-spacing: ${ mobileLetterSpacing };
						}
					}
				</style>${ link }`
				);
			}
		} );
	} );
}

/**
 * @param {string} str
 * @returns {boolean}
 */
function colormagIsNumeric( str ) {
	var matches;

	if ( 'string' !== typeof str ) {
		return false;
	}

	matches = str.match(/\d+/g);

	return null !== matches;
}

( function ( $ ) {

	// Site title.
	wp.customize(
		'blogname',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-title a' ).text( to );
				}
			);
		}
	);

	// Site description.
	wp.customize(
		'blogdescription',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-description' ).text( to );
				}
			);
		}
	);

	// Header display type.
	wp.customize(
		'colormag_header_display_type',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'type_two' ) {
						$( 'body' ).removeClass( 'header_display_type_two' ).addClass( 'header_display_type_one' );
					} else if ( display_type === 'type_three' ) {
						$( 'body' ).removeClass( 'header_display_type_one' ).addClass( 'header_display_type_two' );
					} else if ( display_type === 'type_one' ) {
						$( 'body' ).removeClass( 'header_display_type_one header_display_type_two' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'colormag_site_layout',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var site_layout = layout;

					if ( 'wide_layout' === site_layout ) {
						$( 'body' ).removeClass( 'box-layout' ).addClass( 'wide' );
					} else if ( 'boxed_layout' === site_layout ) {
						$( 'body' ).removeClass( 'wide' ).addClass( 'box-layout' );
					}
				}
			);
		}
	);

	// Footer copyright alignment.
	wp.customize(
		'colormag_footer_copyright_alignment_setting',
		function ( value ) {
			value.bind(
				function ( alignment ) {
					var alignment_type = alignment;

					if ( alignment_type === 'left' ) {
						$( '#colophon' ).removeClass( 'copyright-right copyright-center' );
					} else if ( alignment_type === 'right' ) {
						$( '#colophon' ).removeClass( 'copyright-center' ).addClass( 'copyright-right' );
					} else if ( alignment_type === 'center' ) {
						$( '#colophon' ).removeClass( 'copyright-right' ).addClass( 'copyright-center' );
					}
				}
			);
		}
	);

	// Footer Main Area Display Type.
	wp.customize(
		'colormag_main_footer_layout_display_type',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'layout-2' ) {
						$( '#colophon' ).removeClass( 'colormag-footer--classic-bordered' ).addClass( 'colormag-footer--classic' );
					} else if ( display_type === 'layout-1' ) {
						$( '#colophon' ).removeClass( 'colormag-footer--classic colormag-footer--classic-bordered' );
					}
				}
			);
		}
	);

} )( jQuery );
