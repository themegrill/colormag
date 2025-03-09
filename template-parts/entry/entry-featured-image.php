<?php
/**
* Template part for entry header.
*
* @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ColorMag
* @since   @TODO
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$image_popup_id  = get_post_thumbnail_id();
$image_popup_url = wp_get_attachment_url( $image_popup_id );
?> 
	<div class="cm-featured-image">
				<?php if ( 1 == get_theme_mod( 'colormag_enable_lightbox', 0 ) ) : ?>
					<a href="<?php echo esc_url( $image_popup_url ); ?>" class="image-popup"><?php the_post_thumbnail( 'colormag-featured-image' ); ?></a>
					<?php
				else :
					the_post_thumbnail( 'colormag-featured-image' );
				endif;
				?>
			</div>
