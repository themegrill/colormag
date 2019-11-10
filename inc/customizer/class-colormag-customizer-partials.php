<?php
/**
 * ColorMag customizer class for theme customize partials.
 *
 * Class ColorMag_Customizer_Partials
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer class for theme customize partials.
 *
 * Class ColorMag_Customizer_Partials
 */
class ColorMag_Customizer_Partials {

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

}
