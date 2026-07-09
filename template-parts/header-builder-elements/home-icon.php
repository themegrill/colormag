<?php
/**
 * Header builder: Home icon markup file.
 *
 * @package colormag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$home_icon_class = 'cm-home-icon';

if ( is_front_page() ) {
	$home_icon_class = 'cm-home-icon front_page_on';
}

// Build the default home icon output so it can be filtered.
// Pro hooks `colormag_home_icon_output` to render a logo image instead of
// the home icon when the relevant theme mod is set.
ob_start();
?>

<div class="<?php echo esc_attr( $home_icon_class ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
	>
		<?php colormag_get_icon( 'home' ); ?>
	</a>
</div>
<?php
$home_icon_output = ob_get_clean();

/**
 * Filters the header builder home icon markup.
 *
 * @param string $home_icon_output The default home icon HTML.
 */
echo apply_filters( 'colormag_home_icon_output', $home_icon_output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is built from escaped values above and trusted filter callbacks.
