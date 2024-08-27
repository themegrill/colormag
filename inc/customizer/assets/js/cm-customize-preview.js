// /**
//  * @param {string} controlId
//  * @param {string} selector
//  * @param {string} cssProperty
//  *
//  */
//
// colormagGenerateCSS( 'colormag_site_title_color', '.cm-site-title a', 'color' );
// colormagGenerateCSS( 'colormag_site_title_hover_color', '.cm-site-title a:hover', 'color' );
// colormagGenerateCSS( 'colormag_site_tagline_color', '.cm-site-description', 'color' );
// colormagGenerateTypographyCSS( 'colormag_base_typography', 'body, button, input, select, textarea, blockquote p, .entry-meta, .more-link, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, .cm-secondary .widget, .error-404 .widget, .cm-entry-summary p' );
// colormagGenerateTypographyCSS( 'colormag_headings_typography', 'h1, h2, h3 ,h4, h5, h6' );
// colormagGenerateTypographyCSS( 'colormag_h1_typography', 'h1' );
// colormagGenerateTypographyCSS( 'colormag_h2_typography', 'h2' );
// colormagGenerateTypographyCSS( 'colormag_h3_typography', 'h3' );
// colormagGenerateTypographyCSS( 'colormag_h4_typography', 'h4' );
// colormagGenerateTypographyCSS( 'colormag_h5_typography', 'h5' );
// colormagGenerateTypographyCSS( 'colormag_h6_typography', 'h6' );
// colormagGenerateTypographyCSS( 'colormag_blog_post_title_typography', '.cm-entry-title' );
// colormagGenerateTypographyCSS( 'colormag_site_title_typography', '.cm-site-title' );
// colormagGenerateTypographyCSS( 'colormag_site_tagline_typography', '.cm-site-description' );
// colormagGenerateTypographyCSS( 'colormag_primary_menu_typography', '.cm-primary-nav ul li a' );
// colormagGenerateTypographyCSS( 'colormag_primary_sub_menu_typography', '.cm-primary-nav ul li ul li a' );
// colormagGenerateSliderCSS( 'colormag_primary_menu_top_border_width', '#cm-primary-nav', 'border-top-width' );
// colormagGenerateCSS( 'colormag_button_color', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span, .wp-block-button__link', 'color' );
// colormagGenerateCSS( 'colormag_button_hover_color', '.cm-entry-button span:hover,.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .more-link span:hover, .wp-block-button__link:hover', 'color' );
// colormagGenerateCSS( 'colormag_button_background_color', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link, .wp-block-button__link', 'background-color' );
// colormagGenerateCSS( 'colormag_button_background_hover_color', '.cm-entry-button span:hover,.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .more-link:hover, .wp-block-button__link:hover', 'background-color' );
// colormagGenerateDimensionCSS( 'colormag_button_dimension_padding', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'padding' );
// colormagGenerateSliderCSS( 'colormag_button_border_radius', '.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link', 'border-radius' );
// colormagGenerateSliderWidthCss( 'colormag_sidebar_width', '.cm-secondary', '.cm-primary', 'width' );
//
// ( function ( $ ) {
//
// 	// Site title.
// 	wp.customize(
// 		'blogname',
// 		function ( value ) {
// 			value.bind(
// 				function ( to ) {
// 					$( '#site-title a' ).text( to );
// 				}
// 			);
// 		}
// 	);
//
// 	// Site description.
// 	wp.customize(
// 		'blogdescription',
// 		function ( value ) {
// 			value.bind(
// 				function ( to ) {
// 					$( '#site-description' ).text( to );
// 				}
// 			);
// 		}
// 	);
//
// 	// Header display type.
// 	wp.customize(
// 		'colormag_header_display_type',
// 		function ( value ) {
// 			value.bind(
// 				function ( layout ) {
// 					var display_type = layout;
//
// 					if ( display_type === 'type_two' ) {
// 						$( 'body' ).removeClass( 'header_display_type_two' ).addClass( 'header_display_type_one' );
// 					} else if ( display_type === 'type_three' ) {
// 						$( 'body' ).removeClass( 'header_display_type_one' ).addClass( 'header_display_type_two' );
// 					} else if ( display_type === 'type_one' ) {
// 						$( 'body' ).removeClass( 'header_display_type_one header_display_type_two' );
// 					}
// 				}
// 			);
// 		}
// 	);
//
// 	// Site Layout Option.
// 	wp.customize(
// 		'colormag_container_layout',
// 		function ( value ) {
// 			value.bind(
// 				function ( layout ) {
// 					var site_layout = layout;
//
// 					if ( 'wide' === site_layout ) {
// 						$( 'body' ).removeClass( 'boxed' ).addClass( 'wide' );
// 					} else if ( 'boxed' === site_layout ) {
// 						$( 'body' ).removeClass( 'wide' ).addClass( 'boxed' );
// 					}
// 				}
// 			);
// 		}
// 	);
//
// 	// Footer copyright alignment.
// 	wp.customize(
// 		'colormag_footer_bar_alignment',
// 		function ( value ) {
// 			value.bind(
// 				function ( alignment ) {
// 					var alignment_type = alignment;
//
// 					if ( alignment_type === 'left' ) {
// 						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-2 cm-footer-bar-style-3' ).addClass( 'cm-footer-bar-style-1' );
// 					} else if ( alignment_type === 'right' ) {
// 						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-1 cm-footer-bar-style-3' ).addClass( 'cm-footer-bar-style-2' );
// 					} else if ( alignment_type === 'center' ) {
// 						$( '.cm-footer-bar' ).removeClass( 'cm-footer-bar-style-1 cm-footer-bar-style-2' ).addClass( 'cm-footer-bar-style-3' );
// 					}
// 				}
// 			);
// 		}
// 	);
//
// 	// Footer Main Area Display Type.
// 	wp.customize(
// 		'colormag_main_footer_layout',
// 		function ( value ) {
// 			value.bind(
// 				function ( layout ) {
// 					var display_type = layout;
//
// 					if ( display_type === 'layout-2' ) {
// 						$( '#cm-footer' ).removeClass( 'colormag-footer--classic-bordered' ).addClass( 'colormag-footer--classic' );
// 					} else if ( display_type === 'layout-3' ) {
// 						$( '#cm-footer' ).removeClass( 'colormag-footer--classic' ).addClass( 'colormag-footer--classic-bordered' );
// 					} else if ( display_type === 'layout-1' ) {
// 						$( '#cm-footer' ).removeClass( 'colormag-footer--classic colormag-footer--classic-bordered' );
// 					}
// 				}
// 			);
// 		}
// 	);
//
// } )( jQuery );

