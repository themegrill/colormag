<?php
/**
 * Footer builder: CopyRight
 *
 * @package ColorMag
 */
$default_footer_value      = get_theme_mod(
	'colormag_footer_copyright',
	'<span>' . esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '</span> <br>' . esc_html__( 'Theme: ', 'colormag' ) . '[tg-link]' . esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].'
);
$colormag_footer_copyright = $default_footer_value;
echo '<div class="cm-copyright copyright">';

echo do_shortcode( $colormag_footer_copyright );
echo '</div>';
