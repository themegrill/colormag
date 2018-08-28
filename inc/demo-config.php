<?php
/**
 * Functions for configuring demo importer.
 *
 * @package ThemeGrill_Demo_Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 *
 * @return array
 */
function colormag_demo_importer_packages( $packages ) {
	$new_packages = array(
		'colormag-free'              => array(
			'name'    => __( 'ColorMag', 'colormag' ),
			'preview' => 'http://demo.themegrill.com/colormag/',
		),
		'colormag-beauty-blog'       => array(
			'name'    => __( 'ColorMag Beauty Blog', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-beauty-blog/',
		),
		'colormag-business-magazine' => array(
			'name'    => __( 'ColorMag Business Magazine', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-business-magazine/',
		),
		'colormag-dark'              => array(
			'name'    => __( 'ColorMag Dark', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-dark/',
		),
		'colormag-pro'               => array(
			'name'     => __( 'ColorMag Pro', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-fashion'       => array(
			'name'     => __( 'ColorMag Pro Fashion', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-fashion/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-technology'    => array(
			'name'     => __( 'ColorMag Pro Technology', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-technology/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-sports'        => array(
			'name'     => __( 'ColorMag Pro Sports', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-sports/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-recipes'       => array(
			'name'     => __( 'ColorMag Food Recipe', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-recipes/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-health-blog'   => array(
			'name'     => __( 'ColorMag Health Blog', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-health-blog/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-music'         => array(
			'name'     => __( 'ColorMag Pro Music', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-music/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'colormag_demo_importer_packages' );

/**
 * Set categories color settings in theme customizer.
 *
 * Note: Used rarely, if theme_mod keys are based on term ID.
 *
 * @param  array  $data
 * @param  array  $demo_data
 * @param  string $demo_id
 *
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
		case 'colormag-business-magazine':
			$wp_categories = array(
				4  => 'Investments',
				5  => 'Corporate',
				6  => 'Employment',
				8  => 'Money',
				9  => 'Market',
				14 => 'Global Trade',
				15 => 'Companies',
				16 => 'Entrepreneurship',
			);
			break;
		case 'colormag-beauty-blog':
			$wp_categories = array(
				2  => 'Food & Drinks',
				4  => 'Product',
				5  => 'Hair',
				6  => 'Fashion',
				7  => 'Beauty Tips',
				8  => 'Health',
				9  => 'Eye Make up',
				10 => 'News',
			);
			break;
		case 'colormag-dark':
			$wp_categories = array(
				2  => 'Politics',
				3  => 'Sports',
				4  => 'Travel',
				6  => 'World',
				7  => 'Technology',
				8  => 'Entertainment',
				9  => 'Fashion',
				10 => 'Food &amp; Health',
				11 => 'News',
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
				$cat_prevent[]                                               = $term->term_id;
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

add_filter( 'themegrill_customizer_demo_import_settings', 'colormag_set_cat_colors', 20, 3 );

/**
 * Delete the `Hello world!` post after successful demo import
 */
function colormag_delete_post_import() {
	$page = get_page_by_title( 'Hello world!', OBJECT, 'post' );

	if ( is_object( $page ) && $page->ID ) {
		wp_delete_post( $page->ID, true );
	}
}

add_filter( 'themegrill_ajax_demo_imported', 'colormag_delete_post_import' );
