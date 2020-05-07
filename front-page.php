<?php
/**
 * Template to show the front page.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Do not display the front pages sidebar areas when the Page Builder Template is activated.
if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) :
	?>
	<div class="front-page-top-section clearfix">
		<div class="widget_slider_area">
			<?php
			if ( is_active_sidebar( 'colormag_front_page_slider_area' ) ) {
				dynamic_sidebar( 'colormag_front_page_slider_area' );
			}
			?>
		</div>

		<div class="widget_beside_slider">
			<?php
			if ( is_active_sidebar( 'colormag_front_page_area_beside_slider' ) ) {
				dynamic_sidebar( 'colormag_front_page_area_beside_slider' );
			}
			?>
		</div>
	</div>
<?php endif; ?>

	<div class="main-content-section clearfix">
		<?php
		/**
		 * Hook: colormag_before_body_content.
		 */
		do_action( 'colormag_before_body_content' );
		?>

		<div id="primary">
			<div id="content" class="clearfix">

				<?php
				// Do not display the front pages sidebar areas when the Page Builder Template is activated.
				if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) :

					if ( is_active_sidebar( 'colormag_front_page_content_top_section' ) ) {
						dynamic_sidebar( 'colormag_front_page_content_top_section' );
					}

					if ( is_active_sidebar( 'colormag_front_page_content_middle_left_section' ) || is_active_sidebar( 'colormag_front_page_content_middle_right_section' ) ) {
						?>
						<div class="tg-one-half">
							<?php
							dynamic_sidebar( 'colormag_front_page_content_middle_left_section' );
							?>
						</div>

						<div class="tg-one-half tg-one-half-last">
							<?php
							dynamic_sidebar( 'colormag_front_page_content_middle_right_section' );
							?>
						</div>

						<div class="clearfix"></div>
						<?php
					}

					if ( is_active_sidebar( 'colormag_front_page_content_bottom_section' ) ) {
						dynamic_sidebar( 'colormag_front_page_content_bottom_section' );
					}

				endif; // Do not display the front pages sidebar areas when the Page Builder Template is activated.

				if ( 0 == get_theme_mod( 'colormag_hide_blog_front', 0 ) ) :
					?>

					<div class="article-container">
						<?php
						if ( have_posts() ) :

							/**
							 * Hook: colormag_before_front_page_loop.
							 */
							do_action( 'colormag_before_front_page_loop' );

							while ( have_posts() ) :
								the_post();

								if ( is_front_page() && is_home() ) {
									get_template_part( 'content', '' );
								} elseif ( is_front_page() ) {
									get_template_part( 'content', 'page' );
								}

							endwhile;

							/**
							 * Hook: colormag_after_front_page_loop.
							 */
							do_action( 'colormag_after_front_page_loop' );

							if ( true === apply_filters( 'colormag_front_page_navigation_filter', true ) ) :
								get_template_part( 'navigation', 'none' );
							endif;

						else :

							if ( true === apply_filters( 'colormag_front_page_no_results_filter', true ) ) :
								get_template_part( 'no-results', 'none' );
							endif;

						endif;
						?>
					</div>
				<?php endif; ?>
			</div>
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
