<?php
/**
 * Theme Header Section for ColorMag theme.
 *
 * Displays all of the <head> section and everything up till <div id="cm-content" class="cm-content"> <div class="inner-wrap">
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

do_action( 'colormag_action_doctype' );

?>

<head>

	<?php
	/**
	 * Functions hooked into colormag_action_head action.
	 *
	 * @hooked colormag_head - 10
	 */
	do_action( 'colormag_action_head' );
	?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php

global $colormag_duplicate_posts;
$colormag_duplicate_posts = array();

?>

<?php
/**
 * WordPress function to load custom scripts after body.
 *
 * Introduced in WordPress 5.2.0
 *
 */
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php
/**
 * Hook: colormag_before.
 */
do_action( 'colormag_before' );
?>

<?php
/**
 * Functions hooked into colormag_action_before action.
 *
 * @hooked colormag_background_image_clickable - 5
 * @hooked colormag_page_start - 10
 * @hooked colormag_skip_content_link - 15
 */
do_action( 'colormag_action_before' );
?>

<?php colormag_header(); ?>

<?php
/**
 * Hook: colormag_before_main.
 */
do_action( 'colormag_before_main' );
?>

<?php
/**
 * Functions hooked into colormag_action_before_content action.
 *
 * @hooked colormag_main_section_start - 10
 * @hooked colormag_front_page_full_width_sidebar - 20
 */
do_action( 'colormag_action_before_content' );
?>

<?php
/**
 * Functions hooked into colormag_action_before_inner_content action.
 *
 * @hooked colormag_main_section_inner_start - 10
 */
do_action( 'colormag_action_before_inner_content' );
