<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class ColorMag_Customize_Page_Options
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

			array(
				'name'     => 'colormag_page_featured_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_page_section',
				'priority' => 10,
			),

			// Featured image display in single page option.
			array(
				'name'        => 'colormag_enable_page_featured_image',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the featured image in single page.', 'colormag' ),
				'section'     => 'colormag_page_section',
				'priority'    => 20,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_page_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_page_section',
				'priority' => 30,
			),

			// Page title color group.
			array(
				'name'     => 'colormag_page_title_color_group',
				'label'    => esc_html__( 'Page Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_page_section',
				'priority' => 40,
			),

			// Page title normal color option.
			array(
				'name'     => 'colormag_page_title_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#333333',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_page_title_color_group',
				'section'  => 'colormag_page_section',
				'priority' => 50,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_page_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_page_section',
				'priority' => 60,
			),

			// Page title Typography group.
			array(
				'name'     => 'colormag_single_page_title_typography_group',
				'label'    => esc_html__( 'Page Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_page_section',
				'priority' => 70,
			),

			// Page title typography option.
			array(
				'name'      => 'colormag_page_title_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '34',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => '',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => '',
						),
					),
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_single_page_title_typography_group',
				'section'   => 'colormag_page_section',
				'transport' => 'postMessage',
				'priority'  => 80,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Page_Options();
