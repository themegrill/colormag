<?php
/**
 * ColorMag enqueue CSS and JS files.
 *
 * @package    ColorMag
 *
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_Enqueue_Scripts' ) ) {

	/**
	 * Enqueue Scripts.
	 */
	class ColorMag_Enqueue_Scripts {

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

			add_action( 'wp_enqueue_scripts', array( $this, 'colormag_scripts_styles_method' ) );

			add_action( 'enqueue_block_assets', array( $this, 'colormag_block_editor_styles' ), 1 );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'colormag_inline_customizer_css' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ), 11 );

			add_filter(
				'customind:typography:value',
				array( $this, 'colormag_default_typography' )
			);
		}

		public function colormag_default_typography( $value ) {
			if ( empty( $value['font-family'] ) || 'default' === strtolower( $value['font-family'] ) || ( 'inherit' === strtolower( $value['font-family'] ) ) ) {
				$value['font-family'] = 'Open Sans';
			}
			return $value;
		}

		/**
		 * Enqueue CSS and JS files.
		 */
		public function colormag_scripts_styles_method() {

			// Return if enqueueing is not enabled by the user.
			if ( false === apply_filters( 'colormag_enqueue_theme_assets', true ) ) {
				return;
			}

			// Variables.
			$suffix              = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			$skin_color          = get_theme_mod( 'colormag_color_skin_setting', 'white' );
			$inline_style_handle = ( 'white' === $skin_color ) ? 'colormag_style' : 'colormag_dark_style';

			// Loads our main css.
			wp_enqueue_style( 'colormag_style', get_stylesheet_uri(), array(), time() );
			wp_style_add_data( 'colormag_style', 'rtl', 'replace' );

			// Load dark css.
			if ( 'dark' === $skin_color ) {
				wp_enqueue_style( 'colormag_dark_style', get_template_directory_uri() . '/dark.css', array(), COLORMAG_THEME_VERSION );
			}

			// FontAwesome.
			global $customind;

			$fontawesome_path = $customind->get_asset_url( 'all.min.css', 'assets/fontawesome/v6/css', false );

			wp_enqueue_style( 'font-awesome-all', $fontawesome_path, array(), '6.2.4' );

			// Local Google fonts locally.
			$host_fonts_locally = get_theme_mod( 'colormag_load_google_fonts_locally', false );

			$typography_ids = apply_filters(
				'colormag_enqueue_scripts_typography_ids',
				array(
					'colormag_blog_post_title_typography',
					'colormag_single_post_title_typography',
					'colormag_mobile_menu_typography',
					'colormag_primary_menu_typography',
					'colormag_site_tagline_typography',
					'colormag_site_title_typography',
					'colormag_h6_typography',
					'colormag_h5_typography',
					'colormag_h4_typography',
					'colormag_h3_typography',
					'colormag_h2_typography',
					'colormag_h1_typography',
					'colormag_headings_typography',
					'colormag_base_typography',
					'colormag_footer_copyright_typography',
					'colormag_footer_menu_typography',
					'colormag_footer_widget_1_title_typography',
					'colormag_footer_widget_1_content_typography',
					'colormag_footer_widget_2_title_typography',
					'colormag_footer_widget_2_content_typography',
					'colormag_footer_widget_3_title_typography',
					'colormag_footer_widget_3_content_typography',
					'colormag_footer_widget_4_title_typography',
					'colormag_footer_widget_4_content_typography',
					'colormag_footer_widget_5_title_typography',
					'colormag_footer_widget_5_content_typography',
					'colormag_footer_widget_6_title_typography',
					'colormag_footer_widget_6_content_typography',
					'colormag_footer_widget_7_title_typography',
					'colormag_footer_widget_7_content_typography',
					'colormag_primary_sub_menu_typography',
					'colormag_mobile_sub_menu_typography',
					'colormag_date_typography',
					'colormag_header_site_title_typography',
					'colormag_header_site_tagline_typography',
					'colormag_header_mobile_menu_typography',
					'colormag_news_ticker_typography',
					'colormag_header_primary_menu_typography',
					'colormag_header_primary_sub_menu_typography',
					'colormag_header_secondary_menu_typography',
					'colormag_header_secondary_sub_menu_typography',
					'colormag_widget_1_title_typography',
					'colormag_widget_1_content_typography',
					'colormag_widget_2_title_typography',
					'colormag_widget_2_content_typography',
				)
			);

			$google_fonts_url = \Customind\Core\get_google_fonts_url_by_ids( $typography_ids, $host_fonts_locally );

			if ( $google_fonts_url ) {
				wp_enqueue_style( 'colormag_google_fonts', $google_fonts_url, array(), COLORMAG_THEME_VERSION, 'all' );
			}
			/**
			 * Inline CSS from customizer.
			 */
			add_filter( 'colormag_dynamic_theme_css', array( 'ColorMag_Dynamic_CSS', 'render_output' ) );

			// Generate dynamic CSS to add inline styles for the theme.
			$theme_dynamic_css = apply_filters( 'colormag_dynamic_theme_css', '' );

			wp_add_inline_style( $inline_style_handle, $theme_dynamic_css );

			/**
			 * Adds JavaScript to pages with the comment form to support
			 * sites with threaded comments (when in use).
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// Theme custom JS.
			wp_enqueue_script( 'colormag-custom', COLORMAG_JS_URL . '/colormag-custom' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// BxSlider JS.
			wp_enqueue_script( 'colormag-bxslider', COLORMAG_JS_URL . '/jquery.bxslider' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// Sticky Menu.
			if ( 1 == get_theme_mod( 'colormag_enable_sticky_menu', 0 ) ) {
				// Sticky JS enqueue.
				wp_enqueue_script( 'colormag-sticky-menu', COLORMAG_JS_URL . '/sticky/jquery.sticky' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
			}

			// News Ticker.
			wp_register_script( 'colormag-news-ticker', COLORMAG_JS_URL . '/news-ticker/jquery.newsTicker' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
			if ( ( 1 == get_theme_mod( 'colormag_enable_news_ticker', 0 ) ) || colormag_maybe_enable_builder() ) {
				wp_enqueue_script( 'colormag-news-ticker', COLORMAG_JS_URL . '/news-ticker/jquery.newsTicker' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
			}

			// MagnificPopup JS.
			wp_register_script( 'colormag-featured-image-popup', COLORMAG_JS_URL . '/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// MagnificPopup CSS.
			wp_register_style( 'colormag-featured-image-popup-css', COLORMAG_JS_URL . '/magnific-popup/magnific-popup' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

			if ( ( 1 == get_theme_mod( 'colormag_enable_lightbox', 0 ) ) && ( is_single() || is_page() ) ) {
				wp_enqueue_script( 'colormag-featured-image-popup' );
				wp_enqueue_style( 'colormag-featured-image-popup-css' );
			}

			// EasyTabs JS.
			wp_register_script( 'colormag-easy-tabs', COLORMAG_JS_URL . '/easytabs/jquery.easytabs' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// Navigation JS.
			wp_enqueue_script( 'colormag-navigation', COLORMAG_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// Font Awesome 4.
			$font_awesome_styles = array(
				array(
					'handle'  => 'font-awesome-4',
					'file'    => '/library/font-awesome/css/v4-shims',
					'version' => '4.7.0',
				),
			);

			foreach ( $font_awesome_styles as $style ) {
				wp_register_style(
					$style['handle'],
					get_template_directory_uri() . '/assets' . $style['file'] . $suffix . '.css',
					false,
					$style['version']
				);
				wp_enqueue_style( $style['handle'] );
			}

			wp_enqueue_style( 'colormag-font-awesome-6', get_template_directory_uri() . '/inc/customizer/customind/assets/fontawesome/v6/css/all.min.css', array(), '6.2.4' );

			// Weather Icons.
			wp_register_style( 'owfont', get_template_directory_uri() . '/assets/css/owfont-regular' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

			// FitVids JS.
			wp_enqueue_script( 'colormag-fitvids', COLORMAG_JS_URL . '/fitvids/jquery.fitvids' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// jQuery Video JS.
			wp_register_script( 'jquery-video', COLORMAG_JS_URL . '/jquery.video' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// HTML5Shiv for Lower IE versions.
			wp_enqueue_script( 'html5', COLORMAG_JS_URL . '/html5shiv' . $suffix . '.js', array(), COLORMAG_THEME_VERSION );
			wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

			// Skip link focus fix JS enqueue.
			wp_enqueue_script( 'colormag-skip-link-focus-fix', COLORMAG_JS_URL . '/skip-link-focus-fix' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );
		}

		public function customize_js() {

			wp_enqueue_script(
				'colormag-builder-customizer',
				COLORMAG_CUSTOMIZER_URL . '/assets/js/cm-customize.js',
				array( 'jquery', 'customize-controls' ),
				COLORMAG_THEME_VERSION,
				true
			);
		}

		/**
		 * Enqueue block editor styles.
		 *
		 * @since ColorMag 2.4.6
		 */
		public function colormag_block_editor_styles() {

			if ( ! is_admin() ) {
				return;
			}

			wp_enqueue_style( 'colormag-editor-googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600', array(), COLORMAG_THEME_VERSION );
			wp_enqueue_style( 'colormag-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css', array(), COLORMAG_THEME_VERSION );
			wp_enqueue_style( 'colormag-block-editor-dark-styles', get_template_directory_uri() . '/dark.css', array(), COLORMAG_THEME_VERSION );
			wp_style_add_data( 'colormag-block-editor-styles', 'rtl', 'replace' );
		}

		public function colormag_inline_customizer_css() {
			wp_add_inline_style(
				'customize-controls',
				'
				#customize-control-colormag_base_typography .customind-typography-label, #customize-control-colormag_headings_typography .customind-typography-label {
					font-weight: 600;
				}

				#customize-control-site_icon {
			    padding: 0px 12px;
			    width: 92%;
				}

				#customize-control-site_icon .customize-control-title, #customize-control-site_icon .customize-control-description{
					display:none;
				}

				#sub-accordion-section-colormag_category_colors_section {
				margin-bottom: 10px;
				}

				.control-section-customind-section.open .section-meta {
				margin-bottom: 10px !important;
				}

				#customize-control-site_icon .button-add-media{
				border-radius: 4px;
				}

				#customize-control-colormag_header_builder_components {
				margin-top:24px;
				padding-right:16px;
				}

				#customize-control-colormag_footer_builder_components {
			    padding-right:16px;
				}

			#accordion-section-colormag_transparent_header_section .accordion-section-title button::after {
				    top: calc(50% - 7px);
			}

			#accordion-section-colormag_transparent_header_section .accordion-section-title button{
			 font-weight: 400;
			    font-size:12px;

			}

				#customize-control-blogname {
			    padding: 0px 12px;
				    width: 92%;
				    padding-top: 10px;
				    margin-top: 0;
				    background: #FFF;
				}

				#customize-control-blogdescription {
			    padding: 0px 12px;
			    width: 90%;
				}

				#sub-accordion-panel-colormag_header_builder.current-panel {
			    height: 995px !important;
                 position: relative;
                     background: #F0F0F1;
				}

				#sub-accordion-section-colormag_footer_builder_section {
				background: #F0F0F1 !important;
				margin-top: 20px !important;
				}

				#customize-control-colormag_header_builder_components {
				    background: #F0F0F1 !important;
				}


			.accordion-section-title button.accordion-trigger:focus{
				    box-shadow: 0 0 0 0px #2271b1;
			}

				.wp-full-overlay[data-customind-builder-panel="colormag_footer_builder"].in-sub-panel:not(.section-open) #customize-theme-controls ul[id="sub-accordion-section-colormag_footer_builder_section"]{
			    top: 53px;
			    height: 748px;
				}

				#customize-control-colormag_footer_builder_components .customind-footer-types {
				display:none;
				}

		        #customize-control-colormag_site_identity_general_heading .customind-control .font-normal{
		        font-weight: 600;
		        }

		        #customize-control-colormag_header_media_heading .customind-control .font-normal{
		        font-weight: 600;
		        }

		        #customize-control-colormag_header_media_heading .customind-control {
		        border-bottom: 1px solid #e5e5e5;
		        }

		        #customize-control-colormag_site_identity_general_heading .customind-control {
		        border-bottom: 1px solid #e5e5e5;
		        }

		        #customize-control-blogname #_customize-input-blogname {
		        height: 40px;
		        }

		        #customize-control-blogdescription #_customize-input-blogdescription {
		        height: 40px;
		        }

		        [data-colormag-header-panel="active"]{
			    #sub-accordion-section-colormag_builder{
			    top: 65px !important;
			    left:2px !important;
			    visibility: visible !important;
			    height: auto !important;
			    transform: none !important;
			    z-index: 99999999;

			    .section-meta{
			        display:none !important;
			    }
			}

			#accordion-section-colormag_builder {
			    height:155px !important;
			    visibility: hidden;
			}
			    [data-control-id="colormag_builder_heading"]{
			        max-width: 310px !important;
			    }
			}

			.section-open[data-colormag-header-panel="active"]{
			    #sub-accordion-section-colormag_builder{
			        visibility: hidden !important;
			        height: auto !important;
			        transform: none !important;
			    }
			    }

			    #customize-control-colormag_header_builder_style_heading {
			    margin-top: 20px;
			    }

			    .zak-hidden{
			       height: 0;
				    visibility: hidden;
				    padding: 0 !important;
				    margin: 0;
				}

				#customize-control-colormag_demo_migrated_heading {
				display: none;
				}

				#accordion-section-colormag_customize_upsell_section .accordion-section-title a {
				padding: 10px 30px 11px 14px;
				display: block;
				}

				#accordion-section-colormag_customize_fb_section {
				display: flex;
				    justify-content: center;
				}

			#customize-theme-controls #accordion-section-colormag_customize_fb_section .accordion-section-title {
             background: transparent !important;
		    width: 220px;
		    border: 1px solid #1877F2;
		    border-radius: 4px;
		    margin: 21px;
		    position: relative;
		    text-align: right;
		}

		#customize-theme-controls #accordion-section-colormag_customize_fb_section .accordion-section-title:hover {
		    background: #F7F7F7 !important;
			}

		#accordion-section-colormag_customize_fb_section .accordion-section-title::before {
		        content: "\f09a";
			    font-family: "Font Awesome 6 Brands";
			    position: absolute;
			    right: 195px;
			    top: 48%;
			    transform: translateY(-50%);
			    color: #1877F2;
			    font-size: 15px;
			    display: block;
					}

		#customize-theme-controls #accordion-section-colormag_customize_fb_section .accordion-section-title a {
		       color: #1877F2 !important;
		    padding: 10px 10px 10px 11px;
		    display:block;

		}

		#customize-theme-controls #accordion-section-colormag_customize_fb_section .accordion-section-title a:focus {
		       box-shadow: 0 0 0 0 #2271b1;
            outline: 0 solid transparent;
		}

		#sub-accordion-section-colormag_header_builder_section {
				margin-top: 100px;
				    background: #F0F0F1;
				}


			#accordion-section-colormag_transparent_header_section {
			    display: block !important;
			    font-size:12px;
			}

			#accordion-section-title_tagline {
			    margin-top: 40px;
			    border-top: 1px solid #dcdcde !important;
			}

			#customize-controls .customize-info.section-meta,.customize-section-description,#customize-control-header_video,#customize-control-external_header_video,#customize-control-header_image,#customize-control-show_on_front {
			padding: 0 10px !important;
			width: 95%;
			}

			#customize-controls .customize-info {
			     margin-bottom: 0;
			}

			#customize-control-colormag_header_builder_components {
			    margin-top: 24px;
			}

			#customize-control-colormag_header_footer_components {
			    margin-top: 24px;
			}

			#customize-control-colormag_color_palette .customind-preset-1,#customize-control-colormag_color_palette .customind-preset-2,#customize-control-colormag_color_palette .customind-preset-3,#customize-control-colormag_color_palette .customind-preset-4 {
			display:none;
			}

			#accordion-section-colormag_sticky_header_section .accordion-section-title button::after {
				    top: calc(50% - 7px);
			}
		    '
			);

			if ( colormag_maybe_enable_builder() ) {
				wp_add_inline_style(
					'customize-controls',
					'
#accordion-section-colormag_sticky_header_section .accordion-section-title{
			border-top: 1px solid #dcdcde !important;
			border-left: 1px solid #dcdcde !important;
			border-right: 1px solid #dcdcde !important;
			}

			#accordion-section-colormag_sticky_header_section {
			    display: block !important;
			}

				#accordion-section-colormag_sticky_header_section {
					    position: absolute;
					    bottom: 160px;
					    width: 100%;
				}

				#accordion-section-colormag_sticky_header_section .accordion-section-title{
			    margin: 0 10px;
                border-radius: 4px;
			}

			#accordion-section-colormag_sticky_header_section .accordion-section-title button{
			 font-weight: 400;
			  font-size:12px;
			}

			#accordion-section-colormag_customize_header_navigation_section {
					    position: absolute;
					    bottom: 0px;
				}
					'
				);

			}
		}
	}

}

