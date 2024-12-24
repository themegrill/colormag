<?php
/**
 * ColorMag Elementor Widget Block 4.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

namespace elementor\widgets;

use elementor\widgets\Colormag_Elementor_Widget_Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag Elementor Widget Block 4.
 *
 * Class ColorMag_Elementor_Widgets_Block_4
 */
class ColorMag_Elementor_Widgets_Block_4 extends Colormag_Elementor_Widget_Base {


	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_4 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ColorMag-Posts-Block-4';
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_4 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Block Style 4', 'colormag' );
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_4 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'colormag-econs-block-4';
	}

	/**
	 * Retrieve the list of categories the ColorMag_Elementor_Widgets_Block_4 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'colormag-widget-blocks' ];
	}

	/**
	 * Render ColorMag_Elementor_Widgets_Block_4 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$widget_title                = $this->get_settings( 'widget_title' );
		$posts_number                = $this->get_settings( 'posts_number' );
		$display_type                = $this->get_settings( 'display_type' );
		$offset_posts_number         = $this->get_settings( 'offset_posts_number' );
		$categories_selected         = $this->get_settings( 'categories_selected' );
		$post_element_select_style_2 = $this->get_settings( 'post_element_select_style_2' );
		$show_style_2_image          = $this->get_settings( 'show_style_2_image' );

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $posts_number, $display_type, $categories_selected, $offset_posts_number );
		?>

		<div class="tg-module-block tg-module-block--style-4 tg-module-wrapper">
		<?php
		// Displays the widget title.
		$this->widget_title( $widget_title );

		while ( $get_featured_posts->have_posts() ) :
			$get_featured_posts->the_post();
			?>

			<div class="tg_module_block tg-row tg-two-block">
			<?php if ( $show_style_2_image ) : ?>
				<?php if ( has_post_thumbnail() ) : ?>
			<figure class="tg-module-thumb tg-col-control">
					<?php $this->the_post_thumbnail( 'colormag-highlighted-post' ); ?>
			</figure>
		<?php endif; ?>
			<?php endif; ?>

			<div class="tg-module-info tg-col-control">
			<?php
			foreach ( $post_element_select_style_2 as $element ) {

				if ( 'title' === $element ) {
					// Display the post title.
					$this->the_title();
				}

				if ( 'meta' === $element ) {
					// Display the post date.
					colormag_elementor_widgets_meta();
				}
				?>

				<?php if ( 'excerpt' === $element ) { ?>
					<div class="tg-excerpt entry-content">
						<?php
						// Displays the post excerpts.
						the_excerpt();
						?>
					</div>

					<?php
				}
			}
			?>
				</div>
				</div>

				<?php
			endwhile;

				// Reset the postdata.
				wp_reset_postdata();
		?>
				</div>

				<?php
	}
}
