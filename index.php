<?php
/**
 * Theme Index Section for ColorMag theme.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="cm-row">
	<?php
	/**
	 * Filter: colormag_frontpage_blog_layout_args.
	 *
	 * Layout configuration for the blog posts area. Pro reads the dynamic blog
	 * layout from the customizer.
	 */
	$blog_layout_args = apply_filters(
		'colormag_frontpage_blog_layout_args',
		array(
			'layout' => 'layout-2',
			'style'  => 'cm-layout-2-style-1',
			'col'    => 'col-2',
		)
	);

	$grid_layout = $blog_layout_args['layout'];
	$style       = $blog_layout_args['style'];
	$col         = $blog_layout_args['col'];

	/**
	 * Hook: colormag_before_body_content.
	 */
	do_action( 'colormag_before_body_content' );

	/**
	 * Hook: colormag_before_content_area.
	 *
	 * @hooked colormag_pro_before_content_area (two sidebar select) - 10
	 */
	do_action( 'colormag_before_content_area' );
	?>

		<div id="cm-primary" class="cm-primary">

			<?php
			$pagination_enable = get_theme_mod( 'colormag_enable_pagination', 1 );

			/**
			 * Filter: colormag_posts_container_class.
			 *
			 * Allows pro to add the infinite scroll container class.
			 */
			$pagination_class = apply_filters( 'colormag_posts_container_class', '' );
			?>

			<div class="cm-posts <?php echo esc_attr( trim( 'cm-' . $grid_layout . ' ' . $style . ' ' . $col . ' ' . $pagination_class ) ); ?>" >
				<?php
				if ( have_posts() ) :

					/**
					 * Hook: colormag_before_index_page_loop.
					 */
					do_action( 'colormag_before_index_page_loop' );

					while ( have_posts() ) :
						the_post();

						/**
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', '' );
					endwhile;

					/**
					 * Hook: colormag_after_index_page_loop.
					 */
					do_action( 'colormag_after_index_page_loop' );

				else :

					if ( true === apply_filters( 'colormag_index_page_no_results_filter', true ) ) :
						get_template_part( 'no-results', 'none' );
					endif;

				endif;
				?>
			</div><!-- .cm-posts -->

			<?php
			if ( 1 == $pagination_enable ) {
				colormag_pagination();
			}

			/**
			 * Hook: colormag_after_posts_loop.
			 *
			 * @hooked colormag_pro_after_posts_loop (infinite scroll) - 10
			 */
			do_action( 'colormag_after_posts_loop' );
			?>
		</div><!-- #cm-primary -->

	<?php

	colormag_sidebar_select();

	/**
	 * Hook: colormag_after_body_content.
	 */
	do_action( 'colormag_after_body_content' );
	?>
</div>

<?php
get_footer();