ColorMag_Enqueue_Scripts::get_instance();

/**
 * Filter hook to get the required Google font subsets for this theme.
 */
function colormag_font_subset() {

	$google_font_subsets = array();

	/**
	 * Typography options.
	 */
	// Base typography.
	$base_typography_default = array(
		'subsets' => array( 'latin' ),
	);

	$base_typography = get_theme_mod( 'colormag_base_typography', $base_typography_default );

	if ( isset( $base_typography['subsets'] ) && is_array( $base_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $base_typography['subsets'], $google_font_subsets );
	}

	// Headings typography.
	$headings_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$headings_typography         = get_theme_mod( 'colormag_headings_typography', $headings_typography_default );

	if ( isset( $headings_typography['subsets'] ) && is_array( $headings_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $headings_typography['subsets'], $google_font_subsets );
	}

	// Heading H1 typography.
	$heading_h1_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h1_typography         = get_theme_mod( 'colormag_h1_typography', $heading_h1_typography_default );

	if ( isset( $heading_h1_typography['subsets'] ) && is_array( $heading_h1_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h1_typography['subsets'], $google_font_subsets );
	}

	// Heading H2 typography.
	$heading_h2_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h2_typography         = get_theme_mod( 'colormag_h2_typography', $heading_h2_typography_default );

	if ( isset( $heading_h2_typography['subsets'] ) && is_array( $heading_h2_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h2_typography['subsets'], $google_font_subsets );
	}

	// Heading H3 typography.
	$heading_h3_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h3_typography         = get_theme_mod( 'colormag_h3_typography', $heading_h3_typography_default );

	if ( isset( $heading_h3_typography['subsets'] ) && is_array( $heading_h3_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h3_typography['subsets'], $google_font_subsets );
	}

	// Heading H4 typography.
	$heading_h4_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h4_typography         = get_theme_mod( 'colormag_h4_typography', $heading_h4_typography_default );

	if ( isset( $heading_h4_typography['subsets'] ) && is_array( $heading_h4_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h4_typography['subsets'], $google_font_subsets );
	}

	// Heading H5 typography.
	$heading_h5_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h5_typography         = get_theme_mod( 'colormag_h5_typography', $heading_h5_typography_default );

	if ( isset( $heading_h5_typography['subsets'] ) && is_array( $heading_h5_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h5_typography['subsets'], $google_font_subsets );
	}

	// Heading H6 typography.
	$heading_h6_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h6_typography         = get_theme_mod( 'colormag_h6_typography', $heading_h6_typography_default );

	if ( isset( $heading_h6_typography['subsets'] ) && is_array( $heading_h6_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h6_typography['subsets'], $google_font_subsets );
	}

	return $google_font_subsets;
}

