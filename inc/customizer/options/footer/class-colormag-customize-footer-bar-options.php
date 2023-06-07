<?php
/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
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
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
 */
class ColorMag_Customize_Footer_Bottom_Bar_Options extends ColorMag_Customize_Base_Option {

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
			 * Social Icons.
			 */
			array(
				'name'     => 'colormag_footer_bar_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 10,
			),

			array(
				'name'          => 'colormag_footer_bar_social_icons_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'label'         => esc_html__( 'Social Icons', 'colormag' ),
				'section'       => 'colormag_footer_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_social_icons_section',
					'target_label' => esc_html__( 'Social Icons', 'colormag' ),
				),
				'priority'      => 20,
			),

			array(
				'name'        => 'colormag_footer_bar_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_footer_bar_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_Bottom_Bar_Options();
