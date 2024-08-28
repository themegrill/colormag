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

<nav id="zak-quaternary-nav" class="zak-quaternary-nav menu">
	<?php
	$quaternary_menu = get_theme_mod( 'zakra_header_quaternary_menu', 'none' );
	wp_nav_menu(
		array(
			'theme_location' => 'menu-quaternary',
			'menu_id'        => 'zak-quaternary-menu',
			'menu'           => $quaternary_menu,
			'menu_class'     => 'zak-quaternary-menu',
			'container'      => '',
			'depth'          => apply_filters( 'zakra_quaternary-menu_depth', -1 ),
		)
	);
	?>
</nav><!-- #zak-quaternary-nav -->

