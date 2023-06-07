<?php
/**
 * Class to include Header Media customize options.
 *
 * Class ColorMag_Customize_Header_Media_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
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

			array(
				'name'       => 'colormag_header_media_position_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Position', 'colormag' ),
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
				'priority'   => 10,
			),

			// Header image position option.
			array(
				'name'       => 'colormag_header_media_position',
				'default'    => 'position-two',
				'type'       => 'control',
				'control'    => 'select',
				'section'    => 'header_image',
				'choices'    => array(
					'position-one'   => esc_html__( 'Above Header', 'colormag' ),
					'position-two'   => esc_html__( 'Between Site Identity and Primary Menu', 'colormag' ),
					'position-three' => esc_html__( 'Below Header', 'colormag' ),
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
				'priority'   => 20,
			),

			// Header image link to home page option.
			array(
				'name'       => 'colormag_enable_header_image_link_home',
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
				'priority'   => 30,
			),

			array(
				'name'        => 'colormag_header_media_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'header_image',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Header_Media_Options();
