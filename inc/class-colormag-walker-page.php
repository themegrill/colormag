<?php
/**
* Colormag_Walker_Page class.
*
* @package Colormag
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit();

if ( ! class_exists( 'Colormag_Walker_Page' ) ) {

	/**
	* Class Colormag_Walker_Page.
	*/
	class Colormag_Walker_Page extends Walker_Page {
		/**
		 * {@inheritDoc}
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int    $depth  Optional. Depth of page. Used for padding. Default 0.
		 * @param array  $args   Optional. Arguments for outputting the next level.
		 *                       Default empty array.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
				$t = "\t";
				$n = "\n";
			} else {
				$t = '';
				$n = '';
			}
			$indent  = str_repeat( $t, $depth );
			$output .= "$n$indent<ul class='sub-menu'>$n";
		}

		/**
		* {@inheritDoc}
		*/
		public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {

			$indent    = str_repeat( "\t", $depth );
			$css_class = '';

			if ( ! empty( $args['current_class'] ) && $page->ID === $current_page ) {
				$css_class .= ' ' . $args['current_class'];
			}

			if ( ! empty( $args['has_children_class'] ) && $this->has_children ) {
				$css_class .= ' ' . $args['has_children_class'];
			}

			$output .= $indent . '<li class="' . $css_class . '">';
			$output .= '<a href="' . get_permalink( $page->ID ) . '">' . $page->post_title . '</a>';

			if ( $args['has_children_class'] && $this->has_children ) {
				$output .= '<span role="button" tabindex="0" class="cm-submenu-toggle" onkeypress="">' .
							'<svg class="cm-icon" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 24 24"><path d="M12 17.5c-.3 0-.5-.1-.7-.3l-9-9c-.4-.4-.4-1 0-1.4s1-.4 1.4 0l8.3 8.3 8.3-8.3c.4-.4 1-.4 1.4 0s.4 1 0 1.4l-9 9c-.2.2-.4.3-.7.3z"/></svg>' .
							'</span>';
			}
		}
	}
}
