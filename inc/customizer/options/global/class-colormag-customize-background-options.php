<?php
/**
 * Class to include Background customize options.
 *
 * Class ColorMag_Customize_Background_Options
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
 * Class to include Background customize options.
 *
 * Class ColorMag_Customize_Background_Options
 */
class ColorMag_Customize_Background_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Global color background options.
			 */
			// Outside Background Heading Separator.
			array(
				'name'     => 'colormag_outside_container_background_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Outside Container', 'colormag' ),
				'section'  => 'colormag_global_background_section',
				'priority' => 0,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Background_Options();
