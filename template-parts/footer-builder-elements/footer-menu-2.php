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

<nav id="zak-footer-nav-2" class="zak-footer-nav-2">
	<?php
	$footer_menu_2 = get_theme_mod( 'zakra_footer_menu_2', 'none' );
	wp_nav_menu(
		array(
			'theme_location' => 'menu-footer-2',
			'menu_id'        => 'zak-footer-menu-2',
			'menu'           => $footer_menu_2,
			'menu_class'     => 'zak-footer-menu-2',
			'container'      => '',
			'depth'          => apply_filters( 'zakra_footer-menu_2_depth', -1 ),
		)
	);
	?>
</nav><!-- #zak-footer-nav -->
