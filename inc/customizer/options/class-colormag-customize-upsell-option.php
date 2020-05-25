<?php
/**
 * Archive/ blog layout.
 *
 * @package     colormag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== POST/PAGE/BLOG > ARCHIVE/ BLOG ==========================================*/
if ( ! class_exists( 'ColorMag_Customize_Upsell_Option' ) ) :

	/**
	 * Archive/Blog option.
	 */
	class ColorMag_Customize_Upsell_Option extends ColorMag_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				'colormag_upsell'        => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'upsell',
						'priority' => 10,
						'section'  => 'colormag_customize_upsell_section',
					),
				)


			);

		}

	}

	new ColorMag_Customize_Upsell_Option();

endif;
