<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * Functions hooked into colormag_action_head action.
	 *
	 * @hooked colormag_head - 10
	 */
	do_action( 'colormag_action_head' );

	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php
wp_body_open();

/**
 * Hook: colormag_before.
 */
do_action( 'colormag_before' );


/**
 * Functions hooked into colormag_action_before action.
 *
 * @hooked colormag_page_start - 10
 * @hooked colormag_skip_content_link - 15
 */
do_action( 'colormag_action_before' );


/**
 * Hook: colormag_before_header.
 */
do_action( 'colormag_before_header' );


/**
 * Functions hooked into colormag_action_before_header action.
 *
 * @hooked colormag_header_start - 10
 */
do_action( 'colormag_action_before_header' );


/**
 * Functions hooked into colormag_action_before_inner_header action.
 *
 * @hooked colormag_header_nav_container_start - 10
 */
do_action( 'colormag_action_before_inner_header' );


/**
 * Functions hooked into colormag_action_header action.
 *
 * @hooked colormag_header - 10
 */
do_action( 'colormag_action_header' );


/**
 * Functions hooked into colormag_action_after_inner_header action.
 *
 * @hooked colormag_header_image_before_nav_container_end - 5
 * @hooked colormag_header_nav_container_end - 10
 */
do_action( 'colormag_action_after_inner_header' );


/**
 * Functions hooked into colormag_action_after_header action.
 *
 * @hooked colormag_header_end - 10
 */
do_action( 'colormag_action_after_header' );


/**
 * Hook: colormag_after_header.
 */
do_action( 'colormag_after_header' );


/**
 * Hook: colormag_before_main.
 */
do_action( 'colormag_before_main' );


/**
 * Functions hooked into colormag_action_before_content action.
 *
 * @hooked colormag_main_section_start - 10
 */
do_action( 'colormag_action_before_content' );


/**
 * Functions hooked into colormag_action_before_inner_content action.
 *
 * @hooked colormag_main_section_inner_start - 10
 */
do_action( 'colormag_action_before_inner_content' );
