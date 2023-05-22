<?php
/**
 * ColorMag Elementor Widget Grid 6.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.2.3
 */

namespace elementor\widgets;

use elementor\widgets\Colormag_Elementor_Widget_Base;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ColorMag Elementor Widget Grid 6.
 *
 * Class ColorMag_Elementor_Widgets_Grid_6
 */
class ColorMag_Elementor_Widgets_Grid_6 extends Colormag_Elementor_Widget_Base
{

    /**
     * Post number.
     *
     * @var int
     */
    public $post_number = 3;

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_6 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ColorMag-Posts-Grid-6';
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_6 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Grid Style 6', 'colormag');
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_6 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'colormag-econs-grid-6';
    }

    /**
     * Retrieve the list of categories the ColorMag_Elementor_Widgets_Grid_6 widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return array('colormag-widget-grid');
    }

    /**
     * Render ColorMag_Elementor_Widgets_Grid_6 widget output on the frontend.
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
        $show_pagination = $this->get_settings('show_pagination');
        $widget_title_link = $this->get_settings('widget_title_link');
        $widget_title_link_url = $widget_title_link['url'];
        $widget_title_link_target = $widget_title_link['is_external'] ? 'target="_blank"' : '';

        // Create the posts query.
        $get_featured_posts = $this->query_posts($posts_number, $display_type, $categories_selected, $tags_selected, $authors_selected, $posts_sort_orderby, $posts_sort_order, $offset_posts_number, $show_pagination);

        if (empty($offset_posts_number)) {
            colormag_append_excluded_duplicate_posts($get_featured_posts);
        }
        ?>

        <div class="tg-module-grid tg-module-grid--style-6 tg-module-wrapper tg-fade-in">
            <?php
            // Displays the widget title.
            $this->widget_title($widget_title, $widget_title_link_url, $widget_title_link_target);
            ?>

            <div class="tg-row thinner">
                <?php
                $count = 1;
                while ($get_featured_posts->have_posts()) :
                    $get_featured_posts->the_post();

                    $thumbnail_image_size = (1 === $count) ? 'colormag-elementor-grid-large-thumbnail' : 'colormag-elementor-grid-medium-large-thumbnail';
                    $main_div_loop_wrapper_class = (1 === $count) ? 'tg_module_grid tg_module_grid--full' : 'tg_module_grid tg_module_grid--full tg_module_grid tg_module_grid--medium';

                    if ((1 === $count) || (2 === $count)) :
                        echo '<div class="tg-col-control">';
                    endif;
                    ?>

                    <div class="<?php echo esc_attr($main_div_loop_wrapper_class); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="tg-module-thumb">
                                <?php $this->the_post_thumbnail($thumbnail_image_size); ?>
                            </figure>
                        <?php endif; ?>

                        <div class="tg-module-info">
                            <?php
                            colormag_elementor_colored_category();

                            // Display the post title.
                            $this->the_title();
                            ?>
                        </div>
                    </div>

                    <?php
                    if (1 === $count) :
                        echo '</div>';
                    endif;

                    $count++;
                endwhile;

                if (2 < $count) {
                    echo '</div>';
                }

                // Display the pagination link if enabled.
                $this->paginate_links($show_pagination, $get_featured_posts->max_num_pages);

                // Reset the postdata.
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <?php
    }

}
