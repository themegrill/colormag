<?php
/**
 * ColorMag Elementor Widget Block 1.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

use ColorMagElementor\Colormag_Elementor_Widget_Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag Elementor Widget Block 1.
 *
 * Class ColorMag_Elementor_Widgets_Block_1
 */
class ColorMag_Elementor_Widgets_Block_1 extends Colormag_Elementor_Widget_Base {

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ColorMag-Posts-Block-1';
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Block Style 1', 'colormag' );
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'colormag-econs-block-1';
	}

	/**
	 * Retrieve the list of categories the ColorMag_Elementor_Widgets_Block_1 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'colormag-widget-blocks' );
	}

	/**
	 * Render ColorMag_Elementor_Widgets_Block_1 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$widget_title        = $this->get_settings( 'widget_title' );
		$posts_number        = $this->get_settings( 'posts_number' );
		$display_type        = $this->get_settings( 'display_type' );
		$offset_posts_number = $this->get_settings( 'offset_posts_number' );
		$categories_selected = $this->get_settings( 'categories_selected' );

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $posts_number, $display_type, $categories_selected,$offset_posts_number );
		?>

		<div class="tg-module-block tg-module-block--style-1 tg-module-wrapper">
			<?php
			// Displays the widget title.
			$this->widget_title( $widget_title );
			?>

			<div class="tg-row">
				<?php
				$count = 1;
				while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post(); ?>

			<?php
			$featured_image_size = ( $count == 1 ) ? 'colormag-featured-image' : 'colormag-featured-post-small';
			?>
			<?php if ( $count == 1 ) : // on first post. ?>
				<div class="tg-col-control">
					<div class="tg_module_block">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="tg-module-thumb">
								<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
									<?php the_post_thumbnail( $featured_image_size ); ?>
								</a>
								<?php colormag_elementor_colored_category(); ?>
							</figure>
							<?php
						else :
							if ( $count == 1 ) :
								colormag_elementor_colored_category();
							endif;
						endif;
						?>
						<h3 class="tg-module-title entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php colormag_elementor_widgets_meta(); // Displays the entry meta ?>
						<div class="tg-expert entry-content">
							<?php the_excerpt(); // Displays the post excerpts
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $count == 2 ) : ?>
				<div class="tg-col-control">
					<?php endif; ?>
					<?php if ( $count >= 2 ) : // add grid style after first post. ?>
						<div class="tg_module_block tg_module_block--list-small">
							<?php if ( has_post_thumbnail() ) : ?>
								<figure class="tg-module-thumb">
									<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
										<?php the_post_thumbnail( $featured_image_size ); ?>
									</a>
								</figure>
								<?php
							endif;
							?>
							<div class="tg-module-info">
								<h3 class="tg-module-title entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php colormag_elementor_widgets_meta(); // Displays the entry meta ?>
							</div>
						</div>
					<?php endif;
					$count ++;
					endwhile;
					?>
					<?php if ( $count > 2 ) : ?>
				</div>
			<?php endif; ?>
				<?php
				// Reset the postdata
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
	}
}

