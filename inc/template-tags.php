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
