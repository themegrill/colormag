<?php
/**
 * ColorMag functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 800;

/**
 * $content_width global variable adjustment as per layout option.
 */
function colormag_content_width() {
	global $post;
	global $content_width;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true ); }
	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if ( $colormag_default_layout == 'no_sidebar_full_width' ) { $content_width = 1140; /* pixels */ }
		else { $content_width = 800; /* pixels */ }
	}
	elseif ( $layout_meta == 'no_sidebar_full_width' ) { $content_width = 1140; /* pixels */ }
	else { $content_width = 800; /* pixels */ }
}
add_action( 'template_redirect', 'colormag_content_width' );

add_action( 'after_setup_theme', 'colormag_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if( !function_exists( 'colormag_setup' ) ) :
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
		'default-color' => 'eaeaea'
	) ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'chat', 'audio', 'status' ) );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

	// adding the WooCommerce plugin support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

	// Adds the support for the Custom Logo introduced in WordPress 4.5
	add_theme_support( 'custom-logo',
		array(
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	// Support for selective refresh widgets in Customizer
	add_theme_support( 'customize-selective-refresh-widgets' );

	$starter_content = array(
		'widgets' => array(
			'colormag_header_sidebar' => array(
				'ad_banner_header'	=> array(
					'colormag_728x90_advertisement_widget',
					array(
						'title'  			=> '',
						'728x90_image_link' => 'http://demo.themegrill.com/colormag-pro/',
						'728x90_image_url' 	=> get_template_directory_uri() . '/img/ad-large.jpg',
					),
				),
			),
			'colormag_front_page_slider_area' => array(
				'featured_posts_slider'	=> array(
					'colormag_featured_posts_slider_widget',
					array(
						'type'  	=> 'latest',
						'number' 	=> 2,
					),
				),
			),
			'colormag_front_page_area_beside_slider' => array(
				'featured_posts_slider'	=> array(
					'colormag_highlighted_posts_widget',
					array(
						'type'  	=> 'latest',
						'number' 	=> 4,
					),
				),
			),
			'colormag_right_sidebar' => array(
				'featured_posts_right_sidebar'	=> array(
					'colormag_featured_posts_vertical_widget',
					array(
						'title' 	=> 'News',
						'type' 		=> 'latest',
						'number' 	=> 2,
					),
				),
				'text_premium_themes'	=> array(
					'text',
					array(
						'title'	=> 'Premium Themes',
						'text'	=> '<ul>
									 	<li><a href="http://themegrill.com/themes/spacious-pro/">Spacious Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/foodhunt-pro/">FoodHunt Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/colornews-pro/">ColorNews Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/accelerate-pro/">Accelerate Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/esteem-pro/">Esteem Pro</a></li>
									 	<li><a href="http://http://themegrill.com/themes/radiate-pro/">Radiate Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/fitclub-pro/">Fitclub Pro</a></li>
									 	<li><a href="http://themegrill.com/themes/himalayas-pro/">Himalayas Pro</a></li>
									</ul>',
					),
				),
				'ad_banner_right'	=> array(
					'colormag_125x125_advertisement_widget',
					array(
						'title'  => 'TG: 125x125 Ads',
						'125x125_image_link_1' 	=> 'http://themegrill.com/',
						'125x125_image_url_1' 	=> get_template_directory_uri() . '/img/ad-small.jpg',
						'125x125_image_link_2' 	=> 'http://themegrill.com/',
						'125x125_image_url_2' 	=> get_template_directory_uri() . '/img/ad-small.jpg',
						'125x125_image_link_3' 	=> 'http://themegrill.com/',
						'125x125_image_url_3' 	=> get_template_directory_uri() . '/img/ad-small.jpg',
						'125x125_image_link_4' 	=> 'http://themegrill.com/',
						'125x125_image_url_4' 	=> get_template_directory_uri() . '/img/ad-small.jpg',
					),
				),
			),
			'colormag_front_page_content_top_section' => array(
				'featured_posts_style_1'	=> array(
					'colormag_featured_posts_widget',
					array(
						'title'		=> 'Health',
						'text'		=> '',
						'type'  	=> 'latest',
						'number' 	=> 5,
					),
				),
			),
			'colormag_front_page_content_middle_left_section' => array(
				'featured_posts_style_2_left'	=> array(
					'colormag_featured_posts_vertical_widget',
					array(
						'title'		=> 'FASHION',
						'text'		=> '',
						'type'  	=> 'latest',
						'number' 	=> 4,
					),
				),
			),
			'colormag_front_page_content_middle_right_section' => array(
				'featured_posts_style_2_right'	=> array(
					'colormag_featured_posts_vertical_widget',
					array(
						'title'		=> 'SPORTS',
						'text'		=> '',
						'type'  	=> 'latest',
						'number' 	=> 4,
					),
				),
			),
			'colormag_front_page_content_bottom_section' => array(
				'featured_posts_style_1_bottom'	=> array(
					'colormag_featured_posts_widget',
					array(
						'title'		=> 'Technology',
						'text'		=> 'Check out technology changing the life.',
						'type'  	=> 'latest',
						'number' 	=> 4,
					),
				),
			),
			'colormag_footer_sidebar_one' => array(
				'text_footer_about'	=> array(
					'text',
					array(
						'title'	=> 'About Us',
						'text'	=> '<a title="logo" href="' . home_url() .'"><img src="' . get_template_directory_uri() . '/img/colormag-logo.png" alt="Logo" /></a> <br> We love WordPress and we are here to provide you with professional looking WordPress themes so that you can take your website one step ahead. We focus on simplicity, elegant design and clean code.',
					),
				),
			),
			'colormag_footer_sidebar_two' => array(
				'text_footer_links'	=> array(
					'text',
					array(
						'title'	=> 'Useful Links',
						'text'	=> '<ul>
									 	<li><a href="http://themegrill.com/">ThemeGrill</a></li>
									 	<li><a href="http://themegrill.com/support-forum/">Support</a></li>
									 	<li><a href="http://themegrill.com/theme-instruction/colormag/">Documentation</a></li>
									 	<li><a href="http://themegrill.com/frequently-asked-questions/">FAQ</a></li>
									 	<li><a href="http://themegrill.com/themes/">Themes</a></li>
									 	<li><a href="http://themegrill.com/plugins/">Plugins</a></li>
									 	<li><a href="http://themegrill.com/blog/">Blog</a></li>
									 	<li><a href="http://themegrill.com/plans-pricing/">Plans &amp; Pricing</a></li>
									</ul>',
					),
				),
			),
			'colormag_footer_sidebar_three' => array(
				'text_footer_other_themes'	=> array(
					'text',
					array(
						'title'	=> 'Other Themes',
						'text'	=> '<ul>
									 	<li><a href="http://themegrill.com/themes/envince/">Envince</a></li>
									 	<li><a href="http://themegrill.com/themes/estore/">eStore</a></li>
									 	<li><a href="http://themegrill.com/themes/ample/">Ample</a></li>
									 	<li><a href="http://themegrill.com/themes/spacious/">Spacious</a></li>
									 	<li><a href="http://themegrill.com/themes/accelerate/">Accelerate</a></li>
									 	<li><a href="http://themegrill.com/themes/radiate/">Radiate</a></li>
									 	<li><a href="http://themegrill.com/themes/esteem/">Esteem</a></li>
									 	<li><a href="http://themegrill.com/themes/himalayas/">Himalayas</a></li>
									 	<li><a href="http://themegrill.com/themes/colornews/">ColorNews</a></li>
									</ul>',
					),
				),
			),
			'colormag_footer_sidebar_four' => array(
				'ad_banner_footer'	=> array(
					'colormag_300x250_advertisement_widget',
					array(
						'title'  => 'ColorMag Pro',
						'300x250_image_link' => 'http://demo.themegrill.com/colormag-pro/',
						'300x250_image_url' => get_template_directory_uri() . '/img/ad-medium.jpg',
					),
				),
				'text_footer_colormag_pro'	=> array(
					'text',
					array(
						'title'	=> '',
						'text'	=> 'Contains all features of free version and many new additional features.',
					),
				),
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home' => array(
				'post_title'   	=> esc_html_x( 'Home', 'Theme starter content', 'colormag' ),
			),
			'download' => array(
				'post_type' 	=> 'page',
				'post_title' 	=> 'Download',
				'post_content' 	=> 'ColorMag download',
			),
			'blog',
			'layout' => array(
				'post_type' 	=> 'page',
				'post_title' 	=> 'Layout',
				'post_content' 	=> 'ThemeGrill layout content',
			),
			'theme-info' => array(
				'post_type' 	=> 'page',
				'post_title' 	=> 'Theme Info',
				'post_content' 	=> 'ColorMag theme info',
			),
			'view-pro' => array(
				'post_type' 	=> 'page',
				'post_title' 	=> 'View Pro',
				'post_content' 	=> 'ColorMag view pro',
			),
			'video-tutorial' 	=> array(
				'post_type' 	=> 'page',
				'post_title' 	=> 'Video Tutorial',
				'post_content' 	=> 'ColorMag view tutorial',
			),
			'contact'			=> array(
				'template'		=> 'page-templates/contact.php',
			),

			// Create posts
			'coffee-is-health-food-myth-or-fact' => array(
	            'post_type' 	=> 'post',
	            'post_title' 	=> 'Coffee is health food: Myth or fact?',
	            'post_content' 	=> 'Vivamus vestibulum ut magna vitae facilisis. Maecenas laoreet lobortis tristique. Aenean accumsan malesuada convallis. Suspendisse egestas luctus nisl, sit amet',
	            'thumbnail' 	=> '{{featured-image-coffee}}',
	        ),
	        'mosquito-borne-diseases-has-threaten-world' => array(
	            'post_type' 	=> 'post',
	            'post_title' 	=> 'Mosquito-borne diseases has threaten World',
	            'post_content' 	=> 'Donec a suscipit erat, ac venenatis velit. Sed vitae tortor pellentesque, dictum quam ut, porttitor ligula. Aliquam sit amet mattis mauris. Donec non dui sodales, tincidunt ante id, ullamcorper ex. Curabitur nec ullamcorper justo. Cras ut massa faucibus, tincidunt urna ut, lobortis mauris. Vestibulum sodales rutrum suscipit.',
	            'thumbnail' 	=> '{{featured-image-mosquito}}',
	        ),
	        'get-more-nutrition-in-every-bite' => array(
	            'post_type' 	=> 'post',
	            'post_title' 	=> 'Get more nutrition in every bite',
	            'post_content' 	=> 'Fusce non nunc mi. Integer placerat nulla id quam varius dapibus. Nulla sit amet tellus et purus lobortis efficitur. Vivamus tempus posuere ipsum in suscipit. Quisque pulvinar fringilla cursus. Morbi malesuada laoreet dui, vitae consequat arcu vehicula vel. Fusce vel turpis non ante mollis bibendum a ac risus. Morbi ornare ipsum sit amet enim rhoncus, sed eleifend felis tristique. Mauris sed sollicitudin libero. In nec lacus quis erat rhoncus molestie.',
	            'thumbnail' 	=> '{{featured-image-yummy}}',
	        ),
	        'womens-relay-competition' => array(
	            'post_type' 	=> 'post',
	            'post_title' 	=> 'Women’s Relay Competition',
	            'post_content' 	=> 'The young team of Franziska Hildebrand, Franziska Preuss, Vanessa Hinz and Dahlmeier clocked 1 hour, 11 minutes, 54.6 seconds to beat France by just over 1 minute. Italy took bronze, 1:06.1 behind. Germany missed six targets overall, avoiding any laps around the penalty loop. Maria Dorin Habert of France, who has two individual gold medals at these worlds, passed Russia and France on the last leg and to take her team from fourth to second.',
	            'thumbnail' 	=> '{{featured-image-relay-race}}',
	        ),
	        'destruction-in-montania' => array(
	            'post_type' 	=> 'post',
	            'post_title' 	=> 'Destruction in Montania',
	            'post_content' 	=> 'Nunc consectetur ipsum nisi, ut pellentesque felis tempus vitae. Integer eget lacinia nunc. Vestibulum consectetur convallis augue id egestas. Nullam rhoncus, arcu in tincidunt ultricies, velit diam imperdiet lacus, sed faucibus mi massa vel nunc. In ac viverra augue, a luctus nisl. Donec interdum enim tempus, aliquet metus maximus, euismod quam. Sed pretium finibus rhoncus. Phasellus libero diam, rutrum non ipsum ut, ultricies sodales sapien. Duis viverra purus lorem.',
	            'thumbnail' 	=> '{{featured-image-fireman}}',
	        ),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'colormag-logo' => array(
				'post_title' 	=> _x( 'ColorMag Logo', 'Starter content', 'colormag' ),
				'file' 			=> 'img/colormag-logo.png',
			),
			'featured-image-coffee' => array(
				'post_title' 	=> _x( 'Featured image coffee', 'Starter content', 'colormag' ),
				'file' 			=> 'img/coffee.jpg',
			),
			'featured-image-mosquito' => array(
				'post_title' 	=> _x( 'Featured image mosquito', 'Starter content', 'colormag' ),
				'file' 			=> 'img/mosquito.jpg',
			),
			'featured-image-solar-eclipse' => array(
				'post_title' 	=> _x( 'Featured image solar eclipse', 'Starter content', 'colormag' ),
				'file' 			=> 'img/solar-eclipse.png',
			),
			'featured-image-yummy' => array(
				'post_title' 	=> _x( 'Featured image yummy', 'Starter content', 'colormag' ),
				'file' 			=> 'img/yummy.jpg',
			),
			'featured-image-relay-race' => array(
				'post_title' 	=> _x( 'Featured image relay race', 'Starter content', 'colormag' ),
				'file' 			=> 'img/relay-race.jpg',
			),
			'featured-image-ad-medium' => array(
				'post_title' 	=> _x( 'Featured image ad medium', 'Starter content', 'colormag' ),
				'file' 			=> 'img/ad-medium.jpg',
			),
			'featured-image-ad-large' => array(
				'post_title' 	=> _x( 'Featured image ad large', 'Starter content', 'colormag' ),
				'file' 			=> 'img/ad-large.jpg',
			),
			'featured-image-fireman' => array(
				'post_title' 	=> _x( 'Featured image fireman', 'Starter content', 'colormag' ),
				'file' 			=> 'img/fireman.jpg',
			),
		),

		'options' => array(
			'show_on_front' 	=> 'page',
			'page_on_front' 	=> '{{home}}',
			'page_for_posts' 	=> '{{blog}}',
			'blogname' 			=> 'ColorMag',
			'blogdescription' 	=> 'ColorMag Demo site',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'custom_logo'						 	=> '{{colormag-logo}}',
			'colormag_breaking_news' 				=> 1,
			'colormag_date_display' 				=> 1,
			'colormag_date_display_type' 				=> 'theme_default',
			'colormag_header_logo_placement' 		=> 'header_logo_only',
			'colormag_hide_blog_front' 				=> 1,
			'colormag_search_icon_in_menu' 			=> 1,
			'colormag_random_post_in_menu' 			=> 1,
			'colormag_social_link_activate' 		=> 1,
			'colormag_social_facebook' 				=> '#',
			'colormag_social_twitter' 				=> '#',
			'colormag_social_googleplus' 			=> '#',
			'colormag_social_instagram' 			=> '#',
			'colormag_social_pinterest' 			=> '#',
			'colormag_social_youtube' 				=> '#',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "primary" location.
			'primary' => array(
				'name' => _x( 'Primary', 'Starter content primary menu', 'colormag' ),
				'items' => array(
					'link_home',
					'page_layout' 	=> array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{layout}}',
					),
					'page_layout' 	=> array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{layout}}',
					),
					'page_theme-info' => array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{theme-info}}',
					),
					'page_blog',
					'page_layout' => array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{layout}}',
					),
					'page_view-pro' => array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{view-pro}}',
					),
					'page_video-tutorial' => array(
						'type' 		=> 'post_type',
						'object' 	=> 'page',
						'object_id' => '{{video-tutorial}}',
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

define( 'COLORMAG_INCLUDES_DIR', COLORMAG_PARENT_DIR. '/inc' );
define( 'COLORMAG_CSS_DIR', COLORMAG_PARENT_DIR . '/css' );
define( 'COLORMAG_JS_DIR', COLORMAG_PARENT_DIR . '/js' );
define( 'COLORMAG_LANGUAGES_DIR', COLORMAG_PARENT_DIR . '/languages' );

define( 'COLORMAG_ADMIN_DIR', COLORMAG_INCLUDES_DIR . '/admin' );
define( 'COLORMAG_WIDGETS_DIR', COLORMAG_INCLUDES_DIR . '/widgets' );

define( 'COLORMAG_ADMIN_IMAGES_DIR', COLORMAG_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'COLORMAG_PARENT_URL', get_template_directory_uri() );
define( 'COLORMAG_CHILD_URL', get_stylesheet_directory_uri() );

define( 'COLORMAG_INCLUDES_URL', COLORMAG_PARENT_URL. '/inc' );
define( 'COLORMAG_CSS_URL', COLORMAG_PARENT_URL . '/css' );
define( 'COLORMAG_JS_URL', COLORMAG_PARENT_URL . '/js' );
define( 'COLORMAG_LANGUAGES_URL', COLORMAG_PARENT_URL . '/languages' );

define( 'COLORMAG_ADMIN_URL', COLORMAG_INCLUDES_URL . '/admin' );
define( 'COLORMAG_WIDGETS_URL', COLORMAG_INCLUDES_URL . '/widgets' );

define( 'COLORMAG_ADMIN_IMAGES_URL', COLORMAG_ADMIN_URL . '/images' );

/** Load functions */
require_once( COLORMAG_INCLUDES_DIR . '/custom-header.php' );
require_once( COLORMAG_INCLUDES_DIR . '/functions.php' );
require_once( COLORMAG_INCLUDES_DIR . '/header-functions.php' );
require_once( COLORMAG_INCLUDES_DIR . '/customizer.php' );

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

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-colormag-admin.php';
}

/**
 * Load TGMPA Configs.
 */
require_once( COLORMAG_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( COLORMAG_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-colormag.php' );
?>
