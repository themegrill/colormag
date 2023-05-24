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
			add_action( 'after_setup_theme', array( $this, 'colormag_social_icons_control_migrate' ) );
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

			// Main footer layout.
			$old_main_footer_layout = get_theme_mod( 'colormag_main_footer_layout_display_type' );

			if ( $old_main_footer_layout ) {

				if ( 'type_one' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-1';
				} elseif ( 'type_two' === $old_main_footer_layout ) {
					$new_main_footer_layout = 'layout-2';
				} else {
					$new_main_footer_layout = 'layout-1';
				}

				set_theme_mod( 'colormag_main_footer_layout', $new_main_footer_layout );
				remove_theme_mod( 'colormag_main_footer_layout_display_type' );
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

			// Flyout related posts.
			$enable_fly_out_related_post = get_theme_mod( 'colormag_related_post_flyout_setting' );

			// Related posts.
			$enable_related_post = get_theme_mod( 'colormag_related_posts_activate' );

			if ( $enable_related_post ) {
				set_theme_mod( 'colormag_enable_related_posts', true );
			}
			remove_theme_mod( 'colormag_related_posts_activate' );

			// Post Navigation.
			$enable_post_navigation = get_theme_mod( 'colormag_post_navigation_hide' );

			// Lightbox.
			$enable_lightbox = get_theme_mod( 'colormag_featured_image_popup' );

			if ( $enable_lightbox ) {
				set_theme_mod( 'colormag_enable_lightbox', true );
			}
			remove_theme_mod( 'colormag_featured_image_popup' );

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

			// Featured image caption.
			$enable_category_color = get_theme_mod( 'colormag_featured_image_caption_show' );

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