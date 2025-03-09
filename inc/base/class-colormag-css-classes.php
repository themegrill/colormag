<?php
/**
 * Adds classes to appropriate places.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_Css_Classes' ) ) :

	/**
	 * ColorMag_Css_Classes class.
	 */
	class ColorMag_Css_Classes {

		/**
		 * Constructor.
		 */
		public function __construct() {

			add_filter( 'colormag_header_class', array( $this, 'colormag_add_header_classes' ) );
		}

		/**
		 * Adds css classes into header
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function colormag_add_header_classes( $classes ) {

			$layout = get_theme_mod( 'colormag_main_header_layout', 'layout-1' );
			$width  = get_theme_mod( 'colormag_main_header_width_setting', 'full-width' );

			$layout1_style = get_theme_mod( 'colormag_main_header_layout_1_style', 'style-1' );

			$layout2_style = get_theme_mod( 'colormag_main_header_layout_2_style', 'style-1' );

			if ( ! colormag_maybe_enable_builder() ) {
				$classes[] = 'cm-' . $layout;
			}

			if ( 'layout-1' === $layout ) {
				$classes[] = 'cm-' . $layout . '-' . $layout1_style;
			} elseif ( 'layout-2' === $layout ) {
				$classes[] = 'cm-' . $layout . '-' . $layout2_style;
			}

			if ( 'layout-1' === $layout ) {
				if ( 'full-width' === $width ) {
					$classes[] = 'cm-' . $width;
				} elseif ( 'contained' === $width ) {
					$classes[] = 'cm-' . $width;
				}
			} elseif ( colormag_maybe_enable_builder() ) {
				if ( 'full-width' === $width ) {
					$classes[] = 'cm-' . $width;
				} elseif ( 'contained' === $width ) {
					$classes[] = 'cm-' . $width;
				}
			}

			return $classes;
		}
	}
endif;

new ColorMag_Css_Classes();
