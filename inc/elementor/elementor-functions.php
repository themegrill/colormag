<?php
/**
 * Custom functions to be used within Elementor plugin
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

/**
 * Return the values of all the categories of the posts
 * present in the site
 *
 * @return array of category ids and its respective names
 *
 * @since ColorMag 2.2.3
 */
function colormag_elementor_categories() {
	$categories = get_categories();

	foreach ( $categories as $category ) {
		$output[ $category->term_id ] = $category->name;
	}

	return $output;
}
