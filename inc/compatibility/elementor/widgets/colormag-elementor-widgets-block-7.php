<?php
/**
 * ColorMag Elementor Widget Block 7.
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
 * ColorMag Elementor Widget Block 7.
 *
 * Class ColorMag_Elementor_Widgets_Block_7
 */
class ColorMag_Elementor_Widgets_Block_7 extends Colormag_Elementor_Widget_Base
{

    /**
     * Post number.
     *
     * @var int
     */
    public $post_number = 4;

    /**
     * Retrieve ColorMag_Elementor_Widgets_Block_7 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ColorMag-Posts-Block-7';
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Block_7 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Block Style 7', 'colormag');
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Block_7 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'colormag-econs-block-7';
    }

    /**
     * Retrieve the list of categories the ColorMag_Elementor_Widgets_Block_7 widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return array('colormag-widget-blocks');
    }

    /**
     * Render ColorMag_Elementor_Widgets_Block_7 widget output on the frontend.
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

        <div class="tg-module-block tg-module-block--style-7 tg-module-wrapper tg-fade-in">
            <?php
            // Displays the widget title.
            $this->widget_title($widget_title, $widget_title_link_url, $widget_title_link_target);
            ?>

            <?php
            $count = 1;
            while ($get_featured_posts->have_posts()) :
                $get_featured_posts->the_post();

                $featured_image_size = (1 === $count) ? 'colormag-featured-image' : 'colormag-featured-post-small';

                if (1 === $count) :
                    echo '<div class="tg_module_block tg_module_block--inner-shadow tg_module_block--white">'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
                elseif (2 <= $count) : // add grid style after first post.
                    echo '<div class="tg_module_block tg_module_block--list-small">'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
                endif;

                if (has_post_thumbnail()) :
                    ?>
                    <figure class="tg-module-thumb">
                        <?php $this->the_post_thumbnail($featured_image_size); ?>
                    </figure>
                <?php endif; ?>

                <div class="tg-module-info">
                    <?php
                    if (1 === $count) {
                        colormag_elementor_colored_category();
                    }

                    // Display the post title.
                    $this->the_title();

                    // Displays the entry meta.
                    colormag_elementor_widgets_meta();
                    ?>
                </div> <!-- tg-meta-info-content -->

                <?php
                if (1 === $count || 2 <= $count) {
                    echo '</div>';
                }

                $count++;
            endwhile;

            // Display the pagination link if enabled.
            $this->paginate_links($show_pagination, $get_featured_posts->max_num_pages);

            // Reset the postdata.
            wp_reset_postdata();
            ?>
        </div>

        <?php
    }

}

