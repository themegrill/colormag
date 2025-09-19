<?php
/**
 * ColorMag functions related to WordPress core functionality.
 *
 * @uses    add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses    register_nav_menu() To add support for navigation menu.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_After_Setup_Theme' ) ) {

	/**
	 * After setup theme.
	 */
	class ColorMag_After_Setup_Theme {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator.
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

			$this->setup_hooks();
		}

		/**
		 * Define hooks.
		 *
		 * @return void
		 */
		public function setup_hooks() {

			add_action( 'after_setup_theme', array( $this, 'colormag_setup' ) );
			add_action( 'after_setup_theme', array( $this, 'support_editor_color_palette' ) );
			add_action( 'rest_request_after_callbacks', array( $this, 'elementor_add_theme_colors' ), 999, 3 );
			add_action( 'rest_request_after_callbacks', array( $this, 'display_global_colors_front_end' ), 999, 3 );
			add_filter( 'colormag_theme_dynamic_css', array( $this, 'generate_global_elementor_style' ) );
		}

		public function support_editor_color_palette() {
			$global_palette = get_theme_mod(
				'colormag_color_palette',
				array(
					'id'     => 'preset-5',
					'name'   => 'Preset 5',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#F9FEFD',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#16181A',
						'cm-color-7' => '#8F8F8F',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C7C7C7',
					),
				)
			);
			$editor_palette = $this->format_global_palette( $global_palette );
			add_theme_support( 'editor-color-palette', $editor_palette );
		}

		public function format_global_palette( $global_palette ) {
			$editor_palette = array();

			if ( isset( $global_palette['colors'] ) && is_array( $global_palette['colors'] ) ) {
				$color_names = array(
					'1' => 'Main Accent',
					'2' => 'Secondary Accent',
					'3' => 'Main Background',
					'4' => 'Surface Background',
					'5' => 'Contrast Background',
					'6' => 'Title Text',
					'7' => 'Regular Text',
					'8' => 'Text on Contrast',
					'9' => 'Muted Color / Border',
				);

				foreach ( $global_palette['colors'] as $color_key => $color_value ) {
					preg_match( '/(\d+)$/', $color_key, $matches );
					$num   = $matches[1] ?? '';
					$label = 'ColorMag - ' . ( $color_names[ $num ] ?? $color_key );

					$editor_palette[] = array(
						'name'  => $label,
						'slug'  => $color_key,
						'color' => $color_value,
					);
				}
			}
			return $editor_palette;
		}

		/**
		 * Add theme colors to Elementor global colors via REST API.
		 *
		 * @param \WP_REST_Response $response The response object.
		 * @param array             $handler  The handler that was used.
		 * @param \WP_REST_Request  $request  The request object.
		 * @return \WP_REST_Response
		 */
		public function elementor_add_theme_colors( $response, $handler, $request ) {

			$route = $request->get_route();

			if ( '/elementor/v1/globals' !== $route ) {
				return $response;
			}

			$global_palette = get_theme_mod(
				'colormag_color_palette',
				array(
					'id'     => 'preset-5',
					'name'   => 'Preset 5',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#F9FEFD',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#16181A',
						'cm-color-7' => '#8F8F8F',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C7C7C7',
					),
				)
			);
			$data           = $response->get_data();

			if ( isset( $global_palette['colors'] ) && is_array( $global_palette['colors'] ) ) {
				foreach ( $global_palette['colors'] as $color_key => $color_value ) {
					// Remove hyphens from slug for Elementor compatibility
					$no_hyphens = str_replace( '-', '', $color_key );
					$label      = ucwords( str_replace( '-', ' ', $color_key ) );

					$data['colors'][ $no_hyphens ] = array(
						'id'    => esc_attr( $no_hyphens ),
						'title' => 'Theme ' . $label,
						'value' => $color_value,
					);
				}
			}

			$response->set_data( $data );
			return $response;
		}

		/**
		 * Display individual global colors for Elementor front-end requests.
		 *
		 * @param \WP_REST_Response $response The response object.
		 * @param array             $handler  The handler that was used.
		 * @param \WP_REST_Request  $request  The request object.
		 * @return \WP_REST_Response
		 */
		public function display_global_colors_front_end( $response, $handler, $request ) {
			$route = $request->get_route();

			if ( 0 !== strpos( $route, '/elementor/v1/globals' ) ) {
				return $response;
			}

			$slug_map       = array();
			$global_palette = get_theme_mod(
				'colormag_color_palette',
				array(
					'id'     => 'preset-5',
					'name'   => 'Preset 5',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#F9FEFD',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#16181A',
						'cm-color-7' => '#8F8F8F',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C7C7C7',
					),
				)
			);

			if ( isset( $global_palette['colors'] ) && is_array( $global_palette['colors'] ) ) {
				foreach ( $global_palette['colors'] as $color_key => $color_value ) {
					// Remove hyphens as hyphens do not work with Elementor global styles.
					$no_hyphens              = str_replace( '-', '', $color_key );
					$slug_map[ $no_hyphens ] = $color_key;
				}
			}

			$rest_id = substr( $route, strrpos( $route, '/' ) + 1 );

			if ( ! in_array( $rest_id, array_keys( $slug_map ), true ) ) {
				return $response;
			}

			$original_color_key = $slug_map[ $rest_id ];
			$label              = ucwords( str_replace( '-', ' ', $original_color_key ) );

			return rest_ensure_response(
				array(
					'id'    => esc_attr( $rest_id ),
					'title' => 'Theme ' . $label,
					'value' => $global_palette['colors'][ $original_color_key ],
				)
			);
		}

		/**
		 * Generate global Elementor style CSS variables.
		 *
		 * @param string $dynamic_css The existing dynamic CSS.
		 * @return string
		 */
		public function generate_global_elementor_style( $dynamic_css ) {
			$global_palette = get_theme_mod(
				'colormag_color_palette',
				array(
					'id'     => 'preset-5',
					'name'   => 'Preset 5',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#F9FEFD',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#16181A',
						'cm-color-7' => '#8F8F8F',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C7C7C7',
					),
				)
			);
			$palette_style  = array();
			$style          = array();

			if ( isset( $global_palette['colors'] ) ) {
				foreach ( $global_palette['colors'] as $color_key => $color_value ) {
					// Remove hyphens from color key for CSS variable
					$variable_key           = '--e-global-color-' . str_replace( '-', '', $color_key );
					$style[ $variable_key ] = $color_value;
				}

				$palette_style[':root'] = $style;
				$dynamic_css           .= $this->parse_css( $palette_style );
			}

			return $dynamic_css;
		}

		/**
		 * Parse CSS array into CSS string.
		 *
		 * @param array $css_array The CSS array to parse.
		 * @return string
		 */
		private function parse_css( $css_array ) {
			$css = '';

			foreach ( $css_array as $selector => $properties ) {
				$css .= $selector . ' {';
				foreach ( $properties as $property => $value ) {
					$css .= $property . ': ' . $value . ';';
				}
				$css .= '}';
			}

			return $css;
		}

		/**
		 * All theme setup functionalities.
		 *
		 * @since 1.0
		 */
		function colormag_setup() {

			/**
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'colormag', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
			add_theme_support( 'post-thumbnails' );

			// Registering navigation menu.
			register_nav_menus(
				array(
					'primary'        => esc_html__( 'Primary Menu', 'colormag' ),
					'menu-secondary' => esc_html__( 'Secondary Menu', 'colormag' ),
				)
			);

			// Cropping the images to different sizes to be used in the theme.
			add_image_size( 'colormag-highlighted-post', 392, 272, true );
			add_image_size( 'colormag-featured-post-medium', 390, 205, true );
			add_image_size( 'colormag-featured-post-small', 130, 90, true );
			add_image_size( 'colormag-featured-image', 800, 445, true );

			// Pro required image sizes.
			add_image_size( 'colormag-default-news', 150, 150, true );
			add_image_size( 'colormag-featured-image-large', 1400, 600, true );

			/**
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			// Enable support for Post Formats.
			add_theme_support(
				'post-formats',
				array(
					'aside',
					'image',
					'video',
					'quote',
					'link',
					'gallery',
					'chat',
					'audio',
					'status',
				)
			);

			// Adding excerpt option box for pages as well.
			add_post_type_support( 'page', 'excerpt' );

			/**
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);

			// Adds the support for the Custom Logo introduced in WordPress 4.5.
			add_theme_support(
				'custom-logo',
				array(
					'flex-width'  => true,
					'flex-height' => true,
				)
			);

			// Support Auto Load Next Post plugin.
			add_theme_support(
				'auto-load-next-post',
				array(
					'content_container'    => '#content',
					'title_selector'       => 'h1.cm-entry-title',
					'navigation_container' => 'ul.default-wp-page',
					'comments_container'   => 'div#comments',
				)
			);

			// Support for selective refresh widgets in Customizer.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Gutenberg layout support.
			add_theme_support( 'align-wide' );

			// Add support for Block Styles.
			add_theme_support( 'wp-block-styles' );

			// Responsive embeds support.
			add_theme_support( 'responsive-embeds' );
		}
	}
}

ColorMag_After_Setup_Theme::get_instance();
