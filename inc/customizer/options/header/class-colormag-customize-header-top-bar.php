<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Options
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
 * Class ColorMag_Customize_Header_Top_Bar
 */
class ColorMag_Customize_Header_Top_Bar extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Breaking news options.
			 */
			// Breaking news heading separator.
			array(
				'name'     => 'colormag_breaking_news_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Breaking News', 'colormag' ),
				'section'  => 'colormag_header_top_bar_setting',
				'priority' => 5,
			),

			// Breaking news in header enable/disable option.
			array(
				'name'     => 'colormag_breaking_news',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section'  => 'colormag_header_top_bar_setting',
				'priority' => 10,
			),

			/**
			 * Date in header options.
			 */
			// Date in header heading separator.
			array(
				'name'     => 'colormag_date_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Show Date', 'colormag' ),
				'section'  => 'colormag_header_top_bar_setting',
				'priority' => 105,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_Top_Bar();
