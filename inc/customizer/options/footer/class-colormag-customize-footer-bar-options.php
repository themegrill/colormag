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

			array(
				'name'     => 'colormag_footer_bar_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Bar', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_footer_bar_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 20,
			),

			// Footer copyright alignment option.
			array(
				'name'      => 'colormag_footer_bar_alignment',
				'default'   => 'left',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'label'     => esc_html__( 'Alignment', 'colormag' ),
				'section'   => 'colormag_footer_bar_section',
				'choices'   => apply_filters(
					'colormag_footer_bar_alignment_choices',
					array(
						'left'   => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/left.svg',
						),
						'right'  => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/right.svg',
						),
						'center' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/center.svg',
						),
					)
				),
				'image_col' => 2,
				'transport' => 'postMessage',
				'priority'  => 30,
			),

			array(
				'name'     => 'colormag_footer_bar_style_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_footer_bar_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_footer_copyright_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_footer_copyright_background',
				'default'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_footer_copyright_background_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 40,
			),

			/**
			 * Footer Copyright.
			 */
			array(
				'name'     => 'colormag_footer_copyright_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Copyright', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_footer_copyright_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 60,
			),

			array(
				'name'     => 'colormag_footer_copyright_text_color',
				'tab'      => esc_html__( 'Color', 'colormag' ),
				'default'  => '#f4f4f5',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 70,
			),

			array(
				'name'     => 'colormag_footer_copyright_link_text_color',
				'tab'      => esc_html__( 'Link Color', 'colormag' ),
				'default'  => '#207dafc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 80,
			),

			/**
			 * Social Icons.
			 */
			array(
				'name'     => 'colormag_footer_bar_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 90,
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
				'priority'      => 100,
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
