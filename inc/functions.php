<?php
/**
 * ColorMag functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

/****************************************************************************************/

add_action( 'wp_head', 'colormag_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function colormag_custom_css() {
	$colormag_internal_css = '';

	if ( ! empty( $colormag_internal_css ) ) {
		echo '<!-- ' . get_bloginfo( 'name' ) . ' Internal Styles -->';
		?>
		<style type="text/css"><?php echo $colormag_internal_css; ?></style>
		<?php
	}
}

/**************************************************************************************/

add_action( 'colormag_footer_copyright', 'colormag_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'colormag_footer_copyright' ) ) :
	function colormag_footer_copyright() {
		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="https://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'colormag' ) . '"><span>' . __( 'WordPress', 'colormag' ) . '</span></a>';

		$tg_link = '<a href="https://themegrill.com/themes/colormag" target="_blank" title="' . esc_attr__( 'ThemeGrill', 'colormag' ) . '" rel="author"><span>' . __( 'ThemeGrill', 'colormag' ) . '</span></a>';

		$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'colormag' ), date( 'Y' ), $site_link ) . '<br>' . sprintf( __( 'Theme: %1$s by %2$s.', 'colormag' ), 'ColorMag', $tg_link ) . ' ' . sprintf( __( 'Powered by %s.', 'colormag' ), $wp_link );

		$colormag_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';
		echo $colormag_footer_copyright;
	}
endif;

/**************************************************************************************/

