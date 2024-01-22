<?php
/**
 * Footer hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'colormag_main_section_inner_end' ) ) :

	/**
	 *  Main section inner ends.
	 */
	function colormag_main_section_inner_end() {
		?>
		</div><!-- .cm-container -->
		<?php
	}

endif;

add_action( 'colormag_action_after_inner_content', 'colormag_main_section_inner_end', 10 );

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

add_action( 'colormag_action_after_content', 'colormag_main_section_end', 10 );

if ( ! function_exists( 'colormag_advertisement_above_footer_sidebar' ) )  :

	/**
	 * Advertisement above footer sidebar area.
	 */
	function colormag_advertisement_above_footer_sidebar() {

		if ( is_active_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ) ) :
			?>
			<div class="advertisement_above_footer">
				<div class="inner-wrap">
					<?php dynamic_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ); ?>
				</div>
			</div>
		<?php
		endif;

	}

endif;

add_action( 'colormag_action_after_content', 'colormag_advertisement_above_footer_sidebar', 15 );

if ( ! function_exists( 'colormag_footer_start' ) ) :

	/**
	 * Footer starts.
	 */
	function colormag_footer_start() {
		?>
		<footer id="cm-footer" class="cm-footer <?php echo esc_attr( colormag_footer_layout_class() ); ?>">
		<?php
	}

endif;

add_action( 'colormag_action_before_footer', 'colormag_footer_start', 10 );

if ( ! function_exists( 'colormag_footer_sidebar' ) ) :

	/**
	 * Footer sidebar.
	 */
	function colormag_footer_sidebar() {
		get_sidebar( 'footer' );
	}

endif;

add_action( 'colormag_action_before_footer', 'colormag_footer_sidebar', 15 );

if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_start' ) ) :

	/**
	 * Footer socket inner wrapper starts.
	 */
	function colormag_footer_socket_inner_wrapper_start() {
		?>
		<div class="cm-footer-bar <?php echo esc_attr( colormag_copyright_alignment_class() ); ?>">
			<div class="cm-container">
				<div class="cm-row">
		<?php
	}

endif;

add_action( 'colormag_action_before_inner_footer', 'colormag_footer_socket_inner_wrapper_start', 10 );

if ( ! function_exists( 'colormag_footer_socket_area_start' ) ) :

	/**
	 * Footer socket area starts.
	 */
	function colormag_footer_socket_area_start() {
		?>
		<div class="cm-footer-bar-area">
		<?php
	}

endif;

add_action( 'colormag_action_footer', 'colormag_footer_socket_area_start', 10 );

if ( ! function_exists( 'colormag_footer_socket_right_section' ) ) :

	/**
	 * Footer socket area right section.
	 */
	function colormag_footer_socket_right_section() {

		$social_links_enable          = get_theme_mod( 'colormag_enable_social_icons', 0 );
		$social_links_footer_location = get_theme_mod( 'colormag_enable_social_icons_footer', 1 );
		?>

		<div class="cm-footer-bar__1">
			<?php
			if ( 1 == $social_links_enable && 1 == $social_links_footer_location ) {
				colormag_social_links();
			}
			?>

			<nav class="cm-footer-menu">
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'depth'          => -1,
						)
					);
				}
				?>
			</nav>
		</div> <!-- /.cm-footer-bar__1 -->

		<?php

	}

endif;

add_action( 'colormag_action_footer', 'colormag_footer_socket_right_section', 15 );

if ( ! function_exists( 'colormag_footer_socket_left_section' ) ) :

	/**
	 * Footer socket area left section.
	 */
	function colormag_footer_socket_left_section() {
		?>
		<div class="cm-footer-bar__2">
			<?php do_action( 'colormag_footer_copyright' ); ?>
		</div> <!-- /.cm-footer-bar__2 -->
		<?php
	}

endif;

add_action( 'colormag_action_footer', 'colormag_footer_socket_left_section', 20 );

if ( ! function_exists( 'colormag_footer_socket_area_end' ) ) :

	/**
	 * Footer socket area ends.
	 */
	function colormag_footer_socket_area_end() {
		?>
		</div><!-- .cm-footer-bar-area -->
		<?php
	}

endif;

add_action( 'colormag_action_footer', 'colormag_footer_socket_area_end', 25 );

if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_end' ) ) :

	/**
	 * Footer socket inner wrapper ends.
	 */
	function colormag_footer_socket_inner_wrapper_end() {
		?>
				</div><!-- .cm-container -->
			</div><!-- .cm-row -->
		</div><!-- .cm-footer-bar -->
		<?php
	}

endif;

add_action( 'colormag_action_after_inner_footer', 'colormag_footer_socket_inner_wrapper_end', 10 );

if ( ! function_exists( 'colormag_footer_end' ) ) :

	/**
	 * Footer ends.
	 */
	function colormag_footer_end() {
		?>
		</footer><!-- #cm-footer -->
		<?php
	}

endif;

add_action( 'colormag_action_after_footer', 'colormag_footer_end', 10 );

if ( ! function_exists( 'colormag_scroll_top_button' ) ) :

	/**
	 * Scroll to top button.
	 */
	function colormag_scroll_top_button() {
			?>
			<a href="#cm-masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
		<?php
	}

endif;

add_action( 'colormag_action_after_footer', 'colormag_scroll_top_button', 15 );

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

add_action( 'colormag_action_after', 'colormag_page_end', 10 );

if ( ! function_exists( 'colormag_footer_copyright' ) ) :

	/**
	 * Shows the footer copyright information.
	 */
	function colormag_footer_copyright() {

		$default_footer_value      = esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '<br>' . esc_html__( 'Theme: ', 'colormag') . '[tg-link]' .  esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].';
		$colormag_footer_copyright = $default_footer_value;

		echo do_shortcode( $colormag_footer_copyright );

	}

endif;

add_action( 'colormag_footer_copyright', 'colormag_footer_copyright', 10 );
