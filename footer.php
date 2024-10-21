<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Functions hooked into colormag_action_after_inner_content action.
 *
 * @hooked colormag_main_section_inner_end - 10
 */
do_action( 'colormag_action_after_inner_content' );


/**
 * Functions hooked into colormag_action_after_content action.
 *
 * @hooked colormag_main_section_end - 10
 * @hooked colormag_advertisement_above_footer_sidebar - 15
 */
do_action( 'colormag_action_after_content' );


/**
 * Hook: colormag_before_footer.
 */
do_action( 'colormag_before_footer' );


$enable_builder = get_theme_mod( 'colormag_enable_builder', false );
if ( $enable_builder || colormag_maybe_enable_builder() ) {
	colormag_footer_builder_markup();
} else {

	/**
	 * Functions hooked into colormag_action_before_footer action.
	 *
	 * @hooked colormag_footer_start - 10
	 * @hooked colormag_footer_sidebar - 15
	 */
	do_action( 'colormag_action_before_footer' );


	/**
	 * Functions hooked into colormag_action_before_inner_footer action.
	 *
	 * @hooked colormag_footer_socket_inner_wrapper_start - 10
	 */
	do_action( 'colormag_action_before_inner_footer' );


	/**
	 * Functions hooked into colormag_action_footer action.
	 *
	 * @hooked colormag_footer_socket_area_start - 10
	 * @hooked colormag_footer_socket_right_section - 15
	 * @hooked colormag_footer_socket_left_section - 20
	 * @hooked colormag_footer_socket_area_end - 25
	 */
	do_action( 'colormag_action_footer' );


	/**
	 * Functions hooked into colormag_action_after_inner_footer action.
	 *
	 * @hooked colormag_footer_socket_inner_wrapper_end - 10
	 */
	do_action( 'colormag_action_after_inner_footer' );

}

/**
 * Functions hooked into colormag_action_after_footer action.
 *
 * @hooked colormag_footer_end - 10
 * @hooked colormag_scroll_top_button - 15
 */
do_action( 'colormag_action_after_footer' );


/**
 * Functions hooked into colormag_action_after action.
 *
 * @hooked colormag_page_end - 10
 */
do_action( 'colormag_action_after' );

wp_footer();
?>

</body>
</html>
