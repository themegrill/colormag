<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'themegrill_demo_importer_config', 'tg_demo_importer_config' );

/**
 * Setup demo importer config.
 *
 * @param  array $demo_config
 *
 * @return array
 */
function tg_demo_importer_config( $demo_config ) {
	$new_demo_config = array(
		'colormag-pro'             => array(
			'name'                   => __( 'ColorMag Pro', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname' => 'ColorMag Pro',
			),
			'widgets_data_update'    => array(

				/**
				 * Dropdown Categories - Handles widgets Category ID.
				 *
				 * A. Core Post Category:
				 *   1. colormag_featured_posts_slider_widget
				 *   2. colormag_highlighted_posts_widget
				 *   3. colormag_featured_posts_widget
				 *   4. colormag_featured_posts_vertical_widget
				 *   5. colormag_default_news_widget
				 *   6. colormag_ticker_news_widget
				 *   7. colormag_slider_news_widget
				 *   8. colormag_featured_posts_small_thumbnails
				 *   9. colormag_news_in_picture_widget
				 *
				 */
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_slider_widget'    => array(
							2 => array(
								'category' => 'Research',
							),
						),
						'colormag_highlighted_posts_widget'        => array(
							2 => array(
								'category' => 'Technology',
							),
						),
						'colormag_featured_posts_widget'           => array(
							2 => array(
								'category' => 'Business',
							),
						),
						'colormag_featured_posts_vertical_widget'  => array(
							2  => array(
								'category' => 'Health',
							),
							3  => array(
								'category' => 'Fashion',
							),
							4  => array(
								'category' => 'Politics',
							),
							9  => array(
								'category' => 'Technology',
							),
							10 => array(
								'category' => 'Travel',
							),
						),
						'colormag_default_news_widget'             => array(
							2 => array(
								'category' => 'Adventure',
							),
						),
						'colormag_ticker_news_widget'              => array(
							2 => array(
								'category' => 'Travel',
							),
						),
						'colormag_slider_news_widget'              => array(
							7 => array(
								'category' => 'Sports',
							),
						),
						'colormag_featured_posts_small_thumbnails' => array(
							2 => array(
								'category' => 'Technology',
							),
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'Primary',
					'footer'  => 'Footer',
				),
			),
		),
		'colormag-pro-fashion'     => array(
			'name'                   => __( 'ColorMag Pro Fashion', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro-fashion/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname' => 'ColorMag Pro Fashion',
			),
			'widgets_data_update'    => array(

				/**
				 * Dropdown Categories - Handles widgets Category ID.
				 *
				 * A. Core Post Category:
				 *   1. colormag_featured_posts_slider_widget
				 *   2. colormag_highlighted_posts_widget
				 *   3. colormag_featured_posts_widget
				 *   4. colormag_featured_posts_vertical_widget
				 *   5. colormag_default_news_widget
				 *   6. colormag_ticker_news_widget
				 *   7. colormag_slider_news_widget
				 *   8. colormag_featured_posts_small_thumbnails
				 *   9. colormag_news_in_picture_widget
				 *
				 */
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_slider_widget'    => array(
							2 => array(
								'category' => 'Trends',
							),
						),
						'colormag_highlighted_posts_widget'        => array(
							3 => array(
								'category' => 'Mens Fashion',
							),
						),
						'colormag_featured_posts_widget'           => array(
							2 => array(
								'category' => 'Accessories',
							),
						),
						'colormag_featured_posts_vertical_widget'  => array(
							2 => array(
								'category' => 'Makeup',
							),
							3 => array(
								'category' => 'Mens Fashion',
							),
							4 => array(
								'category' => 'Womans Fashion',
							),
							9 => array(
								'category' => 'Wedding',
							),
						),
						'colormag_default_news_widget'             => array(
							2 => array(
								'category' => 'Outfit',
							),
						),
						'colormag_ticker_news_widget'              => array(
							3 => array(
								'category' => 'Makeup',
							),
							4 => array(
								'category' => 'Mens Fashion',
							),
						),
						'colormag_slider_news_widget'              => array(
							7 => array(
								'category' => 'Glamorous',
							),
						),
						'colormag_featured_posts_small_thumbnails' => array(
							2 => array(
								'category' => 'Outfit',
							),
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'Primary',
					'footer'  => 'Footer',
				),
			),
		),
		'colormag-pro-technology'  => array(
			'name'                   => __( 'ColorMag Pro Technology', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro-technology/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname' => 'ColorMag Pro Technology',
			),
			'widgets_data_update'    => array(

				/**
				 * Dropdown Categories - Handles widgets Category ID.
				 *
				 * A. Core Post Category:
				 *   1. colormag_featured_posts_slider_widget
				 *   2. colormag_highlighted_posts_widget
				 *   3. colormag_featured_posts_widget
				 *   4. colormag_featured_posts_vertical_widget
				 *   5. colormag_default_news_widget
				 *   6. colormag_ticker_news_widget
				 *   7. colormag_slider_news_widget
				 *   8. colormag_featured_posts_small_thumbnails
				 *   9. colormag_news_in_picture_widget
				 *
				 */
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_slider_widget'    => array(
							2 => array(
								'category' => 'Featured',
							),
						),
						'colormag_highlighted_posts_widget'        => array(
							2 => array(
								'category' => 'Highlighted',
							),
						),
						'colormag_featured_posts_widget'           => array(
							2 => array(
								'category' => 'Accessories',
							),
							4 => array(
								'category' => 'Camera',
							),
						),
						'colormag_featured_posts_vertical_widget'  => array(
							2 => array(
								'category' => 'Android',
							),
							3 => array(
								'category' => 'Apple',
							),
							4 => array(
								'category' => 'Tablet',
							),
							5 => array(
								'category' => 'Mobile',
							),
							8 => array(
								'category' => 'Game',
							),
						),
						'colormag_default_news_widget'             => array(
							2 => array(
								'category' => 'Laptop',
							),
						),
						'colormag_ticker_news_widget'              => array(
							2 => array(
								'category' => 'Television',
							),
						),
						'colormag_slider_news_widget'              => array(
							7 => array(
								'category' => 'Glamorous',
							),
						),
						'colormag_featured_posts_small_thumbnails' => array(
							2 => array(
								'category' => 'Accessories',
							),
							3 => array(
								'category' => 'Tablet',
							),
						),
						'colormag_news_in_picture_widget'          => array(
							2 => array(
								'category' => 'Top Product',
							),
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'Primary Menu',
					'footer'  => 'Footer Menu',
				),
			),
		),
		'colormag-pro-sports'      => array(
			'name'                   => __( 'ColorMag Pro Sports', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro-sports/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname' => 'ColorMag Pro Sports',
			),
			'widgets_data_update'    => array(

				/**
				 * Dropdown Categories - Handles widgets Category ID.
				 *
				 * A. Core Post Category:
				 *   1. colormag_featured_posts_slider_widget
				 *   2. colormag_highlighted_posts_widget
				 *   3. colormag_featured_posts_widget
				 *   4. colormag_featured_posts_vertical_widget
				 *   5. colormag_default_news_widget
				 *   6. colormag_ticker_news_widget
				 *   7. colormag_slider_news_widget
				 *   8. colormag_featured_posts_small_thumbnails
				 *   9. colormag_news_in_picture_widget
				 *
				 */
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_slider_widget'    => array(
							2 => array(
								'category' => 'Featured',
							),
						),
						'colormag_highlighted_posts_widget'        => array(
							2 => array(
								'category' => 'Highlighted',
							),
						),
						'colormag_featured_posts_widget'           => array(
							2 => array(
								'category' => 'Athlete',
							),
						),
						'colormag_featured_posts_vertical_widget'  => array(
							2 => array(
								'category' => 'Women',
							),
							5 => array(
								'category' => 'Snow Olympics',
							),
							6 => array(
								'category' => 'Race',
							),
							7 => array(
								'category' => 'Figure Skating',
							),
						),
						'colormag_default_news_widget'             => array(
							2 => array(
								'category' => 'Football',
							),
						),
						'colormag_slider_news_widget'              => array(
							7 => array(
								'category' => 'Athlete',
							),
						),
						'colormag_featured_posts_small_thumbnails' => array(
							2 => array(
								'category' => 'Featured',
							),
						),
						'colormag_news_in_picture_widget'          => array(
							2 => array(
								'category' => 'Top Product',
							),
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'Primary Menu',
				),
			),
		),
		'colormag-pro-recipes'     => array(
			'name'                   => __( 'ColorMag Food Recipe', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro-recipes/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname'      => 'ColorMag Food Recipe',
				'page_on_front' => 'Homepage',
			),
			'elementor_data_update' => array(
				'breakfast' => array(
					'post_title'  => 'Breakfast',
					'data_update' => array(
						'category' => array(
							'ColorMag-Posts-Block-5' => array(
								13 => 'Cake',
							),
							'ColorMag-Posts-Block-9' => array(
								14 => 'News',
							),
						),
					)
				),
				'quick-recipe' => array(
					'post_title'  => 'Quick Recipes',
					'data_update' => array(
						'category' => array(
							'ColorMag-Posts-Block-5' => array(
								7 => 'Quick recipes',
								8 => 'Baking',
							),
							'ColorMag-Posts-Block-6' => array(
								3  => 'Cake',
								12 => 'Cake',
							),
						)
					)
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'primary',
				),
			),
			'plugins_list'           => array(
				'required' => array(
					'elementor' => array(
						'name' => __( 'Elementor', 'envince' ),
						'slug' => 'elementor/elementor.php',
					),
				),
			),
		),
		'colormag-pro-health-blog' => array(
			'name'                   => __( 'ColorMag Health Blog', 'colormag' ),
			'demo_url'               => 'https://demo.themegrill.com/colormag-pro-health-blog/',
			'demo_pack'              => false,
			'theme'                  => 'ColorMag Pro',
			'template'               => 'colormag-pro',
			'core_options'           => array(
				'blogname'      => 'ColorMag Health Blog',
				'page_on_front' => 'Home',
			),
			'widgets_data_update'    => array(
				'dropdown_categories' => array(
					'category' => array(
						'colormag_featured_posts_small_thumbnails' => array(
							2 => array(
								'category' => 'Tips &amp; Guides',
							),
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary' => 'Primary',
				),
			),
			'plugins_list'           => array(
				'required' => array(
					'elementor' => array(
						'name' => __( 'Elementor', 'envince' ),
						'slug' => 'elementor/elementor.php',
					),
				),
			),
		),
	);

	return array_merge( $new_demo_config, $demo_config );
}
