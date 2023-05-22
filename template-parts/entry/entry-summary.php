<?php
/**
 * Template part for entry header.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ColorMag
 * @since   @TODO
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_singular() ) :
	?>

<div class="cm-entry-summary"<?php echo colormag_schema_markup( 'entry_content' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
	<?php
	the_content();

	if ( true == get_theme_mod( 'colormag_cta_enable', false ) ) {
		if ( is_page() ) {
			?>
		<a class="cm-entry-button" title="<?php the_title_attribute(); ?>"
		   href="<?php the_permalink(); ?>">
			<span><?php echo esc_html( get_theme_mod( 'colormag_read_more_text', __( 'Read More', 'colormag' ) ) ); ?></span>
		</a>
			<?php
		}
	}

	wp_link_pages(
		array(
			'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . esc_html__( 'Pages:', 'colormag' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);
	?>
</div>
	<?php
else :
	?>
<div class="cm-entry-summary"<?php echo colormag_schema_markup( 'entry_summary' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
	<?php
	$archive_search_layout = get_theme_mod( 'colormag_blog_layout', 'layout-1' );

	if ( 'content' === get_theme_mod( 'colormag_blog_content_excerpt_type', 'excerpt' ) && ! ( 'layout-1' === $archive_search_layout ) ) :
		the_content( '<span>' . esc_html( get_theme_mod( 'colormag_read_more_text', __( 'Read More', 'colormag' ) ) ) . '</span>' );
	else :
		?>
		<?php the_excerpt(); ?>

		<?php if ( true == get_theme_mod( 'colormag_cta_enable', true ) ) { ?>
		<a class="cm-entry-button" title="<?php the_title_attribute(); ?>"
		   href="<?php the_permalink(); ?>">
			<span><?php echo esc_html( get_theme_mod( 'colormag_read_more_text', __( 'Read More', 'colormag' ) ) ); ?></span>
		</a>
	<?php } ?>
	<?php endif; ?>
</div>

	<?php
	endif;
