<?php
/**
 * Custom template tags for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_entry_meta' ) ) :

	/**
	 * Shows meta information of post.
	 */
	function colormag_entry_meta() {

		if ( 'post' == get_post_type() ) :

			echo '<div class="below-entry-meta">';
			?>

			<?php
			// Displays the same published and updated date if the post is never updated.
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			// Displays the different published and updated date if the post is updated.
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
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
				__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>

			<span class="byline">
				<span class="author vcard">
					<i class="fa fa-user"></i>
					<a class="url fn n"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
					   title="<?php echo get_the_author(); ?>"
					>
						<?php echo esc_html( get_the_author() ); ?>
					</a>
				</span>
			</span>

			<?php if ( ! post_password_required() && comments_open() ) { ?>
				<span class="comments">
						<?php
						comments_popup_link(
							__( '<i class="fa fa-comment"></i> 0 Comments', 'colormag' ),
							__( '<i class="fa fa-comment"></i> 1 Comment', 'colormag' ),
							__( '<i class="fa fa-comments"></i> % Comments', 'colormag' )
						);
						?>
					</span>
				<?php
			}

			$tags_list = get_the_tag_list( '<span class="tag-links"' . colormag_schema_markup( 'tag' ) . '><i class="fa fa-tags"></i>', __( ', ', 'colormag' ), '</span>' );
			if ( $tags_list ) {
				echo $tags_list; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}

			edit_post_link( __( 'Edit', 'colormag' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );

			echo '</div>';

		endif;

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
		$categories = get_the_category();
		$separator  = '&nbsp;';
		$output     = '';

		if ( $categories ) {
			$output .= '<div class="above-entry-meta"><span class="cat-links">';

			foreach ( $categories as $category ) {
				$color_code = colormag_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" style="background:' . colormag_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">' . $category->cat_name . '</a>' . $separator;
				} else {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '"  rel="category tag">' . $category->cat_name . '</a>' . $separator;
				}
			}

			$output .= '</span></div>';

			if ( $echo ) {
				echo trim( $output, $separator ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			} else {
				return trim( $output, $separator );
			}
		}

	}

endif;


if ( ! function_exists( 'colormag_sidebar_select' ) ) :

	/**
	 * Function to display the sidebar selected.
	 */
	function colormag_sidebar_select() {

		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
		$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
		$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

		if ( 'default_layout' === $layout_meta ) {
			if ( is_page() ) {
				colormag_get_sidebar( $colormag_default_page_layout );
			} elseif ( is_single() ) {
				colormag_get_sidebar( $colormag_default_post_layout );
			} else {
				colormag_get_sidebar( $colormag_default_layout );
			}
		} else {
			colormag_get_sidebar( $layout_meta );
		}

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
					<?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<header class="comment-meta comment-author vcard">
							<?php
							echo get_avatar( $comment, 74 );

							printf(
								'<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'colormag' ) . '</span>' : ''
							);

							printf(
								'<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
								sprintf(
									/* Translators: 1. Comment date, 2. Comment time */
									esc_html__( '%1$s at %2$s', 'colormag' ),
									esc_html( get_comment_date() ),
									esc_html( get_comment_time() )
								)
							);

							printf(
								'<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>' . esc_html__( 'Permalink', 'colormag' ) . '</a>',
								esc_url( get_comment_link( $comment->comment_ID ) )
							); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							edit_comment_link();
							?>
						</header><!-- .comment-meta -->

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
