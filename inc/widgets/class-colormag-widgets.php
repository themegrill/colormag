<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function colormag_widgets_init() {

	/**
	 * Registering widget areas for front page
	 */
	// Registering main right sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Sidebar', 'colormag' ),
			'id'            => 'colormag_right_sidebar',
			'description'   => esc_html__( 'Shows widgets at Right side.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',

		)
	);

	// Registering main left sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'colormag' ),
			'id'            => 'colormag_left_sidebar',
			'description'   => esc_html__( 'Shows widgets at Left side.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering Header sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Sidebar', 'colormag' ),
			'id'            => 'colormag_header_sidebar',
			'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Top Full width Area.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Top Full Width Area', 'colormag' ),
			'id'            => 'colormag_front_page_top_full_width_area',
			'description'   => esc_html__( 'Show widget just below menu.', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Slider Area Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Slider Area', 'colormag' ),
			'id'            => 'colormag_front_page_slider_area',
			'description'   => esc_html__( 'Show widget just below menu. Suitable for TG: Featured Cat Slider.', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Area beside slider Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Area beside slider', 'colormag' ),
			'id'            => 'colormag_front_page_area_beside_slider',
			'description'   => esc_html__( 'Show widget beside the slider. Suitable for TG: Highlighted Posts.', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Content Top Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Top Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_top_section',
			'description'   => esc_html__( 'Content Top Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Content Middle Left Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Middle Left Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_middle_left_section',
			'description'   => esc_html__( 'Content Middle Left Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Content Middle Right Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Middle Right Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_middle_right_section',
			'description'   => esc_html__( 'Content Middle Right Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering the Front Page: Content Bottom Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Bottom Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_bottom_section',
			'description'   => esc_html__( 'Content Middle Bottom Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering contact Page sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Contact Page Sidebar', 'colormag' ),
			'id'            => 'colormag_contact_page_sidebar',
			'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering Error 404 Page sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Error 404 Page Sidebar', 'colormag' ),
			'id'            => 'colormag_error_404_page_sidebar',
			'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering advertisement above footer sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Advertisement Above The Footer', 'colormag' ),
			'id'            => 'colormag_advertisement_above_the_footer_sidebar',
			'description'   => esc_html__( 'Shows widgets Just Above The Footer, suitable for TG: 728x90 widget.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar one upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar One ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_one_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar one in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar two upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Two ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_two_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar three upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Three ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_three_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar one.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar One ( Lower )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_one',
			'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar two.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Two ( Lower )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_two',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar three.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Three ( Lower )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_three',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering footer sidebar four.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Four ( Lower )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_four',
			'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering full width footer sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Full Width', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_full_width',
			'description'   => esc_html__( 'Shows widgets just above footer copyright area.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
		)
	);

	// Registering sidebar for WooCommerce pages.
	if ( ( get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 ) == 1 ) && class_exists( 'WooCommerce' ) ) {
		// Registering WooCommerce Right Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Right Sidebar', 'colormag' ),
				'id'            => 'colormag_woocommerce_right_sidebar',
				'description'   => esc_html__( 'Shows widgets at WooCommerce Right sidebar.', 'colormag' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
				'after_widget'  => '</aside>',
				'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
				'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
			)
		);

		// Registering WooCommerce Left Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Left Sidebar', 'colormag' ),
				'id'            => 'colormag_woocommerce_left_sidebar',
				'description'   => esc_html__( 'Shows widgets at WooCommerce Left sidebar.', 'colormag' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
				'after_widget'  => '</aside>',
				'before_title'  => '<' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . ' class="cm-widget-title"><span>',
				'after_title'   => '</span></' . apply_filters( 'colormag_widget_title_markup', 'h3' ) . '>',
			)
		);
	}

	register_widget( 'colormag_featured_posts_slider_widget' );
	register_widget( 'colormag_highlighted_posts_widget' );
	register_widget( 'colormag_featured_posts_widget' );
	register_widget( 'colormag_featured_posts_vertical_widget' );
	register_widget( 'colormag_728x90_advertisement_widget' );
	register_widget( 'colormag_300x250_advertisement_widget' );
	register_widget( 'colormag_125x125_advertisement_widget' );

	// Pro Widgets.
	register_widget( 'colormag_video_widget' );
	register_widget( 'colormag_news_in_picture_widget' );
	register_widget( 'colormag_default_news_widget' );
	register_widget( 'colormag_tabbed_widget' );
	register_widget( 'colormag_random_post_widget' );
	register_widget( 'colormag_slider_news_widget' );
	register_widget( 'colormag_breaking_news_widget' );
	register_widget( 'colormag_ticker_news_widget' );
	register_widget( 'colormag_featured_posts_small_thumbnails' );
	register_widget( 'colormag_weather_widget' );
	register_widget( 'colormag_cta_widget' );
	register_widget( 'colormag_video_playlist' );
	register_widget( 'colormag_exchange_widget' );
	register_widget( 'colormag_google_maps_widget' );

}

