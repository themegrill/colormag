<?php
/**
 * Custom template tags for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_entry_meta' ) ) :

	/**
	 * Shows meta information of post.
	 *
	 * @param bool $full_post_meta       Whether to display full post meta or not.
	 * @param bool $reading_time_display Whether to display reading time post meta or not, used for Ajax call.
	 */
	function colormag_entry_meta( $full_post_meta = true, $reading_time_display = false, $type = 'blog' ) {
		$human_diff_time = '';
		if ( 'blog' === $type ) {
			$meta_orders = get_theme_mod(
				'colormag_blog_post_meta_structure',
				array(
					'date',
					'author',
				)
			);
			if ( get_theme_mod( 'colormag_blog_post_meta_date_style', 'style-1' ) == 'style-2' ) {
				$human_diff_time = 'human-diff-time';
			}
		} elseif ( 'single_post' === $type ) {
			$meta_orders = get_theme_mod(
				'colormag_single_post_meta_structure',
				array(
					'date',
					'author',
				)
			);
			if ( get_theme_mod( 'colormag_single_post_meta_date_style', 'style-1' ) == 'style-2' ) {
				$human_diff_time = 'human-diff-time';
			}
		} elseif ( 'search' === $type ) {
			$meta_orders = get_theme_mod(
				'colormag_search_page_meta_structure',
				array(
					'date',
					'author',
				)
			);
			if ( get_theme_mod( 'colormag_search_page_meta_date_style', 'style-1' ) == 'style-2' ) {
				$human_diff_time = 'human-diff-time';
			}
		}

		$post_meta_separator_type = get_theme_mod( 'colormag_blog_post_meta_separator_type', 'default' );
		if ( 'default' !== $post_meta_separator_type ) {
			$post_meta_separator_class = 'cm-separator';
		} else {
			$post_meta_separator_class = '';
		}

		echo '<div class="cm-below-entry-meta ' . 'cm-separator-' . $post_meta_separator_type . ' ' . $post_meta_separator_class . esc_attr( $human_diff_time ) . '">';

		if ( 'post' === get_post_type() ) :

			foreach ( $meta_orders as $key => $meta_order ) {

				if ( 'date' === $meta_order ) {
					colormag_date_meta_markup();
				}

				if ( 'author' === $meta_order ) {
					colormag_author_meta_markup( $type );
				}

				if ( 'views' === $meta_order && $full_post_meta ) {
					echo wp_kses(
						colormag_post_view_display( get_the_ID() ),
						array(
							'span' => array(
								'class' => true,
							),
						) + ColorMag_SVG_Icons::$allowed_html
					);
				}

				if ( 'comments' === $meta_order ) {
					colormag_comment_meta_markup( $full_post_meta );
				}

				if ( 'tags' === $meta_order && $full_post_meta ) {
					colormag_tags_meta_markup();
				}

				if ( 'read-time' === $meta_order ) {
					colormag_read_time_meta_markup( $full_post_meta, $reading_time_display );
				}

				if ( 'edit-button' === $meta_order && $full_post_meta ) {
					edit_post_link( __( 'Edit', 'colormag' ), '<span class="cm-edit-link">' . colormag_get_icon( 'edit', false ) . ' ', '</span>' );
				}
			}

		endif;

		echo '</div>';
	}

endif;


if ( ! function_exists( 'wp_body_open' ) ) :

	/**
	 * Adds backwards compatibility for wp_body_open() introduced with WordPress 5.2.
	 *
	 * @return void
	 * @see   https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}

endif;


if ( ! function_exists( 'colormag_reading_time' ) ) :

	/**
	 * Displays the reading time in post meta.
	 *
	 * Since we were using JS for this feature, we were compromising site speed since it checks every link when loaded,
	 * for displaying the time taken, and hence, we are opting for this function instead for this feature to fix site speed.
	 *
	 * @return string Reading time taken for post.
	 */
	function colormag_reading_time() {

		global $post;
		$post_content        = get_post_field( 'post_content', $post->ID );
		$word_count          = count( preg_split( '/\s+/', $post_content ) );
		$reading_time        = floor( $word_count / 200 );
		$reading_time_suffix = esc_html__( 'min read', 'colormag' );
		$total_reading_time  = $reading_time . ' ' . $reading_time_suffix;

		return $total_reading_time;
	}

