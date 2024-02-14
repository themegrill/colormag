<?php
/**
 * ColorMag customizer class for theme customize options.
 *
 * Class ColorMag_Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the customizer framework files.
require( dirname( __FILE__ ) . '/core/class-colormag-customizer-framework.php' );

/**
 * ColorMag customizer class.
 *
 * Class ColorMag_Customizer
 */
class ColorMag_Customizer {

	public function __construct() {

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_register' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ), 1 );

		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_dynamic_css' ) );
	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {

		// Override default.
		require COLORMAG_CUSTOMIZER_DIR . '/override-defaults.php';

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the required customize partials file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-partials.php';

		// Include the required customize section and panels register file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-register-sections-panels.php';

		/**
		 * Include the required customize options file.
		 */
		// Global.
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-colors-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-category-colors-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-container-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-sidebar-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-typography-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-button-options.php';

		// Front Page.
		require COLORMAG_CUSTOMIZER_DIR . '/options/front-page/class-colormag-customize-front-page-general-options.php';

		// Header.
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-site-identity-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-media-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-top-bar-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-main-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-primary-menu-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-sticky-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-news-ticker-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-action-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-breadcrumb-options.php';

		// Content.
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-blog-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-single-post-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-page-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-post-meta-options.php';

		// Additional.
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-social-icons-options.php';

		// Footer.
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-column-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-bar-options.php';

		// WooCommerce.
		require COLORMAG_CUSTOMIZER_DIR . '/options/woocommerce/class-colormag-customize-woocommerce-sidebar-options.php';
	}

	/**
	 * Adds inline styles.
	 *
	 * @return void
	 */
	public function customizer_dynamic_css() {
		wp_add_inline_style( 'colormag-style', ColorMag_Dynamic_CSS::get_css() );
	}

	public function editor_dynamic_css() {
		wp_add_inline_style( 'colormag-block-editor-styles', ColorMag_Dynamic_CSS::colormag_editor_block_css() );
	}

	/**
	 * Undocumented function.
	 *
	 * @return void
	 */
	public function get_css() {
	}

}

return new ColorMag_Customizer();
