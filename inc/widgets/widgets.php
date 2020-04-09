<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
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
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering main left sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'colormag' ),
			'id'            => 'colormag_left_sidebar',
			'description'   => esc_html__( 'Shows widgets at Left side.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
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
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Registering the Front Page: Slider Area Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Slider Area', 'colormag' ),
			'id'            => 'colormag_front_page_slider_area',
			'description'   => esc_html__( 'Show widget just below menu. Suitable for TG: Featured Category Slider.', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering the Front Page: Area beside slider Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Area beside slider', 'colormag' ),
			'id'            => 'colormag_front_page_area_beside_slider',
			'description'   => esc_html__( 'Show widget beside the slider. Suitable for TG: Highlighted Posts.', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering the Front Page: Content Top Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Top Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_top_section',
			'description'   => esc_html__( 'Content Top Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering the Front Page: Content Middle Left Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Middle Left Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_middle_left_section',
			'description'   => esc_html__( 'Content Middle Left Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering the Front Page: Content Middle Right Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Middle Right Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_middle_right_section',
			'description'   => esc_html__( 'Content Middle Right Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering the Front Page: Content Bottom Section Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Content Bottom Section', 'colormag' ),
			'id'            => 'colormag_front_page_content_bottom_section',
			'description'   => esc_html__( 'Content Bottom Section', 'colormag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering contact Page sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Contact Page Sidebar', 'colormag' ),
			'id'            => 'colormag_contact_page_sidebar',
			'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering Error 404 Page sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Error 404 Page Sidebar', 'colormag' ),
			'id'            => 'colormag_error_404_page_sidebar',
			'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering advertisement above footer sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Advertisement Above The Footer', 'colormag' ),
			'id'            => 'colormag_advertisement_above_the_footer_sidebar',
			'description'   => esc_html__( 'Shows widgets just above the footer, suitable for TG: 728x90 Advertisement widget.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering footer sidebar one.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar One', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_one',
			'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering footer sidebar two.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Two', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_two',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering footer sidebar three.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Three', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_three',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// Registering footer sidebar four.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Four', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_four',
			'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	register_widget( 'colormag_featured_posts_slider_widget' );
	register_widget( 'colormag_highlighted_posts_widget' );
	register_widget( 'colormag_featured_posts_widget' );
	register_widget( 'colormag_featured_posts_vertical_widget' );
	register_widget( 'colormag_728x90_advertisement_widget' );
	register_widget( 'colormag_300x250_advertisement_widget' );
	register_widget( 'colormag_125x125_advertisement_widget' );

}

add_action( 'widgets_init', 'colormag_widgets_init' );

// Abstract class for widgets.
require COLORMAG_WIDGETS_DIR . '/abstract-colormag-widget.php';

// Require file for TG: Featured Category Slider widget.
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-slider-widget.php';

// Require file for TG: Highlighted Posts.
require COLORMAG_WIDGETS_DIR . '/colormag-highlighted-posts-widget.php';

// Require file for TG: Featured Posts (Style 1).
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-widget.php';

// Require file for TG: Featured Posts (Style 2).
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-vertical-widget.php';

// Require file for TG: 300x250 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-300x250-advertisement-widget.php';

// Require file for TG: 728x90 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-728x90-advertisement-widget.php';

// Require file for TG: 125x125 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-125x125-advertisement-widget.php';
