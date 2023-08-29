<?php
/**
 * Class to include Site Identity customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
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
 * Class to include Site Identity customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
 */
class ColorMag_Customize_Site_Identity_Options extends ColorMag_Customize_Base_Option {

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
			 *  Logo.
			 */
			array(
				'name'     => 'colormag_site_logo_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Logo', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_retina_logo',
				'type'     => 'control',
				'control'  => 'image',
				'label'    => esc_html__( 'Retina Logo', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 15,
			),

			/**
			 *  Site Icon.
			 */
			array(
				'name'     => 'colormag_site_icon_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Icon', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 30,
			),

			/**
			 *  Site Title.
			 */
			array(
				'name'     => 'colormag_site_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Title', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_enable_site_identity',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'default'  => true,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'section'  => 'title_tagline',
				'priority' => 70,
			),

			/**
			 *  Tagline.
			 */
			array(
				'name'     => 'colormag_site_tagline_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Tagline', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 80,
			),

			array(
				'name'     => 'colormag_enable_site_tagline',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'default'  => true,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'section'  => 'title_tagline',
				'priority' => 100,
			),

			array(
				'name'        => 'colormag_site_identity_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'title_tagline',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Site_Identity_Options();
