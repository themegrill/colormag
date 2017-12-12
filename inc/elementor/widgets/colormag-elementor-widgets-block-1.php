<?php
/**
 * ColorMag Elementor Widget Block 1.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class ColorMag_Elementor_Widgets_Block_1 extends Widget_Base {

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ColorMag-Posts-Block-1';
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Block Style 1', 'colormag' );
	}

	/**
	 * Retrieve ColorMag_Elementor_Widgets_Block_1 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'colormag-econs-block-1';
	}

	/**
	 * Retrieve the list of categories the ColorMag_Elementor_Widgets_Block_1 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'colormag-widget-blocks' );
	}

	/**
	 * Register ColorMag_Elementor_Widgets_Block_1 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		// Widget title section
		$this->start_controls_section(
			'section_colormag_featured_posts_block_1_title_manage',
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
			'section_colormag_featured_posts_block_1_design_manage',
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
			'section_colormag_featured_posts_block_1_posts_manage',
			array(
				'label' => esc_html__( 'Posts', 'colormag' ),
			)
		);

		$this->add_control(
			'posts_number',
			array(
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 5,
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
			'section_colormag_featured_posts_block_1_filter_manage',
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
	 * Render ColorMag_Elementor_Widgets_Block_1 widget output on the frontend.
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

		<div class="tg-module-block tg-module-block--style-1 tg-module-wrapper">
			<?php
			$widget_title = $this->get_settings( 'widget_title' );
			if ( ! empty( $widget_title ) ) : ?>
				<div class="tg-module-title-wrap">
					<h4 class="module-title">
						<span><?php echo $this->get_settings( 'widget_title' ); ?></span>
					</h4>
				</div><!-- tg-module-title-wrap -->
			<?php endif;
			?>

			<div class="tg-row">
				<?php
				$count = 1;
				while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post(); ?>

			<?php
			$featured_image_size = ( $count == 1 ) ? 'colormag-featured-image' : 'colormag-featured-post-small';
			?>
			<?php if ( $count == 1 ) : // on first post. ?>
				<div class="tg-col-control">
					<div class="tg_module_block">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="tg-module-thumb">
								<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
									<?php the_post_thumbnail( $featured_image_size ); ?>
								</a>
								<?php colormag_elementor_colored_category(); ?>
							</figure>
							<?php
						else :
							if ( $count == 1 ) :
								colormag_elementor_colored_category();
							endif;
						endif;
						?>
						<h3 class="tg-module-title entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php colormag_elementor_widgets_meta(); // Displays the entry meta ?>
						<div class="tg-expert entry-content">
							<?php the_excerpt(); // Displays the post excerpts
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $count == 2 ) : ?>
				<div class="tg-col-control">
					<?php endif; ?>
					<?php if ( $count >= 2 ) : // add grid style after first post. ?>
						<div class="tg_module_block tg_module_block--list-small">
							<?php if ( has_post_thumbnail() ) : ?>
								<figure class="tg-module-thumb">
									<a href="<?php the_permalink(); ?>" class="tg-thumb-link">
										<?php the_post_thumbnail( $featured_image_size ); ?>
									</a>
								</figure>
								<?php
							endif;
							?>
							<div class="tg-module-info">
								<h3 class="tg-module-title entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php colormag_elementor_widgets_meta(); // Displays the entry meta ?>
							</div>
						</div>
					<?php endif;
					$count ++;
					endwhile;
					?>
					<?php if ( $count > 2 ) : ?>
				</div>
			<?php endif; ?>
				<?php
				// Reset the postdata
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
	}
}

