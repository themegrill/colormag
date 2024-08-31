<?php
/**
 * Site navigation template file.
 *
 * @package colormag
 *
 * @since 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<nav id="cm-primary-nav" class="">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-primary',
			'menu_id'        => 'cm-primary-menu',
			'menu_class'     => 'cm-primary-menu',
			'container'      => '',
			'fallback_cb'    => 'colormag_menu_fallback',
		)
	);
	?>
</nav><!-- #cm-primary-nav -->

