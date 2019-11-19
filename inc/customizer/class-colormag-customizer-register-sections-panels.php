<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 */
class ColorMag_Customize_Register_Section_Panels extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Register panels.
			 */
			// Additional Panel.
			array(
				'name'        => 'colormag_additional_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Additional Options', 'colormag' ),
				'description' => esc_html__( 'Change the Additional Settings from here as you want', 'colormag' ),
				'priority'    => 515,
			),

			// Category Color Panel.
			array(
				'name'        => 'colormag_category_color_panel',
				'type'        => 'panel',
				'title'       => esc_html__( 'Category Color Options', 'colormag' ),
				'description' => esc_html__( 'Change the color of each category items as you want.', 'colormag' ),
				'priority'    => 535,
			),

			// Design Options.
			array(
				'name'        => 'colormag_design_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Design Options', 'colormag' ),
				'description' => esc_html__( 'Change the Design Settings from here as you want', 'colormag' ),
				'priority'    => 505,
			),

			// Footer Options.
			array(
				'name'        => 'colormag_footer_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Footer Options', 'colormag' ),
				'description' => esc_html__( 'Change the Footer Settings from here as you want', 'colormag' ),
				'priority'    => 515,
			),

			// Header Options.
			array(
				'name'        => 'colormag_header_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Header Options', 'colormag' ),
				'description' => esc_html__( 'Change the Header Settings from here as you want', 'colormag' ),
				'priority'    => 500,
			),

			// Social Options.
			array(
				'name'        => 'colormag_social_links_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Social Options', 'colormag' ),
				'description' => esc_html__( 'Change the Social Links Settings from here as you want', 'colormag' ),
				'priority'    => 510,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Register_Section_Panels();
