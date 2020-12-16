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


if ( ! function_exists( 'colormag_footer_start' ) ) :

	/**
	 * Footer starts.
	 */
	function colormag_footer_start() {
		?>
		<footer id="colophon" class="clearfix <?php echo esc_attr( colormag_footer_layout_class() ); ?>">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_sidebar' ) ) :

	/**
	 * Footer sidebar.
	 */
	function colormag_footer_sidebar() {
		get_sidebar( 'footer' );
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_start' ) ) :

	/**
	 * Footer socket inner wrapper starts.
	 */
	function colormag_footer_socket_inner_wrapper_start() {
		?>
		<div class="footer-socket-wrapper clearfix">
			<div class="inner-wrap">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_area_start' ) ) :

	/**
	 * Footer socket area starts.
	 */
	function colormag_footer_socket_area_start() {
		?>
		<div class="footer-socket-area">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_right_section' ) ) :

	/**
	 * Footer socket area right section.
	 */
	function colormag_footer_socket_right_section() {

		$social_links_enable   = get_theme_mod( 'colormag_social_link_activate', 0 );
		$social_links_location = get_theme_mod( 'colormag_social_link_location_option', 'both' );
		?>

		<div class="footer-socket-right-section">
			<?php
			if ( 1 == $social_links_enable && ( 'both' === $social_links_location || 'footer' === $social_links_location ) ) {
				colormag_social_links();
			}
			?>
		</div>

		<?php

	}

endif;


if ( ! function_exists( 'colormag_footer_socket_left_section' ) ) :

	/**
	 * Footer socket area left section.
	 */
	function colormag_footer_socket_left_section() {
		?>
		<div class="footer-socket-left-section">
			<?php do_action( 'colormag_footer_copyright' ); ?>
		</div>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_area_end' ) ) :

	/**
	 * Footer socket area ends.
	 */
	function colormag_footer_socket_area_end() {
		?>
		</div><!-- .footer-socket-area -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_end' ) ) :

	/**
	 * Footer socket inner wrapper ends.
	 */
	function colormag_footer_socket_inner_wrapper_end() {
		?>
			</div><!-- .inner-wrap -->
		</div><!-- .footer-socket-wrapper -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_end' ) ) :

	/**
	 * Footer ends.
	 */
	function colormag_footer_end() {
		?>
		</footer><!-- #colophon -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_scroll_top_button' ) ) :

	/**
	 * Scroll to top button.
	 */
	function colormag_scroll_top_button() {
		?>
		<a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
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


if ( ! function_exists( 'colormag_footer_copyright' ) ) :

	/**
	 * Shows the footer copyright information.
	 */
	function colormag_footer_copyright() {

		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="https://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'colormag' ) . '" rel="nofollow"><span>' . esc_html__( 'WordPress', 'colormag' ) . '</span></a>';

		$tg_link = '<a href="https://themegrill.com/themes/colormag" target="_blank" title="' . esc_attr__( 'ColorMag', 'colormag' ) . '" rel="nofollow"><span>' . esc_html__( 'ColorMag', 'colormag' ) . '</span></a>';

		$default_footer_value = sprintf( /* Translators: %1$s: Current year, %2$s: Site link */ esc_html__( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'colormag' ), date( 'Y' ), $site_link ) . '<br>' . sprintf( /* Translators: %1$s: Theme name, %2$s: ThemeGrill site link */ esc_html__( 'Theme: %1$s by %2$s.', 'colormag' ),  $tg_link, 'ThemeGrill' ) . ' ' . sprintf( /* Translators: %s: WordPress link */ esc_html__( 'Powered by %s.', 'colormag' ), $wp_link );

		$colormag_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';

		echo $colormag_footer_copyright; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

	}

endif;
