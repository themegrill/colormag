<?php
/**
 * ColorMag Elementor Widget Block 2.
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
 * ColorMag Elementor Widget Block 2.
 *
 * Class ColorMag_Elementor_Widgets_Block_2
 */
class ColorMag_Elementor_Widgets_Block_2 extends Colormag_Elementor_Widget_Base {

	/**
	 * Post number.
	 *
	 * @var int
	 */
	public $post_number = 3;

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_2 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ColorMag-Posts-Block-2';
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_2 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Block Style 2', 'colormag' );
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_2 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'colormag-econs-block-2';
	}

	/**
	 * Retrieve the list of categories the ColorMag_Elementor_Widgets_Block_2 widget belongs to.
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
	 * Render ColorMag_Elementor_Widgets_Block_2 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$posts_number        = $this->get_settings( 'posts_number' );
		$display_type        = $this->get_settings( 'display_type' );
		$offset_posts_number = $this->get_settings( 'offset_posts_number' );
		$categories_selected = $this->get_settings( 'categories_selected' );

		$args = array(
			'posts_per_page'      => $posts_number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		// Display from the category selected
		if ( 'categories' == $display_type ) {
			$args[ 'category__in' ] = $categories_selected;
		}

		// Offset the posts
		if ( ! empty( $offset_posts_number ) ) {
			$args[ 'offset' ] = $offset_posts_number;
		}

		// Start the WP_Query Object/Class
		$get_featured_posts = new \WP_Query( $args );
		?>

		<div class="tg-module-block tg-module-wrapper tg-module-block--style-2">
			<?php
			$widget_title = $this->get_settings( 'widget_title' );
			if ( ! empty( $widget_title ) ) : ?>
				<div class="tg-module-title-wrap">
					<h4 class="module-title">
						<span><?php echo $this->get_settings( 'widget_title' ); ?></span>
					</h4>
				</div>
			<?php endif;
			?>

			<div class="tg-row">
				<?php
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post(); ?>
					<div class="tg-col-control">
						<div class="tg_module_block">
							<?php
							if ( has_post_thumbnail() ) : ?>
								<figure class="tg-module-thumb">
									<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
										<?php the_post_thumbnail( 'colormag-highlighted-post' ); ?>
									</a>

									<?php colormag_elementor_colored_category(); ?>
								</figure>
								<?php
							else :
								colormag_elementor_colored_category();
							endif;
							?>

							<h3 class="tg-module-title entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<?php colormag_elementor_widgets_meta(); // Displays the entry meta
							?>

							<div class="tg-expert entry-content">
								<?php the_excerpt(); // Displays the post excerpts
								?>
							</div>

						</div>
					</div>

					<?php
				endwhile;

				// Reset the postdata
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php
	}
}
