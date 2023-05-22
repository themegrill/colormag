<?php
/**
 * ColorMag Elementor Widget Trending News.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.3.1
 */

namespace elementor\widgets;

use elementor\widgets\Colormag_Elementor_Widget_Base;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ColorMag Elementor Widget Trending News.
 *
 * Class ColorMag_Elementor_Widgets_Trending_News
 */
class ColorMag_Elementor_Widgets_Trending_News extends Colormag_Elementor_Widget_Base
{

    /**
     * Enable slider options for this widget.
     *
     * @var bool
     */
    public $has_slider_options = true;

    /**
     * Disable the widget title link.
     *
     * @var bool
     */
    public $enable_widget_title_link = false;

    /**
     * Retrieve ColorMag_Elementor_Widgets_Trending_News widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ColorMag-Posts-Trending-News';
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Trending_News widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Trending News', 'colormag');
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Trending_News widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'colormag-econs-trending-news';
    }

    /**
     * Retrieve the list of categories the ColorMag_Elementor_Widgets_Trending_News widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return array('colormag-widget-global');
    }

    /**
     * Disable posts pagination control for this widget.
     */
    public function posts_pagination_controls()
    {
    }

    /**
     * Render ColorMag_Elementor_Widgets_Trending_News widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render()
    {

        $widget_title = $this->get_settings('widget_title');
        $posts_number = $this->get_settings('posts_number');
        $display_type = $this->get_settings('display_type');
        $offset_posts_number = $this->get_settings('offset_posts_number');
        $posts_sort_orderby = $this->get_settings('posts_sort_orderby');
        $posts_sort_order = $this->get_settings('posts_sort_order');
        $categories_selected = $this->get_settings('categories_selected');
        $tags_selected = $this->get_settings('tags_selected');
        $authors_selected = $this->get_settings('authors_selected');
        $transition_time = $this->get_settings('transition_time');
        $transition_speed = $this->get_settings('transition_speed');

        // Create the posts query.
        $get_featured_posts = $this->query_posts($posts_number, $display_type, $categories_selected, $tags_selected, $authors_selected, $posts_sort_orderby, $posts_sort_order, $offset_posts_number);

        if (empty($offset_posts_number)) {
            colormag_append_excluded_duplicate_posts($get_featured_posts);
        }
        ?>

        <div class="clearfix tg-module-block tg-module-wrapper swiper-container tg-trending-news"
             data-speed="<?php echo absint($transition_speed); ?>">
            <?php if (!empty($widget_title)) : ?>
                <div class="tg-module-title-wrap">
                    <h4 class="trending-news-title">
						<span>
							<?php echo wp_kses_post($widget_title); ?>
						</span>
                    </h4>
                </div><!-- tg-module-title-wrap -->
            <?php endif; ?>

            <div class="swiper-wrapper trending-news-wrapper">
                <?php
                while ($get_featured_posts->have_posts()) :
                    $get_featured_posts->the_post();
                    ?>

                    <div class="tg-col-control swiper-slide trending-news-slide"
                         data-swiper-autoplay="<?php echo absint($transition_time); ?>">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div> <!-- /.tg-col-control -->

                <?php endwhile; ?>
            </div>

            <?php
            // Reset the postdata.
            wp_reset_postdata();
            ?>

            <div class="swiper-controls">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div> <!-- /.tg-trending-news -->
        <?php
    }

}
