<?php
/**
 * Define constants.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_Constants' ) ) {

	/**
	 * ColorMag_Constants class.
	 */
	class ColorMag_Constants {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object Singleton instance of ColorMag_Constants class
		 */
		private static $instance;

		/**
		 * Array of constants and their values.
		 *
		 * @access private
		 * @var array
		 */
		private $constants;

		/**
		 * Singleton instance.
		 *
		 * @return ColorMag_Constants
		 *
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) ) {

				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {

			// TODO: reuse constant instead of calling function for each constant.
			// TODO: sending constant data as constructor argument.
			$this->constants = array(

				/**
				 * Define Directory Location Constants
				 */
				'COLORMAG_THEME_VERSION'         => wp_get_theme( get_template() )->get( 'Version' ),
				'COLORMAG_PARENT_DIR'            => get_template_directory(),
				'COLORMAG_INCLUDES_DIR'          => get_template_directory() . '/inc',
				'COLORMAG_CSS_DIR'               => get_template_directory() . '/assets/css',
				'COLORMAG_JS_DIR'                => get_template_directory() . '/assets/js',
				'COLORMAG_LANGUAGES_DIR'         => get_template_directory() . '/languages',
				'COLORMAG_WIDGETS_DIR'           => get_template_directory() . '/inc/widgets',
				'COLORMAG_CUSTOMIZER_DIR'        => get_template_directory() . '/inc/customizer',
				'COLORMAG_ELEMENTOR_DIR'         => get_template_directory() . '/inc/compatibility/elementor',
				'COLORMAG_ELEMENTOR_WIDGETS_DIR' => get_template_directory() . '/inc/compatibility/elementor/widgets',

				'COLORMAG_CHILD_DIR'             => get_stylesheet_directory(),

				/**
				 * Define URL Location Constants
				 */
				'COLORMAG_PARENT_URL'            => get_template_directory_uri(),

				'COLORMAG_INCLUDES_URL'          => get_template_directory_uri() . '/inc',
				'COLORMAG_CSS_URL'               => get_template_directory_uri() . '/assets/css',
				'COLORMAG_JS_URL'                => get_template_directory_uri() . '/assets/js',
				'COLORMAG_IMG_URL'               => get_template_directory_uri() . '/assets/img',
				'COLORMAG_LANGUAGES_URL'         => get_template_directory_uri() . '/languages',
				'COLORMAG_WIDGETS_URL'           => get_template_directory_uri() . '/inc/widgets',
				'COLORMAG_CUSTOMIZER_URL'        => get_template_directory_uri() . '/inc/customizer',
				'COLORMAG_ELEMENTOR_URL'         => get_template_directory_uri() . '/inc/compatibility/elementor',
				'COLORMAG_ELEMENTOR_WIDGETS_URL' => get_template_directory_uri() . '/inc/compatibilitye/lementor/widgets',

				'COLORMAG_CHILD_URL'             => get_stylesheet_directory_uri(),
			);

			foreach ( $this->constants as $name => $value ) {

				$this->define_constant( $name, $value );
			}
		}

		/**
		 * Define constant safely.
		 *
		 * TODO: @since.
		 *
		 * @param string $name  Constant name.
		 * @param mixed  $value Constant value.
		 *
		 * @return void
		 */
		public function define_constant( $name, $value ) {

			if ( ! defined( $name ) ) {

				define( $name, $value );
			}
		}

	}
}

ColorMag_Constants::get_instance();
