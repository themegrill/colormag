<?php
/**
 * Site branding template file.
 *
 * @package colormag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="site-branding">
	<?php

	// Check for meta logo.
	$post_id      = get_the_ID();
	$meta_logo_id = ! is_home() ? intval( get_post_meta( $post_id, 'colormag_logo', true ) ) : '';

	if ( $meta_logo_id ) {

		$meta_logo_attr = array(
			'class'    => 'cm-logo',
			'itemprop' => 'logo',
		);

		// @codingStandardsIgnoreStart
		$meta_logo = apply_filters(
			'colormag_meta_logo',
			colormag_get_image_by_id( $meta_logo_id, $meta_logo_attr, get_bloginfo( 'name', 'display' ) )
		); // WPCS: CSRF ok.
		// @codingStandardsIgnoreEnd

		printf(
			'<a href="%1$s" class="cm-logo-link" rel="home" itemprop="url">%2$s</a>',
			esc_url( home_url( '/' ) ),
			$meta_logo
		);
	} else {

		do_action( 'colormag_mobile_logo' );

		the_custom_logo();
	}
	?>
	<div class="site-info-wrap">
		<?php
		// Front page with the latest posts.
		$html_tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';
		?>

		<<?php echo esc_attr( $html_tag ); ?> class="site-title ">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</<?php echo esc_attr( $html_tag ); ?>>


	<?php
	$colormag_description = get_bloginfo( 'description' );

	if ( $colormag_description || is_customize_preview() ) :
		?>
		<p class="site-description "><?php echo esc_html( $colormag_description ); /* WPCS: xss ok. */ ?></p>
		<?php
	endif;
	?>
</div>
</div><!-- .site-branding -->
