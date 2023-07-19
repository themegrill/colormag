<?php
/**
 * ColorMag customizer class for theme customize sanitizes.
 *
 * Class ColorMag_Customizer_FrameWork_Sanitizes
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag customizer class for theme customize callbacks.
 *
 * Class ColorMag_Customizer_FrameWork_Sanitizes
 */
class ColorMag_Customizer_FrameWork_Sanitizes {

	/**
	 * Sanitize the checkbox options set within customizer controls.
	 *
	 * @param int $input Input from the customize controls.
	 *
	 * @return int|string
	 */
	public static function sanitize_checkbox( $input ) {

		return ( ( 1 === $input || '1' === $input || true === (bool) $input ) ? 1 : '' );

	}

	/**
	 * Sanitize the number options set within customizer controls.
	 *
	 * @param int $number Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return int
	 */
	public static function sanitize_integer( $number, $setting ) {

		return ( is_numeric( $number ) ? intval( $number ) : $setting->default );

	}

	/**
	 * Sanitize the strings enabling HTML tags set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_html( $input ) {

		return wp_kses_post( $input );

	}

	/**
	 * Sanitize the strings disabling the HTML tags set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_nohtml( $input ) {

		return wp_filter_nohtml_kses( $input );

	}

	/**
	 * Sanitize the key values set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_key( $input ) {

		return sanitize_key( $input );

	}

	/**
	 * Sanitize the text fields set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_text_field( $input ) {

		return sanitize_text_field( $input );

	}

	/**
	 * Sanitize the radio as well as select options set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string
	 */
	public static function sanitize_radio_select( $input, $setting ) {

		// Ensuring that the input is a slug.
		$input = sanitize_text_field( $input );

		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	/**
	 * Sanitize the input set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string
	 */
	public static function sanitize_date( $input ) {

		// General sanitization, to get rid of malicious scripts or characters.
		$input = sanitize_text_field( $input );
		$input = filter_var( $input, FILTER_SANITIZE_STRING );

		// Validate date to check if it is in desired date format.
		if ( self::validate_date_format( $input ) ) {
			return $input;
		} else {
			// If user tries to enter any other value return today's date.
			$input = gmdate( 'Y-m-d' );

			return $input;
		}
	}

	public static function validate_date_format( $input, $date_format = 'Y-m-d' ) {

		// Create a Date object with a given format.
		$d = DateTime::createFromFormat( $date_format, $input );

		// Check if given date matches the given format and return the comparison.
		return $d && $d->format( $date_format ) === $input;
	}

	/**
	 * Sanitize the hex color set within customizer controls.
	 *
	 * @param string $color Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_hex_color( $color ) {

		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

	}

	/**
	 * Sanitize the alpha color set within customizer controls.
	 *
	 * @param string $color Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_alpha_color( $color, $setting ) {

		if ( '' === $color ) {
			return '';
		}

		if ( 'header_textcolor' === $setting->id && 'blank' === $color ) {
			return 'blank';
		}

		// Hex sanitize if no rgba color option is chosen.
		if ( false === strpos( $color, 'rgb' ) ) {
			return self::sanitize_hex_color( $color );
		}

		// Sanitize the rgba color provided via customize option.
		$color = str_replace( ' ', '', $color );

		if ( strpos( $color, 'rgba' ) !== false ) {

			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

			if ( 'background_color' === $setting->id || 'header_textcolor' === $setting->id ) {
				return self::convert_rgba_to_hex( $red, $green, $blue, $alpha );
			}

			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';

		}

		sscanf( $color, 'rgb(%d,%d,%d)', $red, $green, $blue );

		if ( 'background_color' === $setting->id || 'header_textcolor' === $setting->id ) {
			return self::convert_rgba_to_hex( $red, $green, $blue );
		}

		return 'rgb(' . $red . ',' . $green . ',' . $blue . ')';

	}

	/**
	 * Converts RGB/A to a Hex value.
	 *
	 * @param int $red color value.
	 * @param int $green color value.
	 * @param int $blue color value.
	 * @param float $alpha color value.
	 *
	 * @return string Hex value.
	 */
	public static function convert_rgba_to_hex( $red, $green, $blue, $alpha = 1 ) {

		$red   = dechex( (int) $red );
		$green = dechex( (int) $green );
		$blue  = dechex( (int) $blue );
		$alpha = (float) $alpha;

		if ( strlen( $red ) < 2 ) {
			$red = '0' . $red;
		}

		if ( strlen( $green ) < 2 ) {
			$green = '0' . $green;
		}

		if ( strlen( $blue ) < 2 ) {
			$blue = '0' . $blue;
		}

		if ( $alpha < 1 ) {

			$alpha = $alpha * 255;

			if ( $alpha < 7 ) {
				$alpha = '0' . dechex( $alpha );
			} else {
				$alpha = dechex( $alpha );
			}

			return $red . $green . $blue . $alpha;
		}

		return $red . $green . $blue;
	}

	/**
	 * Sanitize false values within customizer controls, which user does not have to input by their own.
	 *
	 * @return bool
	 */
	public static function sanitize_false_values() {

		return false;

	}

	/**
	 * Sanitize the slider value set within customizer controls.
	 *
	 * @param number $val Customizer setting input number.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */
	public static function sanitize_number( $val, $setting ) {

		$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

		if ( isset( $input_attrs ) ) {

			$input_attrs[ 'min' ]  = isset( $input_attrs[ 'min' ] ) ? $input_attrs[ 'min' ] : 0;
			$input_attrs[ 'step' ] = isset( $input_attrs[ 'step' ] ) ? $input_attrs[ 'step' ] : 1;

			if ( isset( $input_attrs[ 'max' ] ) && $val > $input_attrs[ 'max' ] ) {
				$val = $input_attrs[ 'max' ];
			} elseif ( $val < $input_attrs[ 'min' ] ) {
				$val = $input_attrs[ 'min' ];
			}

			if ( $val ) {
				$val = (int) $val;
			}
		}

		return is_numeric( $val ) ? $val : $setting->default;

	}

	/**
	 * Sanitize the dimension value and unit within customizer controls.
	 *
	 * @param number $val Customizer setting input number and unit.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */

	public static function sanitize_dimension( $input, $setting ) {

		if ( isset( $input ) ) {

			$input_attrs = $setting->manager->get_control( $setting->id )->json()[ 'input_attrs' ];
			$unit        = isset( $input[ 'unit' ] ) ? $input[ 'unit' ] : 'px';

			$input[ 'top' ]    = isset( $input[ 'top' ] ) ? (float) $input[ 'top' ] : 0;
			$input[ 'bottom' ] = isset( $input[ 'bottom' ] ) ? (float) $input[ 'bottom' ] : 0;
			$input[ 'left' ]   = isset( $input[ 'left' ] ) ? (float) $input[ 'left' ] : 0;
			$input[ 'right' ]  = isset( $input[ 'right' ] ) ? (float) $input[ 'right' ] : 0;

			$min = isset( $input_attrs[ $unit ][ 'min' ] ) ? (float) $input_attrs[ $unit ][ 'min' ] : 0;
			$max = isset( $input_attrs[ $unit ][ 'max' ] ) ? (float) $input_attrs[ $unit ][ 'max' ] : 200;

			foreach ( $input as $key => $value ) {
				if ( $value < $min ) {
					$input[ $key ] = $min;
				} elseif ( $value > $max ) {
					$input[ $key ] = $max;
				}
			}
		}

		return $input;
	}

	/**
	 * Sanitize the slider value and unit within customizer controls.
	 *
	 * @param number $val Customizer setting input number and unit.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */

	public static function sanitize_slider( $input, WP_Customize_Setting $setting ) {

		if ( isset( $input[ 'size' ] ) ) {

			$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			$size = isset( $input[ 'size' ] ) ? (float) $input[ 'size' ] : 0;
			$unit = isset( $input[ 'unit' ] ) ? $input[ 'unit' ] : 'px';

			$min = isset( $input_attrs[ $unit ][ 'min' ] ) ? (float) $input_attrs[ $unit ][ 'min' ] : 0;
			$max = isset( $input_attrs[ $unit ][ 'max' ] ) ? (float) $input_attrs[ $unit ][ 'max' ] : 200;

			if ( $size < $min ) {
				$size = $min;
			} elseif ( $size > $max ) {
				$size = $max;
			}

			$input = array(
				'size' => $size,
				'unit' => $unit,
			);
		}

		return $input;
	}

	/**
	 * Sanitize the email value set within customizer controls.
	 *
	 * @param string $email Input from the customize controls.
	 * @param object $setting Setting object.
	 *
	 * @return string
	 */
	public static function sanitize_email( $email, $setting ) {

		// Strips out all characters that are not allowable in an email address.
		$email = sanitize_email( $email );

		// If $email is a valid email, return it, otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );

	}

	/**
	 * Sanitize the url value set within customizer controls.
	 *
	 * @param string $url Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_url( $url ) {

		return esc_url_raw( $url );

	}

	/**
	 * Sanitize the dropdown categories value set within customizer controls.
	 *
	 * @param number $cat_id Customizer setting input category id.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */
	public static function sanitize_dropdown_categories( $cat_id, $setting ) {

		// Ensure input is an absolute integer.
		$cat_id = absint( $cat_id );

		// If $cat_id is an ID of a published category, return it, otherwise, return the default value.
		return ( term_exists( $cat_id, 'category' ) ? $cat_id : $setting->default );

	}

	/**
	 * Sanitize the dropdown pages value set within customizer controls.
	 *
	 * @param number $page_id Customizer setting input page id.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */
	public static function sanitize_dropdown_pages( $page_id, $setting ) {

		// Ensure input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it, otherwise, return the default value.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );

	}

	/**
	 * Sanitize the image value set within customizer controls.
	 *
	 * @param number $image Customizer setting input image filename.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */
	public static function sanitize_image_upload( $image, $setting ) {

		/**
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tiff|tif'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);

		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it, otherwise, return the empty value.
		return ( $file[ 'ext' ] ? $image : '' );

	}

	/**
	 * Sanitize the background value set within customizer controls.
	 *
	 * @param number $background_args Customizer setting input background arguments.
	 * @param object $setting Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_background( $background_args, $setting ) {

		if ( ! is_array( $background_args ) ) {
			return array();
		}

		$output = array();

		// Sanitizing the alpha color option.
		if ( isset( $background_args[ 'background-color' ] ) ) {
			$output[ 'background-color' ] = self::sanitize_alpha_color( $background_args[ 'background-color' ], $setting );
		}

		// Sanitizing the background image option.
		if ( isset( $background_args[ 'background-image' ] ) ) {
			$output[ 'background-image' ] = self::sanitize_image_upload( $background_args[ 'background-image' ], $setting );
		}

		// Sanitizing the background repeat option.
		if ( isset( $background_args[ 'background-repeat' ] ) ) {
			$output[ 'background-repeat' ] = self::sanitize_text_field( $background_args[ 'background-repeat' ] );
		}

		// Sanitizing the background position option.
		if ( isset( $background_args[ 'background-position' ] ) ) {
			$output[ 'background-position' ] = self::sanitize_text_field( $background_args[ 'background-position' ] );
		}

		// Sanitizing the background size option.
		if ( isset( $background_args[ 'background-size' ] ) ) {
			$output[ 'background-size' ] = self::sanitize_text_field( $background_args[ 'background-size' ] );
		}

		// Sanitizing the background attachment option.
		if ( isset( $background_args[ 'background-attachment' ] ) ) {
			$output[ 'background-attachment' ] = self::sanitize_text_field( $background_args[ 'background-attachment' ] );
		}

		return $output;

	}

	/**
	 * Sanitize the typography value set within customizer controls.
	 *
	 * @param number $typography_args Customizer setting input typography arguments.
	 * @param object $setting Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_typography( $typography_args, $setting ) {

		if ( ! is_array( $typography_args ) ) {
			return array();
		}

		$output = array();

		// Sanitizing the font family option.
		if ( isset( $typography_args[ 'font-family' ] ) ) {

			$standard_fonts = ColorMag_Fonts::get_system_fonts();
			$google_fonts   = ColorMag_Fonts::get_google_fonts();
			$custom_fonts   = ColorMag_Fonts::get_custom_fonts();
			$valid_keys     = array_merge( $standard_fonts, $google_fonts );

			// If custom fonts is available, merge it to `$valid_keys` array to make those fonts ready for sanitization.
			if ( ! empty( $custom_fonts ) ) {
				$valid_keys = array_merge( $custom_fonts, $valid_keys );
			}

			if ( array_key_exists( $typography_args[ 'font-family' ], $valid_keys ) ) {
				$output[ 'font-family' ] = self::sanitize_text_field( $typography_args[ 'font-family' ] );
			}
		}

		// Sanitizing the font weight option.
		if ( isset( $typography_args[ 'font-weight' ] ) ) {

			$font_variants = ColorMag_Fonts::get_font_variants();

			if ( array_key_exists( $typography_args[ 'font-weight' ], $font_variants ) ) {
				$output[ 'font-weight' ] = self::sanitize_key( $typography_args[ 'font-weight' ] );
			}
		}

		// Sanitizing the subsets option.
		if ( isset( $typography_args[ 'subsets' ] ) ) {

			$subsets        = ColorMag_Fonts::get_google_font_subsets();
			$subsets_values = array();

			if ( is_array( $typography_args[ 'subsets' ] ) ) {

				foreach ( $typography_args[ 'subsets' ] as $key => $value ) {

					if ( array_key_exists( $value, $subsets ) ) {
						$subsets_values[] = self::sanitize_key( $value );
					}
				}

				$output[ 'subsets' ] = $subsets_values;
			}
		}

		// Sanitizing the font style option.
		if ( isset( $typography_args[ 'font-style' ] ) ) {
			$output[ 'font-style' ] = self::sanitize_key( $typography_args[ 'font-style' ] );
		}

		// Sanitizing the text transform option.
		if ( isset( $typography_args[ 'text-transform' ] ) ) {
			$output[ 'text-transform' ] = self::sanitize_key( $typography_args[ 'text-transform' ] );
		}

		// Sanitizing the text decoration option.
		if ( isset( $typography_args[ 'text-decoration' ] ) ) {
			$output[ 'text-decoration' ] = self::sanitize_key( $typography_args[ 'text-decoration' ] );
		}

		$input_attrs = colormag_get_typography_input_attrs( $typography_args );

		// Sanitizing the font size option.
		if ( isset( $typography_args[ 'font-size' ] ) && is_array( $typography_args[ 'font-size' ] ) ) {

			$font_size_values      = array();
			$font_size_input_attrs = $input_attrs[ 'input_attrs' ][ 'attributes_config' ][ 'font-size' ];

			foreach ( $typography_args[ 'font-size' ] as $key => $val ) {
				if ( empty( $val ) || ! in_array( $key, array( 'desktop', 'tablet', 'mobile' ), true ) ) {
					continue;
				}
				$size = isset( $val[ 'size' ] ) ? (float) $val[ 'size' ] : 0;
				$unit = isset( $val[ 'unit' ] ) ? $val[ 'unit' ] : 'px';
				$min  = isset( $font_size_input_attrs[ $unit ][ 'min' ] ) ? (float) $font_size_input_attrs[ $unit ][ 'min' ] : 0;
				$max  = isset( $font_size_input_attrs[ $unit ][ 'max' ] ) ? (float) $font_size_input_attrs[ $unit ][ 'max' ] : 200;

				if ( ! empty( $size ) ) {

					if ( $size < $min ) {
						$size = $min;
					} elseif ( $size > $max ) {
						$size = $max;
					}
				}

				$font_size_values[ $key ] = array(
					'size' => $size,
					'unit' => $unit,
				);
			}

			$output[ 'font-size' ] = $font_size_values;

		}

		// Sanitizing the line height option.
		if ( isset( $typography_args[ 'line-height' ] ) && is_array( $typography_args[ 'line-height' ] ) ) {

			$line_height_values = array();

			$line_height_input_attrs = $input_attrs[ 'input_attrs' ][ 'attributes_config' ][ 'line-height' ];

			foreach ( $typography_args[ 'line-height' ] as $key => $val ) {
				if ( empty( $val ) || ! in_array( $key, array( 'desktop', 'tablet', 'mobile' ), true ) ) {
					continue;
				}
				$size = isset( $val[ 'size' ] ) ? (float) $val[ 'size' ] : 0;
				$unit = isset( $val[ 'unit' ] ) ? $val[ 'unit' ] : '-';
				$min  = isset( $line_height_input_attrs[ $unit ][ 'min' ] ) ? (float) $line_height_input_attrs[ $unit ][ 'min' ] : 0;
				$max  = isset( $line_height_input_attrs[ $unit ][ 'max' ] ) ? (float) $line_height_input_attrs[ $unit ][ 'max' ] : 10;

				if ( $size < $min ) {
					$size = $min;
				} elseif ( $size > $max ) {
					$size = $max;
				}

				$line_height_values[ $key ] = array(
					'size' => $size,
					'unit' => $unit,
				);
			}

			$output[ 'line-height' ] = $line_height_values;

		}

		// Sanitizing the letter spacing option.
		if ( isset( $typography_args[ 'letter-spacing' ] ) && is_array( $typography_args[ 'letter-spacing' ] ) ) {

			$letter_spacing_values = array();

			$letter_spacing_input_attrs = $input_attrs[ 'input_attrs' ][ 'attributes_config' ][ 'letter-spacing' ];

			foreach ( $typography_args[ 'letter-spacing' ] as $key => $val ) {
				if ( empty( $val ) || ! in_array( $key, array( 'desktop', 'tablet', 'mobile' ), true ) ) {
					continue;
				}
				$size = isset( $val[ 'size' ] ) ? (float) $val[ 'size' ] : 0;
				$unit = isset( $val[ 'unit' ] ) ? $val[ 'unit' ] : 'px';
				$min  = isset( $letter_spacing_input_attrs[ $unit ][ 'min' ] ) ? (float) $letter_spacing_input_attrs[ $unit ][ 'min' ] : 0;
				$max  = isset( $letter_spacing_input_attrs[ $unit ][ 'max' ] ) ? (float) $letter_spacing_input_attrs[ $unit ][ 'max' ] : 100;

				if ( $size < $min ) {
					$size = $min;
				} elseif ( $size > $max ) {
					$size = $max;
				}

				$letter_spacing_values[ $key ] = array(
					'size' => $size,
					'unit' => $unit,
				);
			}

			$output[ 'letter-spacing' ] = $letter_spacing_values;
		}

		return $output;

	}

	/**
	 * Sanitize the gradient control's values.
	 *
	 * @param number $gradient_args Customizer setting input gradient arguments.
	 * @param object $setting Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_gradient( $gradient_args, $setting ) {

		if ( ! is_array( $gradient_args ) ) {
			return array();
		}

		return $gradient_args;
	}

	/**
	 * Sanitize the sortable value set within customizer controls.
	 *
	 * @param number $input Customizer setting input sortable arguments.
	 * @param object $setting Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_sortable( $input, $setting ) {

		// Get list of choices from the control associated with the setting.
		$choices    = $setting->manager->get_control( $setting->id )->choices;
		$input_keys = $input;

		foreach ( (array) $input_keys as $key => $value ) {
			if ( ! array_key_exists( $value, $choices ) ) {
				unset( $input[ $key ] );
			}
		}

		// If the input is a valid key, return it, otherwise, return the default.
		return ( is_array( $input ) ? $input : $setting->default );

	}

}
