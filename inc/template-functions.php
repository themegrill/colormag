<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function colormag_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'colormag_pingback_header' );

/**
 * Removing the default style of WordPress gallery.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be full from thumbnail to be used in WordPress gallery as a default size.
 *
 * @param array $out   The output array of shortcode attributes.
 * @param array $pairs The supported attributes and their defaults.
 * @param array $atts  The user defined shortcode attributes.
 *
 * @return mixed
 */
function colormag_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts(
		array(
			'size' => 'colormag-featured-image',
		),
		$atts
	);

	$out['size'] = $atts['size'];

	return $out;
}

add_filter( 'shortcode_atts_gallery', 'colormag_gallery_atts', 10, 3 );


/**
 * Removing the more link jumping to middle of content.
 *
 * @param string $link Read More link element.
 *
 * @return string|string[]
 */
function colormag_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );

	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}

	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

add_filter( 'the_content_more_link', 'colormag_remove_more_jump_link' );

/**
 * Creating responsive video for posts/pages.
 *
 * @param string|false $html    The cached HTML result, stored in post meta.
 * @param string       $url     The attempted embed URL.
 * @param array        $attr    An array of shortcode attributes.
 * @param int          $post_ID Post ID.
 *
 * @return string
 */
function colormag_responsive_video( $html, $url, $attr, $post_ID ) {

	if ( ! current_theme_supports( 'responsive-embeds' ) ) {
		return '<div class="fitvids-video">' . $html . '</div>';
	}

	return $html;
}

add_filter( 'embed_oembed_html', 'colormag_responsive_video', 10, 4 );


/**
 * Use of the hooks for Category Color in the archive titles
 *
 * @param string $title Category title.
 *
 * @return string Category page title.
 */
function colormag_colored_category_title( $title ) {

	$output             = '';
	$color_value        = colormag_category_color( get_cat_id( $title ) );
	$color_border_value = colormag_category_color( get_cat_id( $title ) );

	if ( ! empty( $color_value ) ) {
		$output = '<h1 class="cm-page-title" style="border-bottom-color: ' . esc_attr( $color_border_value ) . '"><span style="background-color: ' . esc_attr( $color_value ) . '">' . esc_html( $title ) . '</span></h1>';
	} else {
		$output = '<h1 class="cm-page-title"><span>' . $title . '</span></h1>';
	}

	return $output;
}

/**
 * Filters the single_cat_title.
 *
 * @param string $category_title Category title.
 */
function colormag_category_title_function( $category_title ) {
	add_filter( 'single_cat_title', 'colormag_colored_category_title' );
}

add_action( 'colormag_category_title', 'colormag_category_title_function' );


/**
 * Filter the get_header_image_tag() for option of adding the link back to home page option.
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 *
 * @return string
 */
function colormag_header_image_markup( $html, $header, $attr ) {

	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$output .= '<div class="header-image-wrap">';

		if ( 1 == get_theme_mod( 'colormag_enable_header_image_link_home', 0 ) ) {
			$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
		}

		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . absint( get_custom_header()->width ) . '" height="' . absint( get_custom_header()->height ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';

		if ( 1 == get_theme_mod( 'colormag_enable_header_image_link_home', 0 ) ) {
			$output .= '</a>';
		}

		$output .= '</div>';
	}

	return $output;
}

add_filter( 'get_header_image_tag', 'colormag_header_image_markup', 10, 3 );


/**
 * Filter the body_class.
 *
 * Throwing different body class for the different layouts in the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 *
 * @return array Classes for body.
 */
