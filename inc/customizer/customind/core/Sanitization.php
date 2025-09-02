<?php
/**
 * Sanitization.
 */

namespace Customind\Core;

use Customind\Core\Traits\Hook;

class Sanitization {

	use Hook;

	/**
	 * Holds single instance of this class.
	 *
	 * @var Sanitization
	 */
	private static $instance = null;

	/**
	 * Create single instance of this class.
	 *
	 * @return Sanitization
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Sanitize radio.
	 *
	 * @param mixed                 $value Value from customizer.
	 * @param \WP_Customize_Setting $setting Settings.
	 * @return string
	 */
	public static function sanitize_radio( $value, $setting ) {
		$value   = sanitize_text_field( $value );
		$choices = $setting->manager->get_control( $setting->id )->choices;

		if ( is_numeric( $value ) ) {
			$value = (int) $value;
		}

		return in_array( $value, array_keys( $choices ), true ) ? $value : ( $setting->default ?? '' );
	}

	/**
	 * Sanitize hex.
	 *
	 * @param string $color
	 * @return string
	 */
	private static function sanitize_hex( $color ) {
		return preg_match( '/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{4}|[0-9A-Fa-f]{6}|[0-9A-Fa-f]{8})$/', $color ) ? $color : '';
	}

	/**
	 * Sanitize rgb.
	 *
	 * @param string $color
	 * @return string
	 */
	private static function sanitize_rgb( $color ) {
		if ( preg_match( '/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/', $color, $matches ) ) {
			list(, $r, $g, $b) = $matches;
			if ( $r <= 255 && $g <= 255 && $b <= 255 ) {
				return $color;
			}
		}
		return '';
	}

	/**
	 * Sanitize rgba.
	 *
	 * @param string $color
	 * @return string
	 */
	private static function sanitize_rgba( $color ) {
		if ( preg_match( '/^rgba\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3}),\s*(0|1|0?\.\d+)\)$/', $color, $matches ) ) {
			list(, $r, $g, $b, $a) = $matches;
			if ( $r <= 255 && $g <= 255 && $b <= 255 && $a >= 0 && $a <= 1 ) {
				return $color;
			}
		}
		return '';
	}

	/**
	 * Sanitize hsl.
	 *
	 * @param string $color
	 * @return string
	 */
	private static function sanitize_hsl( $color ) {
		if ( preg_match( '/^hsl\((\d{1,3}),\s*(\d{1,3})%,\s*(\d{1,3})%\)$/', $color, $matches ) ) {
			list(, $h, $s, $l) = $matches;
			if ( $h <= 360 && $s <= 100 && $l <= 100 ) {
				return $color;
			}
		}
		return '';
	}

	/**
	 * Sanitize hsla.
	 *
	 * @param string $color
	 * @return string
	 */
	private static function sanitize_hsla( $color ) {
		if ( preg_match( '/^hsla\((\d{1,3}),\s*(\d{1,3})%,\s*(\d{1,3})%,\s*(0|1|0?\.\d+)\)$/', $color, $matches ) ) {
			list(, $h, $s, $l, $a) = $matches;
			if ( $h <= 360 && $s <= 100 && $l <= 100 && $a >= 0 && $a <= 1 ) {
				return $color;
			}
		}
		return '';
	}

	/**
	 * Sanitize color.
	 *
	 * @param string $value Value from customizer.
	 * @return string
	 */
	public static function sanitize_color( $value ) {
		switch ( true ) {
			case 0 === strpos( $value, '#' ):
				return self::sanitize_hex( $value );
			case 0 === strpos( $value, 'rgb(' ):
				return self::sanitize_rgb( $value );
			case 0 === strpos( $value, 'rgba(' ):
				return self::sanitize_rgba( $value );
			case 0 === strpos( $value, 'hsl(' ):
				return self::sanitize_hsl( $value );
			case 0 === strpos( $value, 'hsla(' ):
				return self::sanitize_hsla( $value );
			default:
				return '';
		}
	}

	/**
	 * Sanitize input.
	 *
	 * @param string $input
	 * @param \WP_Customize_Setting $setting
	 * @return string
	 */
	public static function sanitize_input( $input, $setting ) {
		$type = $setting->manager->get_control( $setting->id )->input_attrs['type'] ?? 'text';

		switch ( $type ) {
			case 'url':
				return esc_url_raw( $input );
			case 'email':
				return sanitize_email( $input );
			case 'number':
				return self::sanitize_int( $input, $setting );
			default:
				return sanitize_text_field( $input );
		}
	}

	/**
	 * Sanitize int.
	 *
	 * @param string $value
	 * @param \WP_Customize_Setting $setting
	 * @return string
	 */
	public function sanitize_int( $value, $setting ) {
		return is_numeric( $value ) ? floatval( $value ) : $setting->default;
	}

	/**
	 * Sanitize checkbox.
	 *
	 * @param mixed $input
	 * @return boolean
	 */
	public function sanitize_checkbox( $input ) {
		return 1 === $input || '1' === $input || true === (bool) $input;
	}

	/**
	 * Get sanitization callback.
	 *
	 * @param string $control
	 * @return null|callable|string
	 */
	public static function get_sanitization_callback( $control ) {
		$sanitization_callbacks = [
			'customind-text'          => [ __CLASS__, '::sanitize_input' ],
			'customind-checkbox'      => [ __CLASS__, '::sanitize_checkbox' ],
			'customind-toggle'        => [ __CLASS__, '::sanitize_checkbox' ],
			'customind-color'         => [ __CLASS__, '::sanitize_color' ],
			'customind-radio'         => [ __CLASS__, '::sanitize_radio' ],
			'customind-radio-image'   => [ __CLASS__, '::sanitize_radio' ],
			'customind-editor'        => 'wp_kses_post',
			'customind-fontawesome'   => 'sanitize_text_field',
			'customind-select'        => 'sanitize_text_field',
			'customind-textarea'      => null,
			'customind-background'    => null,
			'customind-slider'        => null,
			'customind-dimensions'    => null,
			'customind-typography'    => null,
			'customind-typography-preset'    => null,
			'customind-date'          => null,
			'customind-sortable'      => null,
			'customind-toggle-button' => null,
			'customind-visibility-button' => null,
			'customind-color-group'   => null,
			'customind-accordion'     => null,
			'customind-title'         => null,
			'customind-divider'       => null,
			'customind-gradient'      => null,
			'customind-color-palette' => null,
		];
		$sanitization_callbacks = self::instance()->apply_filters( 'sanitization:callbacks', $sanitization_callbacks );

		if ( isset( $sanitization_callbacks[ $control ] ) && is_callable( $sanitization_callbacks[ $control ] ) ) {
			return $sanitization_callbacks[ $control ];
		}

		return null;
	}
}
