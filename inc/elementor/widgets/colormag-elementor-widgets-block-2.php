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

		$widget_title        = $this->get_settings( 'widget_title' );
		$posts_number        = $this->get_settings( 'posts_number' );
		$display_type        = $this->get_settings( 'display_type' );
		$offset_posts_number = $this->get_settings( 'offset_posts_number' );
		$categories_selected = $this->get_settings( 'categories_selected' );

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $posts_number, $display_type, $categories_selected,$offset_posts_number );
		?>

		<div class="tg-module-block tg-module-wrapper tg-module-block--style-2">
			<?php
			// Displays the widget title.
			$this->widget_title( $widget_title );
			?>

			<div class="tg-row">
				<?php
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();
					?>

					<div class="tg-col-control">
						<div class="tg_module_block">
							<?php if ( has_post_thumbnail() ) : ?>
								<figure class="tg-module-thumb">
									<?php
									$this->the_post_thumbnail( 'colormag-highlighted-post' );

									colormag_elementor_colored_category();
									?>
								</figure>
								<?php
							else :
								colormag_elementor_colored_category();
							endif;
							?>

							<?php
							// Display the post title.
							$this->the_title();

							// Displays the entry meta.
							colormag_elementor_widgets_meta();
							?>

							<div class="tg-expert entry-content">
								<?php
								// Displays the post excerpts.
								the_excerpt();
								?>
							</div>

						</div>
					</div>

					<?php
				endwhile;

				// Reset the postdata.
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php
	}

}
