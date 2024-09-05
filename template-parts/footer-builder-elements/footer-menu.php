<?php
/**
 * Site navigation template file.
 *
 * @package zakra
 *
 * @since 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<nav id="zak-footer-nav" class="zak-footer-nav">
	<?php
	$footer_menu = get_theme_mod( 'zakra_footer_menu', 'none' );
	wp_nav_menu(
		array(
			'theme_location' => 'menu-footer',
			'menu_id'        => 'zak-footer-menu',
			'menu'           => $footer_menu,
			'menu_class'     => 'zak-footer-menu',
			'container'      => '',
			'depth'          => apply_filters( 'zakra_footer-menu_depth', -1 ),
		)
	);
	?>
</nav><!-- #zak-footer-nav -->
