<?php
/**
 * Class to include Image loading customize options.
 *
 * Class ColorMag_Customize_Image_Options
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
 * Class to include Image customize options.
 *
 * Class ColorMag_Customize_Image_Options
 */
class ColorMag_Customize_Image_Load_Options extends ColorMag_Customize_Base_Option {

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
			 * Global image options.
			 */
			// Image loading option Heading Separator.
			array(
				'name'     => 'colormag__image_option_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Image loading options', 'colormag' ),
				'section'  => 'colormag_global_image_section',
				'priority' => 0,
			),

			// Image loading options.
			array(
				'name'      => 'colormag_image_loading_option',
				'default'   => '1',
				'type'      => 'control',
				'control'   => 'radio',
				'section'   => 'colormag_global_image_section',
				'transport' => 'refresh',
				'choices'   => array(
					'style-1' => esc_html__( 'Style 1 (Fade in from bottom)', 'colormag' ),
					'style-2' => esc_html__( 'Style 2 (Fade in from top)', 'colormag' ),
					'style-3' => esc_html__( 'Style 3 (Fade in normally)', 'colormag' ),
				),
				'priority'  => 10,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Image_Load_Options();
