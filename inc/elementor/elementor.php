<?php
/**
 * Implements the compatibility for the Elementor plugin in ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */


if ( ! function_exists( 'colormag_elementor_active_page_check' ) ) :

	/**
	 * Check whether Elementor plugin is activated and is active on current page or not
	 *
	 * @return bool
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_active_page_check() {
		global $post;

		if ( defined( 'ELEMENTOR_VERSION' ) && get_post_meta( $post->ID, '_elementor_edit_mode', true ) ) {
			return true;
		}

		return false;
	}

endif;

if ( ! function_exists( 'colormag_elementor_widget_render_filter' ) ) :

	/**
	 * Render the default WordPress widget settings, ie, divs
	 *
	 * @param $args the widget id
	 *
	 * @return array register sidebar divs
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_widget_render_filter( $args ) {

		return
			array(
				'before_widget' => '<section class="widget ' . colormag_widget_class_names( $args[ 'widget_id' ] ) . ' clearfix">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			);
	}

endif;

add_filter( 'elementor/widgets/wordpress/widget_args', 'colormag_elementor_widget_render_filter' ); // WPCS: spelling ok.

if ( ! function_exists( 'colormag_widget_class_names' ) ) :

	/**
	 * Render the widget classes for Elementor plugin compatibility
	 *
	 * @param $widgets_id the widgets of the id
	 *
	 * @return mixed the widget classes of the id passed
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_widget_class_names( $widgets_id ) {

		$widgets_id = str_replace( 'wp-widget-', '', $widgets_id );

		$classes = colormag_widgets_classes();

		$return_value = isset( $classes[ $widgets_id ] ) ? $classes[ $widgets_id ] : 'widget_featured_posts';

		return $return_value;
	}

endif;

if ( ! function_exists( 'colormag_widgets_classes' ) ) :

	/**
	 * Return all the arrays of widgets classes and classnames of same respectively
	 *
	 * @return array the array of widget classnames and its respective classes
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_widgets_classes() {

		return
			array(
				'colormag_featured_posts_slider_widget'   => 'widget_featured_slider widget_featured_meta',
				'colormag_highlighted_posts_widget'       => 'widget_highlighted_posts widget_featured_meta',
				'colormag_featured_posts_widget'          => 'widget_featured_posts widget_featured_meta',
				'colormag_featured_posts_vertical_widget' => 'widget_featured_posts widget_featured_posts_vertical widget_featured_meta',
				'colormag_728x90_advertisement_widget'    => 'widget_300x250_advertisement',
				'colormag_300x250_advertisement_widget'   => 'widget_728x90_advertisement',
				'colormag_125x125_advertisement_widget'   => 'widget_125x125_advertisement',
			);
	}

endif;
