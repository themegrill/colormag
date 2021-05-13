<?php
/**
 * Class to include Site Identity customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
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

			// Site logo header separator.
			array(
				'name'     => 'colormag_site_logo_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Logo', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 5,
			),

			// Site icon header separator.
			array(
				'name'     => 'colormag_site_icon_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Icon', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 7,
			),

			// Site title header separator.
			array(
				'name'     => 'colormag_site_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Title', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			),

			// Site tagline header separator.
			array(
				'name'     => 'colormag_site_tagline_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Tagline', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 11,
			),

			// Visibility header separator.
			array(
				'name'     => 'colormag_visibility_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Visibility', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 20,
			),

			// Header logo placement option.
			array(
				'name'     => 'colormag_header_logo_placement',
				'default'  => 'header_text_only',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose the option that you want', 'colormag' ),
				'section'  => 'title_tagline',
				'choices'  => array(
					'header_logo_only' => esc_html__( 'Header Logo Only', 'colormag' ),
					'header_text_only' => esc_html__( 'Header Text Only', 'colormag' ),
					'show_both'        => esc_html__( 'Show Both', 'colormag' ),
					'disable'          => esc_html__( 'Disable', 'colormag' ),
				),
				'priority' => 30,
			),

			array(
				'name'        => 'colormag_site_identity_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available for this section.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'title_tagline',
				'priority'    => 50,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Site_Identity_Options();
