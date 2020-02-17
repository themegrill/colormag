<?php
/**
 * Class to include Category Color customize options.
 *
 * Class ColorMag_Customize_Category_Color_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include Category Color customize option.
 *
 * Class ColorMag_Customize_Category_Color_Options
 */
class ColorMag_Customize_Category_Color_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Category color options.
		$args       = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$categories = get_categories( $args );
		foreach ( $categories as $category_list ) {
			$configs[] = array(
				'name'    => 'colormag_category_color_' . get_cat_id( $category_list->cat_name ),
				'default' => '',
				'type'    => 'control',
				'control' => 'colormag-color',
				'label'   => $category_list->cat_name,
				'section' => 'colormag_category_color_setting',
			);
		}

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Category_Color_Options();
