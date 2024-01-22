<?php
/**
 * Implements the compatibility for the Elementor plugin in ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

use elementor\widgets\ColorMag_Elementor_Global_Widgets_Title;
use elementor\widgets\ColorMag_Elementor_Widgets_Block_1;
use elementor\widgets\ColorMag_Elementor_Widgets_Block_2;
use elementor\widgets\ColorMag_Elementor_Widgets_Block_4;
use elementor\widgets\ColorMag_Elementor_Widgets_Block_6;
use elementor\widgets\ColorMag_Elementor_Widgets_Block_9;
use elementor\widgets\ColorMag_Elementor_Widgets_Grid_2;
use elementor\widgets\ColorMag_Elementor_Widgets_Grid_3;
use elementor\widgets\ColorMag_Elementor_Widgets_Grid_4;
use elementor\widgets\ColorMag_Elementor_Widgets_Grid_5;

if ( ! function_exists( 'colormag_elementor_widget_render_filter' ) ) :

	/**
	 * Render the default WordPress widget settings, ie, divs.
	 *
	 * @param array $args The widget id.
	 *
	 * @return array Register sidebar divs.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_widget_render_filter( $args ) {

		$sidebar_args = array(
			'before_widget' => '<section class="widget ' . colormag_widget_class_names( $args['widget_id'] ) . ' clearfix">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		);

		return $sidebar_args;

	}

endif;

add_filter( 'elementor/widgets/wordpress/widget_args', 'colormag_elementor_widget_render_filter' ); // WPCS: spelling ok.

if ( ! function_exists( 'colormag_widget_class_names' ) ) :

	/**
	 * Render the widget classes for Elementor plugin compatibility.
	 *
	 * @param string $widgets_id The widgets of the id.
	 *
	 * @return mixed The widget classes of the id passed.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_widget_class_names( $widgets_id ) {

		$widgets_id = str_replace( 'wp-widget-', '', $widgets_id );

		$classes = colormag_widgets_classes();

		return isset( $classes[ $widgets_id ] ) ? $classes[ $widgets_id ] : 'widget_featured_posts';

	}

endif;

if ( ! function_exists( 'colormag_widgets_classes' ) ) :

	/**
	 * Return all the arrays of widgets classes and classnames of same respectively.
	 *
	 * @return array the array of widget classnames and its respective classes.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_widgets_classes() {

		$sidebar_class = array(
			'colormag_featured_posts_slider_widget'   => 'widget_featured_slider widget_featured_meta',
			'colormag_highlighted_posts_widget'       => 'widget_highlighted_posts widget_featured_meta',
			'colormag_featured_posts_widget'          => 'widget_featured_posts widget_featured_meta',
			'colormag_featured_posts_vertical_widget' => 'widget_featured_posts widget_featured_posts_vertical widget_featured_meta',
			'colormag_728x90_advertisement_widget'    => 'widget_300x250_advertisement',
			'colormag_300x250_advertisement_widget'   => 'widget_728x90_advertisement',
			'colormag_125x125_advertisement_widget'   => 'widget_125x125_advertisement',
		);

		return $sidebar_class;

	}

endif;

/**
 * Load the ColorMag Elementor widgets file and registers it
 */
if ( ! function_exists( 'colormag_elementor_widgets_registered' ) ) :

	/**
	 * Load and register the required Elementor widgets file.
	 *
	 * @param Elementor\Widgets_Manager $widgets_manager The widgets manager instance.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_widgets_registered( $widgets_manager ) {

		// Require the Widget Base class.
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/class-colormag-elementor-widget-base.php';

		// Require the files.
		// 1. Block Widgets.
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-block-1.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-block-2.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-block-4.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-block-6.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-block-9.php';

		// 2. Grid Widgets.
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-grid-2.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-grid-3.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-grid-4.php';
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-widgets-grid-5.php';

		// 3. Global Widgets.
		require COLORMAG_ELEMENTOR_WIDGETS_DIR . '/colormag-elementor-global-widgets-title.php';

		// Register the widgets
		// 1. Block Widgets.
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Block_1() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Block_2() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Block_4() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Block_6() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Block_9() );

		// 2. Grid Widgets.
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Grid_2() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Grid_3() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Grid_4() );
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Widgets_Grid_5() );

		// 3. Global Widgets.
		$widgets_manager->register_widget_type( new ColorMag_Elementor_Global_Widgets_Title() );

	}

endif;

add_action( 'elementor/widgets/widgets_registered', 'colormag_elementor_widgets_registered' );

if ( ! function_exists( 'colormag_elementor_category' ) ) :

	/**
	 * Add the Elementor category for use in ColorMag widgets as separator.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_category() {

		// Register widget block category for Elementor section.
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'colormag-widget-blocks',
			array(
				'title' => esc_html__( 'ColorMag Widget Blocks', 'colormag' ),
			),
			1
		);

		// Register widget grid category for Elementor section.
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'colormag-widget-grid',
			array(
				'title' => esc_html__( 'ColorMag Widget Grid', 'colormag' ),
			),
			1
		);

		// Register widget global category for Elementor section.
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'colormag-widget-global',
			array(
				'title' => esc_html__( 'ColorMag Global Widgets', 'colormag' ),
			),
			1
		);
	}

endif;

add_action( 'elementor/init', 'colormag_elementor_category' );

if ( ! function_exists( 'colormag_elementor_enqueue_style' ) ) :

	/**
	 * Enqueue the styles for use within Elementor only.
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_enqueue_style() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Enqueue the main Elementor CSS file for use with Elementor.
		wp_enqueue_style( 'colormag-elementor', COLORMAG_ELEMENTOR_URL . '/assets/css/elementor' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );
		wp_style_add_data( 'colormag-elementor', 'rtl', 'replace' );

	}

endif;

add_action( 'elementor/frontend/after_enqueue_styles', 'colormag_elementor_enqueue_style' );
