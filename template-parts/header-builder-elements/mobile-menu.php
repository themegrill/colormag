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

wp_nav_menu(
	array(
		'theme_location' => 'menu-mobile',
		'menu_id'        => 'cm-mobile-menu',
		'menu_class'     => 'cm-mobile-menu',
		'container'      => '',

		'fallback_cb'    => function () {
			require get_template_directory() . '/inc/class-zakra-walker-page.php';
			$output = '<ul id="cm-mobile-menu" class="cm-mobile-menu">';

			$output .= wp_list_pages(
				array(
					'echo'               => false,
					'title_li'           => false,
					'walker'             => new Zakra_Walker_Page(),
					'has_children_class' => 'menu-item-has-children',
					'current_class'      => 'current-menu-item',
				)
			);

			$output .= '</ul>';
			echo $output;
		},

	)
);
