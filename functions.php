<?php
/**
 * ColorMag functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 *
 * @uses       add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses       register_nav_menu() To add support for navigation menu.
 * @uses       set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

/**
 * Define Elementor Partner ID
 */
if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
	define( 'ELEMENTOR_PARTNER_ID', 2125 );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * $content_width global variable adjustment as per layout option.
 */
function colormag_content_width() {
	global $post;
	global $content_width;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
	}
	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}
	$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

	if ( $layout_meta == 'default_layout' ) {
		if ( $colormag_default_layout == 'no_sidebar_full_width' ) {
			$content_width = 1140; /* pixels */
		} else {
			$content_width = 800; /* pixels */
		}
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$content_width = 1140; /* pixels */
	} else {
		$content_width = 800; /* pixels */
	}
}

add_action( 'template_redirect', 'colormag_content_width' );

add_action( 'after_setup_theme', 'colormag_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if ( ! function_exists( 'colormag_setup' ) ) :
	function colormag_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'colormag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support( 'post-thumbnails' );

		// Registering navigation menu.
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'colormag' ) );

		// Cropping the images to different sizes to be used in the theme
		add_image_size( 'colormag-highlighted-post', 392, 272, true );
		add_image_size( 'colormag-featured-post-medium', 390, 205, true );
		add_image_size( 'colormag-featured-post-small', 130, 90, true );
		add_image_size( 'colormag-featured-image', 800, 445, true );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'colormag_custom_background_args', array(
			'default-color' => 'eaeaea',
		) ) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'chat',
			'audio',
			'status',
		) );

		// Adding excerpt option box for pages as well
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// adding the WooCommerce plugin support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Adds the support for the Custom Logo introduced in WordPress 4.5
		add_theme_support( 'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Support for selective refresh widgets in Customizer
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg layout support.
		add_theme_support( 'align-wide' );

		$starter_content = array(
			'widgets'     => array(
				'colormag_header_sidebar'                          => array(
					'ad_banner_header' => array(
						'colormag_728x90_advertisement_widget',
						array(
							'728x90_image_link' => 'https://demo.themegrill.com/colormag-pro/',
							'728x90_image_url'  => get_template_directory_uri() . '/img/ad-large.jpg',
						),
					),
				),
				'colormag_front_page_slider_area'                  => array(
					'featured_posts_slider' => array(
						'colormag_featured_posts_slider_widget',
						array(
							'number' => 2,
						),
					),
				),
				'colormag_front_page_area_beside_slider'           => array(
					'featured_posts_slider' => array(
						'colormag_highlighted_posts_widget',
						array(
							'number' => 4,
						),
					),
				),
				'colormag_right_sidebar'                           => array(
					'featured_posts_right_sidebar' => array(
						'colormag_featured_posts_vertical_widget',
						array(
							'title'  => 'NEWS',
							'number' => 2,
						),
					),
					'text_premium_themes'          => array(
						'text',
						array(
							'title' => 'Premium Themes',
							'text'  => '<ul>
										<li><a href="https://themegrill.com/themes/spacious-pro/">Spacious Pro</a></li>
										<li><a href="https://themegrill.com/themes/foodhunt-pro/">FoodHunt Pro</a></li>
										<li><a href="https://themegrill.com/themes/colornews-pro/">ColorNews Pro</a></li>
										<li><a href="https://themegrill.com/themes/accelerate-pro/">Accelerate Pro</a></li>
										<li><a href="https://themegrill.com/themes/esteem-pro/">Esteem Pro</a></li>
										<li><a href="https://http://themegrill.com/themes/radiate-pro/">Radiate Pro</a></li>
										<li><a href="https://themegrill.com/themes/fitclub-pro/">Fitclub Pro</a></li>
										<li><a href="https://themegrill.com/themes/himalayas-pro/">Himalayas Pro</a></li>
									</ul>',
						),
					),
					'ad_banner_right'              => array(
						'colormag_125x125_advertisement_widget',
						array(
							'title'                => 'TG: 125x125 Ads',
							'125x125_image_link_1' => 'https://themegrill.com/',
							'125x125_image_url_1'  => get_template_directory_uri() . '/img/ad-small.jpg',
							'125x125_image_link_2' => 'https://themegrill.com/',
							'125x125_image_url_2'  => get_template_directory_uri() . '/img/ad-small.jpg',
							'125x125_image_link_3' => 'https://themegrill.com/',
							'125x125_image_url_3'  => get_template_directory_uri() . '/img/ad-small.jpg',
							'125x125_image_link_4' => 'https://themegrill.com/',
							'125x125_image_url_4'  => get_template_directory_uri() . '/img/ad-small.jpg',
						),
					),
				),
				'colormag_front_page_content_top_section'          => array(
					'featured_posts_style_1' => array(
						'colormag_featured_posts_widget',
						array(
							'title'  => 'HEALTH',
							'number' => 5,
						),
					),
				),
				'colormag_front_page_content_middle_left_section'  => array(
					'featured_posts_style_2_left' => array(
						'colormag_featured_posts_vertical_widget',
						array(
							'title'  => 'FASHION',
							'number' => 4,
						),
					),
				),
				'colormag_front_page_content_middle_right_section' => array(
					'featured_posts_style_2_right' => array(
						'colormag_featured_posts_vertical_widget',
						array(
							'title'  => 'SPORTS',
							'number' => 4,
						),
					),
				),
				'colormag_front_page_content_bottom_section'       => array(
					'featured_posts_style_1_bottom' => array(
						'colormag_featured_posts_widget',
						array(
							'title'  => 'TECHNOLOGY',
							'text'   => 'Check out technology changing the life.',
							'number' => 4,
						),
					),
				),
				'colormag_footer_sidebar_one'                      => array(
					'text_footer_about' => array(
						'text',
						array(
							'title' => 'About Us',
							'text'  => '<a title="logo" href="' . home_url() . '"><img src="' . get_template_directory_uri() . '/img/colormag-logo.png" alt="Logo" /></a> <br> We love WordPress and we are here to provide you with professional looking WordPress themes so that you can take your website one step ahead. We focus on simplicity, elegant design and clean code.',
						),
					),
				),
				'colormag_footer_sidebar_two'                      => array(
					'text_footer_links' => array(
						'text',
						array(
							'title' => 'Useful Links',
							'text'  => '<ul>
										<li><a href="https://themegrill.com/">ThemeGrill</a></li>
										<li><a href="https://themegrill.com/support-forum/">Support</a></li>
										<li><a href="https://themegrill.com/theme-instruction/colormag/">Documentation</a></li>
										<li><a href="https://themegrill.com/frequently-asked-questions/">FAQ</a></li>
										<li><a href="https://themegrill.com/themes/">Themes</a></li>
										<li><a href="https://themegrill.com/plugins/">Plugins</a></li>
										<li><a href="https://themegrill.com/blog/">Blog</a></li>
										<li><a href="https://themegrill.com/plans-pricing/">Plans &amp; Pricing</a></li>
									</ul>',
						),
					),
				),
				'colormag_footer_sidebar_three'                    => array(
					'text_footer_other_themes' => array(
						'text',
						array(
							'title' => 'Other Themes',
							'text'  => '<ul>
										<li><a href="https://themegrill.com/themes/envince/">Envince</a></li>
										<li><a href="https://themegrill.com/themes/estore/">eStore</a></li>
										<li><a href="https://themegrill.com/themes/ample/">Ample</a></li>
										<li><a href="https://themegrill.com/themes/spacious/">Spacious</a></li>
										<li><a href="https://themegrill.com/themes/accelerate/">Accelerate</a></li>
										<li><a href="https://themegrill.com/themes/radiate/">Radiate</a></li>
										<li><a href="https://themegrill.com/themes/esteem/">Esteem</a></li>
										<li><a href="https://themegrill.com/themes/himalayas/">Himalayas</a></li>
										<li><a href="https://themegrill.com/themes/colornews/">ColorNews</a></li>
									</ul>',
						),
					),
				),
				'colormag_footer_sidebar_four'                     => array(
					'ad_banner_footer'         => array(
						'colormag_300x250_advertisement_widget',
						array(
							'title'              => 'ColorMag Pro',
							'300x250_image_link' => 'https://demo.themegrill.com/colormag-pro/',
							'300x250_image_url'  => get_template_directory_uri() . '/img/ad-medium.jpg',
						),
					),
					'text_footer_colormag_pro' => array(
						'text',
						array(
							'text' => 'Contains all features of free version and many new additional features.',
						),
					),
				),
			),

			// Specify the core-defined pages to create and add custom thumbnails to some of them.
			'posts'       => array(
				'layout'                             => array(
					'post_type'    => 'page',
					'post_title'   => 'Layout',
					'post_content' => 'ThemeGrill layout content',
				),
				'contact'                            => array(
					'template' => 'page-templates/contact.php',
				),

				// Create posts
				'coffee-is-health-food-myth-or-fact' => array(
					'post_type'    => 'post',
					'post_title'   => 'Coffee is health food: Myth or fact?',
					'post_content' => 'Vivamus vestibulum ut magna vitae facilisis. Maecenas laoreet lobortis tristique. Aenean accumsan malesuada convallis. Suspendisse egestas luctus nisl, sit amet',
					'thumbnail'    => '{{featured-image-coffee}}',
				),
				'get-more-nutrition-in-every-bite'   => array(
					'post_type'    => 'post',
					'post_title'   => 'Get more nutrition in every bite',
					'post_content' => 'Fusce non nunc mi. Integer placerat nulla id quam varius dapibus. Nulla sit amet tellus et purus lobortis efficitur. Vivamus tempus posuere ipsum in suscipit. Quisque pulvinar fringilla cursus. Morbi malesuada laoreet dui, vitae consequat arcu vehicula vel. Fusce vel turpis non ante mollis bibendum a ac risus. Morbi ornare ipsum sit amet enim rhoncus, sed eleifend felis tristique. Mauris sed sollicitudin libero. In nec lacus quis erat rhoncus molestie.',
					'thumbnail'    => '{{featured-image-yummy}}',
				),
				'womens-relay-competition'           => array(
					'post_type'    => 'post',
					'post_title'   => 'Women’s Relay Competition',
					'post_content' => 'The young team of Franziska Hildebrand, Franziska Preuss, Vanessa Hinz and Dahlmeier clocked 1 hour, 11 minutes, 54.6 seconds to beat France by just over 1 minute. Italy took bronze, 1:06.1 behind. Germany missed six targets overall, avoiding any laps around the penalty loop. Maria Dorin Habert of France, who has two individual gold medals at these worlds, passed Russia and France on the last leg and to take her team from fourth to second.',
					'thumbnail'    => '{{featured-image-relay-race}}',
				),
				'a-paradise-for-holiday'             => array(
					'post_type'    => 'post',
					'post_title'   => 'A Paradise for Holiday',
					'post_content' => 'Chocolate bar marzipan sweet marzipan. Danish tart bear claw donut cake bonbon biscuit powder croissant. Liquorice cake cookie. Dessert cotton candy macaroon gummies sweet gingerbread sugar plum. Biscuit tart cake. Candy jelly ice cream halvah jelly-o jelly beans brownie pastry sweet. Candy sweet roll dessert. Lemon drops jelly-o fruitcake topping. Soufflé jelly beans bonbon.',
					'thumbnail'    => '{{featured-image-paradise-for-holiday}}',
				),
				'destruction-in-montania'            => array(
					'post_type'    => 'post',
					'post_title'   => 'Destruction in Montania',
					'post_content' => 'Nunc consectetur ipsum nisi, ut pellentesque felis tempus vitae. Integer eget lacinia nunc. Vestibulum consectetur convallis augue id egestas. Nullam rhoncus, arcu in tincidunt ultricies, velit diam imperdiet lacus, sed faucibus mi massa vel nunc. In ac viverra augue, a luctus nisl. Donec interdum enim tempus, aliquet metus maximus, euismod quam. Sed pretium finibus rhoncus. Phasellus libero diam, rutrum non ipsum ut, ultricies sodales sapien. Duis viverra purus lorem.',
					'thumbnail'    => '{{featured-image-fireman}}',
				),
			),

			// Create the custom image attachments used as post thumbnails for pages.
			'attachments' => array(
				'colormag-logo'                       => array(
					'post_title' => 'ColorMag Logo',
					'file'       => 'img/colormag-logo.png',
				),
				'featured-image-fireman'              => array(
					'post_title' => 'Featured image fireman',
					'file'       => 'img/fireman.jpg',
				),
				'featured-image-coffee'               => array(
					'post_title' => 'Featured image coffee',
					'file'       => 'img/coffee.jpg',
				),
				'featured-image-yummy'                => array(
					'post_title' => 'Featured image yummy',
					'file'       => 'img/yummy.jpg',
				),
				'featured-image-relay-race'           => array(
					'post_title' => 'Featured image relay race',
					'file'       => 'img/relay-race.jpg',
				),
				'featured-image-paradise-for-holiday' => array(
					'post_title' => 'Featured image paradise for holiday',
					'file'       => 'img/sea.jpg',
				),
				'featured-image-ad-medium'            => array(
					'post_title' => 'Featured image ad medium',
					'file'       => 'img/ad-medium.jpg',
				),
				'featured-image-ad-large'             => array(
					'post_title' => 'Featured image ad large',
					'file'       => 'img/ad-large.jpg',
				),
			),

			'options'    => array(
				'blogname'        => 'ColorMag',
				'blogdescription' => 'ColorMag Demo site',
			),

			// Set the front page section theme mods to the IDs of the core-registered pages.
			'theme_mods' => array(
				'custom_logo'                     => '{{colormag-logo}}',
				'colormag_breaking_news'          => 1,
				'colormag_date_display'           => 1,
				'colormag_header_logo_placement'  => 'header_logo_only',
				'colormag_hide_blog_front'        => 1,
				'colormag_search_icon_in_menu'    => 1,
				'colormag_random_post_in_menu'    => 1,
				'colormag_social_link_activate'   => 1,
				'colormag_home_icon_display'      => 1,
				'colormag_primary_sticky_menu'    => 1,
				'colormag_related_posts_activate' => 1,
				'colormag_social_facebook'        => '#',
				'colormag_social_twitter'         => '#',
				'colormag_social_googleplus'      => '#',
				'colormag_social_instagram'       => '#',
				'colormag_social_pinterest'       => '#',
				'colormag_social_youtube'         => '#',
			),

			// Set up nav menus for each of the two areas registered in the theme.
			'nav_menus'  => array(
				// Assign a menu to the "primary" location.
				'primary' => array(
					'name'  => 'Primary',
					'items' => array(
						'link_download'   => array(
							'type'  => 'custom',
							'title' => 'Download',
							'url'   => 'https://downloads.wordpress.org/theme/colormag.zip',
						),
						'link_theme-info' => array(
							'type'  => 'custom',
							'title' => 'Theme Info',
							'url'   => 'https://themegrill.com/themes/colormag/',
						),
						'link_view-pro'   => array(
							'type'  => 'custom',
							'title' => 'View pro',
							'url'   => 'https://themegrill.com/themes/colormag/',
						),
						'page_layout'     => array(
							'type'      => 'post_type',
							'object'    => 'page',
							'object_id' => '{{layout}}',
						),
						'page_contact',
					),
				),
			),

		);
		$starter_content = apply_filters( 'colormag_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );
	}
endif;

/**
 * Define Directory Location Constants
 */
define( 'COLORMAG_PARENT_DIR', get_template_directory() );
define( 'COLORMAG_CHILD_DIR', get_stylesheet_directory() );

define( 'COLORMAG_INCLUDES_DIR', COLORMAG_PARENT_DIR . '/inc' );
define( 'COLORMAG_CSS_DIR', COLORMAG_PARENT_DIR . '/css' );
define( 'COLORMAG_JS_DIR', COLORMAG_PARENT_DIR . '/js' );
define( 'COLORMAG_LANGUAGES_DIR', COLORMAG_PARENT_DIR . '/languages' );

define( 'COLORMAG_ADMIN_DIR', COLORMAG_INCLUDES_DIR . '/admin' );
define( 'COLORMAG_WIDGETS_DIR', COLORMAG_INCLUDES_DIR . '/widgets' );
define( 'COLORMAG_ELEMENTOR_DIR', COLORMAG_INCLUDES_DIR . '/elementor' );
define( 'COLORMAG_ELEMENTOR_WIDGETS_DIR', COLORMAG_ELEMENTOR_DIR . '/widgets' );

define( 'COLORMAG_ADMIN_IMAGES_DIR', COLORMAG_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'COLORMAG_PARENT_URL', get_template_directory_uri() );
define( 'COLORMAG_CHILD_URL', get_stylesheet_directory_uri() );

define( 'COLORMAG_INCLUDES_URL', COLORMAG_PARENT_URL . '/inc' );
define( 'COLORMAG_CSS_URL', COLORMAG_PARENT_URL . '/css' );
define( 'COLORMAG_JS_URL', COLORMAG_PARENT_URL . '/js' );
define( 'COLORMAG_LANGUAGES_URL', COLORMAG_PARENT_URL . '/languages' );

define( 'COLORMAG_ADMIN_URL', COLORMAG_INCLUDES_URL . '/admin' );
define( 'COLORMAG_WIDGETS_URL', COLORMAG_INCLUDES_URL . '/widgets' );
define( 'COLORMAG_ELEMENTOR_URL', COLORMAG_INCLUDES_URL . '/elementor' );
define( 'COLORMAG_ELEMENTOR_WIDGETS_URL', COLORMAG_ELEMENTOR_URL . '/widgets' );

define( 'COLORMAG_ADMIN_IMAGES_URL', COLORMAG_ADMIN_URL . '/images' );

/** Load functions */
require_once( COLORMAG_INCLUDES_DIR . '/custom-header.php' );
require_once( COLORMAG_INCLUDES_DIR . '/functions.php' );
require_once( COLORMAG_INCLUDES_DIR . '/header-functions.php' );
require_once( COLORMAG_INCLUDES_DIR . '/customizer.php' );

/** Add the Elementor compatibility file */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	require_once( COLORMAG_ELEMENTOR_DIR . '/elementor.php' );
	require_once( COLORMAG_ELEMENTOR_DIR . '/elementor-functions.php' );
}

require_once( COLORMAG_ADMIN_DIR . '/meta-boxes.php' );

/** Load Widgets and Widgetized Area */
require_once( COLORMAG_WIDGETS_DIR . '/widgets.php' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
	require get_template_directory() . '/inc/demo-config.php';
}

/**
 * Assign the ColorMag version to a variable.
 */
$theme            = wp_get_theme( 'colormag' );
$colormag_version = $theme['Version'];

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-colormag-admin.php';
	require get_template_directory() . '/inc/admin/class-colormag-site-library.php';
	require get_template_directory() . '/inc/admin/class-colormag-theme-review-notice.php';
}

/**
 * Load TGMPA Configs.
 */
require_once( COLORMAG_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( COLORMAG_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-colormag.php' );
?>
