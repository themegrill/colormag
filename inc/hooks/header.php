<?php
/**
 * Hooks for the header.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_head' ) ) :

	/**
	 * HTML Head.
	 */
	function colormag_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php
	}

endif;


if ( ! function_exists( 'colormag_page_start' ) ) :

	/**
	 * Page start.
	 */
	function colormag_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_skip_content_link' ) ) :

	/**
	 * Skip content link.
	 */
	function colormag_skip_content_link() {
		?>
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'colormag' ); ?></a>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_start' ) ) :

	/**
	 * Header starts.
	 */
	function colormag_header_start() {
		?>
		<header id="masthead" class="site-header clearfix <?php echo esc_attr( colormag_header_layout_class() ); ?>">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_nav_container_start' ) ) :

	/**
	 * Header nav container starts.
	 */
	function colormag_header_nav_container_start() {
		?>
		<div id="header-text-nav-container" class="clearfix">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header' ) ) :

	/**
	 * Header main area.
	 */
	function colormag_header() {

		$header_image_position = get_theme_mod( 'colormag_header_image_position', 'position_two' );

		// Display the top header bar.
		colormag_top_header_bar_display();

		if ( 'position_one' === $header_image_position ) {
			the_custom_header_markup();
		}

		// Display the middle header bar.
		colormag_middle_header_bar_display();

		if ( 'position_two' === $header_image_position ) {
			the_custom_header_markup();
		}

		// Display the below header bar.
		colormag_below_header_bar_display();

	}

endif;


if ( ! function_exists( 'colormag_header_nav_container_end' ) ) :

	/**
	 * Header nav container ends.
	 */
	function colormag_header_nav_container_end() {
		?>
		</div><!-- #header-text-nav-container -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_image_before_nav_container_end' ) ) :

	/**
	 * Display the header image just before the header closes.
	 */
	function colormag_header_image_before_nav_container_end() {
		$colormag_header_image_position = get_theme_mod( 'colormag_header_image_position', 'position_two' );

		if ( 'position_three' === $colormag_header_image_position ) {
			the_custom_header_markup();
		}
	}

endif;


if ( ! function_exists( 'colormag_header_end' ) ) :

	/**
	 * Header ends.
	 */
	function colormag_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_main_section_start' ) ) :

	/**
	 * Main section starts.
	 */
	function colormag_main_section_start() {
		?>
		<div id="main" class="clearfix">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_main_section_inner_start' ) ) :

	/**
	 * Main section inner starts.
	 */
	function colormag_main_section_inner_start() {
		?>
		<div class="inner-wrap clearfix">
		<?php
	}

endif;

if ( ! function_exists( 'colormag_change_logo_attr' ) ) :

	/**
	 * Change the image attributes while retina logo is set.
	 *
	 * @param $attr
	 * @param $attachment
	 * @param $size
	 *
	 * @return mixed
	 */
	function colormag_change_logo_attr( $attr, $attachment, $size ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

		if ( ! empty( $custom_logo ) ) {
			$custom_logo = $custom_logo[0];
		}

		if ( isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {
			$retina_logo    = get_theme_mod( 'colormag_retina_logo', '' );
			$attr['srcset'] = '';

			if ( $retina_logo ) {
				$attr['srcset'] = $custom_logo . ' 1x,' . $retina_logo . ' 2x';
			}
		}

		return $attr;
	}

endif;
