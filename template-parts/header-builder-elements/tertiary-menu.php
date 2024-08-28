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

<nav id="zak-tertiary-nav" class="zak-tertiary-nav menu">
	<?php
	$tertiary_menu = get_theme_mod( 'zakra_header_tertiary_menu', 'none' );
	wp_nav_menu(
		array(
			'theme_location' => 'menu-tertiary',
			'menu_id'        => 'zak-tertiary-menu',
			'menu'           => $tertiary_menu,
			'menu_class'     => 'zak-tertiary-menu',
			'container'      => '',
			'depth'          => apply_filters( 'zakra_tertiary-menu_depth', -1 ),
		)
	);
	?>
</nav><!-- #zak-tertiary-nav -->

