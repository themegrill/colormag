<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php do_action( 'colormag_content_page_article_attrs' ); ?>>
	<?php
	/**
	 * Hook: colormag_before_post_content.
	 */
	do_action( 'colormag_before_post_content' );

	/**
	 * Hook: colormag_before_single_page_loop.
	 */
	do_action( 'colormag_before_single_page_loop' );
	?>

	<?php if ( 1 == get_theme_mod( 'colormag_enable_page_featured_image', 1 ) && has_post_thumbnail() ) : ?>
		<div class="cm-featured-image"<?php do_action( 'colormag_content_page_image_attrs' ); ?>>
			<?php
			the_post_thumbnail( 'colormag-featured-image' );

			/**
			 * Hook: colormag_content_page_image_meta.
			 *
			 * Pro outputs the schema image meta tag here.
			 */
			do_action( 'colormag_content_page_image_meta' );
			?>
		</div>
	<?php endif; ?>

	<?php
	if ( ( ! is_page_template( 'page-templates/page-builder.php' ) ) ) {
		if ( get_theme_mod( 'colormag_enable_page_header', true ) ) {
			$markup = is_front_page() ? 'h2' : 'h1';
			?>
			<header class="cm-entry-header">
				<<?php echo esc_attr( $markup ); ?> class="cm-entry-title"<?php do_action( 'colormag_content_page_title_attrs' ); ?>>
					<?php the_title(); ?>
				</<?php echo esc_attr( $markup ); ?> >
			</header>

			<?php
		}
	}
	?>

	<div class="cm-entry-summary"<?php do_action( 'colormag_content_page_summary_attrs' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'      => '<div style="clear: both;"></div><div class="link-pagination clearfix">' . esc_html__( 'Pages:', 'colormag' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);
		?>
	</div>

	<div class="cm-entry-footer">
		<?php
		/**
		 * Hook: colormag_content_page_footer.
		 *
		 * Pro renders the configurable meta order (edit button, etc.) here. When
		 * no callback is attached the free theme falls back to a plain edit link.
		 *
		 * @return bool $handled Whether a callback rendered the footer content.
		 */
		$footer_handled = apply_filters( 'colormag_content_page_footer', false );

		if ( ! $footer_handled ) {
			edit_post_link( __( 'Edit', 'colormag' ), '<span class="cm-edit-link">' . colormag_get_icon( 'edit', false ) . ' ', '</span>' );
		}
		?>
	</div>

	<?php
	/**
	 * Hook: colormag_after_single_page_loop.
	 */
	do_action( 'colormag_after_single_page_loop' );

	/**
	 * Hook: colormag_after_post_content.
	 */
	do_action( 'colormag_after_post_content' );
	?>
</article>
