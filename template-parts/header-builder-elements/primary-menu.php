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

<nav id="cm-primary-nav" class="cm-primary-nav">
	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'cm-menu-primary-container',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			)
		);
	} else {
		require get_template_directory() . '/inc/class-colormag-walker-page.php';
		wp_page_menu(
			array(
				'walker'             => new Colormag_Walker_Page(),
				'has_children_class' => 'menu-item-has-children',
				'current_class'      => 'current-menu-item',
			)
		);
	}
	?>
</nav><!-- #cm-primary-nav -->

