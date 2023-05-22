<?php
/**
 * ColorMag svg icons class
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit();

if ( ! class_exists( 'ColorMag_SVG_Icons' ) ) {

	/**
	 * ColorMag_SVG_Icons class.
	 */
	class ColorMag_SVG_Icons {

		/**
		 * Allowed HTML.
		 *
		 * @var bool[][]
		 */
		public static $allowed_html = array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'circle'  => array(
				'cx' => true,
				'cy' => true,
				'r'  => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		);

		/**
		 * SVG icons.
		 *
		 * @var string[]
		 */
		public static $icons = array(
			'calendar-fill' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.1 6.6v1.6c0 .6-.4 1-1 1H3.9c-.6 0-1-.4-1-1V6.6c0-1.5 1.3-2.8 2.8-2.8h1.7V3c0-.6.4-1 1-1s1 .4 1 1v.8h5.2V3c0-.6.4-1 1-1s1 .4 1 1v.8h1.7c1.5 0 2.8 1.3 2.8 2.8zm-1 4.6H3.9c-.6 0-1 .4-1 1v7c0 1.5 1.3 2.8 2.8 2.8h12.6c1.5 0 2.8-1.3 2.8-2.8v-7c0-.6-.4-1-1-1z"></path></svg>',
			'clock'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10zm0-18c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm3.6 10.8c-.2 0-.3 0-.4-.1l-3.6-1.8c-.4-.2-.6-.5-.6-.9V6.6c0-.6.4-1 1-1s1 .4 1 1v4.8l3 1.5c.5.2.7.8.4 1.3-.1.4-.4.6-.8.6z"></path></svg>',
			'comment'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 5v10c0 1.7-1.3 3-3 3H7.4l-3.7 3.7c-.2.2-.4.3-.7.3-.1 0-.3 0-.4-.1-.4-.1-.6-.5-.6-.9V5c0-1.7 1.3-3 3-3h14c1.7 0 3 1.3 3 3z"></path></svg>',
			'eye'           => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 19.5c-6.2 0-9.7-6.8-9.9-7-.1-.3-.1-.6 0-.9.1-.3 3.6-7 9.9-7s9.7 6.8 9.9 7c.1.3.1.6 0 .9-.2.2-3.7 7-9.9 7zM4.1 12c.8 1.4 3.7 5.5 7.9 5.5s7-4.1 7.9-5.5c-.9-1.4-3.7-5.5-7.9-5.5S5 10.6 4.1 12zm7.9 3.5c-2 0-3.5-1.5-3.5-3.5S10 8.5 12 8.5s3.5 1.5 3.5 3.5-1.5 3.5-3.5 3.5zm0-5c-.8 0-1.5.7-1.5 1.5s.7 1.5 1.5 1.5 1.5-.7 1.5-1.5-.7-1.5-1.5-1.5z"></path></svg>',
			'heart-fill'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.32 4.83a5.73 5.73 0 0 0-8.11 0L12 5l-.21-.21a5.73 5.73 0 0 0-8.11 8.11l7.61 7.62a1 1 0 0 0 1.42 0l7.61-7.62a5.73 5.73 0 0 0 0-8.07Z"></path></svg>',
			'user'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 7c0-2.8 2.2-5 5-5s5 2.2 5 5-2.2 5-5 5-5-2.2-5-5zm9 7H8c-2.8 0-5 2.2-5 5v2c0 .6.4 1 1 1h16c.6 0 1-.4 1-1v-2c0-2.8-2.2-5-5-5z"></path></svg>',
		);

		/**
		 * Get the SVG icon.
		 *
		 * @param string $icon Default is empty.
		 * @param bool   $echo Default is true.
		 * @param array  $args Default is empty.
		 *
		 * @return string|null
		 */
		public static function get_svg( $icon = '', $echo = true, $args = array() ) {

			$icons = self::get_icons();
			$atts  = '';
			$svg   = '';

			if ( ! empty( $args ) ) {

				foreach ( $args as $key => $value ) {

					if ( ! empty( $value ) ) {

						$atts .= esc_html( $key ) . '="' . esc_attr( $value ) . '" ';
					}
				}
			}

			if ( array_key_exists( $icon, $icons ) ) {

				$repl = sprintf( '<svg class="cm-icon coloramg-icon--%1$s" %2$s', $icon, $atts );
				$svg  = preg_replace( '/^<svg /', $repl, trim( $icons[ $icon ] ) );
				$svg  = preg_replace( "/([\n\t]+)/", ' ', $svg );
				$svg  = preg_replace( '/>\s*</', '><', $svg );
			}

			if ( ! $svg ) {

				return null;
			}

			if ( $echo ) {

				echo wp_kses( $svg, self::$allowed_html );
			} else {

				return wp_kses( $svg, self::$allowed_html );
			}
		}

		/**
		 * Get all SVG icons.
		 *
		 * @return mixed|void
		 */
		public static function get_icons() {

			/**
			 * Filter for svg icons.
			 *
			 * TODO: @since.
			 */
			return apply_filters( 'coloramg_svg_icons', self::$icons );
		}
	}
}
