<?php
/**
 * Migration scripts for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_Migration' ) ) {
	class ColorMag_Migration {

		public function __construct() {
			add_action( 'after_setup_theme',  array( $this, 'colormag_social_icons_control_migrate' ) );
			add_action( 'after_setup_theme', array( $this, 'colormag_major_update_customizer_migration_v3' ) );
		}

		/**
		 * Migrate the social icons control.
		 *
		 * @since ColorMag 2.0.6
		 */
		public function colormag_social_icons_control_migrate() {

			$social_icon            = get_theme_mod( 'colormag_social_link_activate', 0 );
			$social_icon_visibility = get_theme_mod( 'colormag_social_link_location_option', 'both' );

			// Disable social icon on header if enabled on footer only.
			if ( 0 !== $social_icon ) {
				set_theme_mod( 'colormag_social_icons_activate', true );
			}

			// Disable social icon on header if enabled on footer only.
			if ( 'footer' === $social_icon_visibility ) {
				set_theme_mod( 'colormag_social_icons_header_activate', false );
			}

			// Disable social icon on footer if enabled on header only.
			if ( 'header' === $social_icon_visibility ) {
				set_theme_mod( 'colormag_social_icons_footer_activate', false );
			}

			$remove_theme_mod_settings = array(
				'colormag_social_link_activate',
				'colormag_social_link_location_option',
			);

			// Loop through the theme mods to remove them.
			foreach ( $remove_theme_mod_settings as $remove_theme_mod_setting ) {
				remove_theme_mod( $remove_theme_mod_setting );
			}

			// Set flag to not repeat the migration process, ie, run it only once.
			update_option( 'colormag_social_icons_control_migrate', true );

		}

		/**
		 * Migrate all of the customize options for 3.0.0 theme update.
		 *
		 * @since ColorMag 3.0.0
		 */
		public function colormag_major_update_customizer_migration_v3() {

			$demo_import_migration = colormag_demo_import_migration();

			// Migrate the customize option if migration is done manually.
			if ( ! $demo_import_migration ) {

				// Bail out if the migration is already done.
				if ( get_option( 'colormag_major_update_customizer_migration_v3' ) ) {
					return;
				}
			}

			/**
			 * Color control migration.
			 */
			$color_options = array(
				array(
					'old_key' => 'colormag_button_text_color',
					'new_key' => 'colormag_button_color',
					'default' => '#ffffff',
				),
				array(
					'old_key' => 'colormag_breaking_news_label_background_color',
					'new_key' => 'colormag_news_ticker_label_background_color',
					'default' => '#55ac55',
				),
				array(
					'old_key' => 'colormag_progress_bar_bgcolor',
					'new_key' => 'colormag_progress_bar_indicator_color',
					'default' => '#222222',
				),
				array(
					'old_key' => 'colormag_footer_small_menu_text_color',
					'new_key' => 'colormag_footer_menu_color',
					'default' => '#b1b6b6',
				),
				array(
					'old_key' => 'colormag_footer_small_menu_text_hover_color',
					'new_key' => 'colormag_footer_menu_hover_color',
					'default' => '#207daf',
				),
			);

			foreach ( $color_options as $option ) {
				$old_value = get_theme_mod( $option['old_key'], $option['default'] );

				if ( $old_value ) {
					set_theme_mod( $option['new_key'], $old_value );

					remove_theme_mod( $option['old_key'] );
				}
			}

			/**
			 * Select control migration.
			 */
			// Container Layout.
			$container_layout = get_theme_mod( 'colormag_site_layout', 'wide_layout' );

			switch ( $container_layout ) {
				case 'boxed_layout':
					$container_layout_new = 'boxed';
					break;
				case 'wide_layout':
					$container_layout_new = 'wide';
					break;
			}

			set_theme_mod( 'colormag_container_layout', $container_layout_new );
			remove_theme_mod( 'colormag_site_layout' );

			// Site identity placement.
			$header_logo_placement = get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' );

			switch ( $header_logo_placement ) {
				case 'disable':
				case 'header_logo_only':
					set_theme_mod( 'colormag_enable_site_identity', 0 );
					set_theme_mod( 'colormag_enable_site_tagline', 0 );
					break;
				case 'show_both':
				case 'header_text_only':
					set_theme_mod( 'colormag_enable_site_identity', 1 );
					set_theme_mod( 'colormag_enable_site_tagline', 1 );
					break;
			}

			set_theme_mod( 'colormag_container_layout', $container_layout_new );
			remove_theme_mod( 'colormag_site_layout' );

			// Header media position.
			$old_header_media_position = get_theme_mod( 'colormag_header_image_position' );

			if ( $old_header_media_position ) {

				if ( 'position_one' === $old_header_media_position ) {
					$new_header_media_position = 'position-one';
				} elseif ( 'position_two' === $old_header_media_position ) {
					$new_header_media_position = 'position-two';
				} elseif ( 'position_three' === $old_header_media_position ) {
					$new_header_media_position = 'position-three';
				} else {
					$new_header_media_position = 'position-one';
				}

				set_theme_mod( 'colormag_header_media_position', $new_header_media_position );
				remove_theme_mod( 'colormag_header_image_position' );
			}

			// News Ticker position.
			$old_news_ticker_position = get_theme_mod( 'colormag_breaking_news_position_options' );

			if ( $old_news_ticker_position ) {

				if ( 'header' === $old_news_ticker_position ) {
					$new_news_ticker_position = 'top-bar';
				} elseif ( 'main' === $old_news_ticker_position ) {
					$new_news_ticker_position = 'below-header';
				} else {
					$new_news_ticker_position = 'top-bar';
				}

				set_theme_mod( 'colormag_news_ticker_position', $new_news_ticker_position );
				remove_theme_mod( 'colormag_breaking_news_position_options' );
			}

			// News Ticker query.
			$old_news_ticker_query = get_theme_mod( 'colormag_breaking_news_category_option' );

			if ( $old_news_ticker_query ) {

				if ( 'latest' === $old_news_ticker_query ) {
					$new_news_ticker_query = 'latest';
				} elseif ( 'category' === $old_news_ticker_query ) {
					$new_news_ticker_query = 'category';
				} else {
					$new_news_ticker_query = 'latest';
				}

				set_theme_mod( 'colormag_news_ticker_query', $new_news_ticker_query );
				remove_theme_mod( 'colormag_breaking_news_category_option' );
			}

			// News Ticker animation.
			$old_news_ticker_animation = get_theme_mod( 'colormag_breaking_news_setting_animation_options' );

			if ( $old_news_ticker_animation ) {

				if ( 'up' === $old_news_ticker_animation ) {
					$new_news_ticker_animation = 'up';
				} elseif ( 'down' === $old_news_ticker_animation ) {
					$new_news_ticker_animation = 'down';
				} else {
					$new_news_ticker_animation = 'down';
				}

				set_theme_mod( 'colormag_news_ticker_animation_direction', $new_news_ticker_animation );
				remove_theme_mod( 'colormag_breaking_news_setting_animation_options' );
			}

			// Blog layout.
			$old_blog_layout = get_theme_mod( 'colormag_archive_search_layout' );

			if ( $old_blog_layout ) {

				if ( 'double_column_layout' === $old_blog_layout ) {
					set_theme_mod( 'colormag_blog_layout', 'layout-2' );
					set_theme_mod( 'colormag_blog_layout_1_style', 'style-1' );
				} elseif ( 'single_column_layout' === $old_blog_layout ) {
					set_theme_mod( 'colormag_blog_layout', 'layout-1' );
					set_theme_mod( 'colormag_blog_layout_1_style', 'style-1' );
				} elseif ( 'full_width_layout' === $old_blog_layout ) {
					set_theme_mod( 'colormag_blog_layout', 'layout-1' );
					set_theme_mod( 'colormag_blog_layout_1_style', 'style-2' );
				} elseif ( 'grid_layout' === $old_blog_layout ) {
					set_theme_mod( 'colormag_blog_layout', 'layout-2' );
					set_theme_mod( 'colormag_blog_layout_1_style', 'style-2' );
				} else {
					set_theme_mod( 'colormag_blog_layout', 'layout-1' );
					set_theme_mod( 'colormag_blog_layout_1_style', 'style-1' );
				}

				remove_theme_mod( 'colormag_archive_search_layout' );
			}

			// Grid layout column.
			$old_grid_layout_column = get_theme_mod( 'colormag_grid_layout_column' );

			if ( $old_grid_layout_column ) {

				if ( 'two' === $old_grid_layout_column ) {
					$new_grid_layout_column = '2';
				} elseif ( 'three' === $old_grid_layout_column ) {
					$new_grid_layout_column = '3';
				} elseif ( 'four' === $old_grid_layout_column ) {
					$new_grid_layout_column = '4';
				} else {
					$new_grid_layout_column = '2';
				}

				set_theme_mod( 'colormag_grid_layout_column', $new_grid_layout_column );
			}

			// Footer bar layout.
			$old_footer_bar_layout = get_theme_mod( 'colormag_footer_copyright_alignment_setting' );

			if ( $old_footer_bar_layout ) {

				if ( 'left' === $old_footer_bar_layout ) {
					$new_footer_bar_layout = 'layout-1';
				} elseif ( 'right' === $old_footer_bar_layout ) {
					$new_footer_bar_layout = 'layout-2';
				} elseif ( 'center' === $old_footer_bar_layout ) {
					$new_footer_bar_layout = 'layout-3';
				} else {
					$new_footer_bar_layout = 'layout-1';
				}

				set_theme_mod( 'colormag_footer_bar_layout', $new_footer_bar_layout );
				remove_theme_mod( 'colormag_footer_copyright_alignment_setting' );
			}

			// Main footer layout.
			$old_main_footer_layout = get_theme_mod( 'colormag_main_footer_layout_display_type' );

			if ( $old_main_footer_layout ) {

				if ( 'type_one' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-1';
				} elseif ( 'type_two' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-2';
				} elseif ( 'type_three' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-3';
				} else {
					$new_main_footer_layout = 'layout-1';
				}

				set_theme_mod( 'colormag_main_footer_layout', $new_main_footer_layout );
				remove_theme_mod( 'colormag_main_footer_layout_display_type' );
			}

			// Post Meta date style.
			$old_post_meta_date_style = get_theme_mod( 'colormag_post_meta_date_setting' );

			if ( $old_post_meta_date_style ) {

				if ( 'post_date' === $old_post_meta_date_style ) {
					$new_post_meta_date_style = 'style-1';
				} elseif ( 'post_human_readable_date' === $old_post_meta_date_style ) {
					$new_post_meta_date_style = 'style-2';
				} else {
					$new_post_meta_date_style = 'style-1';
				}

				set_theme_mod( 'colormag_post_meta_date_style', $new_post_meta_date_style );
				remove_theme_mod( 'colormag_post_meta_date_setting' );
			}

			// Related post flyout query.
			$old_related_post_flyout_query = get_theme_mod( 'colormag_related_posts_flyout_type' );

			if ( $old_related_post_flyout_query ) {

				if ( 'categories' === $old_related_post_flyout_query ) {
					$new_related_post_flyout_query = 'categories';
				} elseif ( 'tags' === $old_related_post_flyout_query ) {
					$new_related_post_flyout_query = 'tags';
				} elseif ( 'date' === $old_related_post_flyout_query ) {
					$new_related_post_flyout_query = 'date';
				} else {
					$new_related_post_flyout_query = 'categories';
				}

				set_theme_mod( 'colormag_flyout_related_posts_query', $new_related_post_flyout_query );
				remove_theme_mod( 'colormag_related_posts_flyout_type' );
			}

			// Related post layout.
			$old_related_posts_layout = get_theme_mod( 'colormag_related_posts_layout' );

			if ( $old_related_posts_layout ) {

				if ( 'style_one' === $old_related_posts_layout ) {
					$new_related_posts_layout = 'style-1';
				} elseif ( 'style_two' === $old_related_posts_layout ) {
					$new_related_posts_layout = 'style-2';
				} elseif ( 'style_three' === $old_related_posts_layout ) {
					$new_related_posts_layout = 'style-3';
				} elseif ( 'style_four' === $old_related_posts_layout ) {
					$new_related_posts_layout = 'style-4';
				} else {
					$new_related_posts_layout = 'style-1';
				}

				set_theme_mod( 'colormag_related_posts_style', $new_related_posts_layout );
				remove_theme_mod( 'colormag_related_posts_flyout_type' );
			}

			// Related post count.
			$old_related_posts_count = get_theme_mod( 'colormag_related_post_number_display' );

			if ( $old_related_posts_count ) {

				if ( '3' === $old_related_posts_count ) {
					$new_related_posts_count = '3';
				} elseif ( '6' === $old_related_posts_count ) {
					$new_related_posts_count = '6';
				} else {
					$new_related_posts_count = 'style-1';
				}

				set_theme_mod( 'colormag_related_posts_count', $new_related_posts_count );
				remove_theme_mod( 'colormag_related_post_number_display' );
			}

			// Related post flyout query.
			$old_related_post_query = get_theme_mod( 'colormag_related_posts' );

			if ( $old_related_post_query ) {

				if ( 'categories' === $old_related_post_query ) {
					$new_related_post_query = 'categories';
				} elseif ( 'tags' === $old_related_post_query ) {
					$new_related_post_query = 'tags';
				} else {
					$new_related_post_query = 'categories';
				}

				set_theme_mod( 'colormag_related_posts_query', $new_related_post_query );
				remove_theme_mod( 'colormag_related_posts' );
			}

			// Post Navigation.
			$old_post_navigation_style = get_theme_mod( 'colormag_post_navigation' );

			if ( $old_post_navigation_style ) {

				if ( 'default' === $old_post_navigation_style ) {
					$new_post_navigation_style = 'style-1';
				} elseif ( 'small_featured_image' === $old_post_navigation_style ) {
					$new_post_navigation_style = 'style-2';
				} elseif ( 'medium_featured_image' === $old_post_navigation_style ) {
					$new_post_navigation_style = 'style-3';
				} else {
					$new_post_navigation_style = 'style-1';
				}

				set_theme_mod( 'colormag_post_navigation_style', $new_post_navigation_style );
				remove_theme_mod( 'colormag_post_navigation' );
			}

			// Single post title.
			$old_single_post_title_position = get_theme_mod( 'colormag_single_post_title_position' );

			if ( $old_single_post_title_position ) {

				if ( 'above' === $old_single_post_title_position ) {
					$new_single_post_title_position = 'position-1';
				} elseif ( 'below' === $old_single_post_title_position ) {
					$new_single_post_title_position = 'position-2';
				} else {
					$new_single_post_title_position = 'position-2';
				}

				set_theme_mod( 'colormag_featured_image_position', $new_single_post_title_position );
				remove_theme_mod( 'colormag_single_post_title_position' );
			}

			// Single post title.
			$old_single_post_title_position = get_theme_mod( 'colormag_author_bio_style_setting' );

			if ( $old_single_post_title_position ) {

				if ( 'style_one' === $old_single_post_title_position ) {
					$new_single_post_title_position = 'style-1';
				} elseif ( 'style_two' === $old_single_post_title_position ) {
					$new_single_post_title_position = 'style-2';
				} elseif ( 'style_three' === $old_single_post_title_position ) {
					$new_single_post_title_position = 'style-3';
				} else {
					$new_single_post_title_position = 'style-1';
				}

				set_theme_mod( 'colormag_author_bio_style', $new_single_post_title_position );
				remove_theme_mod( 'colormag_author_bio_style_setting' );
			}

			// Autoload post type.
			$old_autoload_posts_type = get_theme_mod( 'colormag_autoload_posts_event' );

			if ( $old_autoload_posts_type ) {

				if ( 'button' === $old_autoload_posts_type ) {
					$new_autoload_posts_type = 'button';
				} elseif ( 'scroll' === $old_autoload_posts_type ) {
					$new_autoload_posts_type = 'scroll';
				} else {
					$new_autoload_posts_type = 'button';
				}

				set_theme_mod( 'colormag_autoload_posts_type', $new_autoload_posts_type );
				remove_theme_mod( 'colormag_autoload_posts_event' );
			}

			// Breadcrumb.
			$old_breadcrumb = get_theme_mod( 'colormag_breadcrumb_display' );

			if ( $old_breadcrumb ) {
				if ( 'none' === $old_breadcrumb ) {
					set_theme_mod( 'colormag_enable_breadcrumb', false );
				} elseif ( 'yoast_seo_navxt' === $old_breadcrumb ) {
					set_theme_mod( 'colormag_enable_breadcrumb', true );
				} elseif ( 'colormag_breadcrumb' === $old_breadcrumb ) {
					set_theme_mod( 'colormag_enable_breadcrumb', true );
				}
			}

			// Breadcrumb type.
			$old_breadcrumb_type = get_theme_mod( 'colormag_breadcrumb_display' );

			if ( $old_breadcrumb_type ) {
				if ( 'none' === $old_breadcrumb_type ) {
					$new_breadcrumb_type = 'yoast_seo_navxt';
				} elseif ( 'yoast_seo_navxt' === $old_breadcrumb_type ) {
					$new_breadcrumb_type = 'yoast_seo_navxt';
				} elseif ( 'colormag_breadcrumb' === $old_breadcrumb_type ) {
					$new_breadcrumb_type = 'colormag_breadcrumb';
				} else {
					$new_breadcrumb_type = 'button';
				}

				set_theme_mod( 'colormag_breadcrumb_type', $new_breadcrumb_type );
				remove_theme_mod( 'colormag_breadcrumb_display' );
			}

			// Sticky menu type.
			$old_sticky_menu_style = get_theme_mod( 'colormag_primary_sticky_menu_type' );

			if ( $old_sticky_menu_style ) {
				if ( 'sticky' === $old_sticky_menu_style ) {
					$new_sticky_menu_style = 'style-1';
				} elseif ( 'reveal_on_scroll' === $old_sticky_menu_style ) {
					$new_sticky_menu_style = 'style-2';
				} else {
					$new_sticky_menu_style = 'style-1';
				}

				set_theme_mod( 'colormag_sticky_menu_type', $new_sticky_menu_style );
				remove_theme_mod( 'colormag_primary_sticky_menu_type' );
			}

			// Blog content excerpt type.
			$old_blog_content_excerpt_type = get_theme_mod( 'colormag_archive_content_excerpt_display' );

			if ( $old_blog_content_excerpt_type ) {
				if ( 'excerpt' === $old_blog_content_excerpt_type ) {
					$new_blog_content_excerpt_type = 'excerpt';
				} elseif ( 'content' === $old_blog_content_excerpt_type ) {
					$new_blog_content_excerpt_type = 'content';
				} else {
					$new_blog_content_excerpt_type = 'excerpt';
				}

				set_theme_mod( 'colormag_blog_content_excerpt_type', $new_blog_content_excerpt_type );
				remove_theme_mod( 'colormag_archive_content_excerpt_display' );
			}

			// Pagination type.
			$old_pagination_type = get_theme_mod( 'colormag_post_pagination' );

			if ( $old_pagination_type ) {
				if ( 'default' === $old_pagination_type ) {
					$new_pagination_type = 'default';
				} elseif ( 'numbered_pagination' === $old_pagination_type ) {
					$new_pagination_type = 'numbered_pagination';
				} elseif ( 'infinite_scroll' === $old_pagination_type ) {
					$new_pagination_type = 'infinite_scroll';
				} else {
					$new_pagination_type = 'default';
				}

				set_theme_mod( 'colormag_pagination_type', $new_pagination_type );
				remove_theme_mod( 'colormag_post_pagination' );
			}

			// Infinite scroll type.
			$old_pagination_type = get_theme_mod( 'colormag_infinite_scroll_event' );

			if ( $old_pagination_type ) {
				if ( 'button' === $old_pagination_type ) {
					$new_pagination_type = 'button';
				} elseif ( 'scroll' === $old_pagination_type ) {
					$new_pagination_type = 'scroll';
				} else {
					$new_pagination_type = 'button';
				}

				set_theme_mod( 'colormag_infinite_scroll_type', $new_pagination_type );
				remove_theme_mod( 'colormag_infinite_scroll_event' );
			}

			/**
			 * Toggle control migration.
			 */
			// Hide Blog/Static page posts.
			$blog_static_page_posts = get_theme_mod( 'colormag_hide_blog_front' );

			if ( $blog_static_page_posts ) {
				set_theme_mod( 'colormag_hide_blog_static_page_post', true );
			}
			remove_theme_mod( 'colormag_hide_blog_front' );

			// Unique Post System.
			$enable_unique_post_system = get_theme_mod( 'colormag_unique_post_system' );

			if ( $enable_unique_post_system ) {
				set_theme_mod( 'colormag_enable_unique_post_system', true );
			}
			remove_theme_mod( 'colormag_unique_post_system' );

			// Unique Post System.
			$enable_header_image_link_home = get_theme_mod( 'colormag_header_image_link' );

			if ( $enable_header_image_link_home ) {
				set_theme_mod( 'colormag_enable_header_image_link_home', true );
			}
			remove_theme_mod( 'colormag_header_image_link' );

			// Enable News Ticker.
			$enable_news_ticker = get_theme_mod( 'colormag_breaking_news' );

			if ( $enable_news_ticker ) {
				set_theme_mod( 'colormag_enable_news_ticker', true );
			}
			remove_theme_mod( 'colormag_breaking_news' );

			// Footer Social Icons.
			$enable_social_icon = get_theme_mod( 'colormag_social_icons_activate' );

			if ( $enable_social_icon ) {
				set_theme_mod( 'colormag_enable_social_icons', true );
			}
			remove_theme_mod( 'colormag_social_icons_activate' );

			// Header Social Icons.
			$enable_header_social_icons = get_theme_mod( 'colormag_social_icons_header_activate' );

			if ( $enable_header_social_icons ) {
				set_theme_mod( 'colormag_enable_social_icons_header', true );
			}
			remove_theme_mod( 'colormag_social_icons_header_activate' );

			// Social Icons.
			$enable_social_icons = get_theme_mod( 'colormag_social_icons_activate' );

			if ( $enable_social_icons ) {
				set_theme_mod( 'colormag_enable_social_icon', true );
			}
			remove_theme_mod( 'colormag_social_icons_activate' );

			// Schema Markup.
			$enable_schema_markup = get_theme_mod( 'colormag_enable_schema_markup' );

			if ( $enable_schema_markup ) {
				set_theme_mod( 'colormag_enable_schema_markup', true );
			}
			remove_theme_mod( 'colormag_schema_markup' );

			// Scroll to top.
			$enable_scroll_to_top = get_theme_mod( 'colormag_enable_scroll_to_top' );

			if ( $enable_scroll_to_top ) {
				set_theme_mod( 'colormag_enable_scroll_to_top', true );
			}
			remove_theme_mod( 'colormag_scroll_to_top' );

			// Post Featured Image.
			$enable_post_featured_image = get_theme_mod( 'colormag_featured_image_show' );

			if ( $enable_post_featured_image ) {
				set_theme_mod( 'colormag_enable_featured_image', true );
			}
			remove_theme_mod( 'colormag_featured_image_show' );

			// Page Featured Image.
			$enable_page_featured_image = get_theme_mod( 'colormag_featured_image_single_page_show' );

			if ( $enable_page_featured_image ) {
				set_theme_mod( 'colormag_enable_page_featured_image', true );
			}
			remove_theme_mod( 'colormag_featured_image_single_page_show' );

			// Progress bar indicator.
			$enable_progress_bar_indicator = get_theme_mod( 'colormag_prognroll_indicator' );

			if ( $enable_progress_bar_indicator ) {
				set_theme_mod( 'colormag_enable_progress_bar_indicator', true );
			}
			remove_theme_mod( 'colormag_prognroll_indicator' );

			// Flyout related posts.
			$enable_fly_out_related_post = get_theme_mod( 'colormag_related_post_flyout_setting' );

			if ( $enable_fly_out_related_post ) {
				set_theme_mod( 'colormag_enable_flyout_related_posts', true );
			}
			remove_theme_mod( 'colormag_related_post_flyout_setting' );

			// Related posts.
			$enable_related_post = get_theme_mod( 'colormag_related_posts_activate' );

			if ( $enable_related_post ) {
				set_theme_mod( 'colormag_enable_related_posts', true );
			}
			remove_theme_mod( 'colormag_related_posts_activate' );

			// Post Navigation.
			$enable_post_navigation = get_theme_mod( 'colormag_post_navigation_hide' );

			if ( $enable_post_navigation ) {
				set_theme_mod( 'colormag_enable_post_navigation', true );
			}
			remove_theme_mod( 'colormag_post_navigation_hide' );

			// Lightbox.
			$enable_lightbox = get_theme_mod( 'colormag_featured_image_popup' );

			if ( $enable_lightbox ) {
				set_theme_mod( 'colormag_enable_lightbox', true );
			}
			remove_theme_mod( 'colormag_featured_image_popup' );

			// Social Share.
			$enable_social_share = get_theme_mod( 'colormag_social_share' );

			if ( $enable_social_share ) {
				set_theme_mod( 'colormag_enable_social_share', true );
			}
			remove_theme_mod( 'colormag_social_share' );

			// Social Share Twitter.
			$enable_social_share_twitter = get_theme_mod( 'colormag_social_share_twitter' );

			if ( $enable_social_share_twitter ) {
				set_theme_mod( 'colormag_enable_social_share_twitter', true );
			}
			remove_theme_mod( 'colormag_social_share_twitter' );

			// Social Share Facebook.
			$enable_social_share_facebook = get_theme_mod( 'colormag_social_share_facebook' );

			if ( $enable_social_share_facebook ) {
				set_theme_mod( 'colormag_enable_social_share_facebook', true );
			}
			remove_theme_mod( 'colormag_social_share_facebook' );

			// Social Share Pinterest.
			$enable_social_share_pinterest = get_theme_mod( 'colormag_social_share_pinterest' );

			if ( $enable_social_share_pinterest ) {
				set_theme_mod( 'colormag_enable_social_share_pinterest', true );
			}
			remove_theme_mod( 'colormag_social_share_pinterest' );

			// Author bio link.
			$enable_author_bio_link = get_theme_mod( 'colormag_author_bio_links' );

			if ( $enable_author_bio_link ) {
				set_theme_mod( 'colormag_enable_author_bio_link', true );
			}
			remove_theme_mod( 'colormag_author_bio_links' );

			// Author bio profile.
			$enable_author_bio_profile = get_theme_mod( 'colormag_author_bio_social_sites_show' );

			if ( $enable_author_bio_profile ) {
				set_theme_mod( 'colormag_enable_author_bio_profile', true );
			}
			remove_theme_mod( 'colormag_author_bio_social_sites_show' );

			// Author bio.
			$enable_author_bio = get_theme_mod( 'colormag_author_bio_disable_setting' );

			if ( $enable_author_bio ) {
				set_theme_mod( 'colormag_enable_author_bio', true );
			}
			remove_theme_mod( 'colormag_author_bio_disable_setting' );

			// Autoload posts.
			$enable_autoload_posts = get_theme_mod( 'colormag_autoload_posts' );

			if ( $enable_autoload_posts ) {
				set_theme_mod( 'colormag_enable_autoload_posts', true );
			}
			remove_theme_mod( 'colormag_autoload_posts' );

			// Sticky Menu.
			$enable_sticky_menu = get_theme_mod( 'colormag_primary_sticky_menu' );

			if ( $enable_sticky_menu ) {
				set_theme_mod( 'colormag_enable_sticky_menu', true );
			}
			remove_theme_mod( 'colormag_primary_sticky_menu' );

			// Search in menu.
			$enable_search_in_menu = get_theme_mod( 'colormag_enable_search' );

			if ( $enable_search_in_menu ) {
				set_theme_mod( 'colormag_enable_search', true );
			}
			remove_theme_mod( 'colormag_search_icon_in_menu' );

			// Random post.
			$enable_random_post = get_theme_mod( 'colormag_random_post_in_menu' );

			if ( $enable_random_post ) {
				set_theme_mod( 'colormag_enable_random_post', true );
			}
			remove_theme_mod( 'colormag_random_post_in_menu' );

			// Category color.
			$enable_category_color = get_theme_mod( 'colormag_category_menu_color' );

			if ( $enable_category_color ) {
				set_theme_mod( 'colormag_enable_category_color', true );
			}
			remove_theme_mod( 'colormag_category_menu_color' );

			// Featured image caption.
			$enable_category_color = get_theme_mod( 'colormag_featured_image_caption_show' );

			if ( $enable_category_color ) {
				set_theme_mod( 'colormag_enable_featured_image_caption', true );
			}
			remove_theme_mod( 'colormag_featured_image_caption_show' );

			/**
			 * Typography control migration.
			 */
			// Migrate the typography options.
			$extractsizeandunit = function ( $value ) {
				$unit_list = array( 'px', 'em', 'rem', '%', '-', 'vw', 'vh', 'pt', 'pc' );

				if ( ! $value ) {
					return array(
						'size' => '',
						'unit' => 'px',
					);
				}

				preg_match( '/^(\d+(?:\.\d+)?)(.*)$/', $value, $matches );

				$size = (float) $matches[1];
				$unit = $matches[2];

				if ( 'px' !== $unit ) {
					switch ( $unit ) {
						case 'em':
						case 'pc':
						case 'rem':
							$size *= 16;
							$unit  = 'px';
							break;
						case 'vw':
							$size *= 19.2;
							$unit  = 'px';
							break;
						case 'vh':
							$size *= 10.8;
							$unit  = 'px';
							break;
						case '%':
							$size *= 1.6;
							$unit  = 'px';
							break;
						case 'pt':
							$size *= 1.333;
							$unit  = 'px';
							break;
						default:
							// Do nothing if the unit is not recognized
							break;
					}
				}

				return array(
					'size' => $size,
					'unit' => $unit,
				);
			};

			$typography_options = array(
				array(
					'old_key' => 'colormag_button_typography_setting',
					'new_key' => 'colormag_button_typography',
				),
				array(
					'old_key' => 'colormag_site_title_typography_setting',
					'new_key' => 'colormag_site_title_typography',
				),
				array(
					'old_key' => 'colormag_site_tagline_typography_setting',
					'new_key' => 'colormag_site_tagline_typography',
				),
				array(
					'old_key' => 'colormag_breaking_news_label_typography_setting',
					'new_key' => 'colormag_news_ticker_label_typography',
				),
				array(
					'old_key' => 'colormag_breaking_news_content_typography_setting',
					'new_key' => 'colormag_news_ticker_content_typography',
				),
				array(
					'old_key' => 'colormag_primary_menu_typography_setting',
					'new_key' => 'colormag_primary_menu_typography',
				),
				array(
					'old_key' => 'colormag_primary_sub_menu_typography_setting',
					'new_key' => 'colormag_primary_sub_menu_typography',
				),
				array(
					'old_key' => 'colormag_post_title_typography_setting',
					'new_key' => 'colormag_post_title_typography',
				),
				array(
					'old_key' => 'colormag_comment_title_typography_setting',
					'new_key' => 'colormag_comment_title_typography',
				),
				array(
					'old_key' => 'colormag_post_meta_typography_setting',
					'new_key' => 'colormag_post_meta_typography',
				),
				array(
					'old_key' => 'colormag_page_title_typography_setting',
					'new_key' => 'colormag_page_title_typography',
				),
				array(
					'old_key' => 'colormag_footer_widget_title_typography_setting',
					'new_key' => 'colormag_footer_widget_title_typography',
				),
				array(
					'old_key' => 'colormag_footer_widget_content_typography_setting',
					'new_key' => 'colormag_footer_widget_content_typography',
				),
				array(
					'old_key' => 'colormag_footer_copyright_typography_setting',
					'new_key' => 'colormag_footer_copyright_typography',
				),
				array(
					'old_key' => 'colormag_footer_menu_typography_setting',
					'new_key' => 'colormag_footer_menu_typography',
				),
			);

			foreach ( $typography_options as $option ) {
				$old_value = get_theme_mod( $option['old_key'] );

				if ( $old_value ) {
					$new_desktop_font = isset( $old_value['font-size']['desktop'] ) ? $extractsizeandunit( $old_value['font-size']['desktop'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_tablet_font = isset( $old_value['font-size']['tablet'] ) ? $extractsizeandunit( $old_value['font-size']['tablet'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_mobile_font = isset( $old_value['font-size']['mobile'] ) ? $extractsizeandunit( $old_value['font-size']['mobile'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_desktop_line_height = isset( $old_value['line-height']['desktop'] ) ? $extractsizeandunit( $old_value['line-height']['desktop'] ) : array(
						'size' => '',
						'unit' => '-',
					);

					if ( empty( $new_desktop_line_height['unit'] ) ) {
						$new_desktop_line_height['unit'] = '-';
					}

					$new_tablet_line_height = isset( $old_value['line-height']['tablet'] ) ? $extractsizeandunit( $old_value['line-height']['tablet'] ) : array(
						'size' => '',
						'unit' => '-',
					);

					if ( empty( $new_tablet_line_height['unit'] ) ) {
						$new_tablet_line_height['unit'] = '-';
					}

					$new_mobile_line_height = isset( $old_value['line-height']['mobile'] ) ? $extractsizeandunit( $old_value['line-height']['mobile'] ) : array(
						'size' => '',
						'unit' => '-',
					);

					if ( empty( $new_mobile_line_height['unit'] ) ) {
						$new_mobile_line_height['unit'] = '-';
					}

					$new_desktop_letter_spacing = isset( $old_value['letter-spacing']['desktop'] ) ? $extractsizeandunit( $old_value['letter-spacing']['desktop'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_tablet_letter_spacing = isset( $old_value['letter-spacing']['tablet'] ) ? $extractsizeandunit( $old_value['letter-spacing']['tablet'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_mobile_letter_spacing = isset( $old_value['letter-spacing']['mobile'] ) ? $extractsizeandunit( $old_value['letter-spacing']['mobile'] ) : array(
						'size' => '',
						'unit' => 'px',
					);

					$new_value = array(
						'font-family'    => $old_value['font-family'],
						'font-weight'    => $old_value['font-weight'],
						'font-size'      => array(
							'desktop' => array(
								'size' => $new_desktop_font['size'],
								'unit' => $new_desktop_font['unit'],
							),
							'tablet'  => array(
								'size' => $new_tablet_font['size'],
								'unit' => $new_tablet_font['unit'],
							),
							'mobile'  => array(
								'size' => $new_mobile_font['size'],
								'unit' => $new_mobile_font['unit'],
							),
						),
						'line-height'    => array(
							'desktop' => array(
								'size' => $new_desktop_line_height['size'],
								'unit' => $new_desktop_line_height['unit'],
							),
							'tablet'  => array(
								'size' => $new_tablet_line_height['size'],
								'unit' => $new_tablet_line_height['unit'],
							),
							'mobile'  => array(
								'size' => $new_mobile_line_height['size'],
								'unit' => $new_mobile_line_height['unit'],
							),
						),
						'letter-spacing' => array(
							'desktop' => array(
								'size' => $new_desktop_letter_spacing['size'],
								'unit' => $new_desktop_letter_spacing['unit'],
							),
							'tablet'  => array(
								'size' => $new_tablet_letter_spacing['size'],
								'unit' => $new_tablet_letter_spacing['unit'],
							),
							'mobile'  => array(
								'size' => $new_mobile_letter_spacing['size'],
								'unit' => $new_mobile_letter_spacing['unit'],
							),
						),
						'font-style'     => $old_value['font-style'],
						'text-transform' => $old_value['text-transform'],
					);

					set_theme_mod( $option['new_key'], $new_value );
					remove_theme_mod( $option['old_key'] );
				}
			}

			/**
			 * Radio image control migration.
			 */
			// Sidebar Layout Migration.
			$sidebar_layout_option = array(
				array(
					'old_key' => 'colormag_default_layout',
					'new_key' => 'colormag_default_sidebar_layout',
				),
				array(
					'old_key' => 'colormag_default_page_layout',
					'new_key' => 'colormag_page_sidebar_layout',
				),
				array(
					'old_key' => 'colormag_default_single_posts_layout',
					'new_key' => 'colormag_post_sidebar_layout',
				),
			);

			foreach ( $sidebar_layout_option as $option ) {

				$old_value = get_theme_mod( $option['old_key'] );

				if ( $old_value ) {

					if ( 'right_sidebar' === $old_value ) {
						$new_value = 'right_sidebar';
					} elseif ( 'left_sidebar' === $old_value ) {
						$new_value = 'left_sidebar';
					} elseif ( 'no_sidebar_full_width' === $old_value ) {
						$new_value = 'no_sidebar_full_width';
					} elseif ( 'no_sidebar_content_centered' === $old_value ) {
						$new_value = 'no_sidebar_content_centered';
					} elseif ( 'two_sidebars' === $old_value ) {
						$new_value = 'two_sidebars';
					} else {
						$new_value = 'right_sidebar';
					}

					set_theme_mod( $option['new_key'], $new_value );
					remove_theme_mod( $option['old_key'] );
				}
			}

			/**
			 * Background control migration.
			 */
			// Background Migration.
			$background_option = array(
				array(
					'old_key' => 'colormag_header_background_setting',
					'new_key' => 'colormag_main_header_background',
				),
				array(
					'old_key' => 'colormag_footer_copyright_background_setting',
					'new_key' => 'colormag_footer_copyright_background',
				),
				array(
					'old_key' => 'colormag_footer_background_setting',
					'new_key' => 'colormag_footer_background',
				),
				array(
					'old_key' => 'colormag_primary_sub_menu_background_setting',
					'new_key' => 'colormag_primary_sub_menu_background',
				),
				array(
					'old_key' => 'colormag_primary_menu_background_setting',
					'new_key' => 'colormag_primary_menu_background',
				),
				array(
					'old_key' => 'colormag_breaking_news_label_background_color',
					'new_key' => 'colormag_news_ticker_label_background',
				),
			);

			foreach ( $background_option as $option ) {

				$old_value = get_theme_mod( $option['old_key'] );

				if ( $old_value ) {

					$new_value = array(
						'background-color'      => $old_value['background-color'],
						'background-image'      => $old_value['background-image'],
						'background-repeat'     => $old_value['background-repeat'],
						'background-position'   => $old_value['background-position'],
						'background-size'       => $old_value['background-size'],
						'background-attachment' => $old_value['background-attachment'],
					);

					set_theme_mod( $option['new_key'], $new_value );
					remove_theme_mod( $option['old_key'] );
				}
			}

			// Set flag not to repeat the migration process, run it only once.
			update_option( 'colormag_major_update_customizer_migration_v3', true );
		}
	}

	new ColorMag_Migration();
}