(function ($) {
	function colormagColorPalette(v, to) {
		let styles = "";
		Object.entries(to.colors).forEach(([k, v]) => {
			styles += `--${k}:${v};`;
		});
		v = `:root {${styles}}`;
		return v;
	}

	function colormagGenerateCommonCSS(selector, property, value) {
		return `${selector} {${property}:${value};}`;
	}

	function colormagGenerateSlidebarWidthCSS(
		selector,
		secondarySelector,
		property,
		value,
	) {
		let sidebarCss = value.size;
		let primaryCss = 100 - value.size;
		let css = "";
		css = `${selector} {${property}: ${sidebarCss}${value.unit};}`;
		css += `${secondarySelector} {${property}: ${primaryCss}${value.unit};}`;

		return css;
	}

	function colormagGenerateSliderCSS(selector, property, value) {
		return `${selector} {${property}: ${value.size}${value.unit};}`;
	}

	function colormagGenerateBackgroundCSS(selector, value) {
		let backgroundColor = value["background-color"],
			backgroundImage = value["background-image"],
			backgroundAttachment = value["background-attachment"],
			backgroundPosition = value["background-position"],
			backgroundSize = value["background-size"],
			backgroundRepeat = value["background-repeat"];

		return `${selector}{background-color: ${backgroundColor};background-image: url( ${backgroundImage} );background-attachment: ${backgroundAttachment};background-position: ${backgroundPosition};background-size: ${backgroundSize};background-repeat: ${backgroundRepeat};}`;
	}

	/**
	 * @param {string} str
	 * @returns {boolean}
	 */
	function colormagIsNumeric(str) {
		var matches;

		if ("string" !== typeof str) {
			return false;
		}

		matches = str.match(/\d+/g);

		return null !== matches;
	}

	function colormagGenerateTypographyCSS(controlId, selector, typography) {
		let css = "";
		var link = "",
			fontFamily = "",
			fontWeight = "",
			fontStyle = "",
			fontTransform = "",
			desktopFontSize = "",
			tabletFontSize = "",
			mobileFontSize = "",
			desktopLineHeight = "",
			tabletLineHeight = "",
			mobileLineHeight = "",
			desktopLetterSpacing = "",
			tabletLetterSpacing = "",
			mobileLetterSpacing = "";

		if ("object" == typeof typography) {
			if (undefined !== typography["font-size"]) {
				if (
					undefined !== typography["font-size"]["desktop"]["size"] &&
					"" !== typography["font-size"]["desktop"]["size"]
				) {
					desktopFontSize =
						typography["font-size"]["desktop"]["size"] +
						typography["font-size"]["desktop"]["unit"];
				}

				if (
					undefined !== typography["font-size"]["tablet"]["size"] &&
					"" !== typography["font-size"]["tablet"]["size"]
				) {
					tabletFontSize =
						typography["font-size"]["tablet"]["size"] +
						typography["font-size"]["tablet"]["unit"];
				}

				if (
					undefined !== typography["font-size"]["mobile"]["size"] &&
					"" !== typography["font-size"]["mobile"]["size"]
				) {
					mobileFontSize =
						typography["font-size"]["mobile"]["size"] +
						typography["font-size"]["mobile"]["unit"];
				}
			}

			if (undefined !== typography["line-height"]) {
				if (
					undefined !== typography["line-height"]["desktop"]["size"] &&
					"" !== typography["line-height"]["desktop"]["size"]
				) {
					const desktopLineHeightUnit =
						"-" !== typography["line-height"]["desktop"]["unit"]
							? typography["line-height"]["desktop"]["unit"]
							: "";
					desktopLineHeight =
						typography["line-height"]["desktop"]["size"] +
						desktopLineHeightUnit;
				}

				if (
					undefined !== typography["line-height"]["tablet"]["size"] &&
					"" !== typography["line-height"]["tablet"]["size"]
				) {
					const tabletLineHeightUnit =
						"-" !== typography["line-height"]["tablet"]["unit"]
							? typography["line-height"]["tablet"]["unit"]
							: "";
					tabletLineHeight =
						typography["line-height"]["tablet"]["size"] + tabletLineHeightUnit;
				}

				if (
					undefined !== typography["line-height"]["mobile"]["size"] &&
					"" !== typography["line-height"]["mobile"]["size"]
				) {
					const mobileLineHeightUnit =
						"-" !== typography["line-height"]["mobile"]["unit"]
							? typography["line-height"]["mobile"]["unit"]
							: "";
					mobileLineHeight =
						typography["line-height"]["mobile"]["size"] + mobileLineHeightUnit;
				}
			}

			if (undefined !== typography["letter-spacing"]) {
				if (
					undefined !== typography["letter-spacing"]["desktop"]["size"] &&
					"" !== typography["letter-spacing"]["desktop"]["size"]
				) {
					const desktopLetterSpacingUnit =
						"-" !== typography["letter-spacing"]["desktop"]["unit"]
							? typography["letter-spacing"]["desktop"]["unit"]
							: "";
					desktopLetterSpacing =
						typography["letter-spacing"]["desktop"]["size"] +
						desktopLetterSpacingUnit;
				}

				if (
					undefined !== typography["letter-spacing"]["tablet"]["size"] &&
					"" !== typography["letter-spacing"]["tablet"]["size"]
				) {
					const tabletLetterSpacingUnit =
						"-" !== typography["letter-spacing"]["tablet"]["unit"]
							? typography["letter-spacing"]["tablet"]["unit"]
							: "";
					tabletLetterSpacing =
						typography["letter-spacing"]["tablet"]["size"] +
						tabletLetterSpacingUnit;
				}

				if (
					undefined !== typography["letter-spacing"]["mobile"]["size"] &&
					"" !== typography["letter-spacing"]["mobile"]["size"]
				) {
					const mobileLetterSpacingUnit =
						"-" !== typography["letter-spacing"]["mobile"]["unit"]
							? typography["letter-spacing"]["mobile"]["unit"]
							: "";
					mobileLetterSpacing =
						typography["letter-spacing"]["mobile"]["size"] +
						mobileLetterSpacingUnit;
				}
			}

			if (
				undefined !== typography["font-family"] &&
				"" !== typography["font-family"]
			) {
				fontFamily = typography["font-family"].split(",")[0];
				fontFamily = fontFamily.replace(/'/g, "");

				if (
					fontFamily.includes("default") ||
					fontFamily.includes("-apple-system")
				) {
					fontFamily =
						'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
				} else if (fontFamily.includes("Monaco")) {
					fontFamily =
						'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace';
				} else {
					link = `<link id="${controlId}" href="https://fonts.googleapis.com/css?family=${fontFamily}" rel="stylesheet">`;
				}
			}

			if (
				undefined !== typography["font-weight"] &&
				"" !== typography["font-weight"]
			) {
				if (colormagIsNumeric(typography["font-weight"])) {
					fontWeight = parseInt(typography["font-weight"]);
				} else {
					fontWeight =
						"regular" != typography["font-weight"]
							? typography["font-weight"]
							: "normal";
				}
			}

			if (
				undefined !== typography["font-style"] &&
				"" !== typography["font-style"]
			) {
				fontStyle = typography["font-style"];
			}

			if (
				undefined !== typography["text-transform"] &&
				"" !== typography["text-transform"]
			) {
				fontTransform = typography["text-transform"];
			}

			jQuery("link#" + controlId).remove();

			css = `${selector} {
						font-family: ${fontFamily};
						font-weight: ${fontWeight};
						font-style: ${fontStyle};
						text-transform: ${fontTransform};
						font-size: ${desktopFontSize};
						line-height: ${desktopLineHeight};
						letter-spacing: ${desktopLetterSpacing};
					}`;

			css += `@media (max-width: 768px) {
						${selector} {
							font-size: ${tabletFontSize};
							line-height: ${tabletLineHeight};
							letter-spacing: ${tabletLetterSpacing};
						}
					}`;

			css += `@media (max-width: 600px) {
						${selector}{
							font-size: ${mobileFontSize};
							line-height:${mobileLineHeight};
							letter-spacing: ${mobileLetterSpacing};
						}
					}`;

			jQuery("head").append(link);

			return css;
		}

		return css;
	}

	function colormagGenerateDimnesionCSS(selector, property, value) {
		let topCSS = value.top ? value.top : 0,
			rightCSS = value.right ? value.right : 0,
			bottomCSS = value.bottom ? value.bottom : 0,
			leftCSS = value.left ? value.left : 0,
			unit = value.unit ? value.unit : "px";

		return `${selector}{ ${property} : ${topCSS + unit + " " + rightCSS + unit + " " + bottomCSS + unit + " " + leftCSS + unit}}`;
	}

	wp.hooks.addFilter(
		"customind.dynamic.css",
		"customind",
		function (css, value, id) {
			switch (id) {
				case "colormag_color_palette":
					css = colormagColorPalette(css, value);
					break;
				case "colormag_base_color":
					css = colormagGenerateCommonCSS(
						"body",
						"color",
						value,
					);
					break;

				case "colormag_box_shadow_color":
					css = colormagGenerateCommonCSS(
						".cm-posts .post",
						"box-shadow",
						value,
					);
					break;

				case "colormag_link_color":
					css = colormagGenerateCommonCSS(".cm-entry-summary a", "color", value);
					break;

				case "colormag_link_hover_color":
					css = colormagGenerateCommonCSS(
						`.cm-entry-summary a:hover, .pagebuilder-content a:hover, .pagebuilder-content a:hover`,
						"color",
						value,
					);
					break;

				case "colormag_inside_container_background":
					css = colormagGenerateBackgroundCSS(".cm-content", value);
					break;

				case "colormag_outside_container_background":
					css = colormagGenerateBackgroundCSS("body", value);
					break;

				case "colormag_base_typography":
					css = colormagGenerateTypographyCSS(id, `body, button, input, select, textarea, blockquote p, .entry-meta, .cm-entry-button, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, .cm-secondary .widget, .cm-error-404 .widget, .cm-entry-summary p`, value);
					break;

				case "colormag_headings_typography":
					css = colormagGenerateTypographyCSS(id, "h1, h2, h3, h4, h5, h6", value);
					break;

				case "colormag_h1_typography":
					css = colormagGenerateTypographyCSS(id, "h1", value);
					break;

				case "colormag_h2_typography":
					css = colormagGenerateTypographyCSS(id, "h2", value);
					break;

				case "colormag_h3_typography":
					css = colormagGenerateTypographyCSS(id, "h3", value);
					break;

				case "colormag_h4_typography":
					css = colormagGenerateTypographyCSS(id, "h4", value);
					break;

				case "colormag_h5_typography":
					css = colormagGenerateTypographyCSS(id, "h5", value);
					break;

				case "colormag_h6_typography":
					css = colormagGenerateTypographyCSS(id, "h6", value);
					break;

				case "colormag_button_color":
					css = colormagGenerateCommonCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						"color",
						value,
					);
					break;

				case "colormag_button_hover_color":
					css = colormagGenerateCommonCSS(
						`.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .cm-entry-button span:hover, .wp-block-button .wp-block-button__link:hover`,
						"color",
						value,
					);
					break;

				case "colormag_button_background_color":
					css = colormagGenerateCommonCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						"background-color",
						value,
					);
					break;

				case "colormag_button_background_hover_color":
					css = colormagGenerateCommonCSS(
						`.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .cm-entry-button span:hover, .wp-block-button .wp-block-button__link:hover`,
						"background-color",
						value,
					);
					break;

				case "colormag_button_dimension_padding":
					css = colormagGenerateDimnesionCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						"padding",
						value,
					);
					break;

				case "colormag_button_border_radius":
					css = colormagGenerateSliderCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						"border-radius",
						value,
					);
					break;

				case "colormag_top_bar_background_color":
					css = colormagGenerateCommonCSS(
						`.cm-top-bar`,
						"background-color",
						value,
					);
					break;

				case "colormag_main_header_background":
					css = colormagGenerateBackgroundCSS(
						".cm-header-1, .dark-skin .cm-header-1",
						value,
					);
					break;

					case "colormag_primary_menu_background":
					css = colormagGenerateBackgroundCSS(
						".cm-mobile-nav li, #cm-primary-nav, .cm-layout-2 #cm-primary-nav, .cm-header .cm-main-header .cm-primary-nav .cm-row, .cm-home-icon.front_page_on",
						value,
					);
					break;

				case "colormag_primary_menu_top_border_width":
					css = colormagGenerateSliderCSS(
						"#cm-primary-nav",
						"border-top-width",
						value,
					);
					break;

				case "colormag_primary_menu_top_border_color":
					css = colormagGenerateCommonCSS(
						"#cm-primary-nav",
						"border-top-color",
						value,
					);
					break;

				case "colormag_primary_menu_text_color":
					css = colormagGenerateCommonCSS(
						`.cm-primary-nav a, .cm-primary-nav ul li ul li a, .cm-primary-nav ul li.current-menu-item ul li a, .cm-primary-nav ul li ul li.current-menu-item a, .cm-primary-nav ul li.current_page_ancestor ul li a, .cm-primary-nav ul li.current-menu-ancestor ul li a, .cm-primary-nav ul li.current_page_item ul li a, .cm-primary-nav li.menu-item-has-children>a::after, .cm-primary-nav li.page_item_has_children>a::after, .cm-layout-2-style-1 .cm-primary-nav a, .cm-layout-2-style-1 .cm-primary-nav ul > li > a`,
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-primary-nav .cm-submenu-toggle .cm-icon, .cm-primary-nav .cm-submenu-toggle .cm-icon`,
						"fill",
						value,
					);
					break;

				case "colormag_primary_menu_selected_hovered_text_color":
					css = colormagGenerateCommonCSS(
						`.cm-primary-nav a:hover, .cm-primary-nav ul li.current-menu-item a, .cm-primary-nav ul li ul li.current-menu-item a, .cm-primary-nav ul li.current_page_ancestor a, .cm-primary-nav ul li.current-menu-ancestor a, .cm-primary-nav ul li.current_page_item a, .cm-primary-nav ul li:hover>a, .cm-primary-nav ul li ul li a:hover, .cm-primary-nav ul li ul li:hover>a, .cm-primary-nav ul li.current-menu-item ul li a:hover, .cm-primary-nav li.page_item_has_children.current-menu-item>a::after, .cm-layout-2-style-1 .cm-primary-nav ul li:hover > a`,
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon, .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon `,
						"fill",
						value,
					);
					break;

				case "colormag_primary_menu_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-primary-nav ul li a",
						value,
					);
					break;

				case "colormag_mobile_menu_toggle_icon_color":
					css = colormagGenerateCommonCSS(
						".cm-header .cm-menu-toggle svg, .cm-header .cm-menu-toggle svg",
						"fill",
						value,
					);
					break;

				case "colormag_mobile_menu_text_color":
					css = colormagGenerateCommonCSS(
						`.cm-mobile-nav a, .cm-mobile-nav ul li ul li a, .cm-mobile-nav ul li.current-menu-item ul li a, .cm-mobile-nav ul li ul li.current-menu-item a, .cm-mobile-nav ul li.current_page_ancestor ul li a, .cm-mobile-nav ul li.current-menu-ancestor ul li a, .cm-mobile-nav ul li.current_page_item ul li a, .cm-mobile-nav li.menu-item-has-children>a::after, .cm-mobile-nav li.page_item_has_children>a::after, .cm-layout-2-style-1 .cm-mobile-nav a, .cm-layout-2-style-1 .cm-mobile-nav ul > li > a`,
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-mobile-nav .cm-submenu-toggle .cm-icon, .cm-mobile-nav .cm-submenu-toggle .cm-icon`,
						"fill",
						value,
					);
					break;

					case "colormag_mobile_menu_selected_hovered_text_color":
					css = colormagGenerateCommonCSS(
						`.cm-mobile-nav a:hover, .cm-mobile-nav ul li.current-menu-item a, .cm-mobile-nav ul li ul li.current-menu-item a, .cm-mobile-nav ul li.current_page_ancestor a, .cm-mobile-nav ul li.current-menu-ancestor a, .cm-mobile-nav ul li.current_page_item a, .cm-mobile-nav ul li:hover>a, .cm-mobile-nav ul li ul li a:hover, .cm-mobile-nav ul li ul li:hover>a, .cm-mobile-nav ul li.current-menu-item ul li a:hover, .cm-mobile-nav li.page_item_has_children.current-menu-item>a::after, .cm-layout-2-style-1 .cm-mobile-nav ul li:hover > a`,
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon, .cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon `,
						"fill",
						value,
					);
					break;

				case "colormag_mobile_menu_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-mobile-nav ul li a",
						value,
					);
					break;

					case "colormag_mobile_sub_menu_background":
					css = colormagGenerateBackgroundCSS(
						".cm-mobile-nav .sub-menu,.cm-mobile-nav .sub-menu li, .cm-mobile-nav .children",
						value,
					);
					break;

				case "colormag_mobile_sub_menu_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-mobile-nav ul li ul li a",
						value,
					);
					break;

				case "colormag_primary_sub_menu_background":
					css = colormagGenerateBackgroundCSS(
						".cm-primary-nav .sub-menu, .cm-primary-nav .children",
						value,
					);
					break;

				case "colormag_primary_sub_menu_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-primary-nav ul li ul li a",
						value,
					);
					break;

				case "colormag_header_action_icon_color":
					css = colormagGenerateCommonCSS(
						".fa.search-top:hover",
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						".cm-primary-nav .cm-random-post a:hover > svg, .cm-mobile-nav .cm-random-post a:hover > svg",
						"fill",
						value,
					);
					break;

				case "colormag_header_action_icon_hover_color":
					css = colormagGenerateCommonCSS(
						".fa.search-top",
						"color",
						value,
					);
					css += colormagGenerateCommonCSS(
						".cm-primary-nav .cm-random-post a svg,.cm-mobile-nav .cm-random-post a svg",
						"fill",
						value,
					);
					break;

				case "colormag_blog_post_title_typography":
					css = colormagGenerateTypographyCSS(id, ".cm-entry-title", value);
					break;

				case "colormag_footer_copyright_background":
					css = colormagGenerateBackgroundCSS(
						".cm-footer-bar",
						value,
					);
					break;

