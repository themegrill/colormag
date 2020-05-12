<?php
/**
 * Class to include General customize options.
 *
 * Class ColorMag_Customize_General_Options
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
 * Class to include General customize options.
 *
 * Class ColorMag_Customize_General_Options
 */
class ColorMag_Customize_General_Options extends ColorMag_Customize_Base_Option {

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

			// Front page posts/pages display option.
			array(
				'name'     => 'colormag_hide_blog_front',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to hide blog posts/static page on front page', 'colormag' ),
				'section'  => 'colormag_general_section',
				'priority' => 5,
			),

			// Site layout option.
			array(
				'name'      => 'colormag_site_layout',
				'default'   => 'wide_layout',
				'type'      => 'control',
				'control'   => 'colormag-buttonset',
				'label'     => esc_html__( 'Choose your site layout. The change is reflected in whole site', 'colormag' ),
				'section'   => 'colormag_general_section',
				'transport' => 'postMessage',
				'choices'   => array(
					'boxed_layout' => esc_html__( 'Boxed Layout', 'colormag' ),
					'wide_layout'  => esc_html__( 'Wide Layout', 'colormag' ),
				),
				'priority'  => 10,
			),

			// Skin color option.
			array(
				'name'     => 'colormag_color_skin_setting',
				'default'  => 'white',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose the color skin for your site.', 'colormag' ),
				'section'  => 'colormag_general_section',
				'choices'  => array(
					'white' => esc_html__( 'White Skin', 'colormag' ),
					'dark'  => esc_html__( 'Dark Skin', 'colormag' ),
				),
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_General_Options();
