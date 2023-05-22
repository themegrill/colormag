<?php
/**
 * Tabbed widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tabbed widget.
 *
 * Class colormag_tabbed_widget
 */
class colormag_tabbed_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-tab-widget cm-featured-posts';
		$this->widget_description = esc_html__( 'Displays the popular posts, latest posts and the recent comments in tab. Suitable for the Right/Left sidebar.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Tabbed Widget', 'colormag' );
		$this->settings           = array(
			'enabled_tabs'       => array(
				'type'    => 'checkboxes',
				'default' => array(
					'popular-tab' => 1,
					'recent-tab'  => 1,
					'comment-tab' => 1,
				),
				'label'   => esc_html__( 'Select Tabs', 'colormag' ),
				'choices' => array(
					'popular-tab' => esc_html__( 'Popular', 'colormag' ),
					'recent-tab'  => esc_html__( 'Recent', 'colormag' ),
					'comment-tab' => esc_html__( 'Comments', 'colormag' ),
				),
			),
			'tabs_order'         => array(
				'type'        => 'numbers',
				'default'     => array(
					'popular-tab' => 1,
					'recent-tab'  => 2,
					'comment-tab' => 3,
				),
				'label'       => esc_html__( 'Tab Order', 'colormag' ),
				'choices'     => array(
					'popular-tab' => esc_html__( 'Popular', 'colormag' ),
					'recent-tab'  => esc_html__( 'Recent', 'colormag' ),
					'comment-tab' => esc_html__( 'Comments', 'colormag' ),
				),
				'input_attrs' => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 3,
				),
			),
			'number'             => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of popular posts, recent posts and comments to display:', 'colormag' ),
			),
			'popular_view_count' => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to enable the popular post by view count.', 'colormag' ),
			),
		);

		parent::__construct();

	}

	/**
	 * Output widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {

		// Enqueue the required JS for this widget.
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() || ColorMag_Utils::colormag_elementor_active_page_check() ) {
			wp_enqueue_script( 'colormag-easy-tabs' );
		}

		$number             = empty( $instance['number'] ) ? 4 : $instance['number'];
		$popular_view_count = ! empty( $instance['popular_view_count'] ) ? 'true' : 'false';
		$enabled_tabs       = ! empty ( $instance['enabled_tabs'] ) ? $instance['enabled_tabs'] : array(
			'popular-tab' => 1,
			'recent-tab'  => 1,
			'comment-tab' => 1,
		);

		$icon_comment = colormag_get_icon('comment', false);
		$icon_heart   = colormag_get_icon('heart-fill', false);
		$icon_recent  = colormag_get_icon('clock', false);

		$available_tabs     = array(
			'popular-tab' => $icon_heart . __( 'Popular', 'colormag' ),
			'recent-tab'  => $icon_recent . __( 'Recent', 'colormag' ),
			'comment-tab' => $icon_comment . __( 'Comment', 'colormag' ),
		);
		$tabs_number        = count( $enabled_tabs );
		$tabs_order         = ! empty ( $instance['tabs_order'] ) ? $instance['tabs_order'] : array();

		if ( $tabs_order ) {
			// Order the tabs according to the user set criteria.
			array_multisort( $tabs_order, $available_tabs );
		}

		$this->widget_start( $args );
		?>

		<div class="cm-tabbed-widget">
			<ul class="cm-tabs column-<?php echo absint( $tabs_number ); ?>">
				<?php foreach ( $available_tabs as $tab => $label ) : ?>
					<?php if ( ! empty( $enabled_tabs[ $tab ] ) ) : ?>
						<li class="tabs <?php echo esc_attr( $tab ); ?>-tabs">
							<a href="#<?php echo esc_attr( $tab ); ?>"><?php echo $label; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?></a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>

			<?php foreach ( $available_tabs as $tab => $label ) : ?>
				<?php if ( 'popular-tab' == $tab && ! empty( $enabled_tabs[ $tab ] ) ) : ?>
					<div class="cm-tabbed-widget-popular" id="popular-tab">
						<?php
						global $post;

						// Build up the WP_Query args.
						$query_args = array(
							'posts_per_page'      => $number,
							'post_type'           => 'post',
							'ignore_sticky_posts' => true,
							'orderby'             => 'comment_count',
							'no_found_rows'       => true,
						);

						// Condition if the user is displaying popular posts via post count.
						if ( 'true' === $popular_view_count ) {
							$query_args['meta_key'] = 'total_number_of_views';
							$query_args['orderby']  = 'meta_value_num';
							$query_args['order']    = 'DESC';
						}

						$get_featured_posts = new WP_Query( $query_args );

						$featured = 'colormag-featured-post-small';
						while ( $get_featured_posts->have_posts() ) :
							$get_featured_posts->the_post();
							?>

							<div class="cm-post">
								<?php
								if ( has_post_thumbnail() ) {
									$this->the_post_thumbnail( $post->ID, $featured, 'tabbed-images' );
								}
								?>

								<div class="cm-post-content">
									<?php
									// Displays the post title.
									$this->the_title();

									// Displays the post meta.
									$this->entry_meta();
									?>
								</div>
							</div>
							<?php
						endwhile;
						// Reset Post Data.
						wp_reset_query();
						?>
					</div>
				<?php endif; ?>

				<?php if ( 'recent-tab' == $tab && ! empty( $enabled_tabs[ $tab ] ) ) : ?>
					<div class="cm-tabbed-widget-recent" id="recent-tab">
						<?php
						global $post;

						// Build up the WP_Query args.
						$query_args = array(
							'posts_per_page'      => $number,
							'post_type'           => 'post',
							'ignore_sticky_posts' => true,
							'no_found_rows'       => true,
						);

						$get_featured_posts = new WP_Query( $query_args );

						$featured = 'colormag-featured-post-small';
						while ( $get_featured_posts->have_posts() ) :
							$get_featured_posts->the_post();
							?>

							<div class="cm-post clearfix">
								<?php
								if ( has_post_thumbnail() ) {
									$this->the_post_thumbnail( $post->ID, $featured, 'tabbed-images' );
								}
								?>

								<div class="cm-post-content">
									<?php
									// Displays the post title.
									$this->the_title();

									// Displays the post meta.
									$this->entry_meta();
									?>
								</div>
							</div>
							<?php
						endwhile;
						// Reset Post Data.
						wp_reset_postdata();
						?>
					</div>
				<?php endif; ?>

				<?php if ( 'comment-tab' == $tab && ! empty( $enabled_tabs[ $tab ] ) ) : ?>
					<div class="cm-tabbed-widget-comment" id="comment-tab">
						<?php
						$comments_query = new WP_Comment_Query();
						$commented      = '';
						$comments       = $comments_query->query(
							array(
								'number' => $number,
								'status' => 'approve',
							)
						);

						if ( $comments ) :
							foreach ( $comments as $comment ) :
								$commented .= '<li class="tabbed-comment-widget">';
								$commented .= '<a class="author" href="' . esc_url( get_permalink( $comment->comment_post_ID ) ) . '#comment-' . esc_attr( $comment->comment_ID ) . '">';
								$commented .= get_avatar( $comment->comment_author_email, '50' );
								$commented .= esc_html( get_comment_author( $comment->comment_ID ) );
								$commented .= '</a> ';
								$commented .= esc_html__( 'says:', 'colormag' );
								$commented .= '<p class="commented">';
								$commented .= wp_strip_all_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, '50' ) );
								$commented .= '...';
								$commented .= '</p>';
								$commented .= '</li>';
							endforeach;
						else :
							$commented .= esc_html__( 'No comments', 'colormag' );
						endif;

						echo $commented; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
						?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

		</div>

		<?php
		$this->widget_end( $args );

	}

}