endif;

if ( ! function_exists( 'colormag_category_color' ) ) :

	/**
	 * Getting Category Color.
	 *
	 * @param int $wp_category_id Category id.
	 *
	 * @return string The category color.
	 */
	function colormag_category_color( $wp_category_id ) {

		$args     = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$category = get_categories( $args );

		foreach ( $category as $category_list ) {

			$my_default_lang = apply_filters( 'wpml_default_language', null );

			$wp_category_id = apply_filters( 'wpml_object_id', $wp_category_id, 'category', true, $my_default_lang );

			$color = get_theme_mod( 'colormag_category_color_' . $wp_category_id );

			return $color;

		}
	}

endif;

if ( ! function_exists( 'colormag_colored_category' ) ) :

	/**
	 * Category Color for widgets and other
	 *
	 * @param bool $echo Boolean value to echo or just return.
	 *
	 * @return mixed
	 */
	function colormag_colored_category( $echo = true ) {

		global $post;

		$meta_structure = get_theme_mod(
			'colormag_post_meta_structure',
			array(
				'categories',
				'date',
				'author',
				'views',
				'comments',
				'tags',
				'read-time',
			)
		);

		$categories = get_the_category();
		$output     = '';

		if ( in_array( 'categories', $meta_structure, true ) && $categories ) {
			$output .= '<div class="cm-entry-header-meta"><div class="cm-post-categories">';

			foreach ( $categories as $category ) {
				$color_code = colormag_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" style="background:' . colormag_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">' . $category->cat_name . '</a>';
				} else {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '"  rel="category tag">' . $category->cat_name . '</a>';
				}
			}

			$output .= '</div></div>';

			if ( $echo ) {
				echo wp_kses_post( $output );
			} else {
				return trim( $output );
			}
		}
	}

endif;

/**
 * Sets the post excerpt length to 20 words.
 *
 * Function tied to the excerpt_length filter hook.
 *
 * @param int $length The excerpt length.
 *
 * @return int The filtered excerpt length.
 * @uses filter excerpt_length
 */
function colormag_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'colormag_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts.
 */
function colormag_continue_reading() {
	return '';
}

add_filter( 'excerpt_more', 'colormag_continue_reading' );


