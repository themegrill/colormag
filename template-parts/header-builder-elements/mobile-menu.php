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

wp_nav_menu(
	array(
		'theme_location' => 'primary',
		'menu_id'        => 'cm-mobile-menu',
		'menu_class'     => 'cm-mobile-menu',
		'container'      => 'cm-menu-mobile-container',
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb'    => 'colormag_menu_fallback',
	)
);

