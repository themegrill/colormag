<?php
/**
 * Elementor Widget Base class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Declare required namespace.
namespace ColorMagElementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

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
	protected function _register_controls() {

		// Controls related to widget title section.
		$this->widget_title_controls();

		// Controls related to widget title style section.
		$this->widget_title_style_controls();

		// Controls related to posts section.
		$this->posts_controls();

		// Controls related to posts filter section.
		$this->posts_filter();

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
			array(
				'label'     => esc_html__( 'Color:', 'colormag' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#289dcc',
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
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
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .tg-module-wrapper .module-title span' => 'color: {{VALUE}}',
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
			'section_colormag_osts_manage',
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
	public function posts_filter() {

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

		$this->end_controls_section();

	}

}
