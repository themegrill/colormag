<?php
/**
 * Hooks for the footer.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_main_section_inner_end' ) ) :

	/**
	 *  Main section inner ends.
	 */
	function colormag_main_section_inner_end() {
		?>
		</div><!-- .inner-wrap -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_main_section_end' ) ) :

	/**
	 * Main section ends.
	 */
	function colormag_main_section_end() {
		?>
		</div><!-- #main -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_page_end' ) ) :

	/**
	 * Page end.
	 */
	function colormag_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}

endif;
