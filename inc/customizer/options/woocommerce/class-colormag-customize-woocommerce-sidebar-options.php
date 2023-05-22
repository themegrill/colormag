<?php
/**
 * Class to include Design WooCommerce customize options.
 *
 * Class ColorMag_Customize_WooCommerce_Sidebar_Options
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
 * Bail out if `WooCommerce` plugin is not installed and activated.
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Class to include Design WooCommerce customize options.
 *
 * Class ColorMag_Customize_WooCommerce_Sidebar_Options
 */
class ColorMag_Customize_WooCommerce_Sidebar_Options extends ColorMag_Customize_Base_Option {

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

			// Additional sidebar area for WooCommerce pages option.
			array(
				'name'     => 'colormag_woocommerce_sidebar_register_setting',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to register different sidebar areas to be used for WooCommerce pages.', 'colormag' ),
				'section'  => 'colormag_woocommerce_sidebar_section',
				'priority' => 10,
			),

			array(
				'name'       => 'colormag_woocommerce_sidebar_layout_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Sidebar Layout', 'colormag' ),
				'section'    => 'colormag_woocommerce_sidebar_section',
				'dependency' => array(
					'colormag_woocommerce_sidebar_register_setting',
					'!=',
					0,
				),
				'priority'   => 20,
			),

			// WooCommerce shop page layout option.
			array(
				'name'       => 'colormag_woocmmerce_shop_page_layout',
				'default'    => 'right_sidebar',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'WooCommerce Shop Page Layout', 'colormag' ),
				'section'    => 'colormag_woocommerce_sidebar_section',
				'choices'    => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col'  => 2,
				'dependency' => array(
					'colormag_woocommerce_sidebar_register_setting',
					'!=',
					0,
				),
				'priority'   => 30,
			),

			// WooCommerce archive page layout option.
			array(
				'name'       => 'colormag_woocmmerce_archive_page_layout',
				'default'    => 'right_sidebar',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'WooCommerce Archive Page Layout', 'colormag' ),
				'section'    => 'colormag_woocommerce_sidebar_section',
				'choices'    => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col'  => 2,
				'dependency' => array(
					'colormag_woocommerce_sidebar_register_setting',
					'!=',
					0,
				),
				'priority'   => 40,
			),

			// WooCommerce single product page layout option.
			array(
				'name'       => 'colormag_woocmmerce_single_product_page_layout',
				'default'    => 'right_sidebar',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'WooCommerce Single Product Page Layout', 'colormag' ),
				'section'    => 'colormag_woocommerce_sidebar_section',
				'choices'    => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col'  => 2,
				'dependency' => array(
					'colormag_woocommerce_sidebar_register_setting',
					'!=',
					0,
				),
				'priority'   => 50,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_WooCommerce_Sidebar_Options();