add_action( 'widgets_init', 'colormag_widgets_init' );

if ( ! function_exists( 'widget_title_markup' ) ) :

	/**
	 * Widget Title Markup.
	 */
	function widget_title_markup( $markup ) {

		$markup = get_theme_mod( 'colormag_widget_markup', 'h3' );

		return $markup;
	}
endif;

add_filter( 'colormag_widget_title_markup', 'widget_title_markup' );

if ( ! function_exists( 'colormag_front_page_widget_post_title_markup' ) ) :

	/**
	 * Widget Title Markup.
	 */
	function colormag_front_page_widget_post_title_markup( $markup ) {
		return get_theme_mod( 'colormag_front_page_widget_post_title_markup', 'h3' );
	}
endif;

add_filter( 'colormag_front_page_widget_post_title_markup', 'colormag_front_page_widget_post_title_markup' );

// Abstract class for widgets.
require COLORMAG_WIDGETS_DIR . '/abstract-colormag-widget.php';

// Require file for TG: Featured Category Slider widget.
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-slider-widget.php';

// Require file for TG: Highligted Posts.
require COLORMAG_WIDGETS_DIR . '/colormag-highlighted-posts-widget.php';

// Require file for TG: Featured Post style 1.
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-widget.php';

// Require file for TG: Featured Post style 2.
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-vertical-widget.php';

// Require file for TG: 300x250 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-300x250-advertisement-widget.php';

// Require file for TG: 728x90 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-728x90-advertisement-widget.php';

// Require file for TG: 728x90 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-125x125-advertisement-widget.php';

/**
 * Pro widgets.
 */
// Require file for TG: Videos.
require COLORMAG_WIDGETS_DIR . '/colormag-video-widget.php';

// Require file for TG: Featured Posts (Style 5).
require COLORMAG_WIDGETS_DIR . '/colormag-news-in-picture-widget.php';

// Require file for TG: Featured Posts (Style 4).
require COLORMAG_WIDGETS_DIR . '/colormag-default-news-widget.php';

// Require file for TG: Tabbed Widget.
require COLORMAG_WIDGETS_DIR . '/colormag-tabbed-widget.php';

// Require file for TG: Random Posts Widget.
require COLORMAG_WIDGETS_DIR . '/colormag-random-post-widget.php';

// Require file for TG: Featured Posts (Style 6).
require COLORMAG_WIDGETS_DIR . '/colormag-slider-news-widget.php';

// Require file for TG: Breaking News Widget.
require COLORMAG_WIDGETS_DIR . '/colormag-breaking-news-widget.php';

// Require file for TG: Featured Posts (Style 7).
require COLORMAG_WIDGETS_DIR . '/colormag-ticker-news-widget.php';

// Require file for TG: Featured Posts (Style 3).
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-small-thumbnails.php';

// Require file for TG: Call To Action.
require COLORMAG_WIDGETS_DIR . '/colormag-cta-widget.php';

// Require file for TG: Weather.
require COLORMAG_WIDGETS_DIR . '/colormag-weather-widget.php';

// Require file for TG: Currency Exchange.
require COLORMAG_WIDGETS_DIR . '/colormag-exchange-widget.php';

// Require file for TG: Featured Videos Playlist.
require COLORMAG_WIDGETS_DIR . '/colormag-video-playlist.php';

// Require file for TG: Google Maps.
require COLORMAG_WIDGETS_DIR . '/colormag-google-maps-widget.php';