if ( ! function_exists( 'colormag_sidebar_select' ) ) :

	/**
	 * Function to display the sidebar selected.
	 */
	function colormag_sidebar_select() {

		if ( ( is_page_template( 'page-templates/page-builder.php' ) ) ) {
			return;
		}

		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colormag_page_sidebar_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colormag_page_sidebar_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$colormag_global_sidebar_layout = get_theme_mod( 'colormag_global_sidebar_layout', 'no_sidebar' );
		$colormag_blog_sidebar_layout   = get_theme_mod( 'colormag_blog_sidebar_layout', 'no_sidebar' );
		$colormag_page_sidebar_layout   = get_theme_mod( 'colormag_single_page_sidebar_layout', 'no_sidebar' );
		$colormag_default_post_layout   = get_theme_mod( 'colormag_single_post_sidebar_layout', 'no_sidebar' );

		if ( 'default_layout' === $layout_meta ) {

			if ( is_page() ) {

				if ( 'right_sidebar' === $colormag_page_sidebar_layout || 'two_sidebars' === $colormag_page_sidebar_layout ) {
					ColorMag_Utils::colormag_get_sidebar( $colormag_page_sidebar_layout );
				} elseif ( 'left_sidebar' === $colormag_page_sidebar_layout ) {
					ColorMag_Utils::colormag_get_sidebar( 'left' );
				} elseif ( 'default' === $colormag_page_sidebar_layout ) {

					if ( 'right_sidebar' === $colormag_global_sidebar_layout || 'two_sidebars' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'two_sidebars' === $colormag_global_sidebar_layout ? 'one_sidebars' : $colormag_global_sidebar_layout );
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'left' );
					}
				}
			} elseif ( is_single() ) {

				if ( 'right_sidebar' === $colormag_default_post_layout || 'two_sidebars' === $colormag_default_post_layout ) {
					ColorMag_Utils::colormag_get_sidebar( $colormag_default_post_layout );
				} elseif ( 'left_sidebar' === $colormag_default_post_layout ) {
					ColorMag_Utils::colormag_get_sidebar( 'left' );
				} elseif ( 'default' === $colormag_default_post_layout ) {

					if ( 'right_sidebar' === $colormag_global_sidebar_layout || 'two_sidebars' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'two_sidebars' === $colormag_global_sidebar_layout ? 'one_sidebars' : $colormag_global_sidebar_layout );
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'left' );
					}
				}
			} elseif ( is_archive() || is_home() || is_front_page() ) {

				if ( 'right_sidebar' === $colormag_blog_sidebar_layout || 'two_sidebars' === $colormag_blog_sidebar_layout ) {
					ColorMag_Utils::colormag_get_sidebar( $colormag_blog_sidebar_layout );
				} elseif ( 'left_sidebar' === $colormag_blog_sidebar_layout ) {
					ColorMag_Utils::colormag_get_sidebar( 'left' );
				} elseif ( 'default' === $colormag_blog_sidebar_layout ) {
					if ( 'right_sidebar' === $colormag_global_sidebar_layout || 'two_sidebars' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'two_sidebars' === $colormag_global_sidebar_layout ? 'one_sidebars' : $colormag_global_sidebar_layout );
					} elseif ( 'left_sidebar' === $colormag_global_sidebar_layout ) {
						ColorMag_Utils::colormag_get_sidebar( 'left' );
					}
				}
			}
		} elseif ( 'right_sidebar' === $layout_meta || 'two_sidebars' === $layout_meta ) {
			ColorMag_Utils::colormag_get_sidebar( $layout_meta );
		} elseif ( 'left_sidebar' === $layout_meta ) {
			ColorMag_Utils::colormag_get_sidebar( 'left' );
		}
	}

endif;

if ( ! function_exists( 'colormag_social_links' ) ) :

	/**
	 * Displays the social links.
	 */
	function colormag_social_links() {

		// Bail out if social links is not activated.
		if ( 0 == get_theme_mod( 'colormag_enable_social_icons', 0 ) ) {
			return;
		}

		$colormag_social_links = array(
			'colormag_social_facebook'  => 'Facebook',
			'colormag_social_twitter'   => 'Twitter',
			'colormag_social_instagram' => 'Instagram',
			'colormag_social_pinterest' => 'Pinterest',
			'colormag_social_youtube'   => 'YouTube',
		);
		?>

		<div class="social-links">
			<ul>
				<?php
				/**
				 * Social links set which is static via the theme customize option.
				 */
				$i                     = 0;
				$colormag_links_output = '';
				foreach ( $colormag_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );

					if ( ! empty( $link ) ) {
						$new_tab = '';

						// For opening link in new tab.
						if ( 1 == get_theme_mod( $key . '_checkbox', 0 ) ) {
							$new_tab = 'target="_blank"';
						}

						if ( 'Twitter' == $value ) {
							$colormag_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa-brands fa-x-twitter"></i></a></li>';
						} else {
							$colormag_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
						}
					}

					++$i;
				}

				// Displays the social links which is set static via theme customize option.
				echo wp_kses_post( $colormag_links_output );
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;

if ( ! function_exists( 'colormag_date_display' ) ) :

	/**
	 * Display the date in the header.
	 */
	function colormag_date_display() {

		// Bail out if date in header option is disabled.
		if ( 0 == get_theme_mod( 'colormag_date_display', 0 ) ) {
			return;
		}
		?>

		<div class="date-in-header">
			<?php
			if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( 'l, F j, Y' ) );
			} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( get_option( 'date_format' ) ) );
			}
			?>
		</div>

		<?php
	}

endif;