add_filter( 'colormag_font_subset', 'colormag_font_subset' );


/**
 * Enqueue image upload script for use within widgets.
 */
function colormag_image_uploader() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_media();
	wp_enqueue_script( 'colormag-widget-image-upload', COLORMAG_JS_URL . '/image-uploader' . $suffix . '.js', false, COLORMAG_THEME_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'colormag_image_uploader' );

// Returns an array of category colors.
function colormag_get_category_colors() {
	$category_colors = array();
	foreach ( get_categories() as $cat ) {
		$color                            = get_theme_mod( 'colormag_category_color_' . $cat->term_id );
		$category_colors[ $cat->term_id ] = $color;
	}
	return $category_colors;
}

// Enqueue and localize editor script with category colors.
function colormag_enqueue_editor_assets() {
	wp_enqueue_script(
		'colormag-editor-script',
		get_template_directory_uri() . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor' ),
		COLORMAG_THEME_VERSION,
		true
	);

	wp_localize_script(
		'colormag-editor-script',
		'colormag_category_colors',
		colormag_get_category_colors()
	);

	wp_localize_script(
		'colormag-editor-script',
		'colormag_category_color_override',
		get_theme_mod( 'colormag_enable_override_category_color', false )
	);
}
add_action( 'enqueue_block_editor_assets', 'colormag_enqueue_editor_assets' );