// 				case "colormag_page_header_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-page-header, .zak-container--separate .zak-page-header",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_page_header_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".has-page-header .zak-page-header",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_post_page_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-page-header .zak-page-title, .colormag-single-article .zak-entry-header .entry-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_post_page_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-page-header .zak-page-title, .colormag-single-article .zak-entry-header .entry-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_breadcrumb_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-page-header .breadcrumb-trail ul li",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_breadcrumbs_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-page-header .breadcrumb-trail ul li",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_breadcrumb_separator_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-page-header .breadcrumb-trail ul li::after",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_breadcrumbs_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-page-header .breadcrumb-trail ul li a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_breadcrumbs_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-page-header .breadcrumb-trail ul li a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_blog_post_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".entry-title:not(.zak-page-title)",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-secondary .widget .widget-title, .zak-secondary .widget .wp-block-heading",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-secondary .widget, .zak-secondary .widget li a",
// 						value,
// 					);
// 					break;

				case "colormag_footer_background":
					css = colormagGenerateBackgroundCSS(".cm-footer-cols", value);
					break;

					case "colormag_upper_footer_background":
					css = colormagGenerateBackgroundCSS(".cm-footer .cm-upper-footer-cols .widget", value);
					break;

// 				case "colormag_footer_column_border_top_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-cols",
// 						"border-top-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_column_border_top_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-cols",
// 						"border-top-color",
// 						value,
// 					);
// 					break;
//
				case "colormag_footer_widget_title_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-cols .cm-row .cm-widget-title span",
						"color",
						value,
					);
					break;

					case "colormag_footer_widget_content_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-cols .cm-row, .cm-footer-cols .cm-row p",
						"color",
						value,
					);
					break;

					case "colormag_footer_widget_content_link_text_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-cols .cm-row a",
						"color",
						value,
					);
					break;

					case "colormag_footer_widget_content_link_text_hover_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-cols .cm-row a:hover",
						"color",
						value,
					);
					break;
