<?php
/**
 * ColorMag Elementor Widget Grid 7.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.2.3
 */

namespace elementor\widgets;

use elementor\widgets\Colormag_Elementor_Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ColorMag Elementor Widget Grid 7.
 *
 * Class ColorMag_Elementor_Widgets_Grid_7
 */
class ColorMag_Elementor_Widgets_Grid_7 extends Colormag_Elementor_Widget_Base
{

    /**
     * Post number.
     *
     * @var int
     */
    public $post_number = 2;

    /**
     * Enable slider options for this widget.
     *
     * @var bool
     */
    public $has_slider_options = true;

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_7 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ColorMag-Posts-Grid-7';
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_7 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Grid Style 7', 'colormag');
    }

    /**
     * Retrieve ColorMag_Elementor_Widgets_Grid_7 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'colormag-econs-grid-7';
    }

    /**
     * Retrieve the list of categories the ColorMag_Elementor_Widgets_Grid_7 widget belongs to.
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
     * Extra controls for slider options.
     */
    public function slider_options_controls_extra()
    {

        $this->add_control(
            'autoplay',
            array(
                'label' => esc_html__('Autoplay Slider?', 'colormag'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'colormag'),
                'label_off' => esc_html__('No', 'colormag'),
                'return_value' => 'true',
            )
        );

        $this->add_control(
            'pause_on_hover',
            array(
                'label' => esc_html__('Pause On Hover?', 'colormag'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'colormag'),
                'label_off' => esc_html__('No', 'colormag'),
                'return_value' => 'true',
                'condition' => array(
                    'autoplay' => 'true',
                ),
            )
        );

    }

    /**
     * Disable posts pagination control for this widget.
     */
    public function posts_pagination_controls()
    {
    }

    /**
     * Render ColorMag_Elementor_Widgets_Grid_7 widget output on the frontend.
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
        $widget_title_link = $this->get_settings('widget_title_link');
        $widget_title_link_url = $widget_title_link['url'];
        $widget_title_link_target = $widget_title_link['is_external'] ? 'target="_blank"' : '';
        $transition_time = $this->get_settings('transition_time');
        $transition_speed = $this->get_settings('transition_speed');
        $autoplay = $this->get_settings('autoplay');
        $pause_on_hover = $this->get_settings('pause_on_hover');

        // Create the posts query.
        $get_featured_posts = $this->query_posts($posts_number, $display_type, $categories_selected, $tags_selected, $authors_selected, $posts_sort_orderby, $posts_sort_order, $offset_posts_number);

        if (empty($offset_posts_number)) {
            colormag_append_excluded_duplicate_posts($get_featured_posts);
        }
        ?>

        <div class="tg-module-grid tg-module-grid--style-7 tg-module-wrapper">
            <?php
            // Displays the widget title.
            $this->widget_title($widget_title, $widget_title_link_url, $widget_title_link_target);
            ?>

            <div class="swiper-container"
                 data-transition-time="<?php echo absint($transition_time); ?>"
                 data-speed="<?php echo absint($transition_speed); ?>"
                 data-autoplay="<?php echo esc_attr($autoplay); ?>"
                 data-pause_on_hover="<?php echo esc_attr($pause_on_hover); ?>"
            >
                <div class="swiper-wrapper">
                    <?php
                    while ($get_featured_posts->have_posts()) :
                        $get_featured_posts->the_post();
                        ?>

                        <div class="tg_module_grid swiper-slide"
                             data-swiper-autoplay="<?php echo absint($transition_time); ?>"
                        >
                            <?php if (has_post_thumbnail()) : ?>
                                <figure class="tg-module-thumb">
                                    <?php $this->the_post_thumbnail('colormag-elementor-block-extra-large-thumbnail'); ?>
                                </figure>
                            <?php endif; ?>

                            <div class="tg-module-info">
                                <?php
                                colormag_elementor_colored_category();

                                // Display the post title.
                                $this->the_title();

                                // Displays the entry meta.
                                colormag_elementor_widgets_meta();
                                ?>
                            </div>
                        </div>

                    <?php
                    endwhile;

                    // Reset the postdata.
                    wp_reset_postdata();
                    ?>
                </div>

                <div class="swiper-button-next">
                </div>

                <div class="swiper-button-prev">
                </div>

            </div>
        </div>

        <?php
    }

}
