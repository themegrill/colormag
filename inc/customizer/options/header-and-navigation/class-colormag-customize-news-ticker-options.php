<?php
/**
 * Class to include News Ticker customize options.
 *
 * Class ColorMag_Customize_News_Ticker_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include News Ticker customize options.
 *
 * Class ColorMag_Customize_News_Ticker_Options
 */
class ColorMag_Customize_News_Ticker_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Breaking news.
			 */
			// Breaking news heading separator.
			array(
				'name'     => 'colormag_news_ticker_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'News Ticker', 'colormag' ),
				'section'  => 'colormag_news_ticker_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_news_ticker_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_news_ticker_section',
				'priority' => 20,
			),

			// Breaking news in header enable/disable option.
			array(
				'name'        => 'colormag_enable_news_ticker',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'priority'    => 30,
			),

			// Breaking news position option.
			array(
				'name'        => 'colormag_news_ticker_position',
				'default'     => 'top-bar',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Position', 'colormag' ),
				'description' => esc_html__( 'Choose the location/area to place the Breaking News', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'choices'     => array(
					'top-bar'      => esc_html__( 'Top Bar', 'colormag' ),
					'below-header' => esc_html__( 'Below Header', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 40,
			),

			// Breaking news display posts via latest posts or from specific category option.
			array(
				'name'        => 'colormag_news_ticker_query',
				'default'     => 'latest',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Filter', 'colormag' ),
				'description' => esc_html__( 'Choose the required option to display the latest posts from:', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'choices'     => array(
					'latest'   => esc_html__( 'Latest Posts', 'colormag' ),
					'category' => esc_html__( 'Category', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 50,
			),

			// Breaking news category choose option.
			array(
				'name'        => 'colormag_news_ticker_category',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'colormag-dropdown-categories',
				'label'       => esc_html__( 'Category', 'colormag' ),
				'description' => esc_html__( 'Choose the required category to display as the latest posts:', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'dependency'  => array(
					'conditions' => array(
						array(
							'colormag_enable_news_ticker',
							'!=',
							0,
						),
						array(
							'colormag_news_ticker_query',
							'==',
							'category',
						),
					),
				),
				'priority'    => 60,
			),

			// Breaking news text content option.
			array(
				'name'        => 'colormag_news_ticker_label',
				'default'     => esc_html__( 'Latest:', 'colormag' ),
				'type'        => 'control',
				'control'     => 'text',
				'label'       => esc_html__( 'Label', 'colormag' ),
				'description' => esc_html__( 'Enter the text to display for the ticker news', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector'        => '.breaking-news-latest',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_breaking_news_text',
					),
				),
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 70,
			),

			array(
				'name'       => 'colormag_news_ticker_style_divider',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'style'      => 'dashed',
				'section'    => 'colormag_news_ticker_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 80,
			),

			array(
				'name'       => 'colormag_news_ticker_style_subtitle',
				'type'       => 'control',
				'control'    => 'colormag-subtitle',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_news_ticker_section',
				'dependency' => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'   => 90,
			),

			array(
				'name'       => 'colormag_news_ticker_label_typography_group',
				'label'      => esc_html__( 'Label Typography', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_news_ticker_section',
				'priority'   => 100,
				'dependency' => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
			),

			array(
				'name'      => 'colormag_news_ticker_label_typography',
				'default'   => array(
					'font-family' => 'default',
					'font-weight' => 'regular',
					'subsets'     => array( 'latin' ),
					'font-size'   => array(
						'desktop' => array(
							'size' => '15',
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
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_news_ticker_label_typography_group',
				'section'   => 'colormag_news_ticker_section',
				'transport' => 'postMessage',
				'priority'  => 110,
			),

			array(
				'name'       => 'colormag_news_ticker_content_typography_group',
				'label'      => esc_html__( 'Content Typography', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_news_ticker_section',
				'priority'   => 120,
				'dependency' => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
			),

			array(
				'name'      => 'colormag_news_ticker_content_typography',
				'default'   => array(
					'font-family' => 'default',
					'font-weight' => 'regular',
					'subsets'     => array( 'latin' ),
					'font-size'   => array(
						'desktop' => array(
							'size' => '15',
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
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_news_ticker_content_typography_group',
				'section'   => 'colormag_news_ticker_section',
				'transport' => 'postMessage',
				'priority'  => 130,
			),

			// Breaking news animation style option.
			array(
				'name'        => 'colormag_news_ticker_animation_direction',
				'default'     => 'down',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Animation Style', 'colormag' ),
				'description' => esc_html__( 'Choose the animation style for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'choices'     => array(
					'up'   => esc_html__( 'Up', 'colormag' ),
					'down' => esc_html__( 'Down', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 140,
			),

			// Breaking news duration time option.
			array(
				'name'        => 'colormag_news_ticker_animation_duration',
				'default'     => 4,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Transition Duration', 'colormag' ),
				'description' => esc_html__( 'Enter the duration time for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 150,
			),

			// Breaking news speed time option.
			array(
				'name'        => 'colormag_news_ticker_animation_speed',
				'default'     => 1,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Transition Speed', 'colormag' ),
				'description' => esc_html__( 'Enter the speed time for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_news_ticker_section',
				'dependency'  => array(
					'colormag_enable_news_ticker',
					'!=',
					0,
				),
				'priority'    => 160,
			),

			array(
				'name'       => 'colormag_news_ticker_label_background_color_group',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'label'      => esc_html__( 'Label Background', 'colormag' ),
				'section'    => 'colormag_news_ticker_section',
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_enable_news_ticker',
							'!=',
							0,
						),
						array(
							'colormag_news_ticker_position',
							'==',
							'main',
						),
					),
				),
				'priority'   => 170,
			),

			array(
				'name'       => 'colormag_news_ticker_label_background',
				'default'    => '#55ac55',
				'type'       => 'sub-control',
				'parent'     => 'colormag_news_ticker_label_background_color_group',
				'control'    => 'colormag-color',
				'section'    => 'colormag_news_ticker_section',
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_enable_news_ticker',
							'!=',
							0,
						),
						array(
							'colormag_news_ticker_position',
							'==',
							'main',
						),
					),
				),
				'priority'   => 180,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_News_Ticker_Options();
