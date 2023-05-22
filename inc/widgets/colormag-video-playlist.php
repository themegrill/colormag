<?php
/**
 * Video Playlist Widget.
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
 * Video Playlist Widget.
 *
 * Class colormag_video_playlist
 */
class colormag_video_playlist extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass             = 'widget_video_player';
		$this->widget_description          = esc_html__( 'Display video playlist from Video Post Formats.', 'colormag' );
		$this->widget_name                 = esc_html__( 'TG: Featured Videos Playlist', 'colormag' );
		$this->customize_selective_refresh = false;
		$this->settings                    = array(
			'title'           => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'            => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'number'          => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
			),
			'type'            => array(
				'type'    => 'radio',
				'default' => 'latest',
				'label'   => '',
				'choices' => array(
					'latest'   => esc_html__( 'Show latest Posts', 'colormag' ),
					'category' => esc_html__( 'Show posts from a category', 'colormag' ),
					'tag'      => esc_html__( 'Show posts from a tag', 'colormag' ),
					'author'   => esc_html__( 'Show posts from an author', 'colormag' ),
				),
			),
			'category'        => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
			),
			'tag'             => array(
				'type'    => 'dropdown_tags',
				'default' => '',
				'label'   => esc_html__( 'Select tag', 'colormag' ),
			),
			'author'          => array(
				'type'    => 'dropdown_users',
				'default' => '',
				'label'   => esc_html__( 'Select author', 'colormag' ),
			),
			'layout'          => array(
				'type'    => 'select',
				'default' => 'vertical',
				'label'   => esc_html__( 'Layout:', 'colormag' ),
				'choices' => array(
					'vertical'   => esc_html__( 'Vertical', 'colormag' ),
					'horizontal' => esc_html__( 'Horizontal', 'colormag' ),
				),
			),
			'random_posts'    => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the random post from either the chosen category or from latest post.', 'colormag' ),
			),
			'child_category'  => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the posts from child category of the chosen category.', 'colormag' ),
			),
			'view_all_button' => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the view all button to link that button to the specific category chosen in this widget.', 'colormag' ),
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
			wp_enqueue_script( 'jquery-video' );
		}

		global $post;
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = isset( $instance['text'] ) ? $instance['text'] : '';
		$number          = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type            = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category        = isset( $instance['category'] ) ? $instance['category'] : '';
		$layout          = isset( $instance['layout'] ) ? $instance['layout'] : 'vertical';
		$random_posts    = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$child_category  = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag             = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author          = isset( $instance['author'] ) ? $instance['author'] : '';
		$view_all_button = ! empty( $instance['view_all_button'] ) ? 'true' : 'false';

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: Featured Videos Playlist Description' . $this->id, $text );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text = icl_t( 'ColorMag Pro', 'TG: Featured Videos Playlist Description' . $this->id, $text );
		}

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author, $random_posts, $child_category, $video_post_format_args = true );

		colormag_append_excluded_duplicate_posts( $get_featured_posts );

		$this->widget_start( $args );
		?>

		<?php
		// Displays the widget title.
		$this->widget_title( $title, $type, $category, $view_all_button );

		// Display the description.
		$this->widget_description( $text );
		?>

		<div class="video-player video-player--<?php echo esc_attr( $layout ); ?>">
			<?php
			$video_count     = 1;
			$player_output   = '';
			$playlist_output = '';
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();

				$video_url  = get_post_meta( get_the_ID(), 'video_url', true );
				$embed_data = colormag_get_embed_data( $video_url );

				if ( ! empty( $embed_data ) ) {

					if ( 1 == $video_count ) {
						$player_output .= '<div class="video-frame video-playing">';
						$player_output .= '<iframe class="player-frame" id="video-item-' . absint( $video_count ) . '" src="' . esc_url( $embed_data['url'] ) . '" frameborder="0" width="100%"" height="434" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
						$player_output .= '</div><!-- .video-player-wrapper -->';
					}

					$playlist_output .= '<div class="video-playlist-item" data-id="video-item-' . absint( $video_count ) . '" data-src="' . esc_url( $embed_data['url'] ) . '">';
					$playlist_output .= '<img src="' . esc_url( $embed_data['thumb'] ) . '" />';
					$playlist_output .= '<div class="video-playlist-info">';
					$playlist_output .= '<h2 class="video-playlist-title">' . esc_html( get_the_title() ) . '</h2>';
					$playlist_output .= '<span class="video-duration"></span>';
					$playlist_output .= '</div>';
					$playlist_output .= '</div>';
				}

				$video_count ++;
			endwhile;
			// Reset Post Data.
			wp_reset_postdata();

			// Displays the video.
			if ( ! empty( $player_output ) ) {
				echo $player_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}

			// Displays the available playlist.
			if ( ! empty( $playlist_output ) ) {
				?>
				<div class="video-playlist">
					<?php echo $playlist_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php } ?>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
