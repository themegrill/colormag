<?php
/**
 * Header main hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================= Hooks > Header Main ==========================================*/

if ( ! function_exists( 'colormag_before_header_main' ) ) :

	/**
	 * Before header main.
	 */
	function colormag_before_header_main() {
		?>
		<div class="cm-main-header">
		<?php
	}
endif;

add_action( 'colormag_action_before_inner_header', 'colormag_before_header_main', 10 );

if ( ! function_exists( 'colormag_after_header_main' ) ) :

	/**
	 * After header main.
	 */
	function colormag_after_header_main() {
		?>
		</div> <!-- /.cm-main-header -->
		<?php
	}
endif;

add_action( 'colormag_action_after_inner_header', 'colormag_after_header_main', 10 );
