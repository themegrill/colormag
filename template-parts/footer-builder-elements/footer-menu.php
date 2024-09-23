<?php
/**
 * Site navigation template file.
 *
 * @package colormag
 *
 * @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<nav id="cm-footer-nav" class="cm-footer-nav">
	<?php
	$footer_menu = get_theme_mod( 'colormag_footer_menu', 'none' );
	wp_nav_menu(
		array(
			'theme_location' => 'menu-footer',
			'menu_id'        => 'cm-footer-menu',
			'menu'           => $footer_menu,
			'menu_class'     => 'cm-footer-menu',
			'container'      => '',
			'depth'          => apply_filters( 'colormag_footer-menu_depth', -1 ),
		)
	);
	?>
</nav><!-- #cm-footer-nav -->
