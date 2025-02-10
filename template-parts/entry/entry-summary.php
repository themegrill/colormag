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

<div class="cm-entry-summary">
	<?php
	the_content();

	if ( is_page() ) {
		?>
		<a class="cm-entry-button" title="<?php the_title_attribute(); ?>"
		   href="<?php the_permalink(); ?>">
			<span><?php echo esc_html__( 'Read More', 'colormag' ); ?></span>
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
<div class="cm-entry-summary">

	<?php if ( 'content' === get_theme_mod( 'colormag_blog_content_excerpt_type', 'excerpt' ) ): ?>
		<?php the_content( '<span>' . esc_html__( 'Read More', 'colormag' ) . '</span>' ); ?>
	<?php else: ?>
			<?php the_excerpt(); ?>
		<a class="cm-entry-button" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			<span><?php echo esc_html__( 'Read More', 'colormag' ); ?></span>
		</a>
	<?php endif; ?>
</div>

	<?php
	endif;
