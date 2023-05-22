<?php
/**
 * Class to include Category Colors customize options.
 *
 * Class ColorMag_Customize_Category_Colors_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Category Colors customize options.
 *
 * Class ColorMag_Customize_Category_Colors_Options
 */
class ColorMag_Customize_Category_Colors_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$options = array_merge( $options );

		// Category color options.
		$args           = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$categories     = get_categories( $args );
		$priority_count = 110;

		foreach ( $categories as $category_list ) {

			$configs[] = array(
				'name'     => 'colormag_category_color_' . get_cat_id( $category_list->cat_name ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => $category_list->cat_name,
				'section'  => 'colormag_category_colors_section',
				'priority' => $priority_count,
			);

			$priority_count++;

		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Category_Colors_Options();
