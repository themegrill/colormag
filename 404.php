<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
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
			<div class="cm-posts">
				<section class="cm-error-404 cm-not-found">

					<?php if ( ! is_active_sidebar( 'colormag_error_404_page_sidebar' ) ) : ?>
						<header class="cm-page-header">
							<p><?php esc_html_e( 'oops ! Page Not Found', 'colormag' ); ?></p>

							<h1 class="cm-page-title"><?php esc_html_e( '404', 'colormag' ); ?></h1>
						</header>

						<div class="cm-page-content">
							<p><?php esc_html_e( 'We are sorry for the inconvenience. The page you’re trying to access does not exist or has been removed.', 'colormag' ); ?></p>
						</div>

						<a class="cm-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<span>
								<?php esc_html_e( 'Back to Home', 'colormag' ); ?>
							</span>
						</a>
					<?php
					else :
						dynamic_sidebar( 'colormag_error_404_page_sidebar' );
					endif;
					?>

				</section><!-- .cm-error-404 -->
			</div><!-- .cm-posts -->
		</div><!-- #cm-primary -->

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
