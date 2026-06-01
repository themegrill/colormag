<?php
/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_Builder_CSS
 *
 * @package ColorMag
 *
 * @since   ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_Builder_CSS
 */
class ColorMag_Dynamic_Builder_CSS {

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_builder_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		// Generate dynamic CSS.
		$parse_builder_css = $dynamic_css;

		$date_color = get_theme_mod( 'colormag_date_color', '' );

		$date_color_css     = array(
			'.cm-header-builder .date-in-header' => array(
				'color' => esc_html( $date_color ),
			),
		);
		$parse_builder_css .= colormag_parse_css( '', $date_color, $date_color_css );

		$date_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => 'px',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => 'px',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '-',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$date_typography         = get_theme_mod( 'colormag_date_typography', $date_typography_default );
		$parse_builder_css      .= colormag_parse_typography_css(
			$date_typography_default,
			$date_typography,
			'.cm-header-builder .date-in-header',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		$news_ticker_color = get_theme_mod( 'colormag_news_ticker_color', '' );

		$news_ticker_color_css = array(
			'.cm-header-builder .breaking-news-latest' => array(
				'color' => esc_html( $news_ticker_color ),
			),
		);
		$parse_builder_css    .= colormag_parse_css( '', $news_ticker_color, $news_ticker_color_css );

		$news_ticker_link_color     = get_theme_mod( 'colormag_news_ticker_link_color', '' );
		$news_ticker_link_color_css = array(
			'.cm-header-builder .newsticker li a' => array(
				'color' => esc_html( $news_ticker_link_color ),
			),
		);
		$parse_builder_css         .= colormag_parse_css( '', $news_ticker_link_color, $news_ticker_link_color_css );

		$news_ticker_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => 'px',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => 'px',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '-',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$news_ticker_typography         = get_theme_mod( 'colormag_news_ticker_typography', $news_ticker_typography_default );
		$parse_builder_css             .= colormag_parse_typography_css(
			$news_ticker_typography_default,
			$news_ticker_typography,
			'.cm-header-builder .breaking-news-latest',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		$news_ticker_link_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => 'px',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => 'px',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '-',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$news_ticker_link_typography         = get_theme_mod( 'colormag_news_ticker_typography', $news_ticker_link_typography_default );
		$parse_builder_css                  .= colormag_parse_typography_css(
			$news_ticker_link_typography_default,
			$news_ticker_link_typography,
			'.cm-header-builder .breaking-news ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header html 1 color.
		$header_html_1_text_color     = get_theme_mod( 'colormag_header_html_1_text_color', '' );
		$header_html_1_text_color_css = array(
			'.cm-header-builder .cm-html-1 *' => array(
				'color' => esc_html( $header_html_1_text_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_html_1_text_color, $header_html_1_text_color_css );

		// Header html 1 link color.
		$header_html_1_link_color     = get_theme_mod( 'colormag_header_html_1_link_color', '' );
		$header_html_1_link_color_css = array(
			'.cm-header-builder .cm-html-1 a' => array(
				'color' => esc_html( $header_html_1_link_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_html_1_link_color, $header_html_1_link_color_css );

		// Header html 1 link hover color.
		$header_html_1_link_hover_color     = get_theme_mod( 'colormag_header_html_1_link_hover_color', '' );
		$header_html_1_link_hover_color_css = array(
			'.cm-header-builder .cm-html-1 a:hover' => array(
				'color' => esc_html( $header_html_1_link_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $header_html_1_link_hover_color, $header_html_1_link_hover_color_css );

		// Header html 1 font size.
		$header_html_1_font_size_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$header_html_1_font_size = get_theme_mod( 'colormag_header_html_1_font_size', $header_html_1_font_size_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_html_1_font_size_default,
			$header_html_1_font_size,
			'.cm-header-builder .cm-html-1 *',
			'font-size'
		);

		// Header html 1 margin.
		$header_html_1_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_html_1_margin = get_theme_mod( 'colormag_header_html_1_margin', $header_html_1_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_html_1_margin_default,
			$header_html_1_margin,
			'.cm-header-builder .cm-html-1',
			'margin'
		);

		// Header button text color.
		$header_button_text_color     = get_theme_mod( 'colormag_header_button_color', '#ffffff' );
		$header_button_text_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'color' => esc_html( $header_button_text_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '#ffffff', $header_button_text_color, $header_button_text_color_css );

		// Header button hover text color.
		$header_button_hover_text_color     = get_theme_mod( 'colormag_header_button_hover_color', '#ffffff' );
		$header_button_hover_text_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover' => array(
				'color' => esc_html( $header_button_hover_text_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '#ffffff', $header_button_hover_text_color, $header_button_hover_text_color_css );

		// Header background color.
		$header_button_background_color     = get_theme_mod( 'colormag_header_button_background_color', '#027abb' );
		$header_button_background_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'background-color' => esc_html( $header_button_background_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '#027abb', $header_button_background_color, $header_button_background_color_css );

		// Header button hover background color.
		$header_button_background_hover_color     = get_theme_mod( 'colormag_header_button_background_hover_color', '' );
		$header_button_background_hover_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover' => array(
				'background-color' => esc_html( $header_button_background_hover_color ),
			),
		);
		$parse_builder_css                       .= colormag_parse_css( '#ffffff', $header_button_background_hover_color, $header_button_background_hover_color_css );

		// Header button padding.
		$header_button_padding_default = array(
			'top'    => '5',
			'right'  => '10',
			'bottom' => '5',
			'left'   => '10',
			'unit'   => 'px',
		);

		$header_button_padding = get_theme_mod( 'colormag_header_button_padding', $header_button_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_button_padding_default,
			$header_button_padding,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'padding'
		);

		// Header button border width.
		$header_button_border_width_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_button_border_width = get_theme_mod( 'colormag_header_button_border_width', $header_button_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_button_border_width_default,
			$header_button_border_width,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'border-width'
		);

		// Header button border color.
		$header_button_border_color     = get_theme_mod( 'colormag_header_button_border_color', '' );
		$header_button_border_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'border-color' => esc_html( $header_button_border_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $header_button_border_color, $header_button_border_color_css );

		// Search border color.
		$full_search_border_color     = get_theme_mod( 'colormag_header_search_border_color', '' );
		$full_search_border_color_css = array(
			'.cm-search-icon-in-input-right .search-wrap input' => array(
				'border-color' => esc_html( $full_search_border_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $full_search_border_color, $full_search_border_color_css );

		// Header button radius.
		$header_button_border_radius_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_button_border_radius = get_theme_mod( 'colormag_header_button_border_radius', $header_button_border_radius_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_button_border_radius_default,
			$header_button_border_radius,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'border-radius'
		);

		// Full Search border radius.
		$full_search_border_radius_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$header_button_border_radius = get_theme_mod( 'colormag_header_search_border_radius', $full_search_border_radius_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$full_search_border_radius_default,
			$header_button_border_radius,
			'.cm-search-icon-in-input-right .search-wrap input',
			'border-radius'
		);

		// Newsticker width.
		$news_ticker_width_default = array(
			'size' => 240,
			'unit' => 'px',
		);

		$news_ticker_width = get_theme_mod( 'colormag_news_ticker_width', $news_ticker_width_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$news_ticker_width_default,
			$news_ticker_width,
			'.cm-header-builder .newsticker',
			'width'
		);

		/**
		 * Header top area height.
		 */
		$header_top_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_top_area_height = get_theme_mod( 'colormag_header_top_area_height', $header_top_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_top_area_height_default,
			$header_top_area_height,
			'.cm-header-builder .cm-top-row',
			'height'
		);

		/**
		 * Header top area container.
		 */
		$header_top_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_top_area_container = get_theme_mod( 'colormag_header_top_area_container', $header_top_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_top_area_container_default,
			$header_top_area_container,
			'.cm-header-builder .cm-header-top-row .cm-container',
			'max-width'
		);

		// Header top area background.
		$header_top_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_top_area_background         = get_theme_mod( 'colormag_header_top_area_background', $header_top_area_background_default );
		$parse_builder_css                 .= colormag_parse_background_css( $header_top_area_background_default, $header_top_area_background, '.cm-header-builder .cm-header-top-row' );

		// Header top area padding.
		$header_top_area_padding_default = array(
			'top'    => '14',
			'right'  => '0',
			'bottom' => '14',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_top_area_padding = get_theme_mod( 'colormag_header_top_area_padding', $header_top_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_top_area_padding_default,
			$header_top_area_padding,
			'.cm-header-builder .cm-header-top-row',
			'padding'
		);

		// Header top area border width.
		$header_top_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_top_area_border_width = get_theme_mod( 'colormag_header_top_area_border_width', $header_top_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_top_area_border_width_default,
			$header_top_area_border_width,
			'.cm-header-builder .cm-header-top-row',
			'border-width'
		);

		$header_top_area_border_color     = get_theme_mod( 'colormag_header_top_area_border_color', '#FAFAFA' );
		$header_top_area_border_color_css = array(
			'.cm-header-builder .cm-header-top-row' => array(
				'border-color' => esc_html( $header_top_area_border_color ),
			),
		);
		$parse_builder_css               .= colormag_parse_css( '#FAFAFA', $header_top_area_border_color, $header_top_area_border_color_css );

		// Header top area color.
		$header_top_area_color     = get_theme_mod( 'colormag_header_top_area_color', '' );
		$header_top_area_color_css = array(
			'.cm-header-builder .cm-header-top-row' => array(
				'color' => esc_html( $header_top_area_color ),
			),
		);
		$parse_builder_css        .= colormag_parse_css( '', $header_top_area_color, $header_top_area_color_css );

		/**
		 * Header main area height.
		 */
		$header_main_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_main_area_height = get_theme_mod( 'colormag_header_main_area_height', $header_main_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_main_area_height_default,
			$header_main_area_height,
			'.cm-header-builder .cm-main-row',
			'height'
		);

		/**
		 * Header main area container.
		 */
		$header_main_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_main_area_container = get_theme_mod( 'colormag_header_main_area_container', $header_main_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_main_area_container_default,
			$header_main_area_container,
			'.cm-header-builder .cm-header-main-row .cm-container',
			'max-width'
		);

		// Header main area background.
		$header_main_area_background_default = array(
			'background-color'      => '#FAFAFA',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_main_area_background         = get_theme_mod( 'colormag_header_main_area_background', $header_main_area_background_default );
		$parse_builder_css                  .= colormag_parse_background_css( $header_main_area_background_default, $header_main_area_background, '.cm-header-builder .cm-header-main-row' );

		// Header main area padding.
		$header_main_area_padding_default = array(
			'top'    => '20',
			'right'  => '20',
			'bottom' => '20',
			'left'   => '20',
			'unit'   => 'px',
		);

		$header_main_area_padding = get_theme_mod( 'colormag_header_main_area_padding', $header_main_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_padding_default,
			$header_main_area_padding,
			'.cm-header-builder .cm-header-main-row',
			'padding'
		);

		// Header main area padding.
		$header_main_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_main_area_margin = get_theme_mod( 'colormag_header_main_area_margin', $header_main_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_margin_default,
			$header_main_area_margin,
			'.cm-header-builder .cm-header-main-row',
			'margin'
		);

		// Header main area padding.
		$header_main_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '1',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_main_area_border_width = get_theme_mod( 'colormag_header_main_area_border_width', $header_main_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_border_width_default,
			$header_main_area_border_width,
			'.cm-header-builder .cm-header-main-row',
			'border-width'
		);

		$header_main_area_border_color     = get_theme_mod( 'colormag_header_main_area_border_color', '#E4E4E7' );
		$header_main_area_border_color_css = array(
			'.cm-header-builder .cm-header-main-row' => array(
				'border-color' => esc_html( $header_main_area_border_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '#E4E4E7', $header_main_area_border_color, $header_main_area_border_color_css );

		$header_main_area_color     = get_theme_mod( 'colormag_header_main_area_color', '' );
		$header_main_area_color_css = array(
			'.cm-header-builder .cm-header-main-row' => array(
				'color' => esc_html( $header_main_area_color ),
			),
		);
		$parse_builder_css         .= colormag_parse_css( '', $header_main_area_color, $header_main_area_color_css );

		/**
		 * Header bottom area height.
		 */
		$header_bottom_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_bottom_area_height = get_theme_mod( 'colormag_header_bottom_area_height', $header_bottom_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_bottom_area_height_default,
			$header_bottom_area_height,
			'.cm-header-builder .cm-bottom-row',
			'height'
		);

		/**
		 * Header bottom area container.
		 */
		$header_bottom_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_bottom_area_container = get_theme_mod( 'colormag_header_bottom_area_container', $header_bottom_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_bottom_area_container_default,
			$header_bottom_area_container,
			'.cm-header-builder .cm-header-bottom-row .cm-container',
			'max-width'
		);

		// Header bottom area background.
		$header_bottom_area_width = get_theme_mod( 'colormag_main_header_width_setting', 'full-width' );
		if ( 'contained' === $header_bottom_area_width ) {
			$bottom_header_background_selector = '.cm-header-builder.cm-contained .cm-header-bottom-row .cm-container .cm-bottom-row, .cm-header-builder.cm-contained .cm-mobile-row .cm-header-bottom-row';
		} else {
			$bottom_header_background_selector = '.cm-header-builder.cm-full-width .cm-desktop-row.cm-main-header .cm-header-bottom-row, .cm-header-builder.cm-full-width .cm-mobile-row .cm-header-bottom-row';
		}

		$header_bottom_area_background_default = array(
			'background-color'      => '#27272A',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_bottom_area_background         = get_theme_mod( 'colormag_header_bottom_area_background', $header_bottom_area_background_default );
		if (
			is_array( $header_bottom_area_background ) &&
			isset( $header_bottom_area_background['background-color'] ) &&
			strpos( $header_bottom_area_background['background-color'], 'var(--cm-color' ) === 0
		) {
			$header_bottom_area_background['background-color'] = 'var(--cm-color, #27272A)';
		}
		$parse_builder_css .= colormag_parse_background_css( $header_bottom_area_background_default, $header_bottom_area_background, $bottom_header_background_selector );

		// Header bottom area padding.
		$header_bottom_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_bottom_area_padding = get_theme_mod( 'colormag_header_bottom_area_padding', $header_bottom_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_padding_default,
			$header_bottom_area_padding,
			$bottom_header_background_selector,
			'padding'
		);

		// Header bottom area padding.
		$header_bottom_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_bottom_area_margin = get_theme_mod( 'colormag_header_bottom_area_margin', $header_bottom_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_margin_default,
			$header_bottom_area_margin,
			$bottom_header_background_selector,
			'margin'
		);

		// Header bottom area padding.
		$header_bottom_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_bottom_area_border_width = get_theme_mod( 'colormag_header_bottom_area_border_width', $header_bottom_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_border_width_default,
			$header_bottom_area_border_width,
			$bottom_header_background_selector,
			'border-width'
		);

		$header_bottom_area_border_color     = get_theme_mod( 'colormag_header_bottom_area_border_color', '' );
		$header_bottom_area_border_color_css = array(
			$bottom_header_background_selector => array(
				'border-color' => esc_html( $header_bottom_area_border_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $header_bottom_area_border_color, $header_bottom_area_border_color_css );

		// Header bottom area color.
		$header_bottom_area_color     = get_theme_mod( 'colormag_header_bottom_area_color', '' );
		$header_bottom_area_color_css = array(
			$bottom_header_background_selector => array(
				'color' => esc_html( $header_bottom_area_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_bottom_area_color, $header_bottom_area_color_css );

		$header_primary_menu_text_color     = get_theme_mod( 'colormag_header_primary_menu_text_color', '' );
		$header_primary_menu_text_color_css = array(
			'.cm-header-builder .cm-primary-nav ul li a' => array(
				'color' => esc_html( $header_primary_menu_text_color ),
			),
			'.cm-header-builder .cm-primary-nav .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_primary_menu_text_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $header_primary_menu_text_color, $header_primary_menu_text_color_css );

		$header_primary_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_header_primary_menu_selected_hovered_text_color', '' );
		$header_primary_menu_selected_hovered_text_color_css = array(
			'.cm-header-builder .cm-primary-nav ul li:hover > a' => array(
				'color' => esc_html( $header_primary_menu_selected_hovered_text_color ),
			),
			'.cm-header-builder .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_primary_menu_selected_hovered_text_color ),
			),
		);
		$parse_builder_css                                  .= colormag_parse_css( '', $header_primary_menu_selected_hovered_text_color, $header_primary_menu_selected_hovered_text_color_css );

		$header_primary_menu_active_text_color     = get_theme_mod( 'colormag_header_primary_menu_active_text_color', '' );
		$header_primary_menu_active_text_color_css = array(
			'.cm-header-builder .cm-primary-nav ul li.current-menu-item > a' => array(
				'color' => esc_html( $header_primary_menu_active_text_color ),
			),
			'.cm-header-builder .cm-primary-nav li.current-menu-item > .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_primary_menu_active_text_color ),
			),
		);
		$parse_builder_css                        .= colormag_parse_css( '', $header_primary_menu_active_text_color, $header_primary_menu_active_text_color_css );

		$header_primary_menu_selected_hover_bg     = get_theme_mod( 'colormag_header_primary_menu_hover_background', '' );
		$header_primary_menu_selected_hover_bg_css = array(
			'.cm-header-builder .cm-primary-nav ul li:hover' => array(
				'background' => esc_html( $header_primary_menu_selected_hover_bg ),
			),
		);
		$parse_builder_css                        .= colormag_parse_css( '', $header_primary_menu_selected_hover_bg, $header_primary_menu_selected_hover_bg_css );

		$header_primary_menu_selected_active_bg     = get_theme_mod( 'colormag_header_primary_menu_active_background', '' );
		$header_primary_menu_selected_active_bg_css = array(
			'.cm-header-builder .cm-primary-nav ul li.current-menu-item' => array(
				'background' => esc_html( $header_primary_menu_selected_active_bg ),
			),
		);
		$parse_builder_css                         .= colormag_parse_css( '', $header_primary_menu_selected_active_bg, $header_primary_menu_selected_active_bg_css );

		$header_primary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$header_primary_sub_menu_background         = get_theme_mod( 'colormag_header_primary_sub_menu_background', $header_primary_sub_menu_background_default );
		$parse_builder_css                         .= colormag_parse_background_css( $header_primary_sub_menu_background_default, $header_primary_sub_menu_background, '.cm-header-builder .cm-primary-nav .sub-menu, .cm-header-builder .cm-primary-nav .children' );

		$header_primary_menu_typography_default     = array(
			'font-family' => 'default',
			'font-weight' => '600',
			'font-size'   => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$header_primary_sub_menu_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$header_primary_menu_typography             = get_theme_mod( 'colormag_header_primary_menu_typography', $header_primary_menu_typography_default );
		$header_primary_sub_menu_typography         = get_theme_mod( 'colormag_header_primary_sub_menu_typography', $header_primary_sub_menu_typography_default );

		// Primary menu typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_primary_menu_typography_default,
			$header_primary_menu_typography,
			'.cm-header-builder .cm-primary-nav > ul > li > a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Primary sub menu typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_primary_sub_menu_typography_default,
			$header_primary_sub_menu_typography,
			'.cm-header-builder .cm-primary-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Secondary menu.
		$header_secondary_menu_text_color     = get_theme_mod( 'colormag_header_secondary_menu_text_color', '' );
		$header_secondary_menu_text_color_css = array(
			'.cm-header-builder .cm-secondary-nav ul li a' => array(
				'color' => esc_html( $header_secondary_menu_text_color ),
			),
			'.cm-header-builder .cm-secondary-nav ul li .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_secondary_menu_text_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $header_secondary_menu_text_color, $header_secondary_menu_text_color_css );

		$header_secondary_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_header_secondary_menu_selected_hovered_text_color', '' );
		$header_secondary_menu_selected_hovered_text_color_css = array(
			'.cm-header-builder .cm-secondary-nav ul li:hover > a' => array(
				'color' => esc_html( $header_secondary_menu_selected_hovered_text_color ),
			),
			'.cm-header-builder .cm-secondary-nav ul li:hover > .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_secondary_menu_selected_hovered_text_color ),
			),
		);
		$parse_builder_css                                    .= colormag_parse_css( '', $header_secondary_menu_selected_hovered_text_color, $header_secondary_menu_selected_hovered_text_color_css );

		$header_secondary_menu_selected_hover_bg     = get_theme_mod( 'colormag_header_secondary_menu_hover_background', '' );
		$header_secondary_menu_selected_hover_bg_css = array(
			'.cm-header-builder .cm-secondary-nav ul li:hover' => array(
				'color' => esc_html( $header_secondary_menu_selected_hover_bg ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $header_secondary_menu_selected_hover_bg, $header_secondary_menu_selected_hover_bg_css );

		$header_secondary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$header_secondary_sub_menu_background         = get_theme_mod( 'colormag_header_secondary_sub_menu_background', $header_secondary_sub_menu_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $header_secondary_sub_menu_background_default, $header_secondary_sub_menu_background, '.cm-header-builder nav.cm-secondary-nav ul.sub-menu, .cm-header-builder .cm-secondary-nav .children' );

		$header_secondary_menu_typography_default     = array(
			'font-family' => 'default',
			'font-weight' => '600',
			'font-size'   => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$header_secondary_sub_menu_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);

		// secondary menu typography.
		$header_secondary_menu_typography = get_theme_mod( 'colormag_header_secondary_menu_typography', $header_secondary_menu_typography_default );
		$parse_builder_css               .= colormag_parse_typography_css(
			$header_secondary_menu_typography_default,
			$header_secondary_menu_typography,
			'.cm-header-builder .cm-secondary-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// secondary sub menu typography.
		$header_secondary_sub_menu_typography = get_theme_mod( 'colormag_header_secondary_sub_menu_typography', $header_secondary_sub_menu_typography_default );
		$parse_builder_css                   .= colormag_parse_typography_css(
			$header_secondary_sub_menu_typography_default,
			$header_secondary_sub_menu_typography,
			'.cm-header-builder .cm-secondary-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header search icon color.
		$header_search_icon_color     = get_theme_mod( 'colormag_header_search_icon_color', '' );
		$header_search_icon_color_css = array(
			'.cm-header-builder .cm-top-search .search-top::before' => array(
				'color' => esc_html( $header_search_icon_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_search_icon_color, $header_search_icon_color_css );

		// Header search icon hover color.
		$header_search_icon_hover_color     = get_theme_mod( 'colormag_header_search_icon_hover_color', '' );
		$header_search_icon_hover_color_css = array(
			'.cm-header-builder .cm-top-search:hover > .search-top::before' => array(
				'color' => esc_html( $header_search_icon_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $header_search_icon_hover_color, $header_search_icon_hover_color_css );

		// Header search text color.
		$header_search_text_color     = get_theme_mod( 'colormag_header_search_text_color', '' );
		$header_search_text_color_css = array(
			'.cm-header-builder .cm-top-search .search-form-top input' => array(
				'color' => esc_html( $header_search_text_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_search_text_color, $header_search_text_color_css );

		// Header search placeholder color.
		$header_search_placeholder_color     = get_theme_mod( 'colormag_header_search_placeholder_color', '' );
		$header_search_placeholder_color_css = array(
			'.search-wrap input::placeholder, .cm-search-icon-in-input-right .search-wrap i' => array(
				'color' => esc_html( $header_search_placeholder_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $header_search_placeholder_color, $header_search_placeholder_color_css );

		$header_search_placeholder_color_css = array(
			'.cm-search-icon-in-input-right .search-wrap i' => array(
				'fill' => esc_html( $header_search_placeholder_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $header_search_placeholder_color, $header_search_placeholder_color_css );

		// Social icon color.
		$social_icon_color     = get_theme_mod( 'colormag_header_socials_color', '' );
		$social_icon_color_css = array(
			'.cm-header-builder .header-social-icons a' => array(
				'color' => esc_html( $social_icon_color ),
			),
		);
		$parse_builder_css    .= colormag_parse_css( '', $social_icon_color, $social_icon_color_css );

		// Header search background color.
		$header_search_background     = get_theme_mod( 'colormag_header_search_background', '' );
		$header_search_background_css = array(
			'.cm-header-builder .cm-top-search .search-form-top input, .cm-header-builder .cm-top-search .search-form-top, .cm-search-icon-in-input-right .search-wrap input' => array(
				'background-color' => esc_html( $header_search_background ),
			),
			'.cm-header-builder .search-form-top.show::before' => array(
				'border-bottom-color' => esc_html( $header_search_background ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_search_background, $header_search_background_css );

		// Header builder widget title color.
		$header_widget_title_color     = get_theme_mod( 'colormag_widget_1_title_color', '' );
		$header_widget_title_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title' => array(
				'color' => esc_html( $header_widget_title_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_widget_title_color, $header_widget_title_color_css );

		// Header builder widget content color.
		$header_widget_content_color     = get_theme_mod( 'colormag_widget_1_content_color', '' );
		$header_widget_content_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar' => array(
				'color' => esc_html( $header_widget_content_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $header_widget_content_color, $header_widget_content_color_css );

		// Header builder widget link color.
		$header_widget_link_color     = get_theme_mod( 'colormag_widget_1_link_color', '' );
		$header_widget_link_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar a' => array(
				'color' => esc_html( $header_widget_link_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_widget_link_color, $header_widget_link_color_css );

		// Header builder widget title typography.
		$header_widget_1_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_1_title_typography = get_theme_mod( 'colormag_widget_1_title_typography', $header_widget_1_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_1_title_typography_default,
			$header_widget_1_title_typography,
			'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget content typography.
		$header_widget_1_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_1_content_typography = get_theme_mod( 'colormag_widget_1_content_typography', $header_widget_1_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_1_content_typography_default,
			$header_widget_1_content_typography,
			'.cm-header-builder .widget.widget-colormag_header_sidebar',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget 2 title color.
		$header_widget_2_title_color     = get_theme_mod( 'colormag_widget_2_title_color', '' );
		$header_widget_2_title_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title' => array(
				'color' => esc_html( $header_widget_2_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $header_widget_2_title_color, $header_widget_2_title_color_css );

		// Header builder widget 2 content color.
		$header_widget_2_content_color     = get_theme_mod( 'colormag_widget_2_content_color', '' );
		$header_widget_2_content_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2' => array(
				'color' => esc_html( $header_widget_2_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $header_widget_2_content_color, $header_widget_2_content_color_css );

		// Header builder widget 2 link color.
		$header_widget_2_link_color     = get_theme_mod( 'colormag_widget_2_link_color', '' );
		$header_widget_2_link_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2 a' => array(
				'color' => esc_html( $header_widget_2_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $header_widget_2_link_color, $header_widget_2_link_color_css );

		// Header builder widget title typography.
		$header_widget_2_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_2_title_typography = get_theme_mod( 'colormag_widget_2_title_typography', $header_widget_2_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_2_title_typography_default,
			$header_widget_2_title_typography,
			'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget content typography.
		$header_widget_2_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_2_content_typography = get_theme_mod( 'colormag_widget_2_content_typography', $header_widget_2_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_2_content_typography_default,
			$header_widget_2_content_typography,
			'.cm-header-builder .widget.widget-header-sidebar-2',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header random icon color.
		$header_random_icon_color     = get_theme_mod( 'colormag_header_random_icon_color', '' );
		$header_random_icon_color_css = array(
			'.cm-header-builder .cm-random-post .cm-icon--random-fill' => array(
				'fill' => esc_html( $header_random_icon_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_random_icon_color, $header_random_icon_color_css );

		// Header random icon hover color.
		$header_random_icon_hover_color     = get_theme_mod( 'colormag_header_random_icon_hover_color', '' );
		$header_random_icon_hover_color_css = array(
			'.cm-header-builder .cm-random-post:hover .cm-icon--random-fill' => array(
				'fill' => esc_html( $header_random_icon_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $header_random_icon_hover_color, $header_random_icon_hover_color_css );

		// Header random icon size default.
		$header_random_icon_size_default = array(
			'size' => '',
			'unit' => 'px',
		);
		// Header random icon size.
		$header_random_icon_size = get_theme_mod( 'colormag_header_random_icon_size', $header_random_icon_size_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_random_icon_size_default,
			$header_random_icon_size,
			'.cm-header-builder .cm-random-post .cm-icon--random-fill',
			'font-size'
		);

		// Header home icon color.
		$header_random_icon_color     = get_theme_mod( 'colormag_header_home_icon_color', '' );
		$header_random_icon_color_css = array(
			'.cm-header-builder .cm-home-icon .cm-icon--home' => array(
				'fill' => esc_html( $header_random_icon_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_random_icon_color, $header_random_icon_color_css );

		// Footer builder widget title color.
		$footer_widget_title_color     = get_theme_mod( 'colormag_footer_widget_1_title_color', '' );
		$footer_widget_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_title_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $footer_widget_title_color, $footer_widget_title_color_css );

		// Footer builder widget content color.
		$footer_widget_content_color     = get_theme_mod( 'colormag_footer_widget_1_content_color', '' );
		$footer_widget_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper' => array(
				'color' => esc_html( $footer_widget_content_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_content_color, $footer_widget_content_color_css );

		// Footer builder widget link color.
		$footer_widget_link_color     = get_theme_mod( 'colormag_footer_widget_1_link_color', '' );
		$footer_widget_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a' => array(
				'color' => esc_html( $footer_widget_link_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $footer_widget_link_color, $footer_widget_link_color_css );

		// Footer builder widget link hover color.
		$footer_widget_link_hover_color     = get_theme_mod( 'colormag_footer_widget_1_link_hover_color', '' );
		$footer_widget_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a:hover' => array(
				'color' => esc_html( $footer_widget_link_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $footer_widget_link_hover_color, $footer_widget_link_hover_color_css );

		// Footer builder widget title typography.
		$footer_widget_1_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_1_title_typography         = get_theme_mod( 'colormag_footer_widget_1_title_typography', $footer_widget_1_title_typography_default );
		$parse_builder_css                       .= colormag_parse_typography_css(
			$footer_widget_1_title_typography_default,
			$footer_widget_1_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget content typography.
		$footer_widget_1_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_1_content_typography         = get_theme_mod( 'colormag_footer_widget_1_content_typography', $footer_widget_1_content_typography_default );
		$parse_builder_css                         .= colormag_parse_typography_css(
			$footer_widget_1_content_typography_default,
			$footer_widget_1_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 2 title color.
		$footer_widget_2_title_color     = get_theme_mod( 'colormag_footer_widget_2_title_color', '' );
		$footer_widget_2_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_2_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_2_title_color, $footer_widget_2_title_color_css );

		// Footer builder widget 2 content color.
		$footer_widget_2_content_color     = get_theme_mod( 'colormag_footer_widget_2_content_color', '' );
		$footer_widget_2_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper' => array(
				'color' => esc_html( $footer_widget_2_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_2_content_color, $footer_widget_2_content_color_css );

		// Footer builder widget 2 link color.
		$footer_widget_2_link_color     = get_theme_mod( 'colormag_footer_widget_2_link_color', '' );
		$footer_widget_2_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a' => array(
				'color' => esc_html( $footer_widget_2_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_2_link_color, $footer_widget_2_link_color_css );

		// Footer builder widget 2 link hover color.
		$footer_widget_2_link_hover_color     = get_theme_mod( 'colormag_footer_widget_2_link_hover_color', '' );
		$footer_widget_2_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a:hover' => array(
				'color' => esc_html( $footer_widget_2_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_2_link_hover_color, $footer_widget_2_link_hover_color_css );

		// Footer builder widget 2 title typography.
		$footer_widget_2_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_2_title_typography         = get_theme_mod( 'colormag_footer_widget_2_title_typography', $footer_widget_2_title_typography_default );
		$parse_builder_css                       .= colormag_parse_typography_css(
			$footer_widget_2_title_typography_default,
			$footer_widget_2_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 2 content typography.
		$footer_widget_2_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_2_content_typography         = get_theme_mod( 'colormag_footer_widget_2_content_typography', $footer_widget_2_content_typography_default );
		$parse_builder_css                         .= colormag_parse_typography_css(
			$footer_widget_2_content_typography_default,
			$footer_widget_2_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 3 title color.
		$footer_widget_3_title_color     = get_theme_mod( 'colormag_footer_widget_3_title_color', '' );
		$footer_widget_3_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_3_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_3_title_color, $footer_widget_3_title_color_css );

		// Footer builder widget 3 content color.
		$footer_widget_3_content_color     = get_theme_mod( 'colormag_footer_widget_3_content_color', '' );
		$footer_widget_3_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper' => array(
				'color' => esc_html( $footer_widget_3_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_3_content_color, $footer_widget_3_content_color_css );

		// Footer builder widget 3 link color.
		$footer_widget_3_link_color     = get_theme_mod( 'colormag_footer_widget_3_link_color', '' );
		$footer_widget_3_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a' => array(
				'color' => esc_html( $footer_widget_3_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_3_link_color, $footer_widget_3_link_color_css );

		// Footer builder widget 3 link hover color.
		$footer_widget_3_link_hover_color     = get_theme_mod( 'colormag_footer_widget_3_link_hover_color', '' );
		$footer_widget_3_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a:hover' => array(
				'color' => esc_html( $footer_widget_3_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_3_link_hover_color, $footer_widget_3_link_hover_color_css );

		// Footer builder widget 3 title typography.
		$footer_widget_3_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '3',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_3_title_typography = get_theme_mod( 'colormag_footer_widget_3_title_typography', $footer_widget_3_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_3_title_typography_default,
			$footer_widget_3_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 3 content typography.
		$footer_widget_3_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '3',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_3_content_typography = get_theme_mod( 'colormag_footer_widget_3_content_typography', $footer_widget_3_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_3_content_typography_default,
			$footer_widget_3_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 4 title color.
		$footer_widget_4_title_color     = get_theme_mod( 'colormag_footer_widget_4_title_color', '' );
		$footer_widget_4_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title' => array(
				'color' => esc_html( $footer_widget_4_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_4_title_color, $footer_widget_4_title_color_css );

		// Footer builder widget 4 content color.
		$footer_widget_4_content_color     = get_theme_mod( 'colormag_footer_widget_4_content_color', '' );
		$footer_widget_4_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one' => array(
				'color' => esc_html( $footer_widget_4_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_4_content_color, $footer_widget_4_content_color_css );

		// Footer builder widget 4 link color.
		$footer_widget_4_link_color     = get_theme_mod( 'colormag_footer_widget_4_link_color', '' );
		$footer_widget_4_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a' => array(
				'color' => esc_html( $footer_widget_4_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_4_link_color, $footer_widget_4_link_color_css );

		// Footer builder widget 4 link hover color.
		$footer_widget_4_link_hover_color     = get_theme_mod( 'colormag_footer_widget_4_link_hover_color', '' );
		$footer_widget_4_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a:hover' => array(
				'color' => esc_html( $footer_widget_4_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_4_link_hover_color, $footer_widget_4_link_hover_color_css );

		// Footer builder widget 4 title typography.
		$footer_widget_4_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_4_title_typography = get_theme_mod( 'colormag_footer_widget_4_title_typography', $footer_widget_4_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_4_title_typography_default,
			$footer_widget_4_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 4 content typography.
		$footer_widget_4_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_4_content_typography = get_theme_mod( 'colormag_footer_widget_4_content_typography', $footer_widget_4_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_4_content_typography_default,
			$footer_widget_4_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 5 title color.
		$footer_widget_5_title_color     = get_theme_mod( 'colormag_footer_widget_5_title_color', '' );
		$footer_widget_5_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title' => array(
				'color' => esc_html( $footer_widget_5_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_5_title_color, $footer_widget_5_title_color_css );

		// Footer builder widget 5 content color.
		$footer_widget_5_content_color     = get_theme_mod( 'colormag_footer_widget_5_content_color', '' );
		$footer_widget_5_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two' => array(
				'color' => esc_html( $footer_widget_5_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_5_content_color, $footer_widget_5_content_color_css );

		// Footer builder widget 5 link color.
		$footer_widget_5_link_color     = get_theme_mod( 'colormag_footer_widget_5_link_color', '' );
		$footer_widget_5_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a' => array(
				'color' => esc_html( $footer_widget_5_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_5_link_color, $footer_widget_5_link_color_css );

		// Footer builder widget 5 link hover color.
		$footer_widget_5_link_hover_color     = get_theme_mod( 'colormag_footer_widget_5_link_hover_color', '' );
		$footer_widget_5_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a:hover' => array(
				'color' => esc_html( $footer_widget_5_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_5_link_hover_color, $footer_widget_5_link_hover_color_css );

		// Footer builder widget 5 title typography.
		$footer_widget_5_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '5',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_5_title_typography         = get_theme_mod( 'colormag_footer_widget_5_title_typography', $footer_widget_5_title_typography_default );
		$parse_builder_css                       .= colormag_parse_typography_css(
			$footer_widget_5_title_typography_default,
			$footer_widget_5_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 5 content typography.
		$footer_widget_5_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '5',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_5_content_typography         = get_theme_mod( 'colormag_footer_widget_5_content_typography', $footer_widget_5_content_typography_default );
		$parse_builder_css                         .= colormag_parse_typography_css(
			$footer_widget_5_content_typography_default,
			$footer_widget_5_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 6 title color.
		$footer_widget_6_title_color     = get_theme_mod( 'colormag_footer_widget_6_title_color', '' );
		$footer_widget_6_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title' => array(
				'color' => esc_html( $footer_widget_6_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_6_title_color, $footer_widget_6_title_color_css );

		// Footer builder widget 6 content color.
		$footer_widget_6_content_color     = get_theme_mod( 'colormag_footer_widget_6_content_color', '' );
		$footer_widget_6_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three' => array(
				'color' => esc_html( $footer_widget_6_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_6_content_color, $footer_widget_6_content_color_css );

		// Footer builder widget 6 link color.
		$footer_widget_6_link_color     = get_theme_mod( 'colormag_footer_widget_6_link_color', '' );
		$footer_widget_6_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a' => array(
				'color' => esc_html( $footer_widget_6_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_6_link_color, $footer_widget_6_link_color_css );

		// Footer builder widget 6 link hover color.
		$footer_widget_6_link_hover_color     = get_theme_mod( 'colormag_footer_widget_6_link_hover_color', '' );
		$footer_widget_6_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a:hover' => array(
				'color' => esc_html( $footer_widget_6_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_6_link_hover_color, $footer_widget_6_link_hover_color_css );

		// Footer builder widget 6 title typography.
		$footer_widget_6_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_6_title_typography         = get_theme_mod( 'colormag_footer_widget_6_title_typography', $footer_widget_6_title_typography_default );
		$parse_builder_css                       .= colormag_parse_typography_css(
			$footer_widget_6_title_typography_default,
			$footer_widget_6_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 6 content typography.
		$footer_widget_6_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_6_content_typography         = get_theme_mod( 'colormag_footer_widget_6_content_typography', $footer_widget_6_content_typography_default );
		$parse_builder_css                         .= colormag_parse_typography_css(
			$footer_widget_6_content_typography_default,
			$footer_widget_6_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 7 title color.
		$footer_widget_7_title_color     = get_theme_mod( 'colormag_footer_widget_7_title_color', '' );
		$footer_widget_7_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title' => array(
				'color' => esc_html( $footer_widget_7_title_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_widget_7_title_color, $footer_widget_7_title_color_css );

		// Footer builder widget 7 content color.
		$footer_widget_7_content_color     = get_theme_mod( 'colormag_footer_widget_7_content_color', '' );
		$footer_widget_7_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four' => array(
				'color' => esc_html( $footer_widget_7_content_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_widget_7_content_color, $footer_widget_7_content_color_css );

		// Footer builder widget 7 link color.
		$footer_widget_7_link_color     = get_theme_mod( 'colormag_footer_widget_7_link_color', '' );
		$footer_widget_7_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a' => array(
				'color' => esc_html( $footer_widget_7_link_color ),
			),
		);
		$parse_builder_css             .= colormag_parse_css( '', $footer_widget_7_link_color, $footer_widget_7_link_color_css );

		// Footer builder widget 7 link hover color.
		$footer_widget_7_link_hover_color     = get_theme_mod( 'colormag_footer_widget_7_link_hover_color', '' );
		$footer_widget_7_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a:hover' => array(
				'color' => esc_html( $footer_widget_7_link_hover_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_widget_7_link_hover_color, $footer_widget_7_link_hover_color_css );

		// Footer builder widget 7 title typography.
		$footer_widget_7_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_7_title_typography         = get_theme_mod( 'colormag_footer_widget_7_title_typography', $footer_widget_7_title_typography_default );
		$parse_builder_css                       .= colormag_parse_typography_css(
			$footer_widget_7_title_typography_default,
			$footer_widget_7_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 7 content typography.
		$footer_widget_7_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_7_content_typography         = get_theme_mod( 'colormag_footer_widget_7_content_typography', $footer_widget_7_content_typography_default );
		$parse_builder_css                         .= colormag_parse_typography_css(
			$footer_widget_7_content_typography_default,
			$footer_widget_7_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		//
		// Footer builder html 1 color.
		$footer_html_1_text_color     = get_theme_mod( 'colormag_footer_html_1_text_color', '' );
		$footer_html_1_text_color_css = array(
			'.cm-footer-builder .cm-html-1 *' => array(
				'color' => esc_html( $footer_html_1_text_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $footer_html_1_text_color, $footer_html_1_text_color_css );

		// Footer builder html 1 link color.
		$footer_html_1_link_color     = get_theme_mod( 'colormag_footer_html_1_link_color', '' );
		$footer_html_1_link_color_css = array(
			'.cm-footer-builder .cm-html-1 a' => array(
				'color' => esc_html( $footer_html_1_link_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $footer_html_1_link_color, $footer_html_1_link_color_css );

		// Footer builder html 1 link hover color.
		$footer_html_1_link_hover_color     = get_theme_mod( 'colormag_footer_html_1_link_hover_color', '' );
		$footer_html_1_link_hover_color_css = array(
			'.cm-footer-builder .cm-html-1 a:hover' => array(
				'color' => esc_html( $footer_html_1_link_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $footer_html_1_link_hover_color, $footer_html_1_link_hover_color_css );

		// Footer builder html 1 font size.
		$footer_html_1_font_size_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$footer_html_1_font_size = get_theme_mod( 'colormag_footer_html_1_font_size', $footer_html_1_font_size_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_html_1_font_size_default,
			$footer_html_1_font_size,
			'.cm-footer-builder .cm-html-1 *',
			'font-size'
		);

		// Footer builder html 1 margin.
		$footer_html_1_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_html_1_margin = get_theme_mod( 'colormag_footer_html_1_margin', $footer_html_1_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_html_1_margin_default,
			$footer_html_1_margin,
			'.cm-footer-builder .cm-html-1',
			'margin'
		);

		// Footer builder footer menu color.
		$footer_menu_color     = get_theme_mod( 'colormag_footer_menu_color', '' );
		$footer_menu_color_css = array(
			'.cm-footer-builder .cm-footer-nav ul li a' => array(
				'color' => esc_html( $footer_menu_color ),
			),
		);
		$parse_builder_css    .= colormag_parse_css( '', $footer_menu_color, $footer_menu_color_css );

		// Footer builder footer menu hover color.
		$footer_menu_hover_color     = get_theme_mod( 'colormag_footer_menu_hover_color', '' );
		$footer_menu_hover_color_css = array(
			'.cm-footer-builder .cm-footer-nav ul li a:hover' => array(
				'color' => esc_html( $footer_menu_hover_color ),
			),
		);
		$parse_builder_css          .= colormag_parse_css( '', $footer_menu_hover_color, $footer_menu_hover_color_css );

		// Footer builder footer menu typography.
		$footer_menu_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_menu_1_typography = get_theme_mod( 'colormag_footer_menu_typography', $footer_menu_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_menu_typography_default,
			$footer_menu_1_typography,
			'.cm-footer-builder .cm-footer-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder copyright color.
		$footer_copyright_color     = get_theme_mod( 'colormag_footer_copyright_text_color', '' );
		$footer_copyright_color_css = array(
			'.cm-footer-builder .cm-copyright' => array(
				'color' => esc_html( $footer_copyright_color ),
			),
		);
		$parse_builder_css         .= colormag_parse_css( '', $footer_copyright_color, $footer_copyright_color_css );

		// Footer builder copyright color.
		$footer_copyright_link_color     = get_theme_mod( 'colormag_footer_copyright_link_color', '' );
		$footer_copyright_link_color_css = array(
			'.cm-footer-builder .cm-copyright a' => array(
				'color' => esc_html( $footer_copyright_link_color ),
			),
		);
		$parse_builder_css              .= colormag_parse_css( '', $footer_copyright_link_color, $footer_copyright_link_color_css );

		// Footer builder copyright hover color.
		$footer_copyright_link_hover_color     = get_theme_mod( 'colormag_footer_copyright_link_hover_color', '' );
		$footer_copyright_link_hover_color_css = array(
			'.cm-footer-builder .cm-copyright a:hover' => array(
				'color' => esc_html( $footer_copyright_link_hover_color ),
			),
		);
		$parse_builder_css                    .= colormag_parse_css( '', $footer_copyright_link_hover_color, $footer_copyright_link_hover_color_css );

		// Footer builder copyright typography.
		$footer_copyright_typography_default = array(
			'font-family'    => 'Default',
			'font-weight'    => 'regular',
			'font-size'      => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_copyright_typography = get_theme_mod( 'colormag_footer_copyright_typography', $footer_copyright_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_copyright_typography_default,
			$footer_copyright_typography,
			'.cm-footer-builder .cm-copyright',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder copyright margin.
		$footer_copyright_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_copyright_margin = get_theme_mod( 'colormag_footer_copyright_margin', $footer_copyright_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_copyright_margin_default,
			$footer_copyright_margin,
			'.cm-footer-builder .cm-copyright',
			'margin'
		);

		// Footer builder top area container.
		$footer_top_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_top_area_container = get_theme_mod( 'colormag_footer_top_area_container', $footer_top_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_top_area_container_default,
			$footer_top_area_container,
			'.cm-footer-builder .cm-footer-top-row .cm-container',
			'max-width'
		);

		// Footer builder top area height.
		$footer_top_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_top_area_height = get_theme_mod( 'colormag_footer_top_area_height', $footer_top_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_top_area_height_default,
			$footer_top_area_height,
			'.cm-footer-builder .cm-top-row',
			'height'
		);

		// Footer top area background.
		$footer_top_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_top_area_background         = get_theme_mod( 'colormag_footer_top_area_background', $footer_top_area_background_default );
		$parse_builder_css                 .= colormag_parse_background_css( $footer_top_area_background_default, $footer_top_area_background, '.cm-footer-builder .cm-footer-top-row' );

		// Footer top area widget background.
		$footer_top_area_widget_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_top_area_widget_background         = get_theme_mod( 'colormag_footer_top_area_widget_background', $footer_top_area_widget_background_default );
		$parse_builder_css                        .= colormag_parse_background_css( $footer_top_area_widget_background_default, $footer_top_area_widget_background, '.cm-footer-builder .cm-footer-top-row .widget' );

		// Footer top area padding.
		$footer_top_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_top_area_padding = get_theme_mod( 'colormag_footer_top_area_padding', $footer_top_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_padding_default,
			$footer_top_area_padding,
			'.cm-footer-builder .cm-footer-top-row',
			'padding'
		);

		// Footer top area margin.
		$footer_top_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_top_area_margin = get_theme_mod( 'colormag_footer_top_area_margin', $footer_top_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_margin_default,
			$footer_top_area_margin,
			'.cm-footer-builder .cm-footer-top-row',
			'margin'
		);

		// Footer top area border width.
		$footer_top_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_top_area_border_width = get_theme_mod( 'colormag_footer_top_area_border_width', $footer_top_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_border_width_default,
			$footer_top_area_border_width,
			'.cm-footer-builder .cm-footer-top-row',
			'border-width'
		);

		// Footer builder top area border color.
		$footer_top_area_border_color     = get_theme_mod( 'colormag_footer_top_area_border_color', '' );
		$footer_top_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-top-row' => array(
				'border-color' => esc_html( $footer_top_area_border_color ),
			),
		);
		$parse_builder_css               .= colormag_parse_css( '', $footer_top_area_border_color, $footer_top_area_border_color_css );

		// Footer builder main area height.
		$footer_main_area_height_default = array(

			'size' => 0,
			'unit' => 'px',
		);

		$footer_main_area_height = get_theme_mod( 'colormag_footer_main_area_height', $footer_main_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_main_area_height_default,
			$footer_main_area_height,
			'.cm-footer-builder .cm-main-row',
			'height'
		);

		// Footer builder main area container.
		$footer_main_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_main_area_container = get_theme_mod( 'colormag_footer_main_area_container', $footer_main_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_main_area_container_default,
			$footer_main_area_container,
			'.cm-footer-builder .cm-footer-main-row .cm-container',
			'max-width'
		);

		// Footer builder main area background.
		$footer_main_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_main_area_background         = get_theme_mod( 'colormag_footer_main_area_background', $footer_main_area_background_default );
		$parse_builder_css                  .= colormag_parse_background_css( $footer_main_area_background_default, $footer_main_area_background, '.cm-footer-builder .cm-footer-main-row' );

		// Footer builder main area padding.
		$footer_main_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_main_area_padding = get_theme_mod( 'colormag_footer_main_area_padding', $footer_main_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_padding_default,
			$footer_main_area_padding,
			'.cm-footer-builder .cm-footer-main-row',
			'padding'
		);

		// Footer builder main area margin.
		$footer_main_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_main_area_margin = get_theme_mod( 'colormag_footer_main_area_margin', $footer_main_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_margin_default,
			$footer_main_area_margin,
			'.cm-footer-builder .cm-footer-main-row',
			'margin'
		);

		// Footer builder main area border width.
		$footer_main_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_main_area_border_width = get_theme_mod( 'colormag_footer_main_area_border_width', $footer_main_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_border_width_default,
			$footer_main_area_border_width,
			'.cm-footer-builder .cm-footer-main-row',
			'border-width'
		);

		// Footer builder main area border color.
		$footer_main_area_border_color     = get_theme_mod( 'colormag_footer_main_area_border_color', '' );
		$footer_main_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-main-row' => array(
				'border-color' => esc_html( $footer_main_area_border_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '', $footer_main_area_border_color, $footer_main_area_border_color_css );

		// Footer builder bottom area height.
		$footer_bottom_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_bottom_area_height = get_theme_mod( 'colormag_footer_bottom_area_height', $footer_bottom_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_bottom_area_height_default,
			$footer_bottom_area_height,
			'.cm-footer-builder .cm-bottom-row',
			'height'
		);

		// Footer builder bottom area container.
		$footer_bottom_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_bottom_area_container = get_theme_mod( 'colormag_footer_bottom_area_container', $footer_bottom_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_bottom_area_container_default,
			$footer_bottom_area_container,
			'.cm-footer-builder .cm-footer-bottom-row .cm-container',
			'max-width'
		);

		// Footer builder bottom area background.
		$footer_bottom_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_bottom_area_background         = get_theme_mod( 'colormag_footer_bottom_area_background', $footer_bottom_area_background_default );
		$parse_builder_css                    .= colormag_parse_background_css( $footer_bottom_area_background_default, $footer_bottom_area_background, '.cm-footer-builder .cm-footer-bottom-row' );

		// Footer builder bottom area padding.
		$footer_bottom_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_bottom_area_padding = get_theme_mod( 'colormag_footer_bottom_area_padding', $footer_bottom_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_padding_default,
			$footer_bottom_area_padding,
			'.cm-footer-builder .cm-footer-bottom-row',
			'padding'
		);

		// Footer builder bottom area margin.
		$footer_bottom_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_bottom_area_margin = get_theme_mod( 'colormag_footer_bottom_area_margin', $footer_bottom_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_margin_default,
			$footer_bottom_area_margin,
			'.cm-footer-builder .cm-footer-bottom-row',
			'margin'
		);

		// Footer builder bottom area border width.
		$footer_bottom_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_bottom_area_border_width = get_theme_mod( 'colormag_footer_bottom_area_border_width', $footer_bottom_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_border_width_default,
			$footer_bottom_area_border_width,
			'.cm-footer-builder .cm-footer-bottom-row',
			'border-width'
		);

		$footer_bottom_area_border_color     = get_theme_mod( 'colormag_footer_bottom_area_border_color', '' );
		$footer_bottom_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-bottom-row' => array(
				'border-color' => esc_html( $footer_bottom_area_border_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $footer_bottom_area_border_color, $footer_bottom_area_border_color_css );

		// Header builder site logo width.
		$header_site_logo_width_default = array(
			'desktop' => array(
				'size' => '',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => 'px',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => 'px',
			),
		);

		$header_site_logo_width = get_theme_mod( 'colormag_header_site_logo_height', $header_site_logo_width_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_site_logo_width_default,
			$header_site_logo_width,
			'.cm-header-builder .cm-site-branding img',
			'width'
		);

		// Header builder site title color.
		$header_site_title_color     = get_theme_mod( 'colormag_header_site_identity_color', '' );
		$header_site_title_color_css = array(
			'.cm-header-builder .cm-site-title a' => array(
				'color' => esc_html( $header_site_title_color ),
			),
		);
		$parse_builder_css          .= colormag_parse_css( '', $header_site_title_color, $header_site_title_color_css );

		// Header builder site title hover color.
		$header_site_title_hover_color     = get_theme_mod( 'colormag_header_site_identity_hover_color', '' );
		$header_site_title_hover_color_css = array(
			'.cm-header-builder .cm-site-title a:hover' => array(
				'color' => esc_html( $header_site_title_hover_color ),
			),
		);
		$parse_builder_css                .= colormag_parse_css( '#16181a', $header_site_title_hover_color, $header_site_title_hover_color_css );

		// Header builder site title typography.
		$header_site_title_typography_default = array(
			'font-family'    => 'Default',
			'font-weight'    => 'regular',
			'font-size'      => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_site_title_typography = get_theme_mod( 'colormag_header_site_title_typography', $header_site_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_site_title_typography_default,
			$header_site_title_typography,
			'.cm-header-builder .cm-site-title a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder site tagline color.
		$header_site_tagline_color     = get_theme_mod( 'colormag_header_site_tagline_color', '' );
		$header_site_tagline_color_css = array(
			'.cm-header-builder .cm-site-description' => array(
				'color' => esc_html( $header_site_tagline_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_site_tagline_color, $header_site_tagline_color_css );

		// Header toggle color.
		$header_toggle_color     = get_theme_mod( 'colormag_header_builder_toggle_button_color', '' );
		$header_toggle_color_css = array(
			'.cm-header-builder .cm-toggle-button,.cm-header-builder .cm-mobile-row .cm-menu-toggle svg' => array(
				'fill' => esc_html( $header_toggle_color ),
			),
		);
		$parse_builder_css      .= colormag_parse_css( '', $header_toggle_color, $header_toggle_color_css );

		// Header builder site tagline typography.
		$header_site_tagline_typography_default = array(
			'font-family'    => 'Default',
			'font-weight'    => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$header_site_tagline_typography         = get_theme_mod( 'colormag_header_site_tagline_typography', $header_site_tagline_typography_default );

		// Site tagline typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_site_tagline_typography_default,
			$header_site_tagline_typography,
			'.cm-header-builder .cm-site-description',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header mobile menu color.
		$header_mobile_menu_color     = get_theme_mod( 'colormag_header_mobile_menu_item_color', '' );
		$header_mobile_menu_color_css = array(
			'.cm-header-builder .cm-mobile-nav ul li a' => array(
				'color' => esc_html( $header_mobile_menu_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $header_mobile_menu_color, $header_mobile_menu_color_css );

		// Header mobile menu hover color.
		$header_mobile_menu_hover_color     = get_theme_mod( 'colormag_header_mobile_menu_item_hover_color', '' );
		$header_mobile_menu_hover_color_css = array(
			'.cm-header-builder .cm-mobile-nav ul li:hover a' => array(
				'color' => esc_html( $header_mobile_menu_hover_color ),
			),
		);
		$parse_builder_css                 .= colormag_parse_css( '', $header_mobile_menu_hover_color, $header_mobile_menu_hover_color_css );

		// Header mobile background.
		$mobile_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$mobile_background         = get_theme_mod( 'colormag_mobile_menu_background', $mobile_background_default );
		$parse_builder_css        .= colormag_parse_background_css( $mobile_background_default, $mobile_background, '.cm-mobile-nav ul li' );

		// Header mobile typography.
		$header_mobile_typography_default = array(
			'font-family'    => 'Default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '1.8',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$header_mobile_typography         = get_theme_mod( 'colormag_header_mobile_menu_typography', $header_mobile_typography_default );
		$parse_builder_css               .= colormag_parse_typography_css(
			$header_mobile_typography_default,
			$header_mobile_typography,
			'.cm-header-builder .cm-mobile-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder mobile menu background color.
		$header_mobile_menu_background_color     = get_theme_mod( 'colormag_header_mobile_menu_background', '' );
		$header_mobile_menu_background_color_css = array(
			'.cm-mobile-nav.cm-mobile-open-container > .cm-mobile-menu--open' => array(
				'background-color' => esc_html( $header_mobile_menu_background_color ),
			),
		);
		$parse_builder_css                      .= colormag_parse_css( '', $header_mobile_menu_background_color, $header_mobile_menu_background_color_css );

		// Footer builder area cols.
		$footer_builder_top_col = get_theme_mod( 'colormag_footer_top_area_cols', 4 );

		$footer_builder_main_col = get_theme_mod( 'colormag_footer_main_area_cols', 4 );

		$footer_builder_bottom_col = get_theme_mod( 'colormag_footer_bottom_area_cols', 2 );

		$parse_builder_css .= ":root{--top-grid-columns: {$footer_builder_top_col};
			--main-grid-columns: {$footer_builder_main_col};
			--bottom-grid-columns: {$footer_builder_bottom_col};
			}";

		if ( 1 == $footer_builder_top_col ) {
			$parse_builder_css .= ' .cm-footer-builder .cm-top-row{justify-items: center;} ';
			$parse_builder_css .= ' .cm-footer-builder .cm-top-row .cm-footer-top-1-col{ display: block;} ';
		} elseif ( 1 === $footer_builder_main_col ) {
			$parse_builder_css .= ' .cm-footer-builder .cm-main-row{justify-items: center;} ';
		} elseif ( 1 === $footer_builder_bottom_col ) {
			$parse_builder_css .= ' .cm-footer-builder .cm-bottom-row{justify-items: center;} ';
		}

		// Footer bottom layout alignment.
		$footer_builder_bottom_layout = get_theme_mod( 'colormag_footer_bottom_inner_element_layout', 'column' );

		if ( ! empty( $footer_builder_bottom_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-bottom-row .cm-footer-col{flex-direction: $footer_builder_bottom_layout;}";
		}

		// Footer main layout alignment.
		$footer_builder_main_layout = get_theme_mod( 'colormag_footer_main_inner_element_layout', 'column' );

		if ( ! empty( $footer_builder_main_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-main-row .cm-footer-col{flex-direction: $footer_builder_main_layout;}";
		}

		// Footer top layout alignment.
		$footer_builder_top_layout = get_theme_mod( 'colormag_footer_top_inner_element_layout', 'column' );

		if ( ! empty( $footer_builder_top_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-top-row .cm-footer-col{flex-direction: $footer_builder_top_layout;}";
		}

		$color_palette_default = array(
			'id'     => 'preset-5',
			'name'   => 'Preset 5',
			'colors' => array(
				'cm-color-1' => '#257BC1',
				'cm-color-2' => '#2270B0',
				'cm-color-3' => '#FFFFFF',
				'cm-color-4' => '#F9FEFD',
				'cm-color-5' => '#27272A',
				'cm-color-6' => '#16181A',
				'cm-color-7' => '#8F8F8F',
				'cm-color-8' => '#FFFFFF',
				'cm-color-9' => '#C7C7C7',
			),
		);

		// Color palette.
		$color_palette      = get_theme_mod( 'colormag_color_palette', $color_palette_default );
		$parse_builder_css .= sprintf(
			' :root{%s}',
			array_reduce(
				array_keys( $color_palette['colors'] ?? [] ),
				function ( $acc, $curr ) use ( $color_palette ) {
					$acc .= "--{$curr}: {$color_palette['colors'][$curr]};";

					return $acc;
				},
				''
			)
		);

		// Dark skin color palette.
		$dark_skin_selection = get_theme_mod( 'colormag_dark_skin', '' );

		// Get the selected preset for dark skin using comprehensive function
		$all_presets     = self::get_all_color_palette_presets_with_modifications();
		$selected_preset = null;

		foreach ( $all_presets as $preset ) {
			if ( isset( $preset['id'] ) && $preset['id'] === $dark_skin_selection ) {
				$selected_preset = $preset;
				break;
			}
		}

		if ( $selected_preset && isset( $selected_preset['colors'] ) ) {
			// Generate CSS variables
			$css_variables = array_reduce(
				array_keys( $selected_preset['colors'] ),
				function ( $acc, $curr ) use ( $selected_preset ) {
					$css_var = "--{$curr}: {$selected_preset['colors'][$curr]};";
					$acc    .= $css_var;
					return $acc;
				},
				''
			);

			$dark_skin_css = sprintf( ' .dark-skin {%s}', $css_variables );

			$parse_builder_css .= $dark_skin_css;

		}

		return $parse_builder_css;
	}

	/**
	 * Get all available color palette presets including modified ones
	 *
	 * @return array Array of all presets with their current state (original + modified)
	 */
	public static function get_all_color_palette_presets_with_modifications() {
		// 1. Get predefined presets
		$predefined_presets = array(
			array(
				'id'     => 'preset-1',
				'name'   => 'Preset 1',
				'colors' => array(
					'cm-color-1' => '#040e16',
					'cm-color-2' => '#94c4eb',
					'cm-color-3' => '#eaf3fb',
					'cm-color-4' => '#bfdcf3',
					'cm-color-5' => '#27272a',
					'cm-color-6' => '#0c2941',
					'cm-color-7' => '#15446b',
					'cm-color-8' => '#257bc1',
					'cm-color-9' => '#d4d4d8',
				),
			),
			array(
				'id'     => 'preset-2',
				'name'   => 'Preset 2',
				'colors' => array(
					'cm-color-1' => '#170411',
					'cm-color-2' => '#eb95d0',
					'cm-color-3' => '#fbebf6',
					'cm-color-4' => '#f3c0e3',
					'cm-color-5' => '#971d70',
					'cm-color-6' => '#420c31',
					'cm-color-7' => '#6c1550',
					'cm-color-8' => '#c22590',
					'cm-color-9' => '#e36abc',
				),
			),
			array(
				'id'     => 'preset-3',
				'name'   => 'Preset 3',
				'colors' => array(
					'cm-color-1' => '#161704',
					'cm-color-2' => '#e5eb95',
					'cm-color-3' => '#fafbeb',
					'cm-color-4' => '#f0f3c0',
					'cm-color-5' => '#8f971d',
					'cm-color-6' => '#3e420c',
					'cm-color-7' => '#676c15',
					'cm-color-8' => '#b8c225',
					'cm-color-9' => '#dbe36a',
				),
			),
			array(
				'id'     => 'preset-4',
				'name'   => 'Preset 4',
				'colors' => array(
					'cm-color-1' => '#170704',
					'cm-color-2' => '#eba395',
					'cm-color-3' => '#fbeeeb',
					'cm-color-4' => '#f3c8c0',
					'cm-color-5' => '#97311d',
					'cm-color-6' => '#42150c',
					'cm-color-7' => '#6c2315',
					'cm-color-8' => '#c23f25',
					'cm-color-9' => '#e37e6a',
				),
			),
			array(
				'id'     => 'preset-5',
				'name'   => 'Preset 5',
				'colors' => array(
					'cm-color-1' => '#257BC1',
					'cm-color-2' => '#2270B0',
					'cm-color-3' => '#FFFFFF',
					'cm-color-4' => '#F9FEFD',
					'cm-color-5' => '#27272A',
					'cm-color-6' => '#16181A',
					'cm-color-7' => '#8F8F8F',
					'cm-color-8' => '#FFFFFF',
					'cm-color-9' => '#C7C7C7',
				),
			),
			array(
				'id'     => 'preset-6',
				'name'   => 'Dark',
				'colors' => array(
					'cm-color-1' => '#207daf',
					'cm-color-2' => '#121212',
					'cm-color-3' => '#0d0d0d',
					'cm-color-4' => '#E0E0E0',
					'cm-color-5' => '#27272a',
					'cm-color-6' => '#E3E2E2',
					'cm-color-7' => '#D1D1D1',
					'cm-color-8' => '#EBEBEB',
					'cm-color-9' => '#ffffff3d',
				),
			),
		);

		// 2. Get current color palette data from database
		$color_palette = get_theme_mod( 'colormag_color_palette', array() );

		// 3. Get custom presets from database
		$custom_presets = isset( $color_palette['custom'] ) ? $color_palette['custom'] : array();

		// 4. Get current active palette modifications
		$current_active_colors = isset( $color_palette['colors'] ) ? $color_palette['colors'] : array();
		$current_active_id     = isset( $color_palette['id'] ) ? $color_palette['id'] : 'preset-5';
		$current_active_name   = isset( $color_palette['name'] ) ? $color_palette['name'] : 'Default';

		// 5. Process predefined presets and apply modifications if they're currently active
		$processed_presets = array();

		foreach ( $predefined_presets as $preset ) {
			$preset_copy = $preset;

			// If this preset is currently active and has modifications, replace original with modified
			if ( $current_active_id === $preset['id'] && ! empty( $current_active_colors ) ) {
				$preset_copy['original_colors'] = $preset['colors']; // Store original for reference
				$preset_copy['colors']          = $current_active_colors; // Replace with modified colors
				$preset_copy['is_modified']     = true;
				$preset_copy['modified_colors'] = $current_active_colors;
			} else {
				$preset_copy['is_modified'] = false;
			}

			$processed_presets[] = $preset_copy;
		}

		// 6. Process custom presets
		foreach ( $custom_presets as $custom_preset ) {
			$custom_preset['is_custom']   = true;
			$custom_preset['is_modified'] = false; // Custom presets are not "modified" presets

			// If this custom preset is currently active and has additional modifications
			if ( $current_active_id === $custom_preset['id'] && ! empty( $current_active_colors ) ) {
				$custom_preset['original_colors'] = $custom_preset['colors']; // Store original for reference
				$custom_preset['colors']          = $current_active_colors; // Replace with modified colors
				$custom_preset['is_modified']     = true;
				$custom_preset['modified_colors'] = $current_active_colors;
			}

			$processed_presets[] = $custom_preset;
		}

		// 7. If there's a current active palette that doesn't match any preset, add it as a standalone
		if ( $current_active_id && ! empty( $current_active_colors ) ) {
			$found_in_presets = false;
			foreach ( $processed_presets as $preset ) {
				if ( $preset['id'] === $current_active_id ) {
					$found_in_presets = true;
					break;
				}
			}

			if ( ! $found_in_presets ) {
				$processed_presets[] = array(
					'id'          => $current_active_id,
					'name'        => $current_active_name ?: 'Custom Active',
					'colors'      => $current_active_colors,
					'is_custom'   => true,
					'is_modified' => false,
				);
			}
		}

		return $processed_presets;
	}

	/**
	 * Get only modified presets
	 *
	 * @return array Array of presets that have been modified
	 */
	public static function get_modified_color_palette_presets() {
		$all_presets = self::get_all_color_palette_presets_with_modifications();

		return array_filter(
			$all_presets,
			function ( $preset ) {
				return isset( $preset['is_modified'] ) && $preset['is_modified'] === true;
			}
		);
	}

	/**
	 * Get the current active palette with all modifications
	 *
	 * @return array|null The current active palette or null if none
	 */
	public static function get_current_active_color_palette() {
		$color_palette = get_theme_mod( 'colormag_color_palette', array() );

		if ( empty( $color_palette ) || ! isset( $color_palette['colors'] ) ) {
			return null;
		}

		return array(
			'id'        => isset( $color_palette['id'] ) ? $color_palette['id'] : 'unknown',
			'name'      => isset( $color_palette['name'] ) ? $color_palette['name'] : 'Active Palette',
			'colors'    => $color_palette['colors'],
			'is_active' => true,
			'custom'    => isset( $color_palette['custom'] ) ? $color_palette['custom'] : array(),
		);
	}

	/**
	 * Get preset by ID with current modifications applied
	 *
	 * @param string $preset_id The preset ID to retrieve
	 * @return array|null The preset with modifications or null if not found
	 */
	public static function get_color_palette_preset_with_modifications( $preset_id ) {
		$all_presets = self::get_all_color_palette_presets_with_modifications();

		foreach ( $all_presets as $preset ) {
			if ( $preset['id'] === $preset_id ) {
				return $preset;
			}
		}

		return null;
	}

	/**
	 * Get and display matched preset information
	 *
	 * @param string $preset_id The preset ID to find and display
	 * @return array|null The matched preset or null if not found
	 */
	public static function get_and_display_matched_preset( $preset_id ) {
		$all_presets    = self::get_all_color_palette_presets_with_modifications();
		$matched_preset = null;

		foreach ( $all_presets as $preset ) {
			if ( $preset['id'] === $preset_id ) {
				$matched_preset = $preset;
				break;
			}
		}

		return $matched_preset;
	}
}