//
// 				case "colormag_footer_column_widget_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer .zak-footer-cols a, .zak-footer-col .widget ul a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_column_widget_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer .zak-footer-cols a:hover, .zak-footer-col .widget ul a:hover, .zak-footer .zak-footer-cols a:focus",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widgets_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer .zak-footer-cols .widget-title, .zak-footer-cols h1, .zak-footer-cols h2, .zak-footer-cols h3, .zak-footer-cols h4, .zak-footer-cols h5, .zak-footer-cols h6",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widgets_item_border_bottom_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-cols ul li, .zak-footer-builder .zak-footer-main-row ul li",
// 						"border-bottom-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widgets_item_border_bottom_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-cols ul li, .zak-footer-builder .zak-footer-main-row ul li",
// 						"border-bottom-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bar_background":
// 					css = colormagGenerateBackgroundCSS(".zak-footer-bar", value);
// 					break;
//
// 				case "colormag_footer_bar_border_top_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-bar",
// 						"border-top-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bar_border_top_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-bar",
// 						"border-top-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bar_text_color":
// 					css = colormagGenerateCommonCSS(".zak-footer-bar", "color", value);
// 					break;
//
// 				case "colormag_footer_bar_link_color":
// 					css = colormagGenerateCommonCSS(".zak-footer-bar a", "color", value);
// 					break;
//
// 				case "colormag_footer_bar_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-bar a:hover, .zak-footer-bar a:focus",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_scroll_to_top_background":
// 					css = colormagGenerateCommonCSS(
// 						".zak-scroll-to-top",
// 						"background-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_scroll_to_top_hover_background":
// 					css = colormagGenerateCommonCSS(
// 						".zak-scroll-to-top:hover",
// 						"background-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_scroll_to_top_icon_color":
// 					css = colormagGenerateCommonCSS(".zak-scroll-to-top", "color", value);
// 					css += colormagGenerateCommonCSS(
// 						".zak-scroll-to-top .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_scroll_to_top_icon_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-scroll-to-top:hover",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-scroll-to-top:hover .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				// Builder options.
// 				case "colormag_header_top_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-top-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_top_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-header-top-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_top_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_top_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_top_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_header_top_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_top_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-top-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-main-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-header-main-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_header_main_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-main-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-bottom-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-header-bottom-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_bottom_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-bottom-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_menu_border_bottom_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-main-nav",
// 						"border-bottom-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_border_bottom_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-secondary-nav",
// 						"border-bottom-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_border_bottom_width":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-tertiary-nav",
// 						"border-bottom-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_menu_border_bottom_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-main-nav",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_border_bottom_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_border_bottom_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_menu_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li > a, .zak-header-builder .zak-main-nav.zak-primary-nav ul.zak-primary-menu > li > a, .zak-header-builder .zak-primary-nav.zak-menu-item--layout-2 > ul > li > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li > a .zak-icon, .zak-header-builder .zak-main-nav.zak-primary-nav ul.zak-primary-menu li .zak-icon, .zak-header-builder .zak-primary-nav.zak-menu-item--layout-2 > ul > li > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li > a, .zak-header-builder .zak-main-nav.zak-secondary-nav ul.zak-secondary-menu > li > a, .zak-header-builder .zak-secondary-nav.zak-menu-item--layout-2 > ul > li > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li > a .zak-icon, .zak-header-builder .zak-main-nav.zak-secondary-nav ul.zak-secondary-menu li .zak-icon, .zak-header-builder .zak-secondary-nav.zak-menu-item--layout-2 > ul > li > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li > a, .zak-header-builder .zak-main-nav.zak-tertiary-nav ul.zak-tertiary-menu > li > a, .zak-header-builder .zak-tertiary-nav.zak-menu-item--layout-2 > ul > li > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li > a .zak-icon, .zak-header-builder .zak-main-nav.zak-tertiary-nav ul.zak-tertiary-menu li .zak-icon, .zak-header-builder .zak-tertiary-nav.zak-menu-item--layout-2 > ul > li > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_quaternary_menu_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li > a, .zak-header-builder .zak-main-nav.zak-quaternary-nav ul.zak-quaternary-menu > li > a, .zak-header-builder .zak-quaternary-nav.zak-menu-item--layout-2 > ul > li > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li > a .zak-icon, .zak-header-builder .zak-main-nav.zak-quaternary-nav ul.zak-quaternary-menu li .zak-icon, .zak-header-builder .zak-quaternary-nav.zak-menu-item--layout-2 > ul > li > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_menu_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li:hover > a, .zak-header-builder .zak-primary-nav.zak-menu-item--layout-2 > ul > li:hover > a, .zak-header-builder .zak-primary-nav ul li:hover > a, .zak-header-builder .zak-main-nav.zak-primary-nav ul.zak-primary-menu li:hover > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li:hover > .zak-icon, .zak-header-builder .zak-primary-nav.zak-menu-item--layout-2 > ul > li:hover > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li:hover > a, .zak-header-builder .zak-secondary-nav.zak-menu-item--layout-2 > ul > li:hover > a, .zak-header-builder .zak-secondary-nav ul li:hover > a, .zak-header-builder .zak-main-nav.zak-secondary-nav ul.zak-secondary-menu li:hover > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li:hover > .zak-icon, .zak-header-builder .zak-secondary-nav.zak-menu-item--layout-2 > ul > li:hover > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li:hover > a, .zak-header-builder .zak-tertiary-nav.zak-menu-item--layout-2 > ul > li:hover > a, .zak-header-builder .zak-tertiary-nav ul li:hover > a, .zak-header-builder .zak-main-nav.zak-tertiary-nav ul.zak-tertiary-menu li:hover > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li:hover > .zak-icon, .zak-header-builder .zak-tertiary-nav.zak-menu-item--layout-2 > ul > li:hover > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_quaternary_menu_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li:hover > a, .zak-header-builder .zak-quaternary-nav.zak-menu-item--layout-2 > ul > li:hover > a, .zak-header-builder .zak-quaternary-nav ul li:hover > a, .zak-header-builder .zak-main-nav.zak-quaternary-nav ul.zak-quaternary-menu li:hover > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li:hover > .zak-icon, .zak-header-builder .zak-quaternary-nav.zak-menu-item--layout-2 > ul > li:hover > .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_menu_active_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li:active > a, .zak-header-builder .zak-primary-nav ul > li:not(.zak-header-button).current_page_item > a, .zak-header-builder .zak-primary-nav ul > li:not(.zak-header-button).current_page_ancestor > a, .zak-header-builder .zak-primary-nav ul > li:not(.zak-header-button).current-menu-item > a, .zak-header-builder .zak-primary-nav ul > li:not(.zak-header-button).current-menu-ancestor > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-primary-nav ul li.current-menu-item > a .zak-icon, .zak-header-builder .zak-main-nav.zak-primary-nav ul.zak-primary-menu li.current-menu-item .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_active_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li:active > a, .zak-header-builder .zak-secondary-nav ul > li:not(.zak-header-button).current_page_item > a, .zak-header-builder .zak-secondary-nav ul > li:not(.zak-header-button).current_page_ancestor > a, .zak-header-builder .zak-secondary-nav ul > li:not(.zak-header-button).current-menu-item > a, .zak-header-builder .zak-secondary-nav ul > li:not(.zak-header-button).current-menu-ancestor > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-secondary-nav ul li.current-menu-item > a .zak-icon, .zak-header-builder .zak-main-nav.zak-secondary-nav ul.zak-secondary-menu li.current-menu-item .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_active_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li:active > a, .zak-header-builder .zak-tertiary-nav ul > li:not(.zak-header-button).current_page_item > a, .zak-header-builder .zak-tertiary-nav ul > li:not(.zak-header-button).current_page_ancestor > a, .zak-header-builder .zak-tertiary-nav ul > li:not(.zak-header-button).current-menu-item > a, .zak-header-builder .zak-tertiary-nav ul > li:not(.zak-header-button).current-menu-ancestor > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-tertiary-nav ul li.current-menu-item > a .zak-icon, .zak-header-builder .zak-main-nav.zak-tertiary-nav ul.zak-tertiary-menu li.current-menu-item .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_quaternary_menu_active_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li:active > a, .zak-header-builder .zak-quaternary-nav ul > li:not(.zak-header-button).current_page_item > a, .zak-header-builder .zak-quaternary-nav ul > li:not(.zak-header-button).current_page_ancestor > a, .zak-header-builder .zak-quaternary-nav ul > li:not(.zak-header-button).current-menu-item > a, .zak-header-builder .zak-quaternary-nav ul > li:not(.zak-header-button).current-menu-ancestor > a",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-quaternary-nav ul li.current-menu-item > a .zak-icon, .zak-header-builder .zak-main-nav.zak-quaternary-nav ul.zak-quaternary-menu li.current-menu-item .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_main_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-primary-nav ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-secondary-nav ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_tertiary_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-tertiary-nav ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_quaternary_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-quaternary-nav ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_sub_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-primary-nav ul li ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_secondary_sub_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .zak-secondary-nav ul li ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_search_icon_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-search .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_search_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-header-builder .zak-main-header.zak-header-search--opened",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_search_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-search .zak-search-field, .zak-header-builder .zak-header-search .zak-search-field:focus",
// 						"color",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-search .zak-icon--close::after , .zak-header-builder .zak-header-search .zak-icon--close::before",
// 						"background",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-search .zak-icon--search .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_background_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"background-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_background_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button:hover",
// 						"background-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_border_radius":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"border-radius",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"border-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_button_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-header-buttons .zak-header-button .zak-button",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_1_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-1 *",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_1_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-1 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_1_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-1 a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_1_font_size":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-html-1 *",
// 						"font-size",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_1_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-html-1",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_2_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-2 *",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_2_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-2 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_2_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .zak-html-2 a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_2_font_size":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .zak-html-2 p",
// 						"font-size",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_html_2_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder .zak-html-2",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-top-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-footer-top-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-main-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-footer-main-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-bottom-row",
// 						"height",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_container":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-footer-bottom-row .zak-container",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_background":
// 					css = colormagGenerateBackgroundCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_padding":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"padding",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_site_logo_height":
// 					css = colormagGenerateSliderCSS(
// 						".site-branding .custom-logo-link img",
// 						"max-width",
// 						value,
// 					);
// 					break;
//
				case "colormag_site_title_color":
					css = colormagGenerateCommonCSS(".cm-site-title a", "color", value);
					break;

				case "colormag_site_title_hover_color":
					css = colormagGenerateCommonCSS(".cm-site-title a:hover", "color", value);
					break;

				case "colormag_site_title_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-site-title",
						value,
					);
					break;

				case "colormag_site_tagline_color":
					css = colormagGenerateCommonCSS(".cm-site-description", "color", value);
					break;

				case "colormag_site_tagline_typography":
					css = colormagGenerateTypographyCSS(
						id,
						".cm-site-description",
						value,
					);
					break;

