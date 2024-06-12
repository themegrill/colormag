<?php
/**
 * Template Name: Contact Page Template
 *
 * Displays the Contact Page Template of the theme.
 *
 * @package    ColorMag
 *
 * @since      ColorMag 1.0.0
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
			<div class="cm-posts clearfix">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( '/template-parts/content', 'page' );
				endwhile;
				?>
			</div><!-- .cm-posts -->
		</div><!-- .cm-primary -->

	<?php

	colormag_sidebar_select();

	/**
	 * Hook: colormag_after_body_content.
	 */
	do_action( 'colormag_after_body_content' );
	?>
</div>

<?php
get_footer();