if ( ! function_exists( 'colormag_darkcolor' ) ) :

	/**
	 * Generate darker color
	 *
	 * @param string $hex   Hex color value.
	 * @param string $steps Steps to change the hex color value for equivalent dark color.
	 *
	 * @return string
	 */
	function colormag_darkcolor( $hex, $steps ) {

		// Steps should be between -255 and 255. Negative = darker, positive = lighter.
		$steps = max( -255, min( 255, $steps ) );

		// Normalize into a six character long hex string.
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B.
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {

			// Convert to decimal.
			$color = hexdec( $color );

			// Adjust the color.
			$color = max( 0, min( 255, $color + $steps ) );

			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code.

		}

		return $return;
	}

endif;

if ( ! function_exists( 'colormag_parse_css' ) ) :

	/**
	 * Parses CSS.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param array        $css_output    Array of CSS.
	 * @param string       $min_media     Min Media breakpoint.
	 * @param string       $max_media     Max Media breakpoint.
	 *
	 * @return string Generated CSS.
	 */
	function colormag_parse_css( $default_value, $output_value, $css_output = array(), $min_media = '', $max_media = '' ) {

		// Return if default value matches.
		if ( strpos( $output_value, 'var' ) === false && $default_value === $output_value ) {
			return;
		}

		$parse_css = '';

		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( null === $properties ) {
					break;
				}

				if ( ! count( $properties ) ) {
					continue;
				}

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue;
					}

					++$properties_added;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' !== $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = 'screen and (min-width:' . $min_media . 'px)';
				}

				if ( '' !== $max_media ) {
					$max_media_css = 'screen and (max-width:' . $max_media . 'px)';
				}

				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;
			}
		}

		return $parse_css;
	}