// 				case "colormag_widget_1_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-1-sidebar .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_1_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .widget.widget-top-bar-col-1-sidebar .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_1_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-1-sidebar",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_1_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-1-sidebar a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_1_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .widget.widget-top-bar-col-1-sidebar",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_2_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-2-sidebar .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_2_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .widget.widget-top-bar-col-2-sidebar .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_2_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-2-sidebar",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_2_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .widget.widget-top-bar-col-2-sidebar a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_widget_2_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .widget.widget-top-bar-col-2-sidebar",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_color":
// 					css = colormagGenerateCommonCSS(".zak-mobile-nav a", "color", value);
// 					css += colormagGenerateCommonCSS(
// 						".zak-mobile-nav li.page_item_has_children .zak-submenu-toggle .zak-icon, .zak-mobile-nav li.menu-item-has-children .zak-submenu-toggle .zak-icon",
// 						"fill",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-mobile-nav li:hover > a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_active_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-mobile-nav .current_page_item a, .zak-mobile-nav > .menu ul li.current-menu-item > a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_background":
// 					css = colormagGenerateCommonCSS(
// 						".zak-mobile-nav, .zak-search-form .zak-search-field",
// 						"background-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_border_bottom":
// 					css = colormagGenerateSliderCSS(
// 						".zak-mobile-nav li:not(:last-child)",
// 						"border-bottom-width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_border_bottom_style":
// 					css = colormagGenerateCommonCSS(
// 						".zak-mobile-nav li",
// 						"border-bottom-style",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_item_border_bottom_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-mobile-nav li",
// 						"border-color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_mobile_menu_typography":
// 					css = colormagGenerateTypographyCSS(id, ".zak-mobile-menu a", value);
// 					break;
//
// 				case "colormag_footer_html_1_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-1 *",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_1_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-1 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_1_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-1 a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_1_font_size":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-html-1 *",
// 						"font-size",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_1_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-html-1",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_2_text_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-2 *",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_2_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-2 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_2_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-html-2 a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_2_font_size":
// 					css = colormagGenerateSliderCSS(
// 						".zak-footer-builder .zak-html-2 *",
// 						"font-size",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_html_2_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-html-2",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_1_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-1 .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_1_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-1 .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_1_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-1",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_1_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-1 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_1_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-1",
// 						value,
// 					);
// 					break;
// 				//
// 				case "colormag_footer_widget_2_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-2 .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_2_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-2 .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_2_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-2",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_2_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-2 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_2_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-2",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_3_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-3 .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_3_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-3 .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_3_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-3",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_3_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-3 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_3_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-3",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_4_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-4 .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_4_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-4 .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_4_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-4",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_4_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.widget-footer-sidebar-4 a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_4_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.widget-footer-sidebar-4",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-nav ul li a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-nav ul li a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .zak-footer-nav ul li a",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_2_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-nav-2 ul li a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_2_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-nav-2 ul li a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_menu_2_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .zak-footer-nav-2 ul li a",
// 						value,
// 					);
// 					break;
//
				case "colormag_footer_copyright_text_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-bar-area .cm-footer-bar__2",
						"color",
						value,
					);
					break;

				case "colormag_footer_copyright_link_text_color":
					css = colormagGenerateCommonCSS(
						".cm-footer-bar-area .cm-footer-bar__2 a",
						"color",
						value,
					);
					break;

