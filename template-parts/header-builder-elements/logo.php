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

$screen_reader           = '';
$description             = get_bloginfo( 'description', 'display' );
$header_display_type     = get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' );
$site_identity_enable    = get_theme_mod( 'colormag_enable_site_identity', true );
$site_tagline_enable     = get_theme_mod( 'colormag_enable_site_tagline', true );
$site_title_visibility   = get_theme_mod(
	'colormag_header_site_title_visibility',
	array(
		'desktop',
		'tablet',
		'mobile',
	)
);
$site_tagline_visibility = get_theme_mod(
	'colormag_header_site_tagline_visibility',
	array(
		'desktop',
		'tablet',
		'mobile',
	)
);

$device_types = array( 'desktop', 'tablet', 'mobile' );

$device_classes = array();
foreach ( $device_types as $device ) {
	if ( in_array( $device, $site_title_visibility, true ) ) {
		$device_classes[] = "cm-title-show-$device";
	}
}

$tagline_device_classes = array();
foreach ( $device_types as $device ) {
	if ( in_array( $device, $site_tagline_visibility, true ) ) {
		$tagline_device_classes[] = "cm-tagline-show-$device";
	}
}
?>


	<div id="cm-site-branding" class="cm-site-branding">
		<?php
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
		?>
	</div><!-- #cm-site-branding -->

<?php

if ( $site_identity_enable || $site_tagline_enable ) {
	?>
	<div id="cm-site-info" class="">
		<?php
		if ( $site_identity_enable ) {
			if ( is_front_page() || is_home() ) :
				?>
				<h1 class="cm-site-title <?php echo esc_attr( implode( ' ', $device_classes ) ); ?> <?php echo esc_attr( false === $site_identity_enable ? $screen_reader : '' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			<?php else : ?>
				<h3 class="cm-site-title <?php echo esc_attr( implode( ' ', $device_classes ) ); ?> <?php echo esc_attr( false === $site_identity_enable ? $screen_reader : '' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h3>
				<?php
			endif;
		}
		?>

		<?php
		if ( $site_tagline_enable ) {
			if ( $description || is_customize_preview() ) :
				?>
				<p class="cm-site-description <?php echo esc_attr( implode( ' ', $tagline_device_classes ) ); ?> <?php echo esc_attr( false === $site_tagline_enable ? $screen_reader : '' ); ?>">
					<?php echo esc_html( $description ); ?>
				</p><!-- .cm-site-description -->
				<?php
			endif;
		}
		?>
	</div><!-- #cm-site-info -->
	<?php
}
