<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to colormag_comment() which is
 * located in the inc/functions.php file.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
				/* Translators: %1$s: Post title */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'colormag' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
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

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="comment-navigation clearfix" role="navigation">
				<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'colormag' ); ?></h4>

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'colormag' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'colormag' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'callback'   => 'colormag_comment',
					'short_ping' => true,
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="comment-navigation clearfix" role="navigation">
				<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'colormag' ); ?></h4>

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'colormag' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'colormag' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'colormag' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
