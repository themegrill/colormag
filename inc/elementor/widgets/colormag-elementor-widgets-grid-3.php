<?php
/**
 * ColorMag Elementor Widget Grid 3.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class ColorMag_Elementor_Widgets_Grid_3 extends Widget_Base {

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Grid_3 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ColorMag-Posts-Grid-3';
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Grid_3 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Grid Style 3', 'colormag' );
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Grid_3 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'colormag-econs-grid-3';
	}

	/**
	 * Retrieve the list of categories the ColorMag_Elementor_Widgets_Grid_3 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'colormag-widget-grid' );
	}

	/**
	 * Register ColorMag_Elementor_Widgets_Grid_3 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		// Widget title section
		$this->start_controls_section(
			'section_colormag_featured_posts_grid_3_title_manage',
			array(
				'label' => esc_html__( 'Block Title', 'colormag' ),
			)
		);

		$this->add_control(
			'widget_title',
			array(
				'label'       => esc_html__( 'Title:', 'colormag' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your custom block title', 'colormag' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		// Widget design section
		$this->start_controls_section(
			'section_colormag_featured_posts_grid_3_design_manage',
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

		$this->end_controls_section();

		// Widget posts section
		$this->start_controls_section(
			'section_colormag_featured_posts_grid_3_posts_manage',
			array(
				'label' => esc_html__( 'Posts', 'colormag' ),
			)
		);

		$this->add_control(
			'posts_number',
			array(
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 2,
			)
		);

		$this->add_control(
			'offset_posts_number',
			array(
				'label' => esc_html__( 'Offset Posts:', 'colormag' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		// Widget filter section
		$this->start_controls_section(
			'section_colormag_featured_posts_grid_3_filter_manage',
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

	/**
	 * Render ColorMag_Elementor_Widgets_Grid_3 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$posts_number        = $this->get_settings( 'posts_number' );
		$display_type        = $this->get_settings( 'display_type' );
		$offset_posts_number = $this->get_settings( 'offset_posts_number' );
		$categories_selected = $this->get_settings( 'categories_selected' );

		$args = array(
			'posts_per_page'      => $posts_number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		// Display from the category selected
		if ( 'categories' == $display_type ) {
			$args[ 'category__in' ] = $categories_selected;
		}

		// Offset the posts
		if ( ! empty( $offset_posts_number ) ) {
			$args[ 'offset' ] = $offset_posts_number;
		}

		// Start the WP_Query Object/Class
		$get_featured_posts = new \WP_Query( $args );
		?>

		<div class="tg-module-grid tg-module-grid--style-3 tg-module-wrapper">
			<?php
			$widget_title = $this->get_settings( 'widget_title' );
			if ( ! empty( $widget_title ) ) : ?>
				<div class="tg-module-title-wrap">
					<h4 class="module-title">
						<span><?php echo $this->get_settings( 'widget_title' ); ?></span>
					</h4>
				</div>
			<?php endif;
			?>

			<div class="tg-row thinner">
				<?php
				$count = 1;
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post(); ?>

					<?php
					$custom_class = ( ( $count % 2 ) == 1 ) ? 'tg_module_grid' : 'tg_module_grid';
					?>

					<div class="tg-col-control">
						<div class="<?php echo esc_attr( $custom_class ); ?>">
							<?php
							if ( has_post_thumbnail() ) : ?>
								<figure class="tg-module-thumb">
									<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
										<?php the_post_thumbnail( 'colormag-elementor-grid-large-thumbnail' ); ?>
									</a>
								</figure>
							<?php endif;
							?>

							<div class="tg-module-info">
								<?php colormag_elementor_colored_category(); ?>

								<h3 class="tg-module-title entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php colormag_elementor_widgets_meta(); // Displays the entry meta
								?>
							</div>
						</div>
					</div>

					<?php
					$count ++;
				endwhile;

				// Reset the postdata
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php
	}
}
