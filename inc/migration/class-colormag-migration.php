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

			if ( self::maybe_run_migration() || self::colormag_demo_import_migration() ) {
				add_action( 'after_setup_theme', array( $this, 'colormag_social_icons_control_migrate' ) );
				add_action( 'after_setup_theme', array( $this, 'colormag_free_major_update_customizer_migration_v1' ) );
			}

			$enable_builder = get_theme_mod( 'colormag_enable_builder', '' );
			add_action( 'themegrill_ajax_demo_imported', [ $this, 'colormag_builder_migration' ], 25 );
			if ( $enable_builder ) {
				add_action( 'after_setup_theme', [ $this, 'colormag_builder_migration' ], 25 );
			}

			add_action( 'after_setup_theme', [ $this, 'colormag_outside_background_migration' ], 25 );
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
		 * Migrate all the customize options for 3.0.0 theme update.
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
		 * Migrate customizer options to builder options.
		 *
		 * @package ColorMag
		 *
		 * @since 3.0.0
		 */
		public function colormag_builder_migration() {

			if ( get_option( 'colormag_builder_migration' ) && ! doing_action( 'themegrill_ajax_demo_imported' ) ) {
				return;
			}

			$header_builder_config = [
				'desktop' => array(
					'top'    => array(
						'left'   => array(),
						'center' => array(),
						'right'  => array(),
					),
					'main'   => array(
						'left'   => array(
							'logo',
						),
						'center' => array(),
						'right'  => array(),
					),
					'bottom' => array(
						'left'   => array( 'primary-menu' ),
						'center' => array(),
						'right'  => array(),
					),
				),
				'mobile'  => array(
					'top'    => array(
						'left'   => array(),
						'center' => array(),
						'right'  => array(),
					),
					'main'   => array(
						'left'   => array(),
						'center' => array(),
						'right'  => array(),
					),
					'bottom' => array(
						'left'   => array(
							'toggle-button',
						),
						'center' => array(),
						'right'  => array(),
					),
				),
				'offset'  => array(
					'mobile-menu',
				),
			];

			$main_header_layout = get_theme_mod( 'colormag_main_header_layout', 'layout-1' );
			$home_icon          = get_theme_mod( 'colormag_menu_icon_logo', 'icon' );
			$search_enable      = get_theme_mod( 'colormag_enable_search', 0 );
			$random_enable      = get_theme_mod( 'colormag_enable_random_post', 0 );

			if ( 'layout-1' === $main_header_layout ) {
				$main_header_layout_1_style_alignment = get_theme_mod( 'colormag_header_display_type', 'type_one' );
				if ( 'type_one' === $main_header_layout_1_style_alignment ) {
					$bottom_left = [];
					self::remove_component( 'logo', $header_builder_config );
					$header_builder_config['desktop']['main']['left'][] = 'logo';

					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						self::remove_component( 'widget-1', $header_builder_config );
						$header_builder_config['desktop']['main']['right'][] = 'widget-1';
						$header_builder_config['mobile']['main']['center'][] = 'widget-1';
					}

					if ( 'home-icon' === $home_icon ) {
						self::remove_component( 'home-icon', $header_builder_config );
						$bottom_left[] = 'home-icon';
					}
					self::remove_component( 'primary-menu', $header_builder_config );
					$bottom_left[]                                      = 'primary-menu';
					$header_builder_config['desktop']['bottom']['left'] = $bottom_left;

					if ( $search_enable ) {
						self::remove_component( 'search', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'search';
					}

					if ( $random_enable ) {
						self::remove_component( 'random', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'random';
					}
				} elseif ( 'type_three' === $main_header_layout_1_style_alignment ) {
					$bottom_left = [];
					self::remove_component( 'logo', $header_builder_config );
					$header_builder_config['desktop']['main']['center'][] = 'logo';

					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						self::remove_component( 'widget-1', $header_builder_config );
						$header_builder_config['desktop']['main']['center'][] = 'widget-1';
						$header_builder_config['mobile']['main']['center'][]  = 'widget-1';
					}

					if ( 'home-icon' === $home_icon ) {
						self::remove_component( 'primary-menu', $header_builder_config );
						$bottom_left[] = 'home-icon';
					}
					$bottom_left[]                                      = 'primary-menu';
					$header_builder_config['desktop']['bottom']['left'] = $bottom_left;

					if ( $search_enable ) {
						self::remove_component( 'search', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'search';
					}

					if ( $random_enable ) {
						self::remove_component( 'random', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'random';
					}
				} elseif ( 'type_two' === $main_header_layout_1_style_alignment ) {
					$bottom_left = [];
					self::remove_component( 'logo', $header_builder_config );
					$header_builder_config['desktop']['main']['right'][] = 'logo';

					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						self::remove_component( 'widget-1', $header_builder_config );
						$header_builder_config['desktop']['main']['left'][]  = 'widget-1';
						$header_builder_config['mobile']['main']['center'][] = 'widget-1';
					}

					if ( 'home-icon' === $home_icon ) {
						self::remove_component( 'home-icon', $header_builder_config );
						$bottom_left[] = 'home-icon';
					}
					self::remove_component( 'primary-menu', $header_builder_config );
					$bottom_left[]                                      = 'primary-menu';
					$header_builder_config['desktop']['bottom']['left'] = $bottom_left;

					if ( $search_enable ) {
						self::remove_component( 'search', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'search';
					}

					if ( $random_enable ) {
						self::remove_component( 'random', $header_builder_config );
						$header_builder_config['desktop']['bottom']['right'][] = 'random';
					}
				}
			} elseif ( 'layout-2' === $main_header_layout ) {
				$bottom_left = [];
				self::remove_component( 'logo', $header_builder_config );
				$header_builder_config['desktop']['main']['center'][] = 'logo';

				if ( 'home-icon' === $home_icon ) {
					self::remove_component( 'home-icon', $header_builder_config );
					$bottom_left[] = 'home-icon';
				}
				self::remove_component( 'primary-menu', $header_builder_config );
				$bottom_left[]                                      = 'primary-menu';
				$header_builder_config['desktop']['bottom']['left'] = $bottom_left;

				if ( $search_enable ) {
					self::remove_component( 'search', $header_builder_config );
					$header_builder_config['desktop']['bottom']['right'][] = 'search';
				}

				if ( $random_enable ) {
					self::remove_component( 'random', $header_builder_config );
					$header_builder_config['desktop']['bottom']['right'][] = 'random';
				}
			}

			$top_bar_enable     = get_theme_mod( 'colormag_enable_top_bar', 0 );
			$date_enable        = get_theme_mod( 'colormag_date_display', false );
			$news_ticker_enable = get_theme_mod( 'colormag_enable_news_ticker', 0 );
			$social_enable      = get_theme_mod( 'colormag_enable_social_icons', 0 );
			if ( $top_bar_enable ) {
				if ( $date_enable ) {
					$header_builder_config['desktop']['top']['left'][] = 'date';
				}

				if ( $news_ticker_enable ) {
					$header_builder_config['desktop']['top']['left'][] = 'news-ticker';
				}

				if ( $social_enable ) {
					$header_builder_config['desktop']['top']['right'][] = 'socials';
				}
			}

			$header_builder_config['mobile']['main']['center'][] = 'logo';
			if ( count( $header_builder_config['mobile']['main']['center'] ) > 1 ) {
				$mobile_builder_first                                 = $header_builder_config['mobile']['main']['center'][0];
				$header_builder_config['mobile']['main']['center'][0] = $header_builder_config['mobile']['main']['center'][1];
				$header_builder_config['mobile']['main']['center'][1] = $mobile_builder_first;
			}

			set_theme_mod( 'colormag_header_builder', $header_builder_config );

			// Footer builder migration.
			$footer_builder_config = [
				'desktop' => [
					'top'    => [
						'top-1' => [],
						'top-2' => [],
						'top-3' => [],
						'top-4' => [],
						'top-5' => [],
					],
					'main'   => [
						'main-1' => [],
						'main-2' => [],
						'main-3' => [],
						'main-4' => [],
						'main-5' => [],
					],
					'bottom' => [
						'bottom-1' => [],
						'bottom-2' => [],
						'bottom-3' => [],
						'bottom-4' => [],
						'bottom-5' => [],
					],
				],
				'offset'  => [],
			];

			if ( is_active_sidebar( 'colormag_footer_sidebar_one_upper' ) ) {
				$footer_builder_config['desktop']['top']['top-1'][] = 'widget-1';
			}

			if ( is_active_sidebar( 'colormag_footer_sidebar_two_upper' ) ) {
				$footer_builder_config['desktop']['top']['top-2'][] = 'widget-2';
			}

			if ( is_active_sidebar( 'colormag_footer_sidebar_three_upper' ) ) {
				$footer_builder_config['desktop']['top']['top-3'][] = 'widget-3';
			}

			$footer_column_layout = get_theme_mod( 'colormag_footer_column_layout', 'style-4' );
			if ( 'style-1' === $footer_column_layout ) {
				set_theme_mod( 'colormag_footer_main_area_cols', 1 );
				if ( is_active_sidebar( 'colormag_footer_sidebar_one' ) ) {
					$footer_builder_config['desktop']['main']['main-1'][] = 'widget-4';
				}
			} elseif ( 'style-2' === $footer_column_layout ) {
				set_theme_mod( 'colormag_footer_main_area_cols', 2 );
				if ( is_active_sidebar( 'colormag_footer_sidebar_one' ) ) {
					$footer_builder_config['desktop']['main']['main-1'][] = 'widget-4';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_two' ) ) {
					$footer_builder_config['desktop']['main']['main-2'][] = 'widget-5';
				}
			} elseif ( 'style-3' === $footer_column_layout ) {
				set_theme_mod( 'colormag_footer_main_area_cols', 3 );
				if ( is_active_sidebar( 'colormag_footer_sidebar_one' ) ) {
					$footer_builder_config['desktop']['main']['main-1'][] = 'widget-4';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_two' ) ) {
					$footer_builder_config['desktop']['main']['main-2'][] = 'widget-5';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_three' ) ) {
					$footer_builder_config['desktop']['main']['main-3'][] = 'widget-6';
				}
			} elseif ( 'style-4' === $footer_column_layout ) {
				set_theme_mod( 'colormag_footer_main_area_cols', 4 );
				if ( is_active_sidebar( 'colormag_footer_sidebar_one' ) ) {
					$footer_builder_config['desktop']['main']['main-1'][] = 'widget-4';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_two' ) ) {
					$footer_builder_config['desktop']['main']['main-2'][] = 'widget-5';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_three' ) ) {
					$footer_builder_config['desktop']['main']['main-3'][] = 'widget-6';
				}
				if ( is_active_sidebar( 'colormag_footer_sidebar_four' ) ) {
					$footer_builder_config['desktop']['main']['main-4'][] = 'widget-7';
				}
			}

			$footer_bar_alignment       = get_theme_mod( 'colormag_footer_bar_alignment', 'left' );
			$social_icons_enable        = get_theme_mod( 'colormag_enable_social_icons', false );
			$social_icons_footer_enable = get_theme_mod( 'colormag_enable_social_icons_footer', true );
			if ( 'left' === $footer_bar_alignment ) {
				$footer_builder_config['desktop']['bottom']['bottom-1'] = [ 'copyright' ];
				if ( $social_icons_enable ) {
					if ( $social_icons_footer_enable ) {
						$footer_builder_config['desktop']['bottom']['bottom-2'] = [ 'socials' ];
					}
				}
			} elseif ( 'right' === $footer_column_layout ) {
				if ( $social_icons_enable ) {
					if ( $social_icons_footer_enable ) {
						$footer_builder_config['desktop']['bottom']['bottom-1'] = [ 'socials' ];
					}
				}
				$footer_builder_config['desktop']['bottom']['bottom-2'] = [ 'copyright' ];

			} elseif ( 'center' === $footer_column_layout ) {
				set_theme_mod( 'colormag_footer_bottom_area_cols', 1 );
				$footer_builder_config['desktop']['bottom']['bottom-1'][] = 'copyright';
				if ( $social_icons_enable ) {
					if ( $social_icons_footer_enable ) {
						$footer_builder_config['desktop']['bottom']['bottom-1'][] = 'socials';
					}
				}
			}

			// Social links lists.
			$social_links_count    = 70;
			$colormag_social_links = array(
				'colormag_social_facebook'  => array(
					'id'      => 'colormag_social_facebook',
					'title'   => esc_html__( 'Facebook', 'colormag' ),
					'default' => '',
				),
				'colormag_social_twitter'   => array(
					'id'      => 'colormag_social_twitter',
					'title'   => esc_html__( 'Twitter', 'colormag' ),
					'default' => '',
				),
				'colormag_social_instagram' => array(
					'id'      => 'colormag_social_instagram',
					'title'   => esc_html__( 'Instagram', 'colormag' ),
					'default' => '',
				),
				'colormag_social_pinterest' => array(
					'id'      => 'colormag_social_pinterest',
					'title'   => esc_html__( 'Pinterest', 'colormag' ),
					'default' => '',
				),
				'colormag_social_youtube'   => array(
					'id'      => 'colormag_social_youtube',
					'title'   => esc_html__( 'YouTube', 'colormag' ),
					'default' => '',
				),
			);

			$all_social_links = [];
			foreach ( $colormag_social_links as $colormag_social_link ) {
				$have_url = get_theme_mod( $colormag_social_link['id'] );

				if ( $have_url ) {
					// Extract the social media name from the ID
					$social_name = str_replace( 'colormag_social_', '', $colormag_social_link['id'] );

					$icon = $social_name;

					if ( 'twitter' === $social_name ) {
						$icon = 'x-twitter';
					} elseif ( 'instagram' === $social_name ) {
						$icon = 'square-instagram';
					}

					$footer_social_value = array(
						'id'    => uniqid(),
						'label' => $social_name,
						'url'   => $have_url,
						'icon'  => 'fa-brands fa-' . $icon,
					);

					// You might want to add this value to a larger array of social links
					$all_social_links[] = $footer_social_value;
				}
			}

			set_theme_mod( 'colormag_footer_socials', $all_social_links );

			set_theme_mod( 'colormag_footer_builder', $footer_builder_config );

			// Option migration.
			$top_bar_background = get_theme_mod( 'colormag_top_bar_background_color', '' );
			if ( $top_bar_background ) {
				$top_bar_background_value = array(
					'background-color'      => $top_bar_background,
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'contain',
					'background-attachment' => 'scroll',
				);

				set_theme_mod( 'colormag_header_top_area_background', $top_bar_background_value );
				remove_theme_mod( 'colormag_top_bar_background_color' );
			}

			$site_title_color = get_theme_mod( 'colormag_site_title_color', '' );
			if ( $site_title_color ) {
				set_theme_mod( 'colormag_header_site_identity_color', $site_title_color );
				remove_theme_mod( 'colormag_site_title_color' );
			}

			$site_title_hover_color = get_theme_mod( 'colormag_site_title_hover_color', '' );
			if ( $site_title_hover_color ) {
				set_theme_mod( 'colormag_header_site_identity_hover_color', $site_title_hover_color );
				remove_theme_mod( 'colormag_site_title_hover_color' );
			}

			$site_title_typography = get_theme_mod( 'colormag_site_title_typography', '' );
			if ( $site_title_typography ) {
				set_theme_mod( 'colormag_header_site_title_typography', $site_title_typography );
				remove_theme_mod( 'colormag_site_title_typography' );
			}

			$site_tagline_color = get_theme_mod( 'colormag_site_tagline_color', '' );
			if ( $site_tagline_color ) {
				set_theme_mod( 'colormag_header_site_tagline_color', $site_tagline_color );
				remove_theme_mod( 'colormag_site_tagline_color' );
			}

			$site_tagline_typography = get_theme_mod( 'colormag_site_tagline_typography', '' );
			if ( $site_tagline_typography ) {
				set_theme_mod( 'colormag_header_site_tagline_typography', $site_tagline_typography );
				remove_theme_mod( 'colormag_site_tagline_typography' );
			}

			$main_header_background = get_theme_mod( 'colormag_main_header_background', '' );
			if ( $main_header_background ) {
				set_theme_mod( 'colormag_header_main_area_background', $main_header_background );
				remove_theme_mod( 'colormag_main_header_background' );
			}

			$main_header_width = get_theme_mod( 'colormag_main_header_width_setting', 'full-width' );
			if ( $main_header_width ) {
				set_theme_mod( 'colormag_main_header_width_setting', $main_header_width );
				remove_theme_mod( 'colormag_main_header_width_setting' );
			}

			$primary_menu_bg = get_theme_mod(
				'colormag_primary_menu_background',
				array(
					'background-color'      => '#27272A',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				)
			);
			if ( $primary_menu_bg ) {
				set_theme_mod( 'colormag_header_bottom_area_background', $primary_menu_bg );
				remove_theme_mod( 'colormag_primary_menu_background' );
			}

			$primary_menu_border = get_theme_mod(
				'colormag_primary_menu_top_border_width',
				array(
					'size'  => '4',
					'units' => 'px',
				)
			);
			if ( $primary_menu_border ) {
				$value = array(
					'top'    => $primary_menu_border['size'],
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				);
				set_theme_mod( 'colormag_header_bottom_area_border_width', $value );
				remove_theme_mod( 'colormag_primary_menu_top_border_width' );
			}

			$primary_menu_border_color = get_theme_mod( 'colormag_primary_menu_top_border_color' );
			$primary_color             = get_theme_mod( 'colormag_primary_color' );
			if ( $primary_menu_border_color ) {
				set_theme_mod( 'colormag_header_bottom_area_border_color', $primary_menu_border_color );
				remove_theme_mod( 'colormag_primary_menu_top_border_color' );
			} else {
				set_theme_mod( 'colormag_header_bottom_area_border_color', $primary_color );
			}

			$primary_menu_color = get_theme_mod( 'colormag_primary_menu_text_color' );
			if ( $primary_menu_color ) {
				set_theme_mod( 'colormag_header_primary_menu_text_color', $primary_menu_color );
				remove_theme_mod( 'colormag_primary_menu_text_color' );
			}

			$primary_menu_hover_color = get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color' );
			if ( $primary_menu_hover_color ) {
				set_theme_mod( 'colormag_header_primary_menu_selected_hovered_text_color', $primary_menu_hover_color );
				remove_theme_mod( 'colormag_primary_menu_selected_hovered_text_color' );
			}

			$primary_menu_typo = get_theme_mod( 'colormag_primary_menu_typography' );
			if ( $primary_menu_typo ) {
				set_theme_mod( 'colormag_header_primary_menu_typography', $primary_menu_typo );
				remove_theme_mod( 'colormag_primary_menu_typography' );
			}

			$primary_sub_menu_bg = get_theme_mod(
				'colormag_primary_sub_menu_background',
				array(
					'background-color'      => '#232323',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				)
			);

			if ( $primary_sub_menu_bg ) {
				set_theme_mod( 'colormag_header_primary_sub_menu_background', $primary_sub_menu_bg );
				remove_theme_mod( 'colormag_primary_sub_menu_background' );
			}

			$primary_sub_menu_typography = get_theme_mod( 'colormag_primary_sub_menu_typography' );
			if ( $primary_sub_menu_typography ) {
				set_theme_mod( 'colormag_primary_sub_menu_typography', $primary_sub_menu_typography );
				remove_theme_mod( 'colormag_primary_sub_menu_typography' );
			}

			$header_toggle_color = get_theme_mod( 'colormag_mobile_menu_toggle_icon_color', '#fff' );
			if ( $header_toggle_color ) {
				set_theme_mod( 'colormag_header_builder_toggle_button_color', $header_toggle_color );
				remove_theme_mod( 'colormag_mobile_menu_toggle_icon_color' );
			}

			$mobile_menu_text_color = get_theme_mod( 'colormag_mobile_menu_text_color' );
			if ( $mobile_menu_text_color ) {
				set_theme_mod( 'colormag_header_mobile_menu_item_color', $mobile_menu_text_color );
				remove_theme_mod( 'colormag_mobile_menu_text_color' );
			}

			$mobile_menu_text_hover_color = get_theme_mod( 'colormag_mobile_menu_selected_hovered_text_color' );
			if ( $mobile_menu_text_hover_color ) {
				set_theme_mod( 'colormag_header_mobile_menu_item_hover_color', $mobile_menu_text_hover_color );
				remove_theme_mod( 'colormag_mobile_menu_selected_hovered_text_color' );
			}

			$mobile_typography = get_theme_mod( 'colormag_mobile_menu_typography' );
			if ( $mobile_typography ) {
				set_theme_mod( 'colormag_header_mobile_menu_typography', $mobile_typography );
				remove_theme_mod( 'colormag_mobile_menu_typography' );
			}

			$header_action_color = get_theme_mod( 'colormag_header_action_icon_color', '#fff' );
			if ( $header_action_color ) {
				set_theme_mod( 'colormag_header_search_icon_color', $header_action_color );
				set_theme_mod( 'colormag_header_random_icon_color', $header_action_color );
				remove_theme_mod( 'colormag_header_action_icon_color' );
			}

			$header_action_hover_color = get_theme_mod( 'colormag_header_action_icon_hover_color', '' );
			if ( $header_action_hover_color ) {
				set_theme_mod( 'colormag_header_search_icon_hover_color', $header_action_hover_color );
				set_theme_mod( 'colormag_header_random_icon_hover_color', $header_action_hover_color );
				remove_theme_mod( 'colormag_header_action_icon_hover_color' );
			}

			$footer_background = get_theme_mod( 'colormag_footer_background', '' );

			if ( $footer_background ) {
				set_theme_mod( 'colormag_footer_top_area_background', $footer_background );
				set_theme_mod( 'colormag_footer_main_area_background', $footer_background );
				remove_theme_mod( 'colormag_footer_background' );
			}

			$upper_footer_background = get_theme_mod( 'colormag_upper_footer_background', '' );
			if ( $upper_footer_background ) {
				set_theme_mod( 'colormag_footer_top_area_widget_background', $upper_footer_background );
				remove_theme_mod( 'colormag_upper_footer_background' );
			}

			$widget_title_color = get_theme_mod( 'colormag_footer_widget_title_color', '' );
			if ( $widget_title_color ) {
				set_theme_mod( 'colormag_footer_widget_1_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_2_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_3_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_4_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_5_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_6_title_color', $widget_title_color );
				set_theme_mod( 'colormag_footer_widget_7_title_color', $widget_title_color );
				remove_theme_mod( 'colormag_footer_widget_title_color' );
			}

			$widget_content_color = get_theme_mod( 'colormag_footer_widget_content_color', '' );
			if ( $widget_content_color ) {
				set_theme_mod( 'colormag_footer_widget_1_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_2_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_3_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_4_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_5_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_6_content_color', $widget_content_color );
				set_theme_mod( 'colormag_footer_widget_7_content_color', $widget_content_color );
				remove_theme_mod( 'colormag_footer_widget_content_color' );
			}

			$widget_link_color = get_theme_mod( 'colormag_footer_widget_content_link_text_color', '' );
			if ( $widget_link_color ) {
				set_theme_mod( 'colormag_footer_widget_1_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_2_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_3_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_4_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_5_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_6_link_color', $widget_link_color );
				set_theme_mod( 'colormag_footer_widget_7_link_color', $widget_link_color );
				remove_theme_mod( 'colormag_footer_widget_content_link_text_color' );
			}

			$widget_link_hover_color = get_theme_mod( 'colormag_footer_widget_content_link_text_hover_color', '' );
			if ( $widget_link_hover_color ) {
				set_theme_mod( 'colormag_footer_widget_1_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_2_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_3_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_4_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_5_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_6_link_hover_color', $widget_link_hover_color );
				set_theme_mod( 'colormag_footer_widget_7_link_hover_color', $widget_link_hover_color );
				remove_theme_mod( 'colormag_footer_widget_content_link_text_hover_color' );
			}

			$footer_bar_bg_color = get_theme_mod( 'colormag_footer_copyright_background', '' );
			if ( $footer_bar_bg_color ) {
				set_theme_mod( 'colormag_footer_bottom_area_background', $footer_bar_bg_color );
				remove_theme_mod( 'colormag_footer_copyright_background' );
			}

			$footer_bar_text_color = get_theme_mod( 'colormag_footer_copyright_text_color', '' );
			if ( $footer_bar_text_color ) {
				set_theme_mod( 'colormag_footer_copyright_text_color', $footer_bar_text_color );
				remove_theme_mod( 'colormag_footer_copyright_text_color' );
			}

			$footer_bar_link_color = get_theme_mod( 'colormag_footer_copyright_link_text_color', '' );
			if ( $footer_bar_link_color ) {
				set_theme_mod( 'colormag_footer_copyright_link_color', $footer_bar_link_color );
				remove_theme_mod( 'colormag_footer_copyright_link_text_color' );
			}

			// Social links lists.
			$social_links_count    = 70;
			$colormag_social_links = array(
				'colormag_social_facebook'  => array(
					'id'      => 'colormag_social_facebook',
					'title'   => esc_html__( 'Facebook', 'colormag' ),
					'default' => '',
				),
				'colormag_social_twitter'   => array(
					'id'      => 'colormag_social_twitter',
					'title'   => esc_html__( 'Twitter', 'colormag' ),
					'default' => '',
				),
				'colormag_social_instagram' => array(
					'id'      => 'colormag_social_instagram',
					'title'   => esc_html__( 'Instagram', 'colormag' ),
					'default' => '',
				),
				'colormag_social_pinterest' => array(
					'id'      => 'colormag_social_pinterest',
					'title'   => esc_html__( 'Pinterest', 'colormag' ),
					'default' => '',
				),
				'colormag_social_youtube'   => array(
					'id'      => 'colormag_social_youtube',
					'title'   => esc_html__( 'YouTube', 'colormag' ),
					'default' => '',
				),
			);

			$all_social_links = [];
			foreach ( $colormag_social_links as $colormag_social_link ) {
				$have_url = get_theme_mod( $colormag_social_link['id'] );

				if ( $have_url ) {
					// Extract the social media name from the ID
					$social_name = str_replace( 'colormag_social_', '', $colormag_social_link['id'] );

					$icon = $social_name;

					if ( 'twitter' === $social_name ) {
						$icon = 'x-twitter';
					} elseif ( 'instagram' === $social_name ) {
						$icon = 'square-instagram';
					}

					$footer_social_value = array(
						'id'    => uniqid(),
						'label' => $social_name,
						'url'   => $have_url,
						'icon'  => 'fa-brands fa-' . $icon,
					);

					// You might want to add this value to a larger array of social links
					$all_social_links[] = $footer_social_value;
				}
			}

			set_theme_mod( 'colormag_header_socials', $all_social_links );
			set_theme_mod( 'colormag_footer_socials', $all_social_links );

			update_option( 'colormag_builder_migration', true );
		}

		/**
		 * Migrates outside background settings to a new theme mod.
		 *
		 * This function handles the migration of various background-related theme mods
		 * to a single, consolidated theme mod. It performs the following operations:
		 *
		 * 1. Checks if the migration has already been performed to avoid duplicate migrations.
		 * 2. Retrieves individual background-related theme mods (color, image, preset, position, size, repeat, attachment).
		 * 3. If any of these theme mods exist, it consolidates them into a single array.
		 * 4. Sets the new consolidated theme mod 'elearning_outside_container_background'.
		 * 5. Removes the old individual theme mods.
		 * 6. Updates an option to mark the migration as complete.
		 *
		 * This migration is necessary to update the theme's handling of background settings,
		 * moving from individual settings to a more flexible, consolidated approach.
		 *
		 * @return void
		 *
		 * @since 4.0.9
		 */
		public function colormag_outside_background_migration() {

			if ( get_option( 'colormag_outside_background_migration' ) ) {
				return;
			}

			$background_color      = get_theme_mod( 'background_color' );
			$background_image      = get_theme_mod( 'background_image' );
			$background_preset     = get_theme_mod( 'background_preset' );
			$background_position   = get_theme_mod( 'background_position' );
			$background_size       = get_theme_mod( 'background_size' );
			$background_repeat     = get_theme_mod( 'background_repeat' );
			$background_attachment = get_theme_mod( 'background_attachment' );

			if ( $background_color || $background_image || $background_preset || $background_position || $background_size || $background_repeat || $background_attachment ) {
				$background_value = array(
					'background-color'      => $background_color,
					'background-image'      => $background_image,
					'background-repeat'     => $background_repeat,
					'background-position'   => $background_position,
					'background-size'       => $background_size,
					'background-attachment' => $background_attachment,
				);

				set_theme_mod( 'colormag_outside_container_background', $background_value );
				remove_theme_mod( 'background_color' );
				remove_theme_mod( 'background_image' );
				remove_theme_mod( 'background_preset' );
				remove_theme_mod( 'background_position' );
				remove_theme_mod( 'background_size' );
				remove_theme_mod( 'background_attachment' );
				remove_theme_mod( 'background_repeat' );
			}

			update_option( 'colormag_outside_background_migration', true );
		}

		/**
		 * Recursively removes a specified component from an array.
		 *
		 * This static function traverses through a multidimensional array and removes
		 * all occurrences of a specified component. It performs the following operations:
		 *
		 * 1. Iterates through each element of the input array.
		 * 2. If an element is an array, it recursively calls itself on that sub-array.
		 * 3. If an element matches the component to remove, it unsets that element.
		 * 4. After processing, if the array keys are sequential integers, it reindexes the array.
		 *
		 * @param mixed $component_to_remove The component to be removed from the array.
		 * @param array &$_array             The array to remove the component from (passed by reference).
		 *
		 * @return void The function modifies the input array directly.
		 *
		 * @since 4.0.0
		 */
		public static function remove_component( $component_to_remove, &$_array ) {
			foreach ( $_array as $key => &$value ) {
				if ( is_array( $value ) ) {
					self::remove_component( $component_to_remove, $value );
				} else { // phpcs:ignore
					if ( $value === $component_to_remove ) {
						unset( $_array[ $key ] );
					}
				}
			}
			if ( array_values( $_array ) === $_array ) {
				$_array = array_values( $_array );
			}
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
		 * Determines whether to run the customizer migration.
		 *
		 * This static function checks if the customizer migration needs to be executed.
		 * It performs the following checks:
		 *
		 * 1. Verifies if the migration has already been run by checking a specific option.
		 * 2. If the migration has been run before, it returns false.
		 * 3. If not previously migrated, it checks for the presence of old theme mods.
		 * 4. Specifically looks for theme mods with the 'colormag_' prefix.
		 *
		 * The function is designed to prevent unnecessary migrations and ensure
		 * that the migration only runs when old theme data is present.
		 *
		 * @return bool Returns true if migration should be run, false otherwise.
		 *
		 */
		public static function maybe_run_migration() {

			/**
			 * Check migration is already run or not.
			 * If migration is already run then return false.
			 *
			 */
			$migrated = get_option( 'colormag_free_major_update_customizer_migration_v1' ) || get_theme_mod( 'colormag_enable_builder' );

			if ( $migrated || wp_doing_ajax() ) {

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
