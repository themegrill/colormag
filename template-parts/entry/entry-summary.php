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
			<span><?php echo esc_html( 'Read More' ); ?></span>
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
			<?php the_excerpt(); ?>

	<a class="cm-entry-button" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
		<span><?php echo esc_html( 'Read More' ); ?></span>
	</a>
</div>

	<?php
	endif;
