<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
 */
class ColorMag_Customize_Header_Top_Bar_Options extends ColorMag_Customize_Base_Option {

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
			 * Date in header options.
			 */
			// Date in header heading separator.
			array(
				'name'     => 'colormag_date_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Show Date', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 10,
			),

			// Date in header display option.
			array(
				'name'      => 'colormag_date_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show the date in header', 'colormag' ),
				'section'   => 'colormag_top_bar_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_current_date',
					),
				),
				'priority'  => 20,
			),

			// Date in header display type option.
			array(
				'name'       => 'colormag_date_display_type',
				'default'    => 'theme_default',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Date in header display type:', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'transport'  => $customizer_selective_refresh,
				'choices'    => array(
					'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
					'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
				),
				'partial'    => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_date_display_type',
					),
				),
				'dependency' => array(
					'colormag_date_display',
					'!=',
					0,
				),
				'priority'   => 30,
			),

			/**
			 * Breaking news options.
			 */
			// Breaking news heading separator.
			array(
				'name'     => 'colormag_breaking_news_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Breaking News', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 40,
			),

			// Breaking news in header enable/disable option.
			array(
				'name'     => 'colormag_breaking_news',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 50,
			),

			array(
				'name'        => 'colormag_top_bar_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available for this section.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_top_bar_section',
				'priority'    => 60,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_Top_Bar_Options();
