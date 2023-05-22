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

	$grid_layout = get_theme_mod( 'colormag_blog_layout', 'layout-1' );

	$layout1_style = get_theme_mod( 'colormag_blog_layout_1_style', 'style-1' );

	$layout2_style = get_theme_mod( 'colormag_blog_layout_2_style', 'style-1' );

	$grid_col = get_theme_mod( 'colormag_grid_layout_column', '2' );

	$style = '';

	if ( 'layout-1' === $grid_layout ) {
		$style = 'cm-' . $grid_layout . '-' . $layout1_style;
	} elseif ( 'layout-2' === $grid_layout ) {
		$style = 'cm-' . $grid_layout . '-' . $layout2_style;
	}

	$col = '';

	if ( 'layout-2' === $grid_layout ) {
		$col = 'col-' . $grid_col;
	}
	/**
	 * Hook: colormag_before_body_content.
	 */
	do_action( 'colormag_before_body_content' );
	?>

	<?php colormag_two_sidebar_select(); ?>

	<div id="cm-primary" class="cm-primary">

		<?php
		// Do not display the front pages sidebar areas when the Page Builder Template is activated.
		if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) :

			if ( is_active_sidebar( 'colormag_front_page_content_top_section' ) ) {
				dynamic_sidebar( 'colormag_front_page_content_top_section' );
			}

			if ( is_active_sidebar( 'colormag_front_page_content_middle_left_section' ) || is_active_sidebar( 'colormag_front_page_content_middle_right_section' ) ) {
				?>
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

				<?php
			}

			if ( is_active_sidebar( 'colormag_front_page_content_bottom_section' ) ) {
				dynamic_sidebar( 'colormag_front_page_content_bottom_section' );
			}

		endif; // Do not display the front pages sidebar areas when the Page Builder Template is activated.

		$hide_blog_front = get_theme_mod( 'colormag_hide_blog_static_page_post', false );

		if ( ! $hide_blog_front ) :
			?>

			<?php
			$pagination_type  = get_theme_mod( 'colormag_pagination_type', 'default' );
			$pagination_class = '';

			if ( 'infinite_scroll' === $pagination_type ) {
				$pagination_class .= 'tg-infinite-scroll-container';
			}
			?>
			<div class="cm-posts <?php echo esc_attr( 'cm-' . $grid_layout . ' ' . $style  . ' ' . $col . ' ' . $pagination_class ); ?>" >
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
				colormag_pagination();
			?>

		<?php endif; ?>


		<?php if ( ! $hide_blog_front ) {
			colormag_infinite_scroll();
		}
		?>
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
