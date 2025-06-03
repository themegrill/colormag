<?php
/**
 * Filter array values.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER TOP BAR ==========================================*/
if ( ! class_exists( 'ColorMag_Dynamic_Filter' ) ) :

	/**
	 * Filter array values.
	 */
	class ColorMag_Dynamic_Filter {

		/**
		 * Array of filter name and css classes.
		 *
		 * @since    TBD
		 * @access   private
		 * @var      array $css_class_arr Filter tag and class list.
		 */
		private static $css_class_arr = array();

		/**
		 * Get filter tag and class list in Array.
		 *
		 * @since    1.1.7
		 * @access   public
		 *
		 * @return array Filter tag and class list.
		 */
		public static function css_class_list() {

			self::$css_class_arr = array(
				'colormag_header_class' => array(
					'cm-header',
				),
			);

			return apply_filters( 'colormag_css_class_list', self::$css_class_arr );
		}

		/**
		 * Filter the array according to key.
		 *
		 * @since    1.1.7
		 * @access   public
		 *
		 * @param string $tag Filter tag.
		 *
		 * @return array Filter tag and class list.
		 */
		public static function filter_via_tag( $tag ) {

			$css_class = self::css_class_list();

			$filtered = array();

			if ( isset( $css_class[ $tag ] ) ) {
				$filtered = $css_class[ $tag ];
			}

			return $filtered;
		}
	}

endif;
