<?php
/**
 * ColorMag Elementor Widget Grid 2.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

namespace elementor\widgets;

use elementor\widgets\Colormag_Elementor_Widget_Base;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ColorMag Elementor Widget Grid 2.
 *
 * Class ColorMag_Elementor_Widgets_Grid_2
 */
class ColorMag_Elementor_Widgets_Grid_2 extends Colormag_Elementor_Widget_Base
{

    /**
     * Post number.
     *
     * @var int
     */
    public $post_number = 4;

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_2 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ColorMag-Posts-Grid-2';
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_2 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Grid Style 2', 'colormag');
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_2 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'colormag-econs-grid-2';
    }

    /**
     * Retrieve the list of categories the ColorMag_Elementor_Widgets_Grid_2 widget belongs to.
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
     * Render ColorMag_Elementor_Widgets_Grid_2 widget output on the frontend.
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
        $categories_selected = $this->get_settings('categories_selected');

        // Create the posts query.
        $get_featured_posts = $this->query_posts($posts_number, $display_type, $categories_selected, $offset_posts_number);
        ?>

        <div class="tg-module-grid tg-module-grid--style-2 tg-module-wrapper">
            <?php
            // Displays the widget title.
            $this->widget_title($widget_title);
            ?>

            <div class="tg-row thinner">
                <?php
                $count = 1;
                while ($get_featured_posts->have_posts()) :
                    $get_featured_posts->the_post();

                    $thumbnail_image_size = 'colormag-highlighted-post';
                    $main_div_loop_wrapper_class = 'tg_module_grid tg_module_grid--small tg_module_grid--half tg-col-control';

                    if (1 == $count) {
                        $thumbnail_image_size = 'colormag-elementor-grid-large-thumbnail';
                        $main_div_loop_wrapper_class = 'tg_module_grid tg_module_grid--full';
                    } elseif (2 == $count) {
                        $thumbnail_image_size = 'colormag-elementor-grid-medium-large-thumbnail';
                        $main_div_loop_wrapper_class = 'tg_module_grid tg_module_grid--small tg_module_grid--full tg-col-control';
                    }

                    if ((1 == $count) || (2 == $count)) :
                        echo '<div class="tg-col-control">';
                    endif;
                    if (2 == $count) :
                        echo '<div class="tg-row thinner">';
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
                    if (1 == $count) :
                        echo '</div>';
                    endif;

                    $count++;
                endwhile;

                if (2 < $count) {
                    echo '</div>';
                    echo '</div>';
                }

                // Reset the postdata.
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <?php
    }

}
