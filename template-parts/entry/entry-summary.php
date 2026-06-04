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

/**
 * Filter: colormag_entry_summary_cta_text.
 *
 * The "Read More" call to action label. Pro maps this to the
 * colormag_read_more_text theme mod.
 *
 * @param string $cta_text The CTA label.
 */
$cta_text = apply_filters( 'colormag_entry_summary_cta_text', esc_html__( 'Read More', 'colormag' ) );

if ( is_singular() ) :
	?>

	<div class="cm-entry-summary"<?php do_action( 'colormag_entry_summary_content_attrs' ); ?>>
		<?php
		/**
		 * Filter: colormag_show_excerpt.
		 *
		 * Whether to render the excerpt before the content on singular views.
		 * Pro reads the colormag_enable_excerpt theme mod; the free theme keeps
		 * the excerpt hidden by default.
		 *
		 * @param bool $show_excerpt Whether to show the excerpt.
		 */
		if ( apply_filters( 'colormag_show_excerpt', false ) && has_excerpt() ) {
			the_excerpt();
		}

		the_content();

		if ( is_page() ) {
			?>
			<a class="cm-entry-button" title="<?php the_title_attribute(); ?>"
				href="<?php the_permalink(); ?>">
				<span><?php echo esc_html( $cta_text ); ?></span>
			</a>
			<?php
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
	<div class="cm-entry-summary"<?php do_action( 'colormag_entry_summary_archive_attrs' ); ?>>
		<?php
		$archive_search_layout = get_theme_mod( 'colormag_blog_layout', 'layout-1' );

		if ( 'content' === get_theme_mod( 'colormag_blog_content_excerpt_type', 'excerpt' ) && ! ( 'layout-1' === $archive_search_layout ) ) :
			the_content( '<span>' . esc_html( $cta_text ) . '</span>' );
		else :
			?>
			<?php the_excerpt(); ?>
			<a class="cm-entry-button" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				<span><?php echo esc_html( $cta_text ); ?></span>
			</a>
		<?php endif; ?>
	</div>

	<?php
endif;
