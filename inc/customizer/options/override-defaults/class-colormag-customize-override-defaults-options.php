<?php
/**
 * Class to include Override Defaults customize options.
 *
 * Class ColorMag_Customize_Override_Defaults_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

/**
 * Class to include Override Defaults customize option.
 *
 * Class ColorMag_Customize_Override_Defaults_Options
 */
class ColorMag_Customize_Override_Defaults_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array();

		$options = array_merge( $options, $configs );

		return $options;

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '#site-title a',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_customize_partial_blogname',
					),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '#site-description',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_customize_partial_blogdescription',
					),
				)
			);
		}

	}

}

return new ColorMag_Customize_Override_Defaults_Options();
