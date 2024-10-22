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

require_once __DIR__ . '/functions.php';
/**
 * ColorMag customizer class.
 *
 * Class ColorMag_Customizer
 */
class ColorMag_Customizer {

	public function __construct() {

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_register' ) );

		add_action( 'customize_register', array( $this, 'on_customizer_register' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ), 1 );

		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_dynamic_css' ) );

		if ( get_theme_mod( 'colormag_enable_builder', false ) || colormag_maybe_enable_builder() ) {
			add_filter( 'customizer_widgets_section_args', [ $this, 'modify_widgets_panel' ], 10, 3 );
			add_filter( 'customize_section_active', [ $this, 'modify_widgets_section_state' ], 100, 2 );
		}
	}

	public function on_customizer_register( $wp_customize ) {
		$this->includes();
		do_action( 'colormag_customize_register', $wp_customize );
	}

	protected function includes() {
		require_once __DIR__ . '/panels-sections/panels-sections.php';
		require_once __DIR__ . '/options/options.php';
	}

	/**
	 * Filters response of WP_Customize_Section::active().
	 *
	 * @param bool  $active Whether the Customizer section is active.
	 * @param mixed $section WP_Customize_Section instance.
	 * @return bool
	 */
	public function modify_widgets_section_state( bool $active, $section ): bool {
		if (
			str_contains( $section->id, 'header-sidebar-' ) ||
			str_contains( $section->id, 'footer-sidebar-' ) ||
			str_contains( $section->id, 'colormag_header_sidebar' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_one_upper' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_two_upper' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_three_upper' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_one' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_two' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_three' ) ||
			str_contains( $section->id, 'colormag_footer_sidebar_four' )
		) {
			$active = true;
		}
		return $active;
	}

	/**
	 * Modify widgets panel.
	 *
	 * @param array      $section_args Array of Customizer widget section arguments.
	 * @param string     $section_id   Customizer section ID.
	 * @param int|string $sidebar_id   Sidebar ID.
	 */
	public function modify_widgets_panel( array $section_args, string $section_id, $sidebar_id ): array {
		$footer_widgets = [
			'colormag_footer_sidebar_one_upper',
			'colormag_footer_sidebar_two_upper',
			'colormag_footer_sidebar_three_upper',
			'colormag_footer_sidebar_one',
			'colormag_footer_sidebar_two',
			'colormag_footer_sidebar_three',
			'colormag_footer_sidebar_four',
		];
		$header_widgets = [
			'header-sidebar-1',
			'header-sidebar-2',
			'colormag_header_sidebar',
		];

		if ( in_array( $sidebar_id, $footer_widgets, true ) ) {
			$section_args['panel'] = 'colormag_footer_builder';
		}

		if ( in_array( $sidebar_id, $header_widgets, true ) ) {
			$section_args['panel'] = 'colormag_header_builder';
		}

		return $section_args;
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
		//      require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-register-sections-panels.php';

		/**
		 * Include the required customize options file.
		 */
		//      // Front Page.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/front-page/class-colormag-customize-front-page-general-options.php';
		//
		//      // Header.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-media-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-top-bar-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-main-header-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-primary-menu-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-sticky-header-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-news-ticker-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-header-action-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/header-and-navigation/class-colormag-customize-breadcrumb-options.php';
		//
		//      // Content.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-blog-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-single-post-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-page-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-post-meta-options.php';
		//
		//      // Additional.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-social-icons-options.php';
		//
		//      // Footer.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-column-options.php';
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-bar-options.php';
		//
		//      // WooCommerce.
		//      require COLORMAG_CUSTOMIZER_DIR . '/options/woocommerce/class-colormag-customize-woocommerce-sidebar-options.php';
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
