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

<nav id="cm-secondary-nav" class="cm-secondary-nav menu">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-secondary',
			'menu_id'        => 'cm-secondary-menu',
			'menu_class'     => 'cm-secondary-menu',
			'container'      => '',
			'fallback_cb'    => 'colormag_menu_fallback',
		)
	);
	?>
</nav><!-- #cm-secondary-nav -->

