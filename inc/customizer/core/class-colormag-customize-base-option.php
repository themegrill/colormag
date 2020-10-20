<?php


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ColorMag_Customize_Base_Option {

	public function __construct() {

		// Register the customize panels, sections and controls.
		add_filter( 'colormag_customizer_options', array( $this, 'register_options' ), 10, 2 );

	}

	/**
	 * Base method for customize options.
	 *
	 * @param array                $options      Customize options provided via the theme.
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		return $options;
	}

	/**
	 * Section Description
	 *
	 * @param array $args Description arguments.
	 *
	 * @return mixed Markup of the section description.
	 */
	public function get_section_description( $args ) {

		// Description.
		$content = '<div class="colormag-section-description">';
		$content .= wp_kses_post( $args['description'] );

		// Links.
		if ( $args['links'] ) {

			$content .= '<ul>';
			foreach ( $args['links'] as $index => $link ) {

				if ( $link['attrs'] ) {

					$content .= '<li>';

					// Attribute mapping.
					$attributes = ' target="_blank" ';
					foreach ( $link['attrs'] as $attr => $attr_value ) {
						$attributes .= ' ' . $attr . '="' . esc_attr( $attr_value ) . '" ';
					}

					$content .= '<a ' . $attributes . '>' . esc_html( $link['text'] ) . '</a></li>';

					$content .= '</li>';

				}

			}

			$content .= '</ul>';

		}

		$content .= '</div>';

		return $content;
	}

}

return new ColorMag_Customize_Base_Option();
