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
		'theme_location' => 'menu-mobile',
		'menu_id'        => 'cm-mobile-menu',
		'menu_class'     => 'cm-mobile-menu',
		'container'      => '',

		'fallback_cb'    => function () {
			$output = '<ul id="cm-mobile-menu" class="cm-mobile-menu">';

			$output .= wp_list_pages(
				array(
					'echo'               => false,
					'title_li'           => false,
					'has_children_class' => 'menu-item-has-children',
					'current_class'      => 'current-menu-item',
				)
			);

			$output .= '</ul>';
			echo $output;
		},

	)
);
