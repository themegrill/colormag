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

		return ( ( $input == 1 ) ? 1 : '' );

	}

	/**
	 * Sanitize the number options set within customizer controls.
	 *
	 * @param int                  $number  Input from the customize controls.
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
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string
	 */
	public static function sanitize_radio_select( $input, $setting ) {

		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );

		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

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
	public static function sanitize_alpha_color( $color ) {

		if ( '' === $color ) {
			return '';
		}

		// Hex sanitize if no rgba color option is chosen.
		if ( false === strpos( $color, 'rgba' ) ) {
			return self::sanitize_hex_color( $color );
		}

		// Sanitize the rgba color provided via customize option.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';

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
	 * @param number $val     Customizer setting input number.
	 * @param object $setting Setting object.
	 *
	 * @return int
	 */
	public static function sanitize_number( $val, $setting ) {

		$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

		if ( isset( $input_attrs ) ) {

			$input_attrs['min']  = isset( $input_attrs['min'] ) ? $input_attrs['min'] : 0;
			$input_attrs['step'] = isset( $input_attrs['step'] ) ? $input_attrs['step'] : 1;

			if ( isset( $input_attrs['max'] ) && $val > $input_attrs['max'] ) {
				$val = $input_attrs['max'];
			} elseif ( $val < $input_attrs['min'] ) {
				$val = $input_attrs['min'];
			}

			if ( $val ) {
				$val = (int) $val;
			}
		}

		return is_numeric( $val ) ? $val : $setting->default;

	}

	/**
	 * Sanitize the email value set within customizer controls.
	 *
	 * @param string $email   Input from the customize controls.
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
	 * @param number $cat_id  Customizer setting input category id.
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
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );

	}

	/**
	 * Sanitize the image value set within customizer controls.
	 *
	 * @param number $image   Customizer setting input image filename.
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
		return ( $file['ext'] ? $image : '' );

	}

	/**
	 * Sanitize the background value set within customizer controls.
	 *
	 * @param number $background_args Customizer setting input background arguments.
	 * @param object $setting         Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_background( $background_args, $setting ) {

		if ( ! is_array( $background_args ) ) {
			return array();
		}

		$output = array();

		// Sanitizing the alpha color option.
		if ( isset( $background_args['background-color'] ) ) {
			$output['background-color'] = self::sanitize_alpha_color( $background_args['background-color'] );
		}

		// Sanitizing the background image option.
		if ( isset( $background_args['background-image'] ) ) {
			$output['background-image'] = self::sanitize_image_upload( $background_args['background-image'], $setting );
		}

		// Sanitizing the background repeat option.
		if ( isset( $background_args['background-repeat'] ) ) {
			$output['background-repeat'] = self::sanitize_text_field( $background_args['background-repeat'] );
		}

		// Sanitizing the background position option.
		if ( isset( $background_args['background-position'] ) ) {
			$output['background-position'] = self::sanitize_text_field( $background_args['background-position'] );
		}

		// Sanitizing the background size option.
		if ( isset( $background_args['background-size'] ) ) {
			$output['background-size'] = self::sanitize_text_field( $background_args['background-size'] );
		}

		// Sanitizing the background attachment option.
		if ( isset( $background_args['background-attachment'] ) ) {
			$output['background-attachment'] = self::sanitize_text_field( $background_args['background-attachment'] );
		}

		return $output;

	}

	/**
	 * Sanitize the typography value set within customizer controls.
	 *
	 * @param number $typography_args Customizer setting input typography arguments.
	 * @param object $setting         Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_typography( $typography_args, $setting ) {

		if ( ! is_array( $typography_args ) ) {
			return array();
		}

		$output = array();

		// Sanitizing the font family option.
		if ( isset( $typography_args['font-family'] ) ) {

			$standard_fonts = ColorMag_Fonts::get_system_fonts();
			$google_fonts   = ColorMag_Fonts::get_google_fonts();
			$custom_fonts   = ColorMag_Fonts::get_custom_fonts();
			$valid_keys     = array_merge( $standard_fonts, $google_fonts );

			// If custom fonts is available, merge it to `$valid_keys` array to make those fonts ready for sanitization.
			if ( ! empty( $custom_fonts ) ) {
				$valid_keys = array_merge( $custom_fonts, $valid_keys );
			}

			if ( array_key_exists( $typography_args['font-family'], $valid_keys ) ) {
				$output['font-family'] = self::sanitize_text_field( $typography_args['font-family'] );
			}
		}

		// Sanitizing the font weight option.
		if ( isset( $typography_args['font-weight'] ) ) {

			$font_variants = ColorMag_Fonts::get_font_variants();

			if ( array_key_exists( $typography_args['font-weight'], $font_variants ) ) {
				$output['font-weight'] = self::sanitize_key( $typography_args['font-weight'] );
			}
		}

		// Sanitizing the subsets option.
		if ( isset( $typography_args['subsets'] ) ) {

			$subsets        = ColorMag_Fonts::get_google_font_subsets();
			$subsets_values = array();

			if ( is_array( $typography_args['subsets'] ) ) {

				foreach ( $typography_args['subsets'] as $key => $value ) {

					if ( array_key_exists( $value, $subsets ) ) {
						$subsets_values[] = self::sanitize_key( $value );
					}
				}

				$output['subsets'] = $subsets_values;
			}
		}

		// Sanitizing the font style option.
		if ( isset( $typography_args['font-style'] ) ) {
			$output['font-style'] = self::sanitize_key( $typography_args['font-style'] );
		}

		// Sanitizing the text transform option.
		if ( isset( $typography_args['text-transform'] ) ) {
			$output['text-transform'] = self::sanitize_key( $typography_args['text-transform'] );
		}

		// Sanitizing the text decoration option.
		if ( isset( $typography_args['text-decoration'] ) ) {
			$output['text-decoration'] = self::sanitize_key( $typography_args['text-decoration'] );
		}

		// Sanitizing the font size option.
		if ( isset( $typography_args['font-size'] ) && is_array( $typography_args['font-size'] ) ) {

			$font_size_values = array();

			$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			foreach ( $typography_args['font-size'] as $key => $value ) {

				if ( isset( $key ) && ! empty( $value ) ) {

					if ( isset( $input_attrs ) && ! empty( $input_attrs ) ) {

						foreach ( $input_attrs as $input_key => $input_value ) {

							$input_value['font-size']['min']  = isset( $input_value['font-size']['min'] ) ? $input_value['font-size']['min'] : 0;
							$input_value['font-size']['step'] = isset( $input_value['font-size']['step'] ) ? $input_value['font-size']['step'] : 1;

							if ( isset( $input_value['font-size']['max'] ) && $value > $input_value['font-size']['max'] ) {
								$font_size_values[ $key ] = self::sanitize_text_field( $input_value['font-size']['max'] );
							} elseif ( $value < $input_value['font-size']['min'] ) {
								$font_size_values[ $key ] = self::sanitize_text_field( $input_value['font-size']['min'] );
							} else {
								$font_size_values[ $key ] = self::sanitize_text_field( $value );
							}
						}
					} else {
						$font_size_values[ $key ] = self::sanitize_text_field( $value );
					}
				}

				$output['font-size'] = $font_size_values;

			}
		}

		// Sanitizing the line height option.
		if ( isset( $typography_args['line-height'] ) && is_array( $typography_args['line-height'] ) ) {

			$line_height_values = array();

			$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			foreach ( $typography_args['line-height'] as $key => $value ) {

				if ( isset( $key ) && ! empty( $value ) ) {

					if ( isset( $input_attrs ) && ! empty( $input_attrs ) ) {

						foreach ( $input_attrs as $input_key => $input_value ) {

							$input_value['line-height']['min']  = isset( $input_value['line-height']['min'] ) ? $input_value['line-height']['min'] : 0;
							$input_value['line-height']['step'] = isset( $input_value['line-height']['step'] ) ? $input_value['line-height']['step'] : 1;

							if ( isset( $input_value['line-height']['max'] ) && $value > $input_value['line-height']['max'] ) {
								$line_height_values[ $key ] = self::sanitize_text_field( $input_value['line-height']['max'] );
							} elseif ( $value < $input_value['line-height']['min'] ) {
								$line_height_values[ $key ] = self::sanitize_text_field( $input_value['line-height']['min'] );
							} else {
								$line_height_values[ $key ] = self::sanitize_text_field( $value );
							}
						}
					} else {
						$line_height_values[ $key ] = self::sanitize_text_field( $value );
					}
				}

				$output['line-height'] = $line_height_values;

			}
		}

		// Sanitizing the letter spacing option.
		if ( isset( $typography_args['letter-spacing'] ) && is_array( $typography_args['letter-spacing'] ) ) {

			$letter_spacing_values = array();

			$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			foreach ( $typography_args['letter-spacing'] as $key => $value ) {

				if ( isset( $key ) && ! empty( $value ) ) {

					if ( isset( $input_attrs ) && ! empty( $input_attrs ) ) {

						foreach ( $input_attrs as $input_key => $input_value ) {

							$input_value['letter-spacing']['min']  = isset( $input_value['letter-spacing']['min'] ) ? $input_value['letter-spacing']['min'] : 0;
							$input_value['letter-spacing']['step'] = isset( $input_value['letter-spacing']['step'] ) ? $input_value['letter-spacing']['step'] : 1;

							if ( isset( $input_value['letter-spacing']['max'] ) && $value > $input_value['letter-spacing']['max'] ) {
								$letter_spacing_values[ $key ] = self::sanitize_text_field( $input_value['letter-spacing']['max'] );
							} elseif ( $value < $input_value['letter-spacing']['min'] ) {
								$letter_spacing_values[ $key ] = self::sanitize_text_field( $input_value['letter-spacing']['min'] );
							} else {
								$letter_spacing_values[ $key ] = self::sanitize_text_field( $value );
							}
						}
					} else {
						$letter_spacing_values[ $key ] = sanitize_text_field( $value );
					}
				}

				$output['letter-spacing'] = $letter_spacing_values;

			}
		}

		return $output;

	}

	/**
	 * Sanitize the sortable value set within customizer controls.
	 *
	 * @param number $input   Customizer setting input sortable arguments.
	 * @param object $setting Setting object.
	 *
	 * @return mixed
	 */
	public static function sanitize_sortable( $input, $setting ) {

		// Get list of choices from the control associated with the setting.
		$choices    = $setting->manager->get_control( $setting->id )->choices;
		$input_keys = $input;

		foreach ( $input_keys as $key => $value ) {
			if ( ! array_key_exists( $value, $choices ) ) {
				unset( $input[ $key ] );
			}
		}

		// If the input is a valid key, return it, otherwise, return the default.
		return ( is_array( $input ) ? $input : $setting->default );

	}

}
