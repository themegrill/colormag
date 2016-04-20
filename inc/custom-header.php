<?php
/**
 * Implements a custom header for ColorMag.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 */
function colormag_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'colormag_custom_header_args', array(
		'default-image'          => '',
		'header-text'				 => '',
		'default-text-color'     => '',
		'width'                  => 1400,
		'height'                 => 400,
		'flex-width'				 => true,
		'flex-height'            => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => 'colormag_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'colormag_custom_header_setup' );

if ( ! function_exists( 'colormag_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function colormag_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
		<?php endif; ?>
	</div>
<?php
}
endif; // colormag_admin_header_image