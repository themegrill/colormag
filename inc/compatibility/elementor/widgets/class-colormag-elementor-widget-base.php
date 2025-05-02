<?php
/**
 * Elementor Widget Base class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Declare required namespace.
namespace elementor\widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

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
	 * Register Colormag_Elementor_Widget_Base widget controls.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		// Controls related to widget title section.
		$this->widget_title_controls();

		// Controls related to general.
		$this->widget_general_controls();

		// Controls related to widget title style section.
		$this->widget_title_style_controls();

		// Controls related to posts section.
		$this->posts_controls();

		// Controls related to posts filter section.
		$this->posts_filter_controls();
	}

	/**
	 * Controls related to widget title section.
	 */
	public function widget_general_controls() {

		if ( 'ColorMag-Posts-Block-1' === $this->get_name() || 'ColorMag-Posts-Block-2' === $this->get_name() || 'ColorMag-Posts-Block-3' === $this->get_name() || 'ColorMag-Posts-Block-4' === $this->get_name() || 'ColorMag-Posts-Block-5' === $this->get_name() || 'ColorMag-Posts-Block-6' === $this->get_name() || 'ColorMag-Posts-Block-7' === $this->get_name() ) {
			$this->start_controls_section(
				'ec_button_style_section',
				[
					'label' => esc_html__( 'General', 'colormag' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
		}

		if ( 'ColorMag-Posts-Block-1' === $this->get_name() || 'ColorMag-Posts-Block-2' === $this->get_name() || 'ColorMag-Posts-Block-3' === $this->get_name() ) {
			$this->add_control(
				'post_element_select_style_1',
				[
					'label'       => esc_html__( 'Post Element', 'colormag' ),
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'options'     => [
						'image'   => esc_html__( 'Image', 'colormag' ),
						'title'   => esc_html__( 'Title', 'colormag' ),
						'meta'    => esc_html__( 'Tag', 'colormag' ),
						'excerpt' => esc_html__( 'Content', 'colormag' ),
					],
					'default'     => [ 'image', 'title', 'meta', 'excerpt' ],
				]
			);

			$this->add_control(
				'style_1_element_gap',
				[
					'label'     => __( 'Element Gap', 'colormag' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .tg_module_block.tg-first-block .tg-module-title'         => 'margin-top: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tg_module_block.tg-first-block .tg-module-meta'          => 'margin-top: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tg_module_block.tg-first-block .tg-expert entry-content' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}

		if ( 'ColorMag-Posts-Block-1' === $this->get_name() || 'ColorMag-Posts-Block-4' === $this->get_name() || 'ColorMag-Posts-Block-6' === $this->get_name() || 'ColorMag-Posts-Block-7' === $this->get_name() ) {
			// Widget second column post element.
			$this->add_control(
				'show_style_2_image',
				[
					'label'        => esc_html__( 'Image', 'colormag' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Show', 'colormag' ),
					'label_off'    => esc_html__( 'Hide', 'colormag' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'post_element_select_style_2',
				[
					'label'       => esc_html__( 'Post Element', 'colormag' ),
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'options'     => [
						'title'   => esc_html__( 'Title', 'colormag' ),
						'meta'    => esc_html__( 'Tag', 'colormag' ),
						'excerpt' => esc_html__( 'Content', 'colormag' ),
					],
					'default'     => [ 'title', 'meta', 'excerpt' ],
				]
			);

			$this->add_control(
				'style_2_element_gap',
				[
					'label'     => __( 'Element Gap', 'colormag' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .tg-two-block .tg-module-meta' => 'margin-top: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tg-two-block .tg-excerpt'     => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}

		if ( 'ColorMag-Posts-Block-1' === $this->get_name() || 'ColorMag-Posts-Block-2' === $this->get_name() || 'ColorMag-Posts-Block-3' === $this->get_name() || 'ColorMag-Posts-Block-4' === $this->get_name() || 'ColorMag-Posts-Block-5' === $this->get_name() || 'ColorMag-Posts-Block-6' === $this->get_name() || 'ColorMag-Posts-Block-7' === $this->get_name() ) {
			$this->end_controls_section();
		}
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
			array_merge(
				array(
					'label'     => esc_html__( 'Color:', 'colormag' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tg-module-wrapper .module-title span' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .tg-module-wrapper .module-title'      => 'border-bottom-color: {{VALUE}}',
					),
				),
				class_exists( Color::class ) ? [
					'scheme' => array(
						'type'  => Color::get_type(),
						'value' => Color::COLOR_1,
					),
				] : [
					'global' => [
						'default' => '',
					],
				]
			)
		);

				$this->add_control(
					'widget_title_text_color',
					array_merge(
						array(
							'label'     => esc_html__( 'Text Color:', 'colormag' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#232323',
							'selectors' => array(
								'{{WRAPPER}} .tg-module-wrapper .module-title span' => 'color: {{VALUE}}',
							),
						),
						class_exists( Color::class ) ? [
							'scheme' => array(
								'type'  => Color::get_type(),
								'value' => Color::COLOR_1,
							),
						] : [
							'global' => [
								'default' => '',
							],
						]
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
				),
			)
		);

		$this->add_control(
			'categories_selected',
			array(
				'label'     => esc_html__( 'Select categories:', 'colormag' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => colormag_elementor_categories(),
				'condition' => array(
					'display_type' => 'categories',
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
	 * Query of the posts within the widgets.
	 *
	 * @param int    $posts_number        The number of posts to display.
	 * @param string $display_type        The display posts from the widget setting.
	 * @param int    $categories_selected The category id of the widget setting.
	 * @param int    $offset_posts_number The offset posts number of the widget setting.
	 *
	 * @return \WP_Query
	 */
	public function query_posts( $posts_number, $display_type, $categories_selected, $offset_posts_number ) {

		$query_args = array(
			'posts_per_page'      => $posts_number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		// Display from the category selected.
		if ( 'categories' == $display_type ) {
			$query_args['category__in'] = $categories_selected;
		}

		// Offset the posts.
		if ( ! empty( $offset_posts_number ) ) {
			$query_args['offset'] = $offset_posts_number;
		}

		// Start the WP_Query Object/Class.
		$get_featured_posts = new \WP_Query( $query_args );

		return $get_featured_posts;
	}

	/**
	 * Displays the widget title.
	 *
	 * @param string $widget_title The available widget title.
	 */
	public function widget_title( $widget_title ) {

		// Return if $widget_title is empty.
		if ( ! $widget_title ) {
			return;
		}
		?>

		<div class="tg-module-title-wrap">
			<h4 class="module-title">
				<span><?php echo esc_html( $widget_title ); ?></span>
			</h4>
		</div>

		<?php
	}

	/**
	 * Displays the post title within the widgets.
	 */
	public function the_title() {
		?>
		<h3 class="tg-module-title entry-title">
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
}
