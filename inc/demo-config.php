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
add_filter( 'themegrill_customizer_demo_import_settings', 'colormag_set_cat_colors', 20, 3 );

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

/**
 * Set categories color settings in theme customizer.
 *
 * Note: Used rarely, if theme_mod keys are based on term ID.
 *
 * @param  array  $data
 * @param  array  $demo_data
 * @param  string $demo_id
 * @return array
 */
function colormag_set_cat_colors( $data, $demo_data, $demo_id ) {
	$cat_colors    = array();
	$cat_prevent   = array();
	$wp_categories = array();

	// Format the data based on demo ID.
	switch ( $demo_id ) {
		case 'colormag-free':
			$wp_categories = array(
				1  => 'Sports',
				2  => 'Politics',
				3  => 'Business',
				4  => 'Technology',
				5  => 'WordPress',
				8  => 'General',
				9  => 'Fashion',
				10 => 'Food',
				11 => 'Entertainment',
				13 => 'FEATURED',
				14 => 'TOP STORIES',
				15 => 'TOP VIDEOS',
				16 => 'Health',
				18 => 'Latest',
				19 => 'Drinks',
				20 => 'Gadgets',
				21 => 'Female',
				22 => 'Style',
				23 => 'News',
			);
		break;
	}

	// Fetch categories color settings.
	foreach ( $wp_categories as $term_id => $term_name ) {
		if ( ! empty( $data['mods'][ 'colormag_category_color_' . $term_id ] ) ) {
			$cat_colors[ 'colormag_category_color_' . $term_id ] = $data['mods'][ 'colormag_category_color_' . $term_id ];
		}
	}

	// Set categories color settings properly.
	foreach ( $wp_categories as $term_id => $term_name ) {
		if ( ! empty( $data['mods'][ 'colormag_category_color_' . $term_id ] ) ) {
			$term  = get_term_by( 'name', $term_name, 'category' );
			$color = $cat_colors[ 'colormag_category_color_' . $term_id ];

			if ( is_object( $term ) && $term->term_id ) {
				$cat_prevent[] = $term->term_id;
				$data['mods'][ 'colormag_category_color_' . $term->term_id ] = $color;

				// Prevent deleting stored color settings.
				if ( ! in_array( $term_id, $cat_prevent ) ) {
					unset( $data['mods'][ 'colormag_category_color_' . $term_id ] );
				}
			}
		}
	}

	return $data;
}
