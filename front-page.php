<?php
/**
 * Template to show the front page.
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

// Do not display the front pages sidebar areas when the Page Builder Template is activated.
if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) && ( is_active_sidebar( 'colormag_front_page_area_beside_slider' ) ) && ( is_active_sidebar( 'colormag_front_page_slider_area' ) ) ) :
	?>
	<div class="cm-front-page-top-section">
		<div class="cm-slider-area">
			<?php
				dynamic_sidebar( 'colormag_front_page_slider_area' );
			?>
		</div>

		<div class="cm-beside-slider-widget">
			<?php
				dynamic_sidebar( 'colormag_front_page_area_beside_slider' );
			?>
		</div>
	</div>
<?php endif; ?>

<div class="cm-row">
	<?php
	/**
	 * Filter: colormag_frontpage_blog_layout_args.
	 *
	 * Layout configuration for the front page blog posts area. Pro reads the
	 * dynamic blog layout from the customizer.
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
		// Do not display the front pages sidebar areas when the Page Builder Template is activated.
		if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) :

			if ( is_active_sidebar( 'colormag_front_page_content_top_section' ) ) {
				dynamic_sidebar( 'colormag_front_page_content_top_section' );
			}

			if ( is_active_sidebar( 'colormag_front_page_content_middle_left_section' ) || is_active_sidebar( 'colormag_front_page_content_middle_right_section' ) ) {
				?>
				<div class="cm-column-half">
					<div class="cm-one-half">
						<?php
						dynamic_sidebar( 'colormag_front_page_content_middle_left_section' );
						?>
					</div>

					<div class="cm-one-half cm-one-half-last">
						<?php
						dynamic_sidebar( 'colormag_front_page_content_middle_right_section' );
						?>
					</div>
				</div>
				<?php
			}

			if ( is_active_sidebar( 'colormag_front_page_content_bottom_section' ) ) {
				dynamic_sidebar( 'colormag_front_page_content_bottom_section' );
			}

		endif; // Do not display the front pages sidebar areas when the Page Builder Template is activated.

		$hide_blog_front = get_theme_mod( 'colormag_hide_blog_static_page_post', false );

		if ( ! $hide_blog_front ) :

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
					 * Hook: colormag_before_front_page_loop.
					 */
					do_action( 'colormag_before_front_page_loop' );

					while ( have_posts() ) :
						the_post();

						if ( is_front_page() && is_home() ) {
							get_template_part( 'template-parts/content', '' );
						} elseif ( is_front_page() ) {
							get_template_part( 'template-parts/content', 'page' );
						}

					endwhile;

					/**
					 * Hook: colormag_after_front_page_loop.
					 */
					do_action( 'colormag_after_front_page_loop' );

				else :
					if ( true === apply_filters( 'colormag_front_page_no_results_filter', true ) ) :
						get_template_part( 'template-parts/no-results', 'none' );
					endif;
				endif;
				?>
			</div>

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

		<?php endif; ?>
	</div>


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