// 				case "colormag_footer_copyright_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-copyright a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_copyright_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .zak-copyright",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_copyright_margin":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-footer-builder .zak-copyright",
// 						"margin",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_site_logo_height":
// 					css = colormagGenerateSliderCSS(
// 						".zak-header-builder .site-branding .custom-logo-link img",
// 						"width",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_site_identity_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .site-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_site_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .site-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_site_tagline_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder .site-description",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_site_tagline_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-header-builder .site-description",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_bottom_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-bottom-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_top_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-top-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_link_hover_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row a:hover",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_main_area_widget_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .zak-footer-main-row .widget-title, .zak-footer-builder .zak-footer-main-row h1, .zak-footer-builder .zak-footer-main-row h2, .zak-footer-builder .zak-footer-main-row h3, .zak-footer-builder .zak-footer-main-row h4, .zak-footer-builder .zak-footer-main-row h5, .zak-footer-builder .zak-footer-main-row h6",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_header_builder_background":
// 					css = colormagGenerateBackgroundCSS(".zak-header-builder", value);
// 					break;
//
// 				case "colormag_header_builder_border_width":
// 					css = colormagGenerateDimnesionCSS(
// 						".zak-header-builder",
// 						"border-width",
// 						value,
// 					);
// 					css += colormagGenerateCommonCSS(
// 						".zak-header-builder",
// 						"border-style",
// 						"solid",
// 					);
// 					break;
//
// 				case "colormag_header_builder_border_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-header-builder",
// 						"border-color",
// 						value,
// 					);
// 					break;
// 				//
// 				case "colormag_footer_widget_5_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-1-sidebar .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_5_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.footer-bar-col-1-sidebar .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_5_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-1-sidebar",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_5_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-1-sidebar a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_5_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.footer-bar-col-1-sidebar",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_6_title_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-2-sidebar .widget-title",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_6_title_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.footer-bar-col-2-sidebar .widget-title",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_6_content_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-2-sidebar",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_6_link_color":
// 					css = colormagGenerateCommonCSS(
// 						".zak-footer-builder .widget.footer-bar-col-2-sidebar a",
// 						"color",
// 						value,
// 					);
// 					break;
//
// 				case "colormag_footer_widget_6_content_typography":
// 					css = colormagGenerateTypographyCSS(
// 						id,
// 						".zak-footer-builder .widget.footer-bar-col-2-sidebar",
// 						value,
// 					);
// 					break;
			}
			return css;
		},
	);

	wp.hooks.addAction(
		"customind.change.colormag_color_palette",
		"customind",
		(...args) => {
			console.log(args);
		},
	);

	wp.hooks.addAction(
		"customind.change.colormag_container_layout",
		"customind",
		(layout) => {
			var site_layout = layout;

					if ( 'wide' === site_layout ) {
						$( 'body' ).removeClass( 'boxed' ).addClass( 'wide' );
					} else if ( 'boxed' === site_layout ) {
						$( 'body' ).removeClass( 'wide' ).addClass( 'boxed' );
					}
		},
	);

	wp.hooks.addAction(
		"customind.change.colormag_header_display_type",
		"customind",
		(layout) => {
			var display_type = layout;

			if (display_type === 'type_two') {
				$('body').removeClass('header_display_type_two').addClass('header_display_type_one');
			} else if (display_type === 'type_three') {
				$('body').removeClass('header_display_type_one').addClass('header_display_type_two');
			} else if (display_type === 'type_one') {
				$('body').removeClass('header_display_type_one header_display_type_two');
			}
		},
	);

	wp.hooks.addAction(
		"customind.change.colormag_footer_bar_alignment",
		"customind",
		(alignment) => {
			var alignment_type = alignment;

			if (alignment_type === 'left') {
				$('.cm-footer-bar').removeClass('cm-footer-bar-style-2 cm-footer-bar-style-3').addClass('cm-footer-bar-style-1');
			} else if (alignment_type === 'right') {
				$('.cm-footer-bar').removeClass('cm-footer-bar-style-1 cm-footer-bar-style-3').addClass('cm-footer-bar-style-2');
			} else if (alignment_type === 'center') {
				$('.cm-footer-bar').removeClass('cm-footer-bar-style-1 cm-footer-bar-style-2').addClass('cm-footer-bar-style-3');
			}
		},
	);

	wp.hooks.addAction(
		"customind.change.colormag_main_footer_layout",
		"customind",
		(layout) => {
			var display_type = layout;

			if (display_type === 'layout-2') {
				$('#cm-footer').removeClass('colormag-footer--classic-bordered').addClass('colormag-footer--classic');
			} else if (display_type === 'layout-3') {
				$('#cm-footer').removeClass('colormag-footer--classic').addClass('colormag-footer--classic-bordered');
			} else if (display_type === 'layout-1') {
				$('#cm-footer').removeClass('colormag-footer--classic colormag-footer--classic-bordered');
			}
		},
	);

})(jQuery);
