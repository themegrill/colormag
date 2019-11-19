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

		$wp_customize->add_section( 'colormag_category_color_setting', array(
			'priority' => 1,
			'title'    => __( 'Category Color Settings', 'colormag' ),
			'panel'    => 'colormag_category_color_panel',
		) );

		$i                = 1;
		$args             = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$categories       = get_categories( $args );
		$wp_category_list = array();
		foreach ( $categories as $category_list ) {
			$wp_category_list[ $category_list->cat_ID ] = $category_list->cat_name;

			$wp_customize->add_setting( 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array(
					'ColorMag_Customizer_Sanitizes',
					'sanitize_hex_color',
				),
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
				'label'    => sprintf( __( '%s', 'colormag' ), $wp_category_list[ $category_list->cat_ID ] ),
				'section'  => 'colormag_category_color_setting',
				'settings' => 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
				'priority' => $i,
			) ) );

			$i ++;
		}

	}

}

return new ColorMag_Customize_Category_Color_Options();
