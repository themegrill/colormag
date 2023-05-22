<?php
/**
 * Top bar hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================= Hooks > Header Top ==========================================*/

if ( ! function_exists( 'colormag_header_top' ) ) :

	/**
	 * Header top.
	 * TODO: @since
	 */
	function colormag_header_top() {

		get_template_part( 'template-parts/header/top', 'bar' );
	}
endif;

add_action( 'colormag_action_header_top', 'colormag_header_top', 10 );
