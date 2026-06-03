<?php
/**
 * Site branding template file.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$screen_reader       = '';
$description         = get_bloginfo( 'description', 'display' );
$header_display_type = get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' );

?>
					<div id="cm-site-branding" class="cm-site-branding">
		<?php
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
		?>
					</div><!-- #cm-site-branding -->
	<?php

	if ( false === get_theme_mod( 'colormag_enable_site_identity', true ) || false === get_theme_mod( 'colormag_enable_site_tagline', true ) ) {
		$screen_reader = 'screen-reader-text';
	}
	?>

<?php


if ( true == get_theme_mod( 'colormag_enable_site_identity', true ) || true == get_theme_mod( 'colormag_enable_site_tagline', true ) ) {
	?>
	<div id="cm-site-info" class="<?php echo esc_attr( $screen_reader ); ?>">
		<?php
		if ( true == get_theme_mod( 'colormag_enable_site_identity', true ) ) {
			if ( is_front_page() || is_home() ) :
				?>
						<h1 class="cm-site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<h3 class="cm-site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h3>
						<?php
					endif;
		}
		?>

					<?php
					if ( true == get_theme_mod( 'colormag_enable_site_tagline', true ) ) {
						if ( $description || is_customize_preview() ) :
							?>
						<p class="cm-site-description">
							<?php echo esc_html( $description ); ?>
						</p><!-- .cm-site-description -->
							<?php
					endif;
					}
					?>
				</div><!-- #cm-site-info -->
	<?php
}
