<?php
/**
 * Adds classes to appropriate places.
 *
 * @package ColorMag
 *
 * @since   ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_footer_layout_class' ) ) :

	/**
	 * Function to return the classname for footer option layout class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_footer_layout_class() {

		$colormag_footer_layout_class = get_theme_mod( 'colormag_main_footer_layout', 'layout-1' );
		$class_name                   = '';

		if ( 'layout-2' === $colormag_footer_layout_class ) {
			$class_name = 'colormag-footer--classic';
		}

		return $class_name;

	}

endif;


if ( ! function_exists( 'colormag_copyright_alignment_class' ) ) :

	/**
	 * Function to return the classname for footer copyright alignment class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_copyright_alignment_class() {

		$colormag_copyright_alignment_class = get_theme_mod( 'colormag_footer_bar_alignment', 'left' );
		$class_name                         = 'cm-footer-bar-style-1';

		if ( 'right' === $colormag_copyright_alignment_class ) {
			$class_name = 'cm-footer-bar-style-2';
		} elseif ( 'center' === $colormag_copyright_alignment_class ) {
			$class_name = 'cm-footer-bar-style-3';
		}

		return $class_name;

	}

endif;
