<?php
/**
 * Site navigation template file.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container_class' => 'cm-menu-primary-container',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
} else {
	wp_page_menu();
}
