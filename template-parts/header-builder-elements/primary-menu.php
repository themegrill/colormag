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

<nav id="cm-primary-nav" class="<?php colormag_css_class( 'colormag_nav_class' ); ?> <?php colormag_primary_menu_class(); ?>">
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