if ( ! function_exists( 'colormag_get_weather_color' ) ) :

	/**
	 * Get Weather Color.
	 *
	 * @param string $weather_code Weather code.
	 *
	 * @return string HEX Color Code.
	 */
	function colormag_get_weather_color( $weather_code ) {

		$output = '';

		if ( substr( '2' == $weather_code, 0, 1 ) || '2' == substr( $weather_code, 0, 1 ) ) {
			$output = '#1B364F';
		} elseif ( '5' == substr( $weather_code, 0, 1 ) ) {
			$output = '#7F89A2';
		} elseif ( '6' == substr( $weather_code, 0, 1 ) || 903 == $weather_code ) {
			$output = '#7E9EF3';
		} elseif ( 781 == $weather_code || 900 == $weather_code ) {
			$output = '#666C7A';
		} elseif ( 800 == $weather_code || 904 == $weather_code ) {
			$output = '#628EFB';
		} elseif ( '7' == substr( $weather_code, 0, 1 ) ) {
			$output = '#628EFB';
		} elseif ( '8' == substr( $weather_code, 0, 1 ) ) {
			$output = '#AAB4CD';
		} elseif ( 901 == $weather_code || 902 == $weather_code || 962 == $weather_code ) {
			$output = '#666C7A';
		} elseif ( 905 == $weather_code ) {
			$output = '#81A4FE';
		} elseif ( 906 == $weather_code ) {
			$output = '#81A4FE';
		} elseif ( 951 == $weather_code ) {
			$output = '#628EFB';
		} elseif ( 951 < $weather_code && 962 > $weather_code ) {
			$output = '##628EFB';
		}

		return $output;
	}

endif;

if ( ! function_exists( 'colormag_get_available_currencies' ) ) :

	/**
	 * Get available currencies for fixer.io API.
	 *
	 * @return array
	 */
	function colormag_get_available_currencies() {

		$available_currencies = array(
			'eur' => esc_html__( 'Euro Member Countries', 'colormag' ),
			'aud' => esc_html__( 'Australian Dollar', 'colormag' ),
			'bgn' => esc_html__( 'Bulgarian Lev', 'colormag' ),
			'brl' => esc_html__( 'Brazilian Real', 'colormag' ),
			'cad' => esc_html__( 'Canadian Dollar', 'colormag' ),
			'chf' => esc_html__( 'Swiss Franc', 'colormag' ),
			'cny' => esc_html__( 'Chinese Yuan Renminbi', 'colormag' ),
			'czk' => esc_html__( 'Czech Republic Koruna', 'colormag' ),
			'dkk' => esc_html__( 'Danish Krone', 'colormag' ),
			'gbp' => esc_html__( 'British Pound', 'colormag' ),
			'hkd' => esc_html__( 'Hong Kong Dollar', 'colormag' ),
			'hrk' => esc_html__( 'Croatian Kuna', 'colormag' ),
			'huf' => esc_html__( 'Hungarian Forint', 'colormag' ),
			'idr' => esc_html__( 'Indonesian Rupiah', 'colormag' ),
			'ils' => esc_html__( 'Israeli Shekel', 'colormag' ),
			'inr' => esc_html__( 'Indian Rupee', 'colormag' ),
			'jpy' => esc_html__( 'Japanese Yen', 'colormag' ),
			'krw' => esc_html__( 'Korean (South) Won', 'colormag' ),
			'mxn' => esc_html__( 'Mexican Peso', 'colormag' ),
			'myr' => esc_html__( 'Malaysian Ringgit', 'colormag' ),
			'nok' => esc_html__( 'Norwegian Krone', 'colormag' ),
			'nzd' => esc_html__( 'New Zealand Dollar', 'colormag' ),
			'php' => esc_html__( 'Philippine Peso', 'colormag' ),
			'pln' => esc_html__( 'Polish Zloty', 'colormag' ),
			'ron' => esc_html__( 'Romanian (New) Leu', 'colormag' ),
			'rub' => esc_html__( 'Russian Ruble', 'colormag' ),
			'sek' => esc_html__( 'Swedish Krona', 'colormag' ),
			'sgd' => esc_html__( 'Singapore Dollar', 'colormag' ),
			'thb' => esc_html__( 'Thai Baht', 'colormag' ),
			'try' => esc_html__( 'Turkish Lira', 'colormag' ),
			'usd' => esc_html__( 'United States Dollar', 'colormag' ),
			'zar' => esc_html__( 'South African Rand', 'colormag' ),
		);

		return $available_currencies;
	}

