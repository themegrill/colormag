<?php
/**
 * Dynamic classes for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_header_layout_class' ) ) :

	/**
	 * Function to return the classname for header option layout class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_header_layout_class() {

		// Add the header area display type dynamic class.
		$colormag_header_layout_class = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );
		$class_name                   = '';

		if ( 'type_two' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-clean';
		} elseif ( 'type_three' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-classic';
		}

		return $class_name;

	}

endif;


if ( ! function_exists( 'colormag_footer_layout_class' ) ) :

	/**
	 * Function to return the classname for footer option layout class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_footer_layout_class() {

		$colormag_footer_layout_class = get_theme_mod( 'colormag_main_footer_layout_display_type', 'type_one' );
		$class_name                   = '';

		if ( 'type_two' === $colormag_footer_layout_class ) {
			$class_name = 'colormag-footer--classic';
		}

		return $class_name;

	}

endif;
