<?php
/**
 * Post formats custom outputs.
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
 * For Gallery Post Format.
 */
if ( has_post_format( 'gallery' ) ) :

	if ( get_post_gallery() ) :
		?>
		<div class="gallery-post-format">
			<?php
			$output         = '';
			$galleries      = get_post_gallery( $post, false );
			$attachment_ids = explode( ',', $galleries['ids'] );
			$output         = '<ul class="gallery-images">';

			foreach ( $attachment_ids as $attachment_id ) {
				// Displaying the attached image of gallery.
				$link = wp_get_attachment_image( $attachment_id, 'colormag-featured-image' );

				$output .= '<li>' . $link . '</li>';
			}

			$output .= '</ul>';

			echo wp_kses_post( $output );
			?>
		</div>
		<?php
	endif;

endif;

/**
 * For Video Post Format.
 */
if ( has_post_format( 'video' ) && ! ( has_post_thumbnail() ) ) :

	$video_post_url = get_post_meta( $post->ID, 'video_url', true );

	if ( ! empty( $video_post_url ) ) :
		?>
		<div class="fitvids-video">
			<?php
			$embed_code = wp_oembed_get( $video_post_url );

			echo do_shortcode( $embed_code );
			?>
		</div>
		<?php
	endif;

endif;