endif;

if ( ! function_exists( 'colormag_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param array      $args    An array of arguments.
	 * @param int        $depth   Depth of the current comment.
	 */
	function colormag_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php esc_html_e( 'Pingback:', 'colormag' ); ?>
					<?php comment_author_link(); ?>
					<?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="cm-edit-link">', '</span>' ); ?>
				</p>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<?php
									echo get_avatar( $comment, 74 );
								?>

								<b class="fn">
								<?php
									echo get_comment_author_link();
									// If current post author is also comment author, make it known visually.
								if ( $comment->user_id === $post->post_author ) {
									echo '<span>' . esc_html__( 'Post author', 'colormag' ) . '</span>';
								}
								?>
								</b>

								<div class="comment-metadata">
									<?php
										printf(
											'<div class="comment-date-time"' . '> ' . colormag_get_icon( 'calendar-fill', false ) . '%1$s</div>',
											sprintf(
												/* Translators: 1. Comment date, 2. Comment time */
												esc_html__( '%1$s at %2$s', 'colormag' ),
												esc_html( get_comment_date() ),
												esc_html( get_comment_time() )
											)
										); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

										printf(
											'<a class="comment-permalink" href="%1$s">' . colormag_get_icon( 'permalink', false ) . esc_html__( 'Permalink', 'colormag' ) . '</a>',
											esc_url( get_comment_link( $comment->comment_ID ) )
										); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

										edit_comment_link();

									?>
								</div>
							</div>
						</footer><!-- .comment-meta -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'colormag' ); ?></p>
						<?php endif; ?>

						<section class="comment-content comment">
							<?php
							comment_text();

							comment_reply_link(
								array_merge(
									$args,
									array(
										'reply_text' => esc_html__( 'Reply', 'colormag' ),
										'after'      => '',
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
									)
								)
							);
							?>
						</section><!-- .comment-content -->

					</article><!-- #comment-## -->
				<?php
				break;

		endswitch; // End comment_type check.
	}

endif;

if ( ! function_exists( 'colormag_post_view_display' ) ) :

	/**
	 * Function to display the total number of posts view
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return string
	 */
	function colormag_post_view_display( $post_id, $show_icon = true ) {

		$count_key = 'total_number_of_views';
		$count     = get_post_meta( $post_id, $count_key, true );
		$icon      = $show_icon ? colormag_get_icon( 'eye', false ) : '';

		if ( '' === $count ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );

			$output = '<span class="cm-post-views">' . $icon . '<span class="total-views">' . esc_html__( '0 View', 'colormag' ) . '</span></span>';
		} else {
			/* Translators: %s Post view count */
			$output = '<span class="cm-post-views">' . $icon . '<span class="total-views">' . sprintf( esc_html__( '%s Views', 'colormag' ), $count ) . '</span></span>';
		}

		return $output;
	}

endif;

if ( ! function_exists( 'colormag_post_view_setup' ) ) :

	/**
	 * Function to count views for the posts
	 *
	 * @param int $post_id Post ID.
	 */
	function colormag_post_view_setup( $post_id ) {

		$count_key = 'total_number_of_views';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' === $count ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
		} else {
			++$count;
			update_post_meta( $post_id, $count_key, $count );
		}
	}

endif;

if ( ! function_exists( 'colormag_font_size_range_generator' ) ) :

	/**
	 * Function to generate font size range for font size options.
	 *
	 * @param int $start_range Start range.
	 * @param int $end_range   End range.
	 *
	 * @return array
	 */
	function colormag_font_size_range_generator( $start_range, $end_range ) {
		$range_string = array();

		for ( $i = $start_range; $i <= $end_range; $i++ ) {
			$range_string[ $i ] = $i;
		}

		return $range_string;
	}

endif;