function colormag_body_class( $classes ) {

	global $post;

	$container_meta = '';
	if ( $post ) {
		$container_meta = get_post_meta( $post->ID, 'colormag_page_container_layout', true );
		$layout_meta = get_post_meta( $post->ID, 'colormag_page_sidebar_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colormag_page_sidebar_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$woocommerce_widgets_enabled           = get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 );
	$colormag_default_sidebar_layout       = get_theme_mod( 'colormag_default_sidebar_layout', 'right_sidebar' );
	$colormag_global_container_layout      = get_theme_mod( 'colormag_global_container_layout', 'no_sidebar_full_width' );
	$colormag_blog_container_layout        = get_theme_mod( 'colormag_blog_container_layout', 'no_sidebar_full_width' );
	$colormag_global_sidebar_layout        = get_theme_mod( 'colormag_global_sidebar_layout', 'no_sidebar' );
	$colormag_search_sidebar_layout        = get_theme_mod( 'colormag_search_sidebar_layout', 'no_sidebar' );
	$colormag_blog_sidebar_layout          = get_theme_mod( 'colormag_blog_sidebar_layout', 'no_sidebar' );
	$colormag_single_post_sidebar_layout   = get_theme_mod( 'colormag_single_post_sidebar_layout', 'no_sidebar' );
	$colormag_single_page_sidebar_layout   = get_theme_mod( 'colormag_single_page_sidebar_layout', 'no_sidebar' );
	$colormag_page_sidebar_layout          = get_theme_mod( 'colormag_page_sidebar_layout', 'right_sidebar' );
	$colormag_default_post_layout          = get_theme_mod( 'colormag_post_sidebar_layout', 'right_sidebar' );
	$colormag_single_post_container_layout = get_theme_mod( 'colormag_single_post_container_layout', 'no_sidebar_full_width' );
	$colormag_single_page_container_layout = get_theme_mod( 'colormag_single_page_container_layout', 'no_sidebar_full_width' );
	$colormag_search_page_container_layout = get_theme_mod( 'colormag_search_container_layout', 'no_sidebar_full_width' );

	/**
	 * Header styles.
	 */
	$header_layout_class = get_theme_mod( 'colormag_main_header_layout', 'layout-1' );

	if ( 'layout-1' === $header_layout_class ) {
		$classes[] = 'cm-header-layout-1 adv-style-1';
	} elseif ( 'layout-2' === $header_layout_class ) {
		$classes[] = 'cm-header-layout-2 adv-style-1';
	} elseif ( 'layout-3' === $header_layout_class ) {
		$classes[] = 'cm-header-layout-3 adv-style-1';
	} elseif ( 'layout-4' === $header_layout_class ) {
		$classes[] = 'cm-header-layout-4 adv-style-1';
	}

	// Proceed only if WooCommerce extra widget option is not enabled as well as
	// Proceed only if WooCommerce is enabled and not in WooCommerce pages.
	if ( 0 == $woocommerce_widgets_enabled || ( 1 == $woocommerce_widgets_enabled && ( function_exists( 'is_woocommerce' ) && ( ! is_woocommerce() ) ) ) ) :
		if ( 'default_layout' === $layout_meta ) {
			if ( is_page() ) {
				if ( 'no_sidebar_full_width' === $colormag_single_page_container_layout ) {
					$classes[] = 'cm-normal-container';
				} elseif ( 'no_sidebar_content_stretched' === $colormag_single_page_container_layout ) {
					$classes[] = 'cm-full-width-container';
				} elseif ( 'no_sidebar_content_centered' === $colormag_single_page_container_layout ) {
					$classes[] = 'cm-narrow-container';
				} elseif ( 'default' === $colormag_single_page_container_layout ) {
					if ( 'no_sidebar_full_width' === $colormag_global_container_layout ) {
						$classes[] = 'cm-normal-container';
					} elseif ( 'no_sidebar_content_stretched' === $colormag_global_container_layout ) {
						$classes[] = 'cm-full-width-container';
					} elseif ( 'no_sidebar_content_centered' === $colormag_global_container_layout ) {
						$classes[] = 'cm-narrow-container';
					}
				}

				if ( 'no_sidebar' === $colormag_single_page_sidebar_layout ) {
					$classes[] = 'cm-no-sidebar';
				} elseif ( 'right_sidebar' === $colormag_single_page_sidebar_layout ) {
					$classes[] = 'cm-right-sidebar right-sidebar';
				} elseif ( 'left_sidebar' === $colormag_single_page_sidebar_layout ) {
					$classes[] = 'cm-left-sidebar left-sidebar';
				} elseif ( 'two_sidebars' === $colormag_single_page_sidebar_layout ) {
					$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
				} elseif ( 'default' === $colormag_single_page_sidebar_layout ) {
					if ( 'no_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-no-sidebar';
					} elseif ( 'right_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-right-sidebar right-sidebar';
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-left-sidebar left-sidebar';
					} elseif ( 'two_sidebars' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
					}
				}
			} elseif ( is_single() ) {
				if ( 'no_sidebar_full_width' === $colormag_single_post_container_layout ) {
					$classes[] = 'cm-normal-container';
				} elseif ( 'no_sidebar_content_stretched' === $colormag_single_post_container_layout ) {
					$classes[] = 'cm-full-width-container';
				} elseif ( 'no_sidebar_content_centered' === $colormag_single_post_container_layout ) {
					$classes[] = 'cm-narrow-container';
				} elseif ( 'default' === $colormag_single_post_container_layout ) {
					if ( 'no_sidebar_full_width' === $colormag_global_container_layout ) {
						$classes[] = 'cm-normal-container';
					} elseif ( 'no_sidebar_content_stretched' === $colormag_global_container_layout ) {
						$classes[] = 'cm-full-width-container';
					} elseif ( 'no_sidebar_content_centered' === $colormag_global_container_layout ) {
						$classes[] = 'cm-narrow-container';
					}
				}

				if ( 'no_sidebar' === $colormag_single_post_sidebar_layout ) {
					$classes[] = 'cm-no-sidebar';
				} elseif ( 'right_sidebar' === $colormag_single_post_sidebar_layout ) {
					$classes[] = 'cm-right-sidebar right-sidebar';
				} elseif ( 'left_sidebar' === $colormag_single_post_sidebar_layout ) {
					$classes[] = 'cm-left-sidebar left-sidebar';
				} elseif ( 'two_sidebars' === $colormag_single_post_sidebar_layout ) {
					$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
				} elseif ( 'default' === $colormag_single_post_sidebar_layout ) {
					if ( 'no_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-no-sidebar';
					} elseif ( 'right_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-right-sidebar right-sidebar';
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-left-sidebar left-sidebar';
					} elseif ( 'two_sidebars' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
					}
				}
			} elseif ( is_search() ) {
				if ( 'no_sidebar_full_width' === $colormag_search_page_container_layout ) {
					$classes[] = 'cm-normal-container';
				} elseif ( 'no_sidebar_content_stretched' === $colormag_search_page_container_layout ) {
					$classes[] = 'cm-full-width-container';
				} elseif ( 'no_sidebar_content_centered' === $colormag_search_page_container_layout ) {
					$classes[] = 'cm-narrow-container';
				} elseif ( 'default' === $colormag_search_page_container_layout ) {
					if ( 'no_sidebar_full_width' === $colormag_global_container_layout ) {
						$classes[] = 'cm-normal-container';
					} elseif ( 'no_sidebar_content_stretched' === $colormag_global_container_layout ) {
						$classes[] = 'cm-full-width-container';
					} elseif ( 'no_sidebar_content_centered' === $colormag_global_container_layout ) {
						$classes[] = 'cm-narrow-container';
					}
				}

				if ( 'no_sidebar' === $colormag_search_sidebar_layout ) {
					$classes[] = 'cm-no-sidebar';
				} elseif ( 'right_sidebar' === $colormag_search_sidebar_layout ) {
					$classes[] = 'cm-right-sidebar right-sidebar';
				} elseif ( 'left_sidebar' === $colormag_search_sidebar_layout ) {
					$classes[] = 'cm-left-sidebar left-sidebar';
				} elseif ( 'two_sidebars' === $colormag_search_sidebar_layout ) {
					$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
				} elseif ( 'default' === $colormag_search_sidebar_layout ) {
					if ( 'no_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-no-sidebar';
					} elseif ( 'right_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-right-sidebar right-sidebar';
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-left-sidebar left-sidebar';
					} elseif ( 'two_sidebars' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
					}
				}
			} else {
				if ( 'no_sidebar_full_width' === $colormag_blog_container_layout ) {
					$classes[] = 'cm-normal-container';
				} elseif ( 'no_sidebar_content_stretched' === $colormag_blog_container_layout ) {
					$classes[] = 'cm-full-width-container';
				} elseif ( 'no_sidebar_content_centered' === $colormag_blog_container_layout ) {
					$classes[] = 'cm-narrow-container';
				} elseif ( 'default' === $colormag_blog_container_layout ) {
					if ( 'no_sidebar_full_width' === $colormag_global_container_layout ) {
						$classes[] = 'cm-normal-container';
					} elseif ( 'no_sidebar_content_stretched' === $colormag_global_container_layout ) {
						$classes[] = 'cm-full-width-container';
					} elseif ( 'no_sidebar_content_centered' === $colormag_global_container_layout ) {
						$classes[] = 'cm-narrow-container';
					}
				}
				if ( 'no_sidebar' === $colormag_blog_sidebar_layout ) {
					$classes[] = 'cm-no-sidebar';
				} elseif ( 'right_sidebar' === $colormag_blog_sidebar_layout ) {
					$classes[] = 'cm-right-sidebar right-sidebar';
				} elseif ( 'left_sidebar' === $colormag_blog_sidebar_layout ) {
					$classes[] = 'cm-left-sidebar left-sidebar';
				} elseif ( 'two_sidebars' === $colormag_blog_sidebar_layout ) {
					$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
				} elseif ( 'default' === $colormag_blog_sidebar_layout ) {
					if ( 'no_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-no-sidebar';
					} elseif ( 'right_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-right-sidebar right-sidebar';
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-left-sidebar left-sidebar';
					} elseif ( 'two_sidebars' === $colormag_global_sidebar_layout ) {
						$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
					}
				}
			}
		} else {
			if ( 'right_sidebar' === $layout_meta ) {
				$classes[] = 'cm-right-sidebar right-sidebar';
			} elseif ( 'left_sidebar' === $layout_meta ) {
				$classes[] = 'cm-left-sidebar left-sidebar';
			} elseif ( 'two_sidebars' === $layout_meta ) {
				$classes[] = 'cm-two-sidebars tg-site-layout--2-sidebars';
			} elseif ( 'no_sidebar' === $layout_meta ) {
				$classes[] = 'cm-no-sidebar';
			}

			if ( 'no_sidebar_full_width' === $container_meta ) {
				$classes[] = 'cm-normal-container';
			} elseif ( 'no_sidebar_content_stretched' === $container_meta ) {
				$classes[] = 'cm-full-width-container';
			} elseif ( 'no_sidebar_content_centered' === $container_meta ) {
				$classes[] = 'cm-narrow-container';
			}
		}

	endif;

	// For site layout option.
	$site_layout = get_theme_mod( 'colormag_container_layout', 'wide' );
	$classes[]   = ( 'wide' == $site_layout ) ? 'wide' : 'boxed';

	// Add body class for header display type.
	$header_display_type = get_theme_mod( 'colormag_header_display_type', 'type_one' );

	// For header display type 2.
	if ( 'type_two' === $header_display_type ) {
		$classes[] = 'header_display_type_one';
	}

	// For header display type 3.
	if ( 'type_three' === $header_display_type ) {
		$classes[] = 'header_display_type_two';
	}

	// Add body class for body skin type.
	if ( 'dark' === get_theme_mod( 'colormag_color_skin_setting', 'white' ) ) {
		$classes[] = 'dark-skin';
	}

	// For background image clickable.
	$background_image_url_link = get_theme_mod( 'colormag_background_image_link' );
	if ( $background_image_url_link ) {
		$classes[] = 'clickable-background-image';
	}

	return $classes;
}

add_filter( 'body_class', 'colormag_body_class' );

/**
 * List of allowed social protocols in HTML attributes.
 *
 * @param array $protocols Array of allowed protocols.
 *
 * @return array
 */
function colormag_allowed_social_protocols( $protocols ) {
	$social_protocols = array(
		'skype',
	);

	return array_merge( $protocols, $social_protocols );
}

add_filter( 'kses_allowed_protocols', 'colormag_allowed_social_protocols' );

/**
 * Filters the columns displayed in the Posts list table.
 *
 * @param string[] $columns An associative array of column headings.
 *
 * @return mixed
 */
function colormag_posts_column_views( $columns ) {

	$columns['post_views'] = esc_html__( 'Total Views', 'colormag' );

	return $columns;
}

add_filter( 'manage_posts_columns', 'colormag_posts_column_views' );

/**
 * Fires in each custom column in the Posts list table.
 *
 * @param string $column_name The name of the column to display.
 * @param int    $post_id     The current post ID.
 */
function colormag_posts_custom_column_views( $column_name, $post_id ) {
	if ( 'post_views' === $column_name ) {
		echo wp_kses_post( colormag_post_view_display( get_the_ID(), false ) );
	}
}

add_action( 'manage_posts_custom_column', 'colormag_posts_custom_column_views', 5, 2 );

/**
 * Adding the custom generated user field.
 *
 * @param int $user User id.
 */
function colormag_extra_user_field( $user ) {
	?>
	<h3><?php esc_html_e( 'User Social Links', 'colormag' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="colormag_twitter"><?php esc_html_e( 'Twitter', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_twitter" id="colormag_twitter"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_twitter', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_facebook"><?php esc_html_e( 'Facebook', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_facebook" id="colormag_facebook"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_facebook', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_google_plus"><?php esc_html_e( 'Google Plus', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_google_plus" id="colormag_google_plus"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_google_plus', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_flickr"><?php esc_html_e( 'Flickr', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_flickr" id="colormag_flickr"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_flickr', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_linkedin"><?php esc_html_e( 'LinkedIn', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_linkedin" id="colormag_linkedin"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_linkedin', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_instagram"><?php esc_html_e( 'Instagram', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_instagram" id="colormag_instagram"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_instagram', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_tumblr"><?php esc_html_e( 'Tumblr', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_tumblr" id="colormag_tumblr"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_tumblr', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="colormag_youtube"><?php esc_html_e( 'Youtube', 'colormag' ); ?></label></th>
			<td>
				<input type="text" name="colormag_youtube" id="colormag_youtube"
						value="<?php echo esc_attr( get_the_author_meta( 'colormag_youtube', $user->ID ) ); ?>"
						class="regular-text"
				/>
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'show_user_profile', 'colormag_extra_user_field' );
add_action( 'edit_user_profile', 'colormag_extra_user_field' );

/**
 * Saving the user field used above for social sites.
 *
 * @param int $user_id User id.
 *
 * @return bool
 */
function colormag_extra_user_field_save_option( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	// Update user meta for Twitter.
	if ( isset( $_POST['colormag_twitter'] ) && wp_unslash( $_POST['colormag_twitter'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_twitter', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_twitter'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_twitter' );
	}

	// Update user meta for Facebook.
	if ( isset( $_POST['colormag_facebook'] ) && wp_unslash( $_POST['colormag_facebook'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_facebook', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_facebook'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_facebook' );
	}

	// Update user meta for Google Plus.
	if ( isset( $_POST['colormag_google_plus'] ) && wp_unslash( $_POST['colormag_google_plus'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_google_plus', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_google_plus'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_google_plus' );
	}

	// Update user meta for Flickr.
	if ( isset( $_POST['colormag_flickr'] ) && wp_unslash( $_POST['colormag_flickr'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_flickr', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_flickr'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_flickr' );
	}

	// Update user meta for LinkedIn.
	if ( isset( $_POST['colormag_linkedin'] ) && wp_unslash( $_POST['colormag_linkedin'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_linkedin', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_linkedin'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_linkedin' );
	}

	// Update user meta for Instagram.
	if ( isset( $_POST['colormag_instagram'] ) && wp_unslash( $_POST['colormag_instagram'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_instagram', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_instagram'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_instagram' );
	}

	// Update user meta for Tumblr.
	if ( isset( $_POST['colormag_tumblr'] ) && wp_unslash( $_POST['colormag_tumblr'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_tumblr', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_tumblr'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_tumblr' );
	}

	// Update user meta for YouTube.
	if ( isset( $_POST['colormag_youtube'] ) && wp_unslash( $_POST['colormag_youtube'] ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		update_user_meta( $user_id, 'colormag_youtube', wp_filter_nohtml_kses( wp_unslash( $_POST['colormag_youtube'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	} else {
		delete_user_meta( $user_id, 'colormag_youtube' );
	}
}

add_action( 'personal_options_update', 'colormag_extra_user_field_save_option' );
add_action( 'edit_user_profile_update', 'colormag_extra_user_field_save_option' );

if ( ! function_exists( 'colormag_get_icon' ) ) :

	/**
	 * Get SVG icon.
	 *
	 * @param string $icon Default is empty.
	 * @param bool $echo Default is true.
	 * @param array $args Default is empty.
	 *
	 * @return string|null
	 */
	function colormag_get_icon( $icon = '', $echo = true, $args = array() ) {
		return ColorMag_SVG_Icons::get_svg( $icon, $echo, $args );
	}
endif;

if ( ! function_exists( 'colormag_css_class' ) ) :

	/**
	 * Adds css classes to elements dynamically.
	 *
	 * @param string $tag Filter tag name.
	 *
	 * TODO: deprecate this function to ColorMag_Dynamic_Filter
	 *
	 * @return string CSS classes.
	 */
	function colormag_css_class( $tag, $echo = true ) {

		// Get list of css classes in array for the `$tag` aka element.
		$classes = ColorMag_Dynamic_Filter::filter_via_tag( $tag );

		// Filter for the element classes.
		$classes = apply_filters( $tag, $classes );

		// Remove duplicate classes if any.
		$classes = array_unique( $classes );

		// Output in string format.
		if ( true === $echo ) {

			echo esc_attr( join( ' ', $classes ) );
		} else {

			return join( ' ', $classes );
		}
	}
endif;
