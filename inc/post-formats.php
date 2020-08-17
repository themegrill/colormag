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

			echo $output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>
		</div>
		<?php
	endif;

endif;
