<?php
/**
 * Localize load more scripts.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Navigation for single post that loads on scroll on single post page.
 */
function colormag_ajax_single_post_navigation() {

	if ( is_attachment() ) :
		?>
		<ul class="default-wp-page">
			<li class="previous"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'colormag' ) ); ?></li>
			<li class="next"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'colormag' ) ); ?></li>
		</ul>
		<?php
	endif;
}


/**
 * Comments section for single post that loads on scroll on single post page.
 */
function colormag_ajax_single_post_comments( $query, $comments ) {
	?>

	<div id="comments" class="comments-area">

		<?php

		if ( $query->have_comments() ) {
			$query->the_comment();
			?>

		<h3 class="comments-title">

			<?php
			$comment_count = get_comments_number();

			if ( '1' === $comment_count ) {

				printf(
					/* Translators: %1$s: Post title */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'colormag' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {

				printf(
				/* Translators: %1$s: Comment count, %2$s: Post title */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'colormag' ) ),
					number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>

		</h3>

		<ul class="comment-list">

			<?php
			wp_list_comments(
				array(
					'callback'          => 'colormag_comment',
					'short_ping'        => true,
					'reverse_top_level' => true,
				),
				$comments
			);
			?>

		</ul><!-- .comment-list -->

			<?php

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
				?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'colormag' ); ?></p>
				<?php
			}
		}
		comment_form();
}
