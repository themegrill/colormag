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

		private $old_theme_mods;

		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'colormag_social_icons_control_migrate' ) );

			if ( self::maybe_run_migration() || self::colormag_demo_import_migration() ) {
				add_action( 'after_setup_theme', array( $this, 'colormag_free_major_update_customizer_migration_v1' ) );
			}
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
		public function colormag_free_major_update_customizer_migration_v1() {

			/**
			 * Select control migration.
			 */
			// Site Layout.
			$container_layout = get_theme_mod( 'colormag_site_layout' );

			if ( $container_layout ) {
				if ( 'boxed_layout' === $container_layout ) {
					$new_container_layout = 'boxed';
				} elseif ( 'wide_layout' === $container_layout ) {
					$new_container_layout = 'wide';
				}
				set_theme_mod( 'colormag_container_layout', $new_container_layout );
				remove_theme_mod( 'colormag_site_layout' );
			}

			// Home Icon.
			$home_icon = get_theme_mod( 'colormag_home_icon_display', '0' );

			if ( $home_icon ) {
				set_theme_mod( 'colormag_menu_icon_logo', 'home-icon' );
				remove_theme_mod( 'colormag_home_icon_display' );
			}

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

			// Main Header layout.
			$old_main_header_layout = get_theme_mod( 'colormag_main_total_header_area_display_type' );

			if ( $old_main_header_layout ) {

				if ( 'type_one' === $old_main_header_layout ) {
					set_theme_mod( 'colormag_main_header_layout', 'layout-1' );
					set_theme_mod( 'colormag_main_header_layout_1_style', 'style-1' );
				} elseif ( 'type_two' === $old_main_header_layout ) {
					set_theme_mod( 'colormag_main_header_layout', 'layout-1' );
					set_theme_mod( 'colormag_main_header_layout_1_style', 'style-1' );
					set_theme_mod( 'colormag_main_header_width_setting', 'contained' );
				} elseif ( 'type_three' === $old_main_header_layout ) {
					set_theme_mod( 'colormag_main_header_layout', 'layout-2' );
					set_theme_mod( 'colormag_main_header_layout_2_style', 'style-1' );
				}
				remove_theme_mod( 'colormag_main_total_header_area_display_type' );
			}

			// Sticky Menu.
			$enable_sticky_menu = get_theme_mod( 'colormag_primary_sticky_menu' );

			if ( $enable_sticky_menu ) {
				set_theme_mod( 'colormag_enable_sticky_menu', true );
				remove_theme_mod( 'colormag_primary_sticky_menu' );
			}

			// Main footer layout.
			$old_main_footer_layout = get_theme_mod( 'colormag_main_footer_layout_display_type' );

			if ( $old_main_footer_layout ) {

				if ( 'type_one' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-1';
				} elseif ( 'type_two' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-2';
				}

				set_theme_mod( 'colormag_main_footer_layout', $new_main_footer_layout );
				remove_theme_mod( 'colormag_main_footer_layout_display_type' );
			}

			/**
			 * Toggle control migration.
			 */
			// Top bar.
			$top_bar_date_enable        = get_theme_mod( 'colormag_date_display' );
			$top_bar_news_ticker_enable = get_theme_mod( 'colormag_enable_news_ticker' );

			if ( $top_bar_date_enable || $top_bar_news_ticker_enable ) {
				set_theme_mod( 'colormag_enable_top_bar', true );
			}

			// Search.
			$search_enable = get_theme_mod( 'colormag_search_icon_in_menu' );

			if ( $search_enable ) {
				set_theme_mod( 'colormag_enable_search', true );
				remove_theme_mod( 'colormag_search_icon_in_menu' );
			}

			// Hide Blog/Static page posts.
			$blog_static_page_posts = get_theme_mod( 'colormag_hide_blog_front' );

			if ( $blog_static_page_posts ) {
				set_theme_mod( 'colormag_hide_blog_static_page_post', true );
				remove_theme_mod( 'colormag_hide_blog_front' );
			}

			// Header media link home.
			$enable_header_image_link_home = get_theme_mod( 'colormag_header_image_link' );

			if ( $enable_header_image_link_home ) {
				set_theme_mod( 'colormag_enable_header_image_link_home', true );
				remove_theme_mod( 'colormag_header_image_link' );
			}

			// Enable News Ticker.
			$enable_news_ticker = get_theme_mod( 'colormag_breaking_news' );

			if ( $enable_news_ticker ) {
				set_theme_mod( 'colormag_enable_news_ticker', true );
				remove_theme_mod( 'colormag_breaking_news' );
			}

			// Social Icons.
			$enable_social_icons = get_theme_mod( 'colormag_social_icons_activate' );

			if ( $enable_social_icons ) {
				set_theme_mod( 'colormag_enable_social_icons', true );
				remove_theme_mod( 'colormag_social_icons_activate' );
			}

			// Header Social Icons.
			$enable_header_social_icons = get_theme_mod( 'colormag_social_icons_header_activate', true );

			if ( $enable_header_social_icons ) {
				set_theme_mod( 'colormag_enable_social_icons_header', true );
				remove_theme_mod( 'colormag_social_icons_header_activate' );
			} else {
				set_theme_mod( 'colormag_enable_social_icons_header', false );
				remove_theme_mod( 'colormag_social_icons_header_activate' );
			}

			// Footer Social Icons.
			$enable_footer_social_icons = get_theme_mod( 'colormag_social_icons_footer_activate', true );

			if ( $enable_footer_social_icons ) {
				set_theme_mod( 'colormag_enable_social_icons_footer', true );
				remove_theme_mod( 'colormag_social_icons_header_activate' );
			} else {
				set_theme_mod( 'colormag_enable_social_icons_footer', false );
				remove_theme_mod( 'colormag_social_icons_header_activate' );
			}

			// Single Post Featured Image.
			$enable_post_featured_image = get_theme_mod( 'colormag_featured_image_show' );

			if ( ! empty( $enable_post_featured_image ) ) {
				set_theme_mod( 'colormag_enable_featured_image', false );
			} else {
				set_theme_mod( 'colormag_enable_featured_image', true );
			}

			// Lightbox.
			$enable_lightbox = get_theme_mod( 'colormag_featured_image_popup' );

			if ( $enable_lightbox ) {
				set_theme_mod( 'colormag_enable_lightbox', true );
				remove_theme_mod( 'colormag_featured_image_popup' );
			}

			// Related posts.
			$enable_related_post = get_theme_mod( 'colormag_related_posts_activate' );

			if ( $enable_related_post ) {
				set_theme_mod( 'colormag_enable_related_posts', true );
				remove_theme_mod( 'colormag_related_posts_activate' );
			}

			// Related post query.
			$old_related_post_query = get_theme_mod( 'colormag_related_posts' );

			if ( $old_related_post_query ) {

				if ( 'tags' === $old_related_post_query ) {
					$new_related_post_query = 'tags';
				} else {
					$new_related_post_query = 'categories';
				}

				set_theme_mod( 'colormag_related_posts_query', $new_related_post_query );
				remove_theme_mod( 'colormag_related_posts' );
			}

			// Page Featured Image.
			$enable_page_featured_image = get_theme_mod( 'colormag_featured_image_single_page_show' );

			if ( $enable_page_featured_image ) {
				set_theme_mod( 'colormag_enable_page_featured_image', true );
				remove_theme_mod( 'colormag_featured_image_single_page_show' );
			}

			// Search.
			$enable_search_in_menu = get_theme_mod( 'colormag_enable_search' );

			if ( $enable_search_in_menu ) {
				set_theme_mod( 'colormag_enable_search', true );
				remove_theme_mod( 'colormag_search_icon_in_menu' );
			}

			// Random post.
			$enable_random_post = get_theme_mod( 'colormag_random_post_in_menu' );

			if ( $enable_random_post ) {
				set_theme_mod( 'colormag_enable_random_post', true );
				remove_theme_mod( 'colormag_random_post_in_menu' );
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
					} else {
						$new_value = 'right_sidebar';
					}

					set_theme_mod( $option['new_key'], $new_value );
					remove_theme_mod( $option['old_key'] );
				}
			}

			// Set flag to not repeat the migration process, ie, run it only once.
			update_option( 'colormag_free_major_update_customizer_migration_v1', true );
		}

		/**
		 * Return the value for customize migration on demo import.
		 *
		 * @return bool
		 */
		function colormag_demo_import_migration() {
			if ( isset( $_GET['demo-import-migration'] ) && isset( $_GET['_demo_import_migration_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_GET['_demo_import_migration_nonce'], 'demo_import_migration' ) ) {
					wp_die( __( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
				}

				update_option( 'colormag_demo_import_migration_notice_dismiss', true );
				return true;
			}

			return false;
		}


		/**
		 * @return bool
		 */
		public static function maybe_run_migration() {

			/**
			 * Check migration is already run or not.
			 * If migration is already run then return false.
			 *
			 */
			$migrated = get_option( 'colormag_free_major_update_customizer_migration_v1' );

			if ( $migrated ) {

				return false;
			}

			/**
			 * If user don't import the demo and upgrade the theme.
			 * Then we need to run the migration.
			 *
			 */
			$result     = false;
			$theme_mods = get_theme_mods();

			foreach ( $theme_mods as $key => $_ ) {

				if ( strpos( $key, 'colormag_' ) !== false ) {

					$result = true;
					break;
				}
			}

			return $result;
		}
	}

	new ColorMag_Migration();
}