endif;

if ( ! function_exists( 'colormag_parse_background_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 *
	 * @return string|void Generated CSS for background CSS property.
	 */
	function colormag_parse_background_css( $default_value, $output_value, $selector ) {

		if ( strpos( $output_value['background-color'], 'var' ) === false && $default_value === $output_value ) {
			return;
		}

		$parse_css  = '';
		$parse_css .= $selector . '{';

		// For background color.
		if ( isset( $output_value['background-color'] ) ) {
			$parse_css .= 'background-color:' . $output_value['background-color'] . ';';
		}

		// For background image.
		if ( isset( $output_value['background-image'] ) && ( $output_value['background-image'] != $default_value['background-image'] ) ) {
			$parse_css .= 'background-image:url(' . $output_value['background-image'] . ');';
		}

		// For background position.
		if ( isset( $output_value['background-position'] ) && ( $output_value['background-position'] != $default_value['background-position'] ) ) {
			$parse_css .= 'background-position:' . $output_value['background-position'] . ';';
		}

		// For background size.
		if ( isset( $output_value['background-size'] ) && ( $output_value['background-size'] != $default_value['background-size'] ) ) {
			$parse_css .= 'background-size:' . $output_value['background-size'] . ';';
		}

		// For background attachment.
		if ( isset( $output_value['background-attachment'] ) && ( $output_value['background-attachment'] != $default_value['background-attachment'] ) ) {
			$parse_css .= 'background-attachment:' . $output_value['background-attachment'] . ';';
		}

		// For background repeat.
		if ( isset( $output_value['background-repeat'] ) && ( $output_value['background-repeat'] != $default_value['background-repeat'] ) ) {
			$parse_css .= 'background-repeat:' . $output_value['background-repeat'] . ';';
		}

		$parse_css .= '}';

		return $parse_css;
	}

endif;

if ( ! function_exists( 'colormag_parse_dimension_css' ) ) {
	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 * @param string       $property      CSS property.
	 *
	 * @return string|void Generated CSS for dimension CSS.
	 */
	function colormag_parse_dimension_css( $default_value, $output_value, $selector, $property ) {

		if ( $default_value === $output_value ) {
			return;
		}

		$parse_css = $selector . '{';

		$unit = isset( $output_value['unit'] ) ? $output_value['unit'] : ( isset( $default_value['unit'] ) ? $default_value['unit'] : 'px' );

		if ( 'border-width' === $property ) {

			if ( isset( $output_value['top'] ) && ( $output_value['top'] !== $default_value['top'] ) ) {
				$parse_css .= 'border-top-width:' . $output_value['top'] . $unit . ';';
			}

			if ( isset( $output_value['right'] ) && ( $output_value['right'] !== $default_value['right'] ) ) {
				$parse_css .= 'border-right-width:' . $output_value['right'] . $unit . ';';
			}

			if ( isset( $output_value['bottom'] ) && ( $output_value['bottom'] !== $default_value['bottom'] ) ) {
				$parse_css .= 'border-bottom-width:' . $output_value['bottom'] . $unit . ';';
			}

			if ( isset( $output_value['left'] ) && ( $output_value['left'] !== $default_value['left'] ) ) {
				$parse_css .= 'border-left-width:' . $output_value['left'] . $unit . ';';
			}
		} elseif ( 'border-radius' === $property ) {

			if ( isset( $output_value['top'] ) && ( $output_value['top'] !== $default_value['top'] ) ) {
				$parse_css .= 'border-top-left-radius:' . $output_value['top'] . $unit . ';';
			}

			if ( isset( $output_value['right'] ) && ( $output_value['right'] !== $default_value['right'] ) ) {
				$parse_css .= 'border-top-right-radius:' . $output_value['right'] . $unit . ';';
			}

			if ( isset( $output_value['bottom'] ) && ( $output_value['bottom'] !== $default_value['bottom'] ) ) {
				$parse_css .= 'border-bottom-right-radius:' . $output_value['bottom'] . $unit . ';';
			}

			if ( isset( $output_value['left'] ) && ( $output_value['left'] !== $default_value['left'] ) ) {
				$parse_css .= 'border-bottom-left-radius:' . $output_value['left'] . $unit . ';';
			}
		} else {
			if ( isset( $output_value['top'] ) && ( $output_value['top'] !== $default_value['top'] ) ) {
				$parse_css .= $property . '-top:' . $output_value['top'] . $unit . ';';
			}

			if ( isset( $output_value['right'] ) && ( $output_value['right'] !== $default_value['right'] ) ) {
				$parse_css .= $property . '-right:' . $output_value['right'] . $unit . ';';
			}

			if ( isset( $output_value['bottom'] ) && ( $output_value['bottom'] !== $default_value['bottom'] ) ) {
				$parse_css .= $property . '-bottom:' . $output_value['bottom'] . $unit . ';';
			}

			if ( isset( $output_value['left'] ) && ( $output_value['left'] !== $default_value['left'] ) ) {
				$parse_css .= $property . '-left:' . $output_value['left'] . $unit . ';';
			}
		}

		$parse_css .= '}';

		return $parse_css;
	}
}

if ( ! function_exists( 'colormag_parse_border_css' ) ) {
	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 * @param string       $property      CSS property.
	 *
	 * @return string|void Generated CSS for border CSS.
	 */
	function colormag_parse_border_css( $default_value, $output_value, $selector, $property ) {
		if ( $default_value === $output_value ) {
			return;
		}
		$parse_css = $selector . '{';
		if ( isset( $output_value ) && ! empty( $output_value ) && ( $output_value !== $default_value ) ) {
			if ( $property == 'radius' || $property == 'width' ) {
				$parse_css .= 'border-' . $property . ':' . $output_value . 'px;';
			} else {
				$parse_css .= 'border-' . $property . ':' . $output_value . ';';
			}
		}
		$parse_css .= '}';
		return $parse_css;
	}
}

if ( ! function_exists( 'colormag_parse_typography_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 * @param array        $devices       Devices for breakpoints.
	 *
	 * @return string|void Generated CSS for typography CSS.
	 */
	function colormag_parse_typography_css( $default_value, $output_value, $selector, $devices = array() ) {

		if ( isset( $default_value['font-family'] ) && isset( $output_value['font-family'] ) && 'Inherit' === $output_value['font-family'] ) {
			$output_value['font-family'] = 'inherit';
		}

		if ( $default_value === $output_value ) {
			return;
		}

		$parse_css = $selector . '{';

		// For font family.
		$default_value_font_family = isset( $default_value['font-family'] ) ? $default_value['font-family'] : '';
		if ( isset( $output_value['font-family'] ) && ! empty( $output_value['font-family'] ) && ( $output_value['font-family'] !== $default_value_font_family ) && ( 'default' !== strtolower( $output_value['font-family'] ) ) ) {
			$parse_css .= 'font-family:' . $output_value['font-family'] . ';';
		}

		// For font style.
		$default_value_font_style = isset( $default_value['font-style'] ) ? $default_value['font-style'] : '';
		if ( isset( $output_value['font-style'] ) && ! empty( $output_value['font-style'] ) && ( $output_value['font-style'] !== $default_value_font_style ) ) {
			$parse_css .= 'font-style:' . $output_value['font-style'] . ';';
		}

		// For text transform.
		$default_value_text_transform = isset( $default_value['text-transform'] ) ? $default_value['text-transform'] : '';
		if ( isset( $output_value['text-transform'] ) && ! empty( $output_value['text-transform'] ) && ( $output_value['text-transform'] !== $default_value_text_transform ) ) {
			$parse_css .= 'text-transform:' . $output_value['text-transform'] . ';';
		}

		// For text decoration.
		$default_value_text_decoration = isset( $default_value['text-decoration'] ) ? $default_value['text-decoration'] : '';
		if ( isset( $output_value['text-decoration'] ) && ! empty( $output_value['text-decoration'] ) && ( $output_value['text-decoration'] !== $default_value_text_decoration ) ) {
			$parse_css .= 'text-decoration:' . $output_value['text-decoration'] . ';';
		}

		// For font weight.
		$default_value_font_weight = isset( $default_value['font-weight'] ) ? $default_value['font-weight'] : '';
		if ( isset( $output_value['font-weight'] ) && ! empty( $output_value['font-weight'] ) && ( $output_value['font-weight'] !== $default_value_font_weight ) ) {
			$font_weight_value = $output_value['font-weight'];

			if ( 'italic' === $font_weight_value || 'regular' === $font_weight_value ) {
				$parse_css .= 'font-weight:' . 400 . ';';
			} else {
				$parse_css .= 'font-weight:' . str_replace( 'italic', '', $font_weight_value ) . ';';
			}
		}

		// For font size on desktop.
		$font_size_unit            = isset( $output_value['font-size']['desktop']['unit'] ) ? $output_value['font-size']['desktop']['unit'] : 'px';
		$default_desktop_font_size = isset( $default_value['font-size']['desktop']['size'] ) ? $default_value['font-size']['desktop']['size'] : '';
		if ( isset( $output_value['font-size']['desktop']['size'] ) && ! empty( $output_value['font-size']['desktop']['size'] ) && ( $output_value['font-size']['desktop']['size'] !== $default_desktop_font_size ) ) {
			$parse_css .= 'font-size:' . $output_value['font-size']['desktop']['size'] . $font_size_unit . ';';
		}

		// For line height on desktop.
		$line_height_unit_value      = isset( $output_value['line-height']['desktop']['unit'] ) ? $output_value['line-height']['desktop']['unit'] : 'px';
		$line_height_unit            = ( '-' !== $line_height_unit_value ) ? $line_height_unit_value : '';
		$default_desktop_line_height = isset( $default_value['line-height']['desktop']['size'] ) ? $default_value['line-height']['desktop']['size'] : '';

		if ( isset( $output_value['line-height']['desktop']['size'] ) && ! empty( $output_value['line-height']['desktop']['size'] ) && ( $output_value['line-height']['desktop']['size'] !== $default_desktop_line_height ) ) {
			$parse_css .= 'line-height:' . $output_value['line-height']['desktop']['size'] . $line_height_unit . ';';
		}

		// For letter spacing on desktop.
		$letter_spacing_unit            = isset( $output_value['letter-spacing']['desktop']['unit'] ) ? $output_value['letter-spacing']['desktop']['unit'] : 'px';
		$default_desktop_letter_spacing = isset( $default_value['letter-spacing']['desktop']['size'] ) ? $default_value['letter-spacing']['desktop']['size'] : '';

		if ( isset( $output_value['letter-spacing']['desktop']['size'] ) && ! empty( $output_value['letter-spacing']['desktop']['size'] ) && ( $output_value['letter-spacing']['desktop']['size'] !== $default_desktop_letter_spacing ) ) {
			$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['desktop']['size'] . $letter_spacing_unit . ';';
		}

		$parse_css .= '}';

		// For responsive devices.
		if ( is_array( $devices ) ) {

			foreach ( $devices as $device => $size ) {

				// For tablet devices.
				if ( 'tablet' === $device && $size ) {
					$default_tablet_font_size_spacing = isset( $default_value['font-size']['tablet']['size'] ) ? $default_value['font-size']['tablet']['size'] : '';
					if ( isset( $output_value['font-size']['tablet']['size'] ) && ! empty( $output_value['font-size']['tablet']['size'] ) && $output_value['font-size']['tablet']['size'] !== $default_tablet_font_size_spacing ) {

						$font_size_tablet_unit = $output_value['font-size']['tablet']['unit'] ? $output_value['font-size']['tablet']['unit'] : 'px';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'font-size:' . $output_value['font-size']['tablet']['size'] . $font_size_tablet_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}

					$default_tablet_line_height_spacing = isset( $default_value['line-height']['tablet']['size'] ) ? $default_value['line-height']['tablet']['size'] : '';
					if ( isset( $output_value['line-height']['tablet']['size'] ) && ! empty( $output_value['line-height']['tablet']['size'] ) && $output_value['line-height']['tablet']['size'] !== $default_tablet_line_height_spacing ) {

						$line_height_tablet_unit_value = $output_value['line-height']['tablet']['unit'] ? $output_value['line-height']['tablet']['unit'] : '';
						$line_height_tablet_unit       = ( '-' !== $line_height_tablet_unit_value ) ? $line_height_tablet_unit_value : '';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'line-height:' . $output_value['line-height']['tablet']['size'] . $line_height_tablet_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}

					$default_tablet_letter_spacing_spacing = isset( $default_value['letter-spacing']['tablet']['size'] ) ? $default_value['letter-spacing']['tablet']['size'] : '';
					if ( isset( $output_value['letter-spacing']['tablet']['size'] ) && ! empty( $output_value['letter-spacing']['tablet']['size'] ) && $output_value['letter-spacing']['tablet']['size'] !== $default_tablet_letter_spacing_spacing ) {

						$letter_spacing_tablet_unit = $output_value['letter-spacing']['tablet']['unit'] ? $output_value['letter-spacing']['tablet']['unit'] : 'px';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['tablet']['size'] . $letter_spacing_tablet_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}
				}

				// For mobile devices.
				if ( 'mobile' === $device && $size ) {
					$default_mobile_font_size_spacing = isset( $default_value['font-size']['mobile']['size'] ) ? $default_value['font-size']['mobile']['size'] : '';
					if ( isset( $output_value['font-size']['mobile']['size'] ) && ! empty( $output_value['font-size']['mobile']['size'] ) && $output_value['font-size']['mobile']['size'] !== $default_mobile_font_size_spacing ) {

						$font_size_mobile_unit = $output_value['font-size']['mobile']['unit'] ? $output_value['font-size']['mobile']['unit'] : 'px';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'font-size:' . $output_value['font-size']['mobile']['size'] . $font_size_mobile_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}

					$default_mobile_line_height_spacing = isset( $default_value['line-height']['mobile']['size'] ) ? $default_value['line-height']['mobile']['size'] : '';
					if ( isset( $output_value['line-height']['mobile']['size'] ) && ! empty( $output_value['line-height']['mobile']['size'] ) && $output_value['line-height']['mobile']['size'] !== $default_mobile_line_height_spacing ) {

						$line_height_mobile_unit_value = $output_value['line-height']['mobile']['unit'] ? $output_value['line-height']['mobile']['unit'] : '';
						$line_height_mobile_unit       = ( '-' !== $line_height_mobile_unit_value ) ? $line_height_mobile_unit_value : '';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'line-height:' . $output_value['line-height']['mobile']['size'] . $line_height_mobile_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}

					$default_mobile_letter_spacing_spacing = isset( $default_value['letter-spacing']['mobile']['size'] ) ? $default_value['letter-spacing']['mobile']['size'] : '';
					if ( isset( $output_value['letter-spacing']['mobile']['size'] ) && ! empty( $output_value['letter-spacing']['mobile']['size'] ) && $output_value['letter-spacing']['mobile']['size'] !== $default_mobile_letter_spacing_spacing ) {

						$letter_spacing_mobile_unit = $output_value['letter-spacing']['mobile']['unit'] ? $output_value['letter-spacing']['mobile']['unit'] : 'px';

						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';
						$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['mobile']['size'] . $letter_spacing_mobile_unit . ';';
						$parse_css .= '}';
						$parse_css .= '}';
					}
				}
			}
		}

		return $parse_css;
	}

endif;

if ( ! function_exists( 'colormag_parse_slider_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value Updated value.
	 * @param string $selector CSS selector.
	 * @param string $property CSS property.
	 *
	 * @return string|void Generated CSS for dimension CSS.
	 */
	function colormag_parse_slider_css( $default_value, $output_value, $selector, $property ) {

		if ( $default_value === $output_value ) {
			return;
		}

		$parse_css = '';

		if ( isset( $output_value['desktop']['size'] ) || isset( $output_value['tablet']['size'] ) || isset( $output_value['mobile']['size'] ) ) {
			$parse_css = '';

			// Desktop styling
			if ( isset( $output_value['desktop']['size'] ) ) {
				$unit = isset( $output_value['desktop']['unit'] ) ? $output_value['desktop']['unit'] :
					( isset( $default_value['desktop']['unit'] ) ? $default_value['desktop']['unit'] : 'px' );

				$parse_css .= $selector . '{';
				$parse_css .= $property . ':' . $output_value['desktop']['size'] . $unit . ';';
				$parse_css .= '}';
			}

			// Tablet styling
			if ( isset( $output_value['tablet']['size'] ) && ! empty( $output_value['tablet']['size'] ) ) {
				$tablet_unit = isset( $output_value['tablet']['unit'] ) ? $output_value['tablet']['unit'] :
					( isset( $default_value['tablet']['unit'] ) ? $default_value['tablet']['unit'] : 'px' );

				$parse_css .= '@media(max-width: 768px){';
				$parse_css .= $selector . '{';
				$parse_css .= $property . ':' . $output_value['tablet']['size'] . $tablet_unit . ';';
				$parse_css .= '}';
				$parse_css .= '}';
			}

			// Mobile styling
			if ( isset( $output_value['mobile']['size'] ) && ! empty( $output_value['mobile']['size'] ) ) {
				$mobile_unit = isset( $output_value['mobile']['unit'] ) ? $output_value['mobile']['unit'] :
					( isset( $default_value['mobile']['unit'] ) ? $default_value['mobile']['unit'] : 'px' );

				$parse_css .= '@media(max-width: 600px){';
				$parse_css .= $selector . '{';
				$parse_css .= $property . ':' . $output_value['mobile']['size'] . $mobile_unit . ';';
				$parse_css .= '}';
				$parse_css .= '}';
			}
		} elseif ( isset( $output_value['size'] ) ) {
			// Handle legacy format (non-responsive)
			$parse_css  = $selector . '{';
			$unit       = isset( $output_value['unit'] ) ? $output_value['unit'] :
				( isset( $default_value['unit'] ) ? $default_value['unit'] : 'px' );
			$parse_css .= $property . ':' . $output_value['size'] . $unit . ';';
			$parse_css .= '}';
		}

		return $parse_css;
	}

	endif;
