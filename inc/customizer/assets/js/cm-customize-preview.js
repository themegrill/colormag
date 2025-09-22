(function ($) {
	function colormagColorPalette(v, to) {
		let styles = '';
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
		let css = '';
		css = `${selector} {${property}: ${sidebarCss}${value.unit};}`;
		css += `${secondarySelector} {${property}: ${primaryCss}${value.unit};}`;

		return css;
	}

	function colormagElementLayoutCSS(selector, property, value) {
		return `${selector} {${property}: ${value};}`;
	}

	function colormagGenerateSliderCSS(selector, property, value) {
		let css = '';

		// Check if we have responsive values (desktop, tablet, mobile)
		if (value.desktop || value.tablet || value.mobile) {
			// Desktop styling
			if (value.desktop?.size) {
				const unit = value.desktop.unit || 'px';
				css += `${selector} {${property}: ${value.desktop.size}${unit};}`;
			}

			// Tablet styling
			if (value.tablet?.size) {
				const tabletUnit = value.tablet.unit || 'px';
				css += `@media(max-width: 768px) {${selector} {${property}: ${value.tablet.size}${tabletUnit};}}`;
			}

			// Mobile styling
			if (value.mobile?.size) {
				const mobileUnit = value.mobile.unit || 'px';
				css += `@media(max-width: 600px) {${selector} {${property}: ${value.mobile.size}${mobileUnit};}}`;
			}
		} else {
			// Legacy format (non-responsive)
			const unit = value.unit || 'px';
			css = `${selector} {${property}: ${value.size}${unit};}`;
		}

		return css;
	}

	function colormagGenerateBackgroundCSS(selector, value) {
		let backgroundColor = value['background-color'],
			backgroundImage = value['background-image'],
			backgroundAttachment = value['background-attachment'],
			backgroundPosition = value['background-position'],
			backgroundSize = value['background-size'],
			backgroundRepeat = value['background-repeat'];

		return `${selector}{background-color: ${backgroundColor};background-image: url( ${backgroundImage} );background-attachment: ${backgroundAttachment};background-position: ${backgroundPosition};background-size: ${backgroundSize};background-repeat: ${backgroundRepeat};}`;
	}

	/**
	 * @param {string} str
	 * @returns {boolean}
	 */
	function colormagIsNumeric(str) {
		var matches;

		if ('string' !== typeof str) {
			return false;
		}

		matches = str.match(/\d+/g);

		return null !== matches;
	}

	function colormagGenerateTypographyCSS(controlId, selector, typography) {
		let css = '';
		var link = '',
			fontFamily = '',
			fontWeight = '',
			fontStyle = '',
			fontTransform = '',
			desktopFontSize = '',
			tabletFontSize = '',
			mobileFontSize = '',
			desktopLineHeight = '',
			tabletLineHeight = '',
			mobileLineHeight = '',
			desktopLetterSpacing = '',
			tabletLetterSpacing = '',
			mobileLetterSpacing = '';

		if ('object' == typeof typography) {
			if (undefined !== typography['font-size']) {
				if (
					'undefined' !== typeof typography?.['font-size']?.desktop?.size &&
					'' !== typography['font-size']['desktop']['size']
				) {
					desktopFontSize =
						typography['font-size']['desktop']['size'] +
						typography['font-size']['desktop']['unit'];
				}

				if (
					'undefined' !== typeof typography?.['font-size']?.tablet?.size &&
					'' !== typography['font-size']['tablet']['size']
				) {
					tabletFontSize =
						typography['font-size']['tablet']['size'] +
						typography['font-size']['tablet']['unit'];
				}

				if (
					'undefined' !== typeof typography?.['font-size']?.mobile?.size &&
					'' !== typography['font-size']['mobile']['size']
				) {
					mobileFontSize =
						typography['font-size']['mobile']['size'] +
						typography['font-size']['mobile']['unit'];
				}
			}

			if (undefined !== typography['line-height']) {
				if (
					'undefined' !== typeof typography?.['line-height']?.desktop?.size &&
					'' !== typography['line-height']['desktop']['size']
				) {
					const desktopLineHeightUnit =
						'-' !== typography['line-height']['desktop']['unit']
							? typography['line-height']['desktop']['unit']
							: '';
					desktopLineHeight =
						typography['line-height']['desktop']['size'] +
						desktopLineHeightUnit;
				}

				if (
					'undefined' !== typeof typography?.['line-height']?.tablet?.size &&
					'' !== typography['line-height']['tablet']['size']
				) {
					const tabletLineHeightUnit =
						'-' !== typography['line-height']['tablet']['unit']
							? typography['line-height']['tablet']['unit']
							: '';
					tabletLineHeight =
						typography['line-height']['tablet']['size'] + tabletLineHeightUnit;
				}

				if (
					'undefined' !== typeof typography?.['line-height']?.mobile?.size &&
					'' !== typography['line-height']['mobile']['size']
				) {
					const mobileLineHeightUnit =
						'-' !== typography['line-height']['mobile']['unit']
							? typography['line-height']['mobile']['unit']
							: '';
					mobileLineHeight =
						typography['line-height']['mobile']['size'] + mobileLineHeightUnit;
				}
			}

			if (undefined !== typography['letter-spacing']) {
				if (
					'undefined' !==
						typeof typography?.['letter-spacing']?.desktop?.size &&
					'' !== typography['letter-spacing']['desktop']['size']
				) {
					const desktopLetterSpacingUnit =
						'-' !== typography['letter-spacing']['desktop']['unit']
							? typography['letter-spacing']['desktop']['unit']
							: '';
					desktopLetterSpacing =
						typography['letter-spacing']['desktop']['size'] +
						desktopLetterSpacingUnit;
				}

				if (
					'undefined' !== typeof typography?.['letter-spacing']?.tablet?.size &&
					'' !== typography['letter-spacing']['tablet']['size']
				) {
					const tabletLetterSpacingUnit =
						'-' !== typography['letter-spacing']['tablet']['unit']
							? typography['letter-spacing']['tablet']['unit']
							: '';
					tabletLetterSpacing =
						typography['letter-spacing']['tablet']['size'] +
						tabletLetterSpacingUnit;
				}

				if (
					'undefined' !== typeof typography?.['letter-spacing']?.mobile?.size &&
					'' !== typography['letter-spacing']['mobile']['size']
				) {
					const mobileLetterSpacingUnit =
						'-' !== typography['letter-spacing']['mobile']['unit']
							? typography['letter-spacing']['mobile']['unit']
							: '';
					mobileLetterSpacing =
						typography['letter-spacing']['mobile']['size'] +
						mobileLetterSpacingUnit;
				}
			}

			if (
				undefined !== typography['font-family'] &&
				'' !== typography['font-family']
			) {
				fontFamily = typography['font-family'].split(',')[0];
				fontFamily = fontFamily.replace(/'/g, '');

				if (
					fontFamily.includes('default') ||
					fontFamily.includes('Default') ||
					fontFamily.includes('-apple-system')
				) {
					fontFamily =
						'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
				} else if (fontFamily.includes('Monaco')) {
					fontFamily =
						'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace';
				} else {
					link = `<link id="${controlId}" href="https://fonts.googleapis.com/css?family=${fontFamily}" rel="stylesheet">`;
				}
			}

			if (
				undefined !== typography['font-weight'] &&
				'' !== typography['font-weight']
			) {
				if (colormagIsNumeric(typography['font-weight'])) {
					fontWeight = parseInt(typography['font-weight']);
				} else {
					fontWeight =
						'regular' != typography['font-weight']
							? typography['font-weight']
							: 'normal';
				}
			}

			if (
				undefined !== typography['font-style'] &&
				'' !== typography['font-style']
			) {
				fontStyle = typography['font-style'];
			}

			if (
				undefined !== typography['text-transform'] &&
				'' !== typography['text-transform']
			) {
				fontTransform = typography['text-transform'];
			}

			jQuery('link#' + controlId).remove();

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

			jQuery('head').append(link);

			return css;
		}

		return css;
	}

	function colormagGenerateDimensionCSS(selector, property, value) {
		let topCSS = value.top ? value.top : 0,
			rightCSS = value.right ? value.right : 0,
			bottomCSS = value.bottom ? value.bottom : 0,
			leftCSS = value.left ? value.left : 0,
			unit = value.unit ? value.unit : 'px';

		return `${selector}{ ${property} : ${topCSS + unit + ' ' + rightCSS + unit + ' ' + bottomCSS + unit + ' ' + leftCSS + unit}}`;
	}

	wp.hooks.addFilter(
		'customind.dynamic.css',
		'customind',
		function (css, value, id) {
			switch (id) {
				case 'colormag_color_palette':
					css = colormagColorPalette(css, value);
					break;
				case 'colormag_base_color':
					css = colormagGenerateCommonCSS('body', 'color', value);
					break;

				case 'colormag_box_shadow_color':
					css = colormagGenerateCommonCSS(
						'.cm-posts .post',
						'box-shadow',
						value,
					);
					break;

				case 'colormag_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-entry-summary a',
						'color',
						value,
					);
					break;

				case 'colormag_link_hover_color':
					css = colormagGenerateCommonCSS(
						`.cm-entry-summary a:hover, .pagebuilder-content a:hover, .pagebuilder-content a:hover`,
						'color',
						value,
					);
					break;

				case 'colormag_inside_container_background':
					css = colormagGenerateBackgroundCSS('.cm-content', value);
					break;

				case 'colormag_outside_container_background':
					css = colormagGenerateBackgroundCSS('body,body.boxed', value);
					break;

				case 'colormag_base_typography':
					css = colormagGenerateTypographyCSS(
						id,
						`body, button, input, select, textarea, blockquote p, .entry-meta, .cm-entry-button, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, .cm-secondary .widget, .cm-error-404 .widget, .cm-entry-summary p`,
						value,
					);
					break;

				case 'colormag_headings_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'h1, h2, h3, h4, h5, h6',
						value,
					);
					break;

				case 'colormag_h1_typography':
					css = colormagGenerateTypographyCSS(id, 'h1', value);
					break;

				case 'colormag_h2_typography':
					css = colormagGenerateTypographyCSS(id, 'h2', value);
					break;

				case 'colormag_h3_typography':
					css = colormagGenerateTypographyCSS(id, 'h3', value);
					break;

				case 'colormag_h4_typography':
					css = colormagGenerateTypographyCSS(id, 'h4', value);
					break;

				case 'colormag_h5_typography':
					css = colormagGenerateTypographyCSS(id, 'h5', value);
					break;

				case 'colormag_h6_typography':
					css = colormagGenerateTypographyCSS(id, 'h6', value);
					break;

				case 'colormag_button_color':
					css = colormagGenerateCommonCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						'color',
						value,
					);
					break;

				case 'colormag_button_hover_color':
					css = colormagGenerateCommonCSS(
						`.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .cm-entry-button span:hover, .wp-block-button .wp-block-button__link:hover`,
						'color',
						value,
					);
					break;

				case 'colormag_button_background_color':
					css = colormagGenerateCommonCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						'background-color',
						value,
					);
					break;

				case 'colormag_button_background_hover_color':
					css = colormagGenerateCommonCSS(
						`.colormag-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover, .cm-entry-button span:hover, .wp-block-button .wp-block-button__link:hover`,
						'background-color',
						value,
					);
					break;

				case 'colormag_button_dimension_padding':
					css = colormagGenerateDimensionCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						'padding',
						value,
					);
					break;

				case 'colormag_button_border_radius':
					css = colormagGenerateSliderCSS(
						`.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .cm-entry-button span, .wp-block-button .wp-block-button__link`,
						'border-radius',
						value,
					);
					break;

				case 'colormag_top_bar_background_color':
					css = colormagGenerateCommonCSS(
						`.cm-top-bar`,
						'background-color',
						value,
					);
					break;

				case 'colormag_main_header_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-header-1, .dark-skin .cm-header-1',
						value,
					);
					break;

				case 'colormag_primary_menu_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-mobile-nav li, #cm-primary-nav, .cm-layout-2 #cm-primary-nav, .cm-header .cm-main-header .cm-primary-nav .cm-row, .cm-home-icon.front_page_on',
						value,
					);
					break;

				case 'colormag_primary_menu_top_border_width':
					css = colormagGenerateSliderCSS(
						'#cm-primary-nav',
						'border-top-width',
						value,
					);
					break;

				case 'colormag_header_search_width':
					css = colormagGenerateSliderCSS(
						'.cm-search-icon-in-input-right .search-wrap, .cm-search-box .search-wrap',
						'width',
						value,
					);
					break;

				case 'colormag_primary_menu_top_border_color':
					css = colormagGenerateCommonCSS(
						'#cm-primary-nav',
						'border-top-color',
						value,
					);
					break;

				case 'colormag_primary_menu_text_color':
					css = colormagGenerateCommonCSS(
						`.cm-primary-nav a, .cm-primary-nav ul li ul li a, .cm-primary-nav ul li.current-menu-item ul li a, .cm-primary-nav ul li ul li.current-menu-item a, .cm-primary-nav ul li.current_page_ancestor ul li a, .cm-primary-nav ul li.current-menu-ancestor ul li a, .cm-primary-nav ul li.current_page_item ul li a, .cm-primary-nav li.menu-item-has-children>a::after, .cm-primary-nav li.page_item_has_children>a::after, .cm-layout-2-style-1 .cm-primary-nav a, .cm-layout-2-style-1 .cm-primary-nav ul > li > a`,
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-primary-nav .cm-submenu-toggle .cm-icon, .cm-primary-nav .cm-submenu-toggle .cm-icon`,
						'fill',
						value,
					);
					break;

				case 'colormag_primary_menu_selected_hovered_text_color':
					css = colormagGenerateCommonCSS(
						`.cm-primary-nav a:hover, .cm-primary-nav ul li.current-menu-item a, .cm-primary-nav ul li ul li.current-menu-item a, .cm-primary-nav ul li.current_page_ancestor a, .cm-primary-nav ul li.current-menu-ancestor a, .cm-primary-nav ul li.current_page_item a, .cm-primary-nav ul li:hover>a, .cm-primary-nav ul li ul li a:hover, .cm-primary-nav ul li ul li:hover>a, .cm-primary-nav ul li.current-menu-item ul li a:hover, .cm-primary-nav li.page_item_has_children.current-menu-item>a::after, .cm-layout-2-style-1 .cm-primary-nav ul li:hover > a`,
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon, .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon `,
						'fill',
						value,
					);
					break;

				case 'colormag_primary_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-primary-nav ul li a',
						value,
					);
					break;

				case 'colormag_mobile_menu_toggle_icon_color':
					css = colormagGenerateCommonCSS(
						'.cm-header .cm-menu-toggle svg, .cm-header .cm-menu-toggle svg',
						'fill',
						value,
					);
					break;

				case 'colormag_mobile_menu_text_color':
					css = colormagGenerateCommonCSS(
						`.cm-mobile-nav a, .cm-mobile-nav ul li ul li a, .cm-mobile-nav ul li.current-menu-item ul li a, .cm-mobile-nav ul li ul li.current-menu-item a, .cm-mobile-nav ul li.current_page_ancestor ul li a, .cm-mobile-nav ul li.current-menu-ancestor ul li a, .cm-mobile-nav ul li.current_page_item ul li a, .cm-mobile-nav li.menu-item-has-children>a::after, .cm-mobile-nav li.page_item_has_children>a::after, .cm-layout-2-style-1 .cm-mobile-nav a, .cm-layout-2-style-1 .cm-mobile-nav ul > li > a`,
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-mobile-nav .cm-submenu-toggle .cm-icon, .cm-mobile-nav .cm-submenu-toggle .cm-icon`,
						'fill',
						value,
					);
					break;

				case 'colormag_mobile_menu_selected_hovered_text_color':
					css = colormagGenerateCommonCSS(
						`.cm-mobile-nav a:hover, .cm-mobile-nav ul li.current-menu-item a, .cm-mobile-nav ul li ul li.current-menu-item a, .cm-mobile-nav ul li.current_page_ancestor a, .cm-mobile-nav ul li.current-menu-ancestor a, .cm-mobile-nav ul li.current_page_item a, .cm-mobile-nav ul li:hover>a, .cm-mobile-nav ul li ul li a:hover, .cm-mobile-nav ul li ul li:hover>a, .cm-mobile-nav ul li.current-menu-item ul li a:hover, .cm-mobile-nav li.page_item_has_children.current-menu-item>a::after, .cm-layout-2-style-1 .cm-mobile-nav ul li:hover > a`,
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						`.cm-layout-2 .cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon, .cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon `,
						'fill',
						value,
					);
					break;

				case 'colormag_mobile_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-mobile-nav ul li a',
						value,
					);
					break;

				case 'colormag_mobile_sub_menu_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-mobile-nav .sub-menu,.cm-mobile-nav .sub-menu li, .cm-mobile-nav .children',
						value,
					);
					break;

				case 'colormag_mobile_sub_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-mobile-nav ul li ul li a',
						value,
					);
					break;

				case 'colormag_primary_sub_menu_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-primary-nav .sub-menu, .cm-primary-nav .children',
						value,
					);
					break;

				case 'colormag_primary_sub_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-primary-nav ul li ul li a',
						value,
					);
					break;

				case 'colormag_header_action_icon_hover_color':
					css = colormagGenerateCommonCSS(
						'.fa.search-top:hover',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-primary-nav .cm-random-post a:hover > svg, .cm-mobile-nav .cm-random-post a:hover > svg',
						'fill',
						value,
					);
					break;

				case 'colormag_header_action_icon_color':
					css = colormagGenerateCommonCSS('.fa.search-top', 'color', value);
					css += colormagGenerateCommonCSS(
						'.cm-primary-nav .cm-random-post a svg,.cm-mobile-nav .cm-random-post a svg',
						'fill',
						value,
					);
					break;

				case 'colormag_blog_post_title_typography':
					css = colormagGenerateTypographyCSS(id, '.cm-entry-title', value);
					break;

				case 'colormag_single_post_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.single .cm-entry-header .cm-entry-title',
						value,
					);
					break;

				case 'colormag_footer_copyright_background':
					css = colormagGenerateBackgroundCSS('.cm-footer-bar', value);
					break;

				case 'colormag_footer_background':
					css = colormagGenerateBackgroundCSS('.cm-footer-cols', value);
					break;

				case 'colormag_upper_footer_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-footer .cm-upper-footer-cols .widget',
						value,
					);
					break;

				case 'colormag_footer_widget_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-cols .cm-row .cm-widget-title span',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-cols .cm-row, .cm-footer-cols .cm-row p',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_content_link_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-cols .cm-row a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_content_link_text_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-cols .cm-row a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_date_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .date-in-header',
						'color',
						value,
					);
					break;

				case 'colormag_news_ticker_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .breaking-news-latest',
						'color',
						value,
					);
					break;

				case 'colormag_news_ticker_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .newsticker li a',
						'color',
						value,
					);
					break;

				case 'colormag_date_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .date-in-header',
						value,
					);
					break;

				case 'colormag_news_ticker_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .breaking-news-latest',
						value,
					);
					break;

				case 'colormag_news_ticker_link_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .breaking-news ul li a',
						value,
					);
					break;

				case 'colormag_header_html_1_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-html-1 *',
						'color',
						value,
					);
					break;

				case 'colormag_header_html_1_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-html-1 a',
						'color',
						value,
					);
					break;

				case 'colormag_header_html_1_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-html-1 a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_header_html_1_font_size':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-html-1 *',
						'font-size',
						value,
					);
					break;

				case 'colormag_header_html_1_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-html-1',
						'margin',
						value,
					);
					break;

				case 'colormag_header_primary_menu_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li a',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav .cm-submenu-toggle .cm-icon',
						'fill',
						value,
					);
					break;

				case 'colormag_header_primary_menu_selected_hovered_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li:hover > a',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon',
						'fill',
						value,
					);
					break;

				case 'colormag_header_primary_menu_active_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li.current-menu-item > a',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav li.current-menu-item > .cm-submenu-toggle .cm-icon',
						'fill',
						value,
					);
					break;

				case 'colormag_header_primary_menu_hover_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li:hover',
						'background',
						value,
					);
					break;

				case 'colormag_header_primary_menu_hover_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li:hover',
						'background',
						value,
					);
					break;

				case 'colormag_header_primary_menu_active_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-primary-nav ul li.current-menu-item',
						'background',
						value,
					);
					break;

				case 'colormag_header_primary_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-primary-nav > ul > li > a',
						value,
					);
					break;

				case 'colormag_header_primary_sub_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-primary-nav ul li ul li a',
						value,
					);
					break;

				case 'colormag_header_secondary_menu_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-secondary-nav ul li a',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-secondary-nav ul li .cm-submenu-toggle .cm-icon',
						'fill',
						value,
					);
					break;

				case 'colormag_header_secondary_menu_selected_hovered_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-secondary-nav ul li:hover > a',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-secondary-nav ul li > .cm-submenu-toggle .cm-icon',
						'fill',
						value,
					);
					break;

				case 'colormag_header_secondary_menu_hover_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-secondary-nav ul li:hover',
						'background-color',
						value,
					);
					break;

				case 'colormag_header_secondary_sub_menu_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-header-builder .cm-secondary-nav .sub-menu, .cm-header-builder .cm-secondary-nav .children',
						value,
					);
					break;

				case 'colormag_header_secondary_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-secondary-nav ul li a',
						value,
					);
					break;

				case 'colormag_header_secondary_sub_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-secondary-nav ul li ul li a',
						value,
					);
					break;

				case 'colormag_header_mobile_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-mobile-nav ul li a',
						value,
					);
					break;

				case 'colormag_mobile_menu_background':
					css = colormagGenerateBackgroundCSS('.cm-mobile-nav ul li', value);
					break;

				case 'colormag_header_mobile_menu_item_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-mobile-nav ul li a',
						'color',
						value,
					);
					break;

				case 'colormag_header_mobile_menu_item_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-mobile-nav ul li:hover a',
						'color',
						value,
					);
					break;

				case 'colormag_header_button_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'color',
						value,
					);
					break;

				case 'colormag_header_button_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover',
						'color',
						value,
					);
					break;

				case 'colormag_header_button_background_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'background-color',
						value,
					);
					break;

				case 'colormag_header_button_background_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover',
						'background-color',
						value,
					);
					break;

				case 'colormag_header_button_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'padding',
						value,
					);
					break;

				case 'colormag_header_button_border_radius':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'border-radius',
						value,
					);
					break;

				case 'colormag_header_search_border_radius':
					css = colormagGenerateSliderCSS(
						'.cm-search-icon-in-input-right .search-wrap input',
						'border-radius',
						value,
					);
					break;

				case 'colormag_header_button_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'border-width',
						value,
					);
					break;

				case 'colormag_header_search_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-search-icon-in-input-right .search-wrap input',
						'border-width',
						value,
					);
					break;

				case 'colormag_header_button_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_search_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-search-icon-in-input-right .search-wrap input',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_top_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-top-row',
						'height',
						value,
					);
					break;

				case 'colormag_header_top_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-header-top-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_header_top_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-header-builder .cm-header-top-row',
						value,
					);
					break;

				case 'colormag_header_top_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-top-row',
						'padding',
						value,
					);
					break;

				case 'colormag_header_top_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-top-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-top-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_header_top_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-top-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_top_area_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-top-row',
						'color',
						value,
					);
					break;

				case 'colormag_header_main_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-main-row',
						'height',
						value,
					);
					break;

				case 'colormag_header_main_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-header-main-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_header_main_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-header-builder .cm-header-main-row',
						value,
					);
					break;

				case 'colormag_header_main_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-main-row',
						'padding',
						value,
					);
					break;

				case 'colormag_header_main_area_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-main-row',
						'margin',
						value,
					);
					break;

				case 'colormag_header_main_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-main-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-main-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_header_main_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-main-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_main_area_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-main-row',
						'color',
						value,
					);
					break;

				case 'colormag_header_bottom_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-bottom-row',
						'height',
						value,
					);
					break;

				case 'colormag_header_bottom_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-header-bottom-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_header_bottom_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-header-builder .cm-header-bottom-row',
						value,
					);
					break;

				case 'colormag_header_bottom_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-bottom-row',
						'padding',
						value,
					);
					break;

				case 'colormag_header_bottom_area_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-bottom-row',
						'margin',
						value,
					);
					break;

				case 'colormag_header_bottom_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-header-builder .cm-header-bottom-row, .cm-header-builder .cm-mobile-row .cm-header-bottom-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-bottom-row, .cm-header-builder .cm-mobile-row .cm-header-bottom-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_header_bottom_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-bottom-row, .cm-header-builder .cm-mobile-row .cm-header-bottom-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_bottom_area_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-header-bottom-row',
						'color',
						value,
					);
					break;

				case 'colormag_header_socials_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .header-social-icons a',
						'color',
						value,
					);
					break;

				case 'colormag_header_search_icon_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-top-search .search-top::before',
						'color',
						value,
					);
					break;

				case 'colormag_header_search_icon_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-top-search:hover > .search-top::before',
						'color',
						value,
					);
					break;

				case 'colormag_header_search_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-top-search .search-form-top input, .search-wrap input',
						'color',
						value,
					);
					break;

				case 'colormag_header_search_placeholder_color':
					css = colormagGenerateCommonCSS(
						'.search-wrap input::placeholder, .cm-search-icon-in-input-right .search-wrap i',
						'color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-search-icon-in-input-right .search-wrap i',
						'fill',
						value,
					);
					break;

				case 'colormag_header_search_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-top-search .search-form-top input,.search-wrap input, .cm-header-builder .cm-top-search .search-form-top',
						'background-color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .search-form-top.show::before',
						'border-bottom-color',
						value,
					);
					break;

				case 'colormag_header_random_icon_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-random-post .cm-icon--random-fill',
						'fill',
						value,
					);
					break;

				case 'colormag_header_search_button_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .fa.search-top, .cm-header-builder .search-wrap button',
						'background-color',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-header-builder .fa.search-top, .cm-header-builder .search-wrap button',
						'border-color',
						value,
					);
					break;

				case 'colormag_header_search_button_hover_background':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .fa.search-top:hover, .cm-header-builder .search-wrap button:hover',
						'background-color',
						value,
					);
					css += colormagGenerateCommonCSS(
						"'.cm-header-builder .fa.search-top:hover, .cm-header-builder .search-wrap button:hover'",
						'border-color',
						value,
					);
					break;

				case 'colormag_header_random_icon_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-random-post:hover > .cm-icon--random-fill',
						'fill',
						value,
					);
					break;

				case 'colormag_header_random_icon_size':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-random-post .cm-icon--random-fill',
						'font-size',
						value,
					);
					break;

				case 'colormag_header_home_icon_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-home-icon .cm-icon--home',
						'fill',
						value,
					);
					break;

				case 'colormag_footer_top_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-top-row',
						'height',
						value,
					);
					break;

				case 'colormag_footer_top_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-footer-top-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_footer_top_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-footer-builder .cm-footer-top-row',
						value,
					);
					break;

				case 'colormag_footer_top_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'padding',
						value,
					);
					break;

				case 'colormag_footer_top_area_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'margin',
						value,
					);
					break;

				case 'colormag_footer_top_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_footer_top_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_footer_main_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-main-row',
						'height',
						value,
					);
					break;

				case 'colormag_footer_main_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-footer-main-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_footer_main_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-footer-builder .cm-footer-main-row',
						value,
					);
					break;

				case 'colormag_footer_main_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'padding',
						value,
					);
					break;

				case 'colormag_footer_main_area_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'margin',
						value,
					);
					break;

				case 'colormag_footer_main_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_footer_main_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_height':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-bottom-row',
						'height',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_container':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-footer-bottom-row .cm-container',
						'max-width',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_padding':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						'padding',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						'margin',
						value,
					);
					break;

				case 'colormag_footer_bottom_area_border_width':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						'border-width',
						value,
					);
					css += colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						'border-style',
						'solid',
					);
					break;

				case 'colormag_footer_bottom_area_border_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-bottom-row',
						'border-color',
						value,
					);
					break;

				case 'colormag_site_title_color':
					css = colormagGenerateCommonCSS('.cm-site-title a', 'color', value);
					break;

				case 'colormag_site_title_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-site-title a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_site_title_typography':
					css = colormagGenerateTypographyCSS(id, '.cm-site-title', value);
					break;

				case 'colormag_site_tagline_color':
					css = colormagGenerateCommonCSS(
						'.cm-site-description',
						'color',
						value,
					);
					break;

				case 'colormag_site_tagline_color':
					css = colormagGenerateCommonCSS(
						'.cm-site-description',
						'color',
						value,
					);
					break;

				case 'colormag_site_tagline_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-site-description',
						value,
					);
					break;

				case 'colormag_widget_1_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_widget_1_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title',
						value,
					);
					break;

				case 'colormag_widget_1_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-colormag_header_sidebar',
						'color',
						value,
					);
					break;

				case 'colormag_widget_1_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-colormag_header_sidebar a',
						'color',
						value,
					);
					break;

				case 'colormag_widget_1_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .widget.widget-colormag_header_sidebar',
						value,
					);
					break;

				case 'colormag_widget_2_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_widget_2_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title',
						value,
					);
					break;

				case 'colormag_widget_2_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-header-sidebar-2',
						'color',
						value,
					);
					break;

				case 'colormag_widget_2_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .widget.widget-header-sidebar-2 a',
						'color',
						value,
					);
					break;

				case 'colormag_widget_2_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .widget.widget-header-sidebar-2',
						value,
					);
					break;

				case 'colormag_footer_top_area_widget_background':
					css = colormagGenerateBackgroundCSS(
						'.cm-footer-builder .cm-footer-top-row .widget',
						value,
					);
					break;

				case 'colormag_header_mobile_menu_background':
					css = colormagGenerateCommonCSS(
						'.cm-mobile-nav li',
						'background-color',
						value,
					);
					break;

				case 'colormag_footer_html_1_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-html-1 *',
						'color',
						value,
					);
					break;

				case 'colormag_footer_html_1_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-html-1 a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_html_1_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-html-1 a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_html_1_font_size':
					css = colormagGenerateSliderCSS(
						'.cm-footer-builder .cm-html-1 *',
						'font-size',
						value,
					);
					break;

				case 'colormag_footer_html_1_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-html-1',
						'margin',
						value,
					);
					break;

				case 'colormag_footer_widget_1_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_1_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_1_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_1_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_1_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_1_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper',
						value,
					);
					break;

				case 'colormag_footer_widget_2_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_2_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_2_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_2_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_2_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_2_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper',
						value,
					);
					break;

				case 'colormag_footer_widget_3_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_3_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_3_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_3_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_3_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_3_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper',
						value,
					);
					break;

				case 'colormag_footer_widget_4_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_4_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_4_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_4_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_4_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_4_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one',
						value,
					);
					break;

				case 'colormag_footer_widget_5_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_5_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_5_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_5_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_5_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_5_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two',
						value,
					);
					break;

				case 'colormag_footer_widget_6_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_6_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_6_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_6_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_6_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_6_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three',
						value,
					);
					break;

				case 'colormag_footer_widget_7_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_7_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title',
						value,
					);
					break;

				case 'colormag_footer_widget_7_content_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_7_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_7_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_widget_7_content_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four',
						value,
					);
					break;

				case 'colormag_footer_menu_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-nav ul li a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_menu_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-nav ul li a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_menu_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-builder .cm-footer-nav ul li a',
						value,
					);
					break;

				case 'colormag_footer_copyright_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-bar-area .cm-footer-bar__2, .cm-footer-builder .cm-copyright',
						'color',
						value,
					);
					break;

				case 'colormag_footer_copyright_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-copyright a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_copyright_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-copyright a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_copyright_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-footer-bar-area .cm-footer-bar__2, .cm-footer-builder .cm-copyright',
						value,
					);
					break;

				case 'colormag_footer_copyright_margin':
					css = colormagGenerateDimensionCSS(
						'.cm-footer-builder .cm-copyright',
						'margin',
						value,
					);
					break;

				case 'colormag_footer_copyright_link_text_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-bar-area .cm-footer-bar__2 a',
						'color',
						value,
					);
					break;

				case 'colormag_header_site_logo_height':
					css = colormagGenerateSliderCSS(
						'.cm-header-builder .cm-site-branding img',
						'width',
						value,
					);
					break;

				case 'colormag_header_site_identity_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-site-title a',
						'color',
						value,
					);
					break;

				case 'colormag_header_site_identity_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-site-title a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_header_site_title_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-site-title a',
						value,
					);
					break;

				case 'colormag_header_site_tagline_color':
					css = colormagGenerateCommonCSS(
						'.cm-header-builder .cm-site-description ',
						'color',
						value,
					);
					break;

				case 'colormag_header_site_tagline_typography':
					css = colormagGenerateTypographyCSS(
						id,
						'.cm-header-builder .cm-site-description ',
						value,
					);
					break;

				case 'colormag_footer_top_area_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-top-row',
						'color',
						value,
					);
					break;

				case 'colormag_footer_main_area_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row',
						'color',
						value,
					);
					break;

				case 'colormag_footer_main_area_link_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row a',
						'color',
						value,
					);
					break;

				case 'colormag_footer_main_area_link_hover_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row a:hover',
						'color',
						value,
					);
					break;

				case 'colormag_footer_main_area_widget_title_color':
					css = colormagGenerateCommonCSS(
						'.cm-footer-builder .cm-footer-main-row .widget-title, .cm-footer-builder .cm-footer-main-row h1, .cm-footer-builder .cm-footer-main-row h2, .cm-footer-builder .cm-footer-main-row h3, .cm-footer-builder .cm-footer-main-row h4, .cm-footer-builder .cm-footer-main-row h5, .cm-footer-builder .cm-footer-main-row h6',
						'color',
						value,
					);
					break;

				case 'colormag_footer_bottom_inner_element_layout':
					css = colormagElementLayoutCSS(
						'.cm-footer-builder .cm-footer-bottom-row .cm-footer-col',
						'flex-direction',
						value,
					);
					break;

				case 'colormag_footer_main_inner_element_layout':
					css = colormagElementLayoutCSS(
						'.cm-footer-builder .cm-footer-main-row .cm-footer-col',
						'flex-direction',
						value,
					);
					break;

				case 'colormag_footer_top_inner_element_layout':
					css = colormagElementLayoutCSS(
						'.cm-footer-builder .cm-footer-top-row .cm-footer-col',
						'flex-direction',
						value,
					);
					break;
			}
			return css;
		},
	);

	wp.hooks.addAction(
		'customind.change.colormag_color_palette',
		'customind',
		(...args) => {
			console.log(args);
		},
	);

	wp.hooks.addAction(
		'customind.change.colormag_container_layout',
		'customind',
		(layout) => {
			var site_layout = layout;

			if ('wide' === site_layout) {
				$('body').removeClass('boxed').addClass('wide');
			} else if ('boxed' === site_layout) {
				$('body').removeClass('wide').addClass('boxed');
			}
		},
	);

	wp.hooks.addAction(
		'customind.change.colormag_header_display_type',
		'customind',
		(layout) => {
			var display_type = layout;

			if (display_type === 'type_two') {
				$('body')
					.removeClass('header_display_type_two')
					.addClass('header_display_type_one');
			} else if (display_type === 'type_three') {
				$('body')
					.removeClass('header_display_type_one')
					.addClass('header_display_type_two');
			} else if (display_type === 'type_one') {
				$('body').removeClass(
					'header_display_type_one header_display_type_two',
				);
			}
		},
	);

	wp.hooks.addAction(
		'customind.change.colormag_footer_bar_alignment',
		'customind',
		(alignment) => {
			var alignment_type = alignment;

			if (alignment_type === 'left') {
				$('.cm-footer-bar')
					.removeClass('cm-footer-bar-style-2 cm-footer-bar-style-3')
					.addClass('cm-footer-bar-style-1');
			} else if (alignment_type === 'right') {
				$('.cm-footer-bar')
					.removeClass('cm-footer-bar-style-1 cm-footer-bar-style-3')
					.addClass('cm-footer-bar-style-2');
			} else if (alignment_type === 'center') {
				$('.cm-footer-bar')
					.removeClass('cm-footer-bar-style-1 cm-footer-bar-style-2')
					.addClass('cm-footer-bar-style-3');
			}
		},
	);

	wp.hooks.addAction(
		'customind.change.colormag_main_footer_layout',
		'customind',
		(layout) => {
			var display_type = layout;

			if (display_type === 'layout-2') {
				$('#cm-footer')
					.removeClass('colormag-footer--classic-bordered')
					.addClass('colormag-footer--classic');
			} else if (display_type === 'layout-3') {
				$('#cm-footer')
					.removeClass('colormag-footer--classic')
					.addClass('colormag-footer--classic-bordered');
			} else if (display_type === 'layout-1') {
				$('#cm-footer').removeClass(
					'colormag-footer--classic colormag-footer--classic-bordered',
				);
			}
		},
	);
})(jQuery);
