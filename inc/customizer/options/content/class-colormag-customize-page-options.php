<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class ColorMag_Customize_Page_Options
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
 * Class to include Page customize options.
 *
 * Class ColorMag_Customize_Page_Options
 */
class ColorMag_Customize_Page_Options extends ColorMag_Customize_Base_Option {

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

			// Post Title header separator.
			array(
				'name'     => 'colormag_page_feature_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_page_section',
				'priority' => 0,
			),

			// Featured image display in single page option.
			array(
				'name'     => 'colormag_featured_image_single_page_show',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the featured image in single page.', 'colormag' ),
				'section'  => 'colormag_page_section',
				'priority' => 5,
			),

			array(
				'name'        => 'colormag_customize_page_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available for this section.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_page_section',
				'priority'    => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Page_Options();
