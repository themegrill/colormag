<?php
/**
 * Class to include Header Media customize options.
 *
 * Class ColorMag_Customize_Header_Media_Options
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
 * Class to include Header Media customize options.
 *
 * Class ColorMag_Customize_Header_Media_Options
 */
class ColorMag_Customize_Header_Media_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$header_image_value = get_theme_mod( 'header_image' ) === 'remove-header' ? 'remove-header' : '';
		$header_video_value = get_theme_mod( 'header_video' ) === 0 ? 0 : '';

		$configs = array(

			// Header image position option.
			array(
				'name'       => 'colormag_header_image_position',
				'default'    => 'position_two',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Header image display position', 'colormag' ),
				'section'    => 'header_image',
				'choices'    => array(
					'position_one'   => esc_html__( 'Display the Header image just above the site title/text.', 'colormag' ),
					'position_two'   => esc_html__( 'Default: Display the Header image between site title/text and the main/primary menu.', 'colormag' ),
					'position_three' => esc_html__( 'Display the Header image below main/primary menu.', 'colormag' ),
				),
				'dependency' => array(
					'conditions' => array(
						array(
							'header_image',
							'!=',
							$header_image_value,
						),
						array(
							'header_video',
							'!=',
							$header_video_value,
						),
						array(
							'external_header_video',
							'!=',
							'',
						),
					),
					'operator'   => 'OR',
				),
				'priority'   => 10,
			),

			// Header image link to home page option.
			array(
				'name'       => 'colormag_header_image_link',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to make header image link back to home page', 'colormag' ),
				'section'    => 'header_image',
				'dependency' => array(
					'conditions' => array(
						array(
							'header_image',
							'!=',
							$header_image_value,
						),
						array(
							'header_video',
							'!=',
							$header_video_value,
						),
						array(
							'external_header_video',
							'!=',
							'',
						),
					),
					'operator'   => 'OR',
				),
				'priority'   => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}
}

return new ColorMag_Customize_Header_Media_Options();
