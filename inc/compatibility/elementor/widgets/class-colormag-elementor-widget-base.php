<?php
/**
 * Elementor Widget Base class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Declare required namespace.
namespace elementor\widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Widget Base class.
 *
 * Class Colormag_Elementor_Widget_Base
 */
abstract class Colormag_Elementor_Widget_Base extends Widget_Base {

	/**
	 * Post number.
	 *
	 * @var int
	 */
	public $post_number = 5;

	/**
	 * Control to enable if slider options is available.
	 *
	 * @var bool
	 */
	public $has_slider_options = false;

	/**
	 * Control to disable the widget title link if it's unavailable.
	 *
	 * @var bool
	 */
	public $enable_widget_title_link = true;

	/**
	 * Register Colormag_Elementor_Widget_Base widget controls.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		// Controls related to widget title section.
		$this->widget_title_controls();

		// Controls related to widget title style section.
		$this->widget_title_style_controls();

		// Controls related to posts section.
		$this->posts_controls();

		// Controls related to posts filter section.
		$this->posts_filter_controls();

		// Controls related to posts pagination section.
		$this->posts_pagination_controls();

		// Controls related to slider options section.
		$this->slider_options_controls();

	}

	/**
	 * Controls related to widget title section.
	 */
	public function widget_title_controls() {

		// Widget title section.
		$this->start_controls_section(
			'section_colormag_widget_title_manage',
			array(
				'label' => esc_html__( 'Block Title', 'colormag' ),
			)
		);

		// Widget title.
		$this->add_control(
			'widget_title',
			array(
				'label'       => esc_html__( 'Title:', 'colormag' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your custom block title', 'colormag' ),
				'label_block' => true,
			)
		);

		if ( $this->enable_widget_title_link ) :

			// Widget title link.
			$this->add_control(
				'widget_title_link',
				array(
					'label'         => esc_html__( 'Title URL', 'colormag' ),
					'type'          => Controls_Manager::URL,
					'default'       => array(
						'url'         => '',
						'is_external' => '',
					),
					'show_external' => true,
				)
			);

		endif;

		// Extra option control related to widget title section.
		$this->widget_title_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to widget title section.
	 */
	public function widget_title_controls_extra() {
	}

	/**
	 * Controls related to widget title style section.
	 */
	public function widget_title_style_controls() {

		// Widget design section.
		$this->start_controls_section(
			'section_colormag_widget_title_design_manage',
			array(
				'label' => esc_html__( 'Widget Title', 'colormag' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'widget_title_color',
			array(
				'label'     => esc_html__( 'Color:', 'colormag' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#207daf',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .tg-module-wrapper .module-title span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tg-module-wrapper .module-title'      => 'border-bottom-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'widget_title_text_color',
			array(
				'label'     => esc_html__( 'Text Color:', 'colormag' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .tg-module-wrapper .module-title span'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .tg-module-wrapper .module-title span a' => 'color: {{VALUE}}',
				),
			)
		);

		// Extra option control related to widget title style section.
		$this->widget_title_style_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to widget title style section.
	 */
	public function widget_title_style_controls_extra() {
	}

	/**
	 * Controls related to posts section.
	 */
	public function posts_controls() {

		// Widget posts section.
		$this->start_controls_section(
			'section_colormag_posts_manage',
			array(
				'label' => esc_html__( 'Posts', 'colormag' ),
			)
		);

		$this->add_control(
			'posts_number',
			array(
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
				'type'    => Controls_Manager::TEXT,
				'default' => $this->post_number,
			)
		);

		$this->add_control(
			'offset_posts_number',
			array(
				'label' => esc_html__( 'Offset Posts:', 'colormag' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'meta_select',
			[
				'label'       => esc_html__( 'Meta', 'colormag' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => [
					'date'         => esc_html__( 'Date', 'colormag' ),
					'comment'      => esc_html__( 'Comment', 'colormag' ),
					'author'       => esc_html__( 'Author', 'colormag' ),
					'tag'          => esc_html__( 'Tag', 'colormag' ),
					'reading_time' => esc_html__( 'Reading Time', 'colormag' ),
				],
				'default'     => [ 'date' ],
			]
		);


		// Extra option control related to posts section.
		$this->posts_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to posts section.
	 */
	public function posts_controls_extra() {
	}

	/**
	 * Controls related to posts filter section.
	 */
	public function posts_filter_controls() {

		// Posts filter section.
		$this->start_controls_section(
			'section_colormag_posts_filter_manage',
			array(
				'label' => esc_html__( 'Filter', 'colormag' ),
			)
		);

		$this->add_control(
			'display_type',
			array(
				'label'   => esc_html__( 'Display the posts from:', 'colormag' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => array(
					'latest'     => esc_html__( 'Latest Posts', 'colormag' ),
					'categories' => esc_html__( 'Categories', 'colormag' ),
					'tags'       => esc_html__( 'Tags', 'colormag' ),
					'authors'    => esc_html__( 'Authors', 'colormag' ),
				),
			)
		);

		$this->add_control(
			'categories_selected',
			array(
				'label'     => esc_html__( 'Select categories:', 'colormag' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => colormag_elementor_categories(),
				'multiple'  => true,
				'condition' => array(
					'display_type' => 'categories',
				),
			)
		);

		$this->add_control(
			'tags_selected',
			array(
				'label'     => esc_html__( 'Select tags:', 'colormag' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => colormag_elementor_tags(),
				'multiple'  => true,
				'condition' => array(
					'display_type' => 'tags',
				),
			)
		);

		$this->add_control(
			'authors_selected',
			array(
				'label'     => esc_html__( 'Select authors:', 'colormag' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => colormag_elementor_authors(),
				'multiple'  => true,
				'condition' => array(
					'display_type' => 'authors',
				),
			)
		);

		$this->add_control(
			'posts_sort_orderby',
			array(
				'label'   => esc_html__( 'Orderby:', 'colormag' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'          => esc_html__( 'None', 'colormag' ),
					'ID'            => esc_html__( 'Post ID', 'colormag' ),
					'author'        => esc_html__( 'Post Author', 'colormag' ),
					'title'         => esc_html__( 'Post Title', 'colormag' ),
					'name'          => esc_html__( 'Post Name(Slug)', 'colormag' ),
					'date'          => esc_html__( 'Post Date', 'colormag' ),
					'modified'      => esc_html__( 'Post Modified Date', 'colormag' ),
					'rand'          => esc_html__( 'Random Post', 'colormag' ),
					'comment_count' => esc_html__( 'Comment Count', 'colormag' ),
				),
			)
		);

		$this->add_control(
			'posts_sort_order',
			array(
				'label'   => esc_html__( 'Sort Order:', 'colormag' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'ASC'  => esc_html__( 'Ascending', 'colormag' ),
					'DESC' => esc_html__( 'Descending', 'colormag' ),
				),
			)
		);

		// Extra option control related to posts filter section.
		$this->posts_filter_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to posts filter section.
	 */
	public function posts_filter_controls_extra() {
	}

	/**
	 * Controls related to posts pagination section.
	 */
	public function posts_pagination_controls() {

		// Pagination section.
		$this->start_controls_section(
			'section_colormag_posts_pagination_manage',
			array(
				'label' => esc_html__( 'Pagination', 'colormag' ),
			)
		);

		$this->add_control(
			'show_pagination',
			array(
				'label'        => esc_html__( 'Show Pagination', 'colormag' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Show', 'colormag' ),
				'label_off'    => esc_html__( 'Hide', 'colormag' ),
				'return_value' => 'yes',
			)
		);

		// Extra option control related to posts pagination section.
		$this->posts_pagination_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to posts pagination section.
	 */
	public function posts_pagination_controls_extra() {
	}

	/**
	 * Controls related to slider options section.
	 */
	public function slider_options_controls() {

		// Return if $has_slider_options is set to false.
		if ( ! $this->has_slider_options ) {
			return;
		}

		// Slider options section.
		$this->start_controls_section(
			'section_colormag_slider_options_manage',
			array(
				'label' => esc_html__( 'Slide Options', 'colormag' ),
			)
		);

		$this->add_control(
			'transition_time',
			array(
				'label'   => esc_html__( 'Transition Time', 'colormag' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3000,
			)
		);

		$this->add_control(
			'transition_speed',
			array(
				'label'   => esc_html__( 'Transition Speed', 'colormag' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 300,
			)
		);

		// Extra option control related to slider options section.
		$this->slider_options_controls_extra();

		$this->end_controls_section();

	}

	/**
	 * Extra option control related to slider options section.
	 */
	public function slider_options_controls_extra() {
	}

	/**
	 * Get the query var.
	 *
	 * @return int|mixed
	 */
	public function get_quuery_var() {

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		return $paged;

	}

	/**
	 * Query of the posts within the widgets.
	 *
	 * @param int    $posts_number        The number of posts to display.
	 * @param string $display_type        The display posts from the widget setting.
	 * @param int    $categories_selected The category id of the widget setting.
	 * @param int    $tags_selected       The tag id of the widget setting.
	 * @param int    $authors_selected    The author id of the widget setting.
	 * @param string $posts_sort_orderby  The posts order of the widget setting.
	 * @param string $posts_sort_order    The post sort order of the widget setting.
	 * @param int    $offset_posts_number The offset posts number of the widget setting.
	 * @param string $show_pagination     The option to enable the pagination  of the widget setting.
	 *
	 * @return \WP_Query
	 */
	public function query_posts( $posts_number, $display_type, $categories_selected, $tags_selected, $authors_selected, $posts_sort_orderby, $posts_sort_order, $offset_posts_number, $show_pagination = 'no' ) {

		$paged = $this->get_quuery_var();

		$query_args = array(
			'posts_per_page'      => $posts_number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'oderby'              => $posts_sort_orderby,
			'order'               => $posts_sort_order,
			'paged'               => $paged,
			'post_status'         => 'publish',
		);

		// Display from the category selected.
		if ( 'categories' == $display_type ) {
			$query_args['category__in'] = $categories_selected;
		}

		// Display from the tags selected.
		if ( 'tags' == $display_type ) {
			$query_args['tag__in'] = $tags_selected;
		}

		// Display from the authors selected.
		if ( 'authors' == $display_type ) {
			$query_args['author__in'] = $authors_selected;
		}

		// Offset the posts.
		if ( ! empty( $offset_posts_number ) ) {
			$query_args['offset'] = $offset_posts_number;
		} else {
			// adding the excluding post function.
			$post__not_in               = colormag_exclude_duplicate_posts();
			$query_args['post__not_in'] = $post__not_in;
		}

		// If no pagination enabled, set no_found_rows to true for better query handling and faster query execution.
		if ( 'no' == $show_pagination ) {
			$query_args['no_found_rows'] = true;
		}

		// Start the WP_Query Object/Class.
		$get_featured_posts = new \WP_Query( $query_args );

		return $get_featured_posts;

	}

	/**
	 * Displays the pagination in the widgets.
	 *
	 * @param string $show_pagination Option for pagination display.
	 * @param int    $total_pages     The total number of pages found on WP_Query.
	 */
	public function paginate_links( $show_pagination, $total_pages ) {

		// Return if pagination option is disabled.
		if ( 'yes' !== $show_pagination ) {
			return;
		}
		?>

		<div class="widget-pagination default-wp-page clearfix">
			<?php
			$big   = 999999999;
			$paged = $this->get_quuery_var();

			echo paginate_links(
				array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, $paged ),
					'total'     => $total_pages,
					'prev_text' => esc_html__( '&larr; Previous', 'colormag' ),
					'next_text' => esc_html__( 'Next &rarr;', 'colormag' ),
					'mid_size'  => 1,
				)
			); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>
		</div>

		<?php
	}

	/**
	 * Displays the widget title.
	 *
	 * @param string $widget_title             The available widget title.
	 * @param string $widget_title_link_url    The link to of the widget title.
	 * @param string $widget_title_link_target The link target of the added url.
	 */
	public function widget_title( $widget_title, $widget_title_link_url, $widget_title_link_target ) {

		// Return if $widget_title is empty.
		if ( ! $widget_title ) {
			return;
		}
		?>

		<div class="tg-module-title-wrap">
			<h4 class="module-title">
				<span>
					<?php
					if ( $widget_title_link_url ) {
						echo '<a href="' . esc_url( $widget_title_link_url ) . '" ' . $widget_title_link_target . '>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
					}

					// Displays the title.
					echo wp_kses_post( $widget_title );

					if ( $widget_title_link_url ) {
						echo '</a>';
					}
					?>
				</span>
			</h4>
		</div><!-- tg-module-title-wrap -->

		<?php
	}

	/**
	 * Displays the post title within the widgets.
	 */
	public function the_title() {
		?>
		<h3 class="tg-module-title cm-entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php
	}

	/**
	 * Displays the featured image of the post within the widgets.
	 *
	 * @param string $size The featured image size.
	 */
	public function the_post_thumbnail( $size = '' ) {
		?>
		<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
			<?php the_post_thumbnail( $size ); ?>
		</a>
		<?php
	}

	public function render_date() {
		if ( ! in_array( 'date', $this->get_control_value( 'meta_select' ) ) ) {
			return;
		}

		echo '<span class="ec-post__cm-post-date">' . get_the_date() . '</span>';
	}

}
