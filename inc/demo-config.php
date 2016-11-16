<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'themegrill_demo_importer_config', 'colormag_demo_importer_config' );

/**
 * Setup demo importer config.
 *
 * @param  array $demo_config
 * @return array
 */
function colormag_demo_importer_config( $demo_config ) {
	$new_demo_config = array(
		'colormag-free' => array(
			'name'         => __( 'ColorMag', 'colormag' ),
			'demo_url'     => 'http://demo.themegrill.com/colormag/',
			'demo_pack'    => true,
			'core_options' => array(
				'blogname'       => 'ColorMag',
			),
			'widgets_data_update' => array(

				/**
				 * Dropdown Categories - Handles widgets Category ID.
				 *
				 * A. Core Post Category:
				 *   1. colormag_featured_posts_slider_widget
				 *   2. colormag_highlighted_posts_widget
				 *   3. colormag_featured_posts_widget
				 *   4. colormag_featured_posts_vertical_widget
				 *
				 */
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_slider_widget' => array(
							4 => array(
								'category' => 'Latest'
							)
						),
						'colormag_highlighted_posts_widget' => array(
							3 => array(
								'category' => 'FEATURED'
							)
						),
						'colormag_featured_posts_widget' => array(
							3 => array(
								'category' => 'Health'
							),
							4 => array(
								'category' => 'Technology'
							)
						),
						'colormag_featured_posts_vertical_widget' => array(
							3 => array(
								'category' => 'Fashion'
							),
							4 => array(
								'category' => 'Sports'
							),
							5 => array(
								'category' => 'General'
							),
						),
					)
				)
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary'      => 'Primary',
				)
			),
		),
	);

	return array_merge( $new_demo_config, $demo_config );
}
