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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo colormag_schema_markup( 'entry' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
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
		<div class="cm-featured-image"<?php echo colormag_schema_markup( 'image' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
			<?php
			the_post_thumbnail( 'colormag-featured-image' );

			if ( 1 == get_theme_mod( 'colormag_enable_schema_markup', '' ) ) :
				?>
				<meta itemprop="url" content="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, 'full' ) ); ?>">
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
	if ( ( ! is_page_template( 'page-templates/page-builder.php' ) ) ) {

		$markup = is_front_page() ? 'h1' : 'h2';
		?>
		<header class="cm-entry-header">
			<<?php echo esc_attr( $markup ); ?> class="cm-entry-title"<?php echo colormag_schema_markup( 'entry_title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
				<?php the_title(); ?>
			</<?php echo esc_attr( $markup ); ?> >
		</header>

		<?php
	}
	?>

	<div class="cm-entry-summary"<?php echo colormag_schema_markup( 'entry_content' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
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

	<div class="entry-footer">
		<?php
		// Edit button remove option add.
		if ( 0 == get_theme_mod( 'colormag_edit_button_entry_meta_remove', 0 ) ) :
			edit_post_link( esc_html__( 'Edit', 'colormag' ), '<span class="cm-edit-link"><i class="fa fa-edit"></i>', '</span>' );
		endif;
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