if ( ! function_exists( 'colormag_plugin_version_compare' ) ) :

	/**
	 * Compare user's current version of plugin.
	 *
	 * @param string $plugin_slug        The plugin slug.
	 * @param string $version_to_compare The plugin's version.
	 *
	 * @return bool
	 */
	function colormag_plugin_version_compare( $plugin_slug, $version_to_compare ) {
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$plugin_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $plugin_version, $version_to_compare, '<' );
	}

endif;

if ( ! function_exists( 'colormag_author_social_link' ) ) :

	/**
	 * Function to show the profile field data.
	 */
	function colormag_author_social_link() {
		?>

		<ul class="author-social-sites">
			<?php if ( get_the_author_meta( 'colormag_twitter' ) ) { ?>
				<li class="twitter-link">
					<a href="https://twitter.com/<?php the_author_meta( 'colormag_twitter' ); ?>">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
			<?php } // End check for twitter. ?>

			<?php if ( get_the_author_meta( 'colormag_facebook' ) ) { ?>
				<li class="facebook-link">
					<a href="https://facebook.com/<?php the_author_meta( 'colormag_facebook' ); ?>">
						<i class="fa fa-facebook"></i>
					</a>
				</li>
			<?php } // End check for facebook. ?>

			<?php if ( get_the_author_meta( 'colormag_flickr' ) ) { ?>
				<li class="flickr-link">
					<a href="https://flickr.com/<?php the_author_meta( 'colormag_flickr' ); ?>">
						<i class="fa fa-flickr"></i>
					</a>
				</li>
			<?php } // End check for flickr. ?>

			<?php if ( get_the_author_meta( 'colormag_linkedin' ) ) { ?>
				<li class="linkedin-link">
					<a href="https://linkedin.com/<?php the_author_meta( 'colormag_linkedin' ); ?>">
						<i class="fa fa-linkedin"></i>
					</a>
				</li>
			<?php } // End check for linkedin. ?>

			<?php if ( get_the_author_meta( 'colormag_instagram' ) ) { ?>
				<li class="instagram-link">
					<a href="https://instagram.com/<?php the_author_meta( 'colormag_instagram' ); ?>">
						<i class="fa fa-instagram"></i>
					</a>
				</li>
			<?php } // End check for instagram. ?>

			<?php if ( get_the_author_meta( 'colormag_tumblr' ) ) { ?>
				<li class="tumblr-link">
					<a href="https://tumblr.com/<?php the_author_meta( 'colormag_tumblr' ); ?>">
						<i class="fa fa-tumblr"></i>
					</a>
				</li>
			<?php } // End check for tumblr. ?>

			<?php if ( get_the_author_meta( 'colormag_youtube' ) ) { ?>
				<li class="youtube-link">
					<a href="https://youtube.com/<?php the_author_meta( 'colormag_youtube' ); ?>">
						<i class="fa fa-youtube"></i>
					</a>
				</li>
			<?php } // End check for youtube. ?>
		</ul>

		<?php
	}

endif;

if ( ! function_exists( 'colormag_pagination' ) ) :
	function colormag_pagination() {

		/**
		 * Hook: colormag_after_archive_page_loop.
		 */
		if ( 'default' === get_theme_mod( 'colormag_pagination_type', 'default' ) ) :
			if ( true === apply_filters( 'colormag_page_navigation_filter', true ) ) :
				get_template_part( 'navigation', 'none' );
			endif;
		endif;

		if ( 'numbered_pagination' === get_theme_mod( 'colormag_pagination_type', 'default' ) ) :
			colormag_numbered_pagination();
		endif;
	}
endif;

if ( ! function_exists( 'colormag_numbered_pagination' ) ) :
	function colormag_numbered_pagination() {
		?>

		<div class="tg-numbered-pagination">
			<?php
			$args = array(
				'type'      => 'list',
				'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
				'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
			);

			the_posts_pagination( $args );
			?>
		</div>
		<?php
	}
endif;

// Retrieves the attachment src from the file URL
function colormag_get_image_src_by_url( $image_url, $image_size ) {
	if ( ! isset( $image_url ) || '' === $image_url ) {
		return array( 0 => null );
	} else {
		return wp_get_attachment_image_src( attachment_url_to_postid( $image_url ), $image_size );
	}
}

