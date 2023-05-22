<?php
/**
 * Template Name: Gutenberg Block / Page Builder (ColorMag)
 *
 * Displays the Page Builder Template provided via the theme.
 * Suitable for page builder plugins
 *
 * @package    ColorMag
 *
 * @since      ColorMag 2.2.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="cm-row">
	<?php

	/**
	 * Hook: colormag_before_body_content.
	 */
	do_action( 'colormag_before_body_content' );
	?>

		<div id="cm-primary" class="cm-primary">
			<div class="cm-posts" class="pagebuilder-content clearfix">
				<?php
				while ( have_posts() ) :
					the_post();

					the_content();
				endwhile;
				?>
			</div><!-- .cm-posts -->
		</div><!-- .cm-primary -->

	<?php
	/**
	 * Hook: colormag_after_body_content.
	 */
	do_action( 'colormag_after_body_content' );
	?>
</div>

<?php
get_footer();
