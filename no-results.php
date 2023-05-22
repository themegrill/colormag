<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="cm-no-results cm-not-found">
	<img
		src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/search-result.png' ); ?>"
		alt=""
	/>

	<header class="cm-page-header">
		<h1 class="cm-page-title"><?php esc_html_e( 'No matching post found', 'colormag' ); ?></h1>
	</header><!-- .cm-page-header -->

	<div class="cm-page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				printf(
					wp_kses(
					/* Translators: %1$s: Link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'colormag' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'colormag' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'colormag' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .cm-page-content -->

</section><!-- .cm-no-results -->
