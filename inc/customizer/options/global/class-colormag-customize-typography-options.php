<?php
/**
 * Class to include Typography General customize options.
 *
 * Class ColorMag_Customize_Typography_options
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
 * Class to include Typography General customize options.
 *
 * Class ColorMag_Customize_Typography_options
 */
class ColorMag_Customize_Typography_options extends ColorMag_Customize_Base_Option {

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
			 * Base.
			 */
			array(
				'name'     => 'colormag_body_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Body', 'colormag' ),
				'section'  => 'colormag_global_typography_section',
				'priority' => 10,
			),

			array(
				'name'      => 'colormag_base_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'size' => '15',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.6',
							'unit' => '-',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => '-',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => '-',
						),
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'control',
				'control'   => 'colormag-typography',
				'transport' => 'postMessage',
				'section'   => 'colormag_global_typography_section',
				'priority'  => 20,
			),

			/**
			 * Headings.
			 */
			array(
				'name'     => 'colormag_headings_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Headings', 'colormag' ),
				'section'  => 'colormag_global_typography_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_headings_typography_group',
				'label'    => esc_html__( 'Headings', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 40,
			),

			array(
				'name'      => 'colormag_headings_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
					'letter-spacing' => array(
						'desktop' => array(
							'size' => '',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'font-style'     => 'inherit',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_headings_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 50,
			),

			/**
			 * H1.
			 */
			array(
				'name'     => 'colormag_h1_typography_group',
				'label'    => esc_html__( 'H1', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 60,
			),

			array(
				'name'      => 'colormag_h1_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'size' => '36',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_h1_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 70,
			),

			/**
			 * H2.
			 */
			array(
				'name'     => 'colormag_h2_typography_group',
				'label'    => esc_html__( 'H2', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 80,
			),

			array(
				'name'      => 'colormag_h2_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'size' => '32',
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
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_h2_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 90,
			),

			/**
			 * H3.
			 */
			array(
				'name'     => 'colormag_h3_typography_group',
				'label'    => esc_html__( 'H3', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 100,
			),

			array(
				'name'      => 'colormag_h3_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'size' => '24',
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
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_h3_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 110,
			),

			/**
			 * H4.
			 */
			array(
				'name'     => 'colormag_h4_typography_group',
				'label'    => esc_html__( 'H4', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 120,
			),

			array(
				'name'      => 'colormag_h4_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'   => array(
						'desktop' => array(
							'size' => '24',
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
					'line-height' => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
				'parent'    => 'colormag_h4_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 130,
			),

			/**
			 * H5.
			 */
			array(
				'name'     => 'colormag_h5_typography_group',
				'label'    => esc_html__( 'H5', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 140,
			),

			array(
				'name'      => 'colormag_h5_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'   => array(
						'desktop' => array(
							'size' => '22',
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
					'line-height' => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
				'parent'    => 'colormag_h5_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 150,
			),

			/**
			 * H6.
			 */
			array(
				'name'     => 'colormag_h6_typography_group',
				'label'    => esc_html__( 'H6', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_typography_section',
				'priority' => 160,
			),

			array(
				'name'      => 'colormag_h6_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'   => array(
						'desktop' => array(
							'size' => '18',
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
					'line-height' => array(
						'desktop' => array(
							'size' => '1.2',
							'unit' => '-',
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
				'parent'    => 'colormag_h6_typography_group',
				'section'   => 'colormag_global_typography_section',
				'transport' => 'postMessage',
				'priority'  => 170,
			),

			array(
				'name'        => 'colormag_colors_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_global_typography_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Typography_options();
