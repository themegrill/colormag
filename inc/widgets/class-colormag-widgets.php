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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',

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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);
	// Registering Header sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Sidebar', 'colormag' ),
			'id'            => 'colormag_header_sidebar',
			'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix widget-colormag_header_sidebar">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar one upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar One ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_one_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar one in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s widget-colormag_footer_sidebar_one_upper">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar two upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Two ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_two_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s widget-colormag_footer_sidebar_two_upper">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar three upper.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Three ( Upper )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_three_upper',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three in upper.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s widget-colormag_footer_sidebar_three_upper">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar one.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar One', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_one',
			'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s widget-colormag_footer_sidebar_one">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar two.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Two', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_two',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s widget-colormag_footer_sidebar_two">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar three.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Three', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_three',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s  widget-colormag_footer_sidebar_three">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
		)
	);

	// Registering footer sidebar four.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar Four ( Lower )', 'colormag' ),
			'id'            => 'colormag_footer_sidebar_four',
			'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'colormag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s  widget-colormag_footer_sidebar_four">',
			'after_widget'  => '</aside>',
			'before_title'  => '<' . colormag_widget_title_tag() . ' class="cm-widget-title"><span>',
			'after_title'   => '</span></' . colormag_widget_title_tag() . '>',
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

function colormag_builder_widget_init() {
	$sidebars = array(
		'header-sidebar-2' => esc_html__( 'Widget Two', 'colormag' ),
	);
	foreach ( $sidebars as $id => $name ) {

		register_sidebar(
			apply_filters(
				'colormag_sidebars_widget_args',
				array(
					'id'            => $id,
					'name'          => $name,
					'description'   => esc_html__( 'Add widgets here.', 'colormag' ),
					'before_widget' => '<section id="%1$s" class="widget widget-' . $id . ' %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			)
		);
	}
}

add_action( 'widgets_init', 'colormag_builder_widget_init' );

if ( ! function_exists( 'widget_title_markup' ) ) :

	/**
	 * Widget Title Markup.
	 *
	 * @param string $markup The markup passed by the filter, used as the default.
	 */
	function widget_title_markup( $markup ) {

		return get_theme_mod( 'colormag_widget_markup', $markup );
	}
endif;

add_filter( 'colormag_widget_title_markup', 'widget_title_markup' );

if ( ! function_exists( 'colormag_front_page_widget_post_title_markup' ) ) :

	/**
	 * Widget Post Title Markup.
	 *
	 * @param string $markup The markup passed by the filter, used as the default.
	 */
	function colormag_front_page_widget_post_title_markup( $markup ) {

		return get_theme_mod( 'colormag_front_page_widget_post_title_markup', $markup );
	}
endif;

add_filter( 'colormag_front_page_widget_post_title_markup', 'colormag_front_page_widget_post_title_markup' );

if ( ! function_exists( 'colormag_sanitize_heading_tag' ) ) :

	/**
	 * Restricts a filtered heading tag to an actual heading element.
	 *
	 * @since 4.2.3
	 *
	 * @param string $tag     The filtered tag name.
	 * @param string $default The tag to fall back to.
	 * @return string
	 */
	function colormag_sanitize_heading_tag( $tag, $default ) {

		return in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ), true ) ? $tag : $default;
	}
endif;

if ( ! function_exists( 'colormag_widget_title_tag' ) ) :

	/**
	 * Heading tag for a widget's own title.
	 *
	 * Sits directly below the site title's H1 so that pages built out of widgets
	 * do not jump straight from H1 to H3.
	 *
	 * @since 4.2.3
	 *
	 * @return string
	 */
	function colormag_widget_title_tag() {

		/**
		 * Filters the heading tag used for widget titles.
		 *
		 * @since 4.2.3
		 *
		 * @param string $tag Heading tag name.
		 */
		$tag = apply_filters( 'colormag_widget_title_markup', 'h2' );

		return colormag_sanitize_heading_tag( $tag, 'h2' );
	}
endif;

if ( ! function_exists( 'colormag_widget_entry_title_tag' ) ) :

	/**
	 * Heading tag for the post titles rendered inside a widget.
	 *
	 * One level below the widget's own title, so the entries read as content of
	 * that section rather than as siblings of it.
	 *
	 * @since 4.2.3
	 *
	 * @return string
	 */
	function colormag_widget_entry_title_tag() {

		/**
		 * Filters the heading tag used for post titles inside widgets.
		 *
		 * @since 4.2.3
		 *
		 * @param string $tag Heading tag name.
		 */
		$tag = apply_filters( 'colormag_front_page_widget_post_title_markup', 'h3' );

		return colormag_sanitize_heading_tag( $tag, 'h3' );
	}
endif;

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