if ( ! function_exists( 'colormag_date_meta_markup' ) ) :

	/**
	 * Prints post meta markup for date of post published or updated.
	 *
	 * @return void
	 */
	function colormag_date_meta_markup() {

		// Displays the same published and updated date if the post is never updated.
		$time_string = '<time class="entry-date published updated" datetime="%1$s"' . '>%2$s</time>';

		// Displays the different published and updated date if the post is updated.
		if ( ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) && 'modified-date' === get_theme_mod( 'colormag_blog_post_date_type', 'post-date' ) ) {
			$time_string = '<time class="cm-modified-date updated" datetime="%3$s"' . '>%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			/* Translators: 1. Post link, 2. Post time, 3. Post date */
			__( '<span class="cm-post-date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s %4$s</a></span>', 'colormag' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			colormag_get_icon( 'calendar-fill', false ),
			$time_string
		); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'colormag_author_meta_markup' ) ) :

	/**
	 * Prints post meta markup for author.
	 *
	 * @return void
	 */
	function colormag_author_meta_markup() {
		?>

		<span class="cm-author cm-vcard">
			<?php colormag_get_icon( 'user' ); ?>
			<a class="url fn n"
			href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
			title="<?php echo esc_attr( get_the_author() ); ?>"
			>
				<?php echo esc_html( get_the_author() ); ?>
			</a>
		</span>

		<?php
	}
endif;

if ( ! function_exists( 'colormag_comment_meta_markup' ) ) :

	/**
	 * Prints post meta markup for comments.
	 *
	 * @param [boolean] $full_post_meta
	 * @return void
	 */
	function colormag_comment_meta_markup( $full_post_meta ) {

		if ( ! post_password_required() && comments_open() ) {
			?>

			<span class="cm-comments-link">
				<?php

				$icon = colormag_get_icon( 'comment', false );
				if ( $full_post_meta ) {
					comments_popup_link(
						$icon . __( ' 0 Comments', 'colormag' ),
						$icon . __( ' 1 Comment', 'colormag' ),
						$icon . __( ' % Comments', 'colormag' )
					);
				} else {

					colormag_get_icon( 'comment' );
					comments_popup_link( '0', '1', '%' );
				}
				?>
			</span>

			<?php
		}
	}

endif;

if ( ! function_exists( 'colormag_tags_meta_markup' ) ) :

	/**
	 * Prints post meta markup tags.
	 *
	 * @return void
	 */
	function colormag_tags_meta_markup() {
		$tags_list = get_the_tag_list( '<span class="cm-tag-links"' . '>' . colormag_get_icon( 'tag', false ) . ' ', __( ', ', 'colormag' ), '</span>' );

		if ( $tags_list ) {
			echo wp_kses(
				$tags_list,
				array(
					'span' => array(
						'class' => array(),
					),
					'a'    => array(
						'href' => array(),
						'rel'  => array(),
					),
				) + ColorMag_SVG_Icons::$allowed_html
			);
		}
	}

endif;

if ( ! function_exists( 'colormag_read_time_meta_markup' ) ) :

	/**
	 * Undocumented function
	 *
	 * @param [boolean] $full_post_meta
	 * @param [boolean] $reading_time_display
	 * @return void
	 */
	function colormag_read_time_meta_markup( $full_post_meta, $reading_time_display ) {

		if ( $full_post_meta || ( ! $full_post_meta && $reading_time_display ) ) {
			?>

			<span class="reading-time cm-reading-time">
				<span class="eta"></span> <?php echo esc_html( colormag_reading_time() ); ?>
			</span>

			<?php
		}
	}

endif;

if ( ! function_exists( 'colormag_get_the_title' ) ) :

	/**
	 * Function to set length of the post title, depending upon the number of words user enters from the customizer pane.
	 *
	 * @param string $title get_the_title().
	 *
	 * @return string $title.
	 */
	function colormag_get_the_title( $title ) {

		$title_length = get_theme_mod( 'colormag_blog_post_title_length', '' );

		if ( is_int( $title_length ) ) {
			$title = wp_trim_words( $title, $title_length );
		}

		return $title;
	}
endif;
