<?php
/**
 * Implements a custom header for ColorMag.
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

/**
 * Setup the WordPress core custom header feature.
 */
function colormag_custom_header_setup() {

	add_theme_support(
		'custom-header',
		apply_filters(
			'colormag_custom_header_args',
			array(
				'default-image'          => '',
				'header-text'            => '',
				'default-text-color'     => '',
				'width'                  => 1400,
				'height'                 => 400,
				'flex-width'             => true,
				'flex-height'            => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'video'                  => true,
				'admin-preview-callback' => 'colormag_admin_header_image',
			)
		)
	);

}

add_action( 'after_setup_theme', 'colormag_custom_header_setup' );

function colormag_redirect_header_menu() {
	global $submenu;
	if ( ! isset( $submenu['themes.php'] ) ) {
		return;
	}
	$target_url = 'customize.php?autofocus%5Bsection%5D=colormag_header_builder_section&return=%2Fwp-admin%2F';
	foreach ( $submenu['themes.php'] as &$item ) {
		if ( isset( $item[2] ) && strpos( $item[2], 'autofocus%5Bcontrol%5D=header_image' ) !== false ) {
			$item[2] = $target_url;
			break;
		}
	}
}
add_action( 'admin_menu', 'colormag_redirect_header_menu', 999 );

if ( ! function_exists( 'colormag_admin_header_image' ) ) :

	/**
	 * Custom header image markup displayed on the Appearance > Header admin panel.
	 */
	function colormag_admin_header_image() {
		?>
		<div id="headimg">
			<?php
			if ( function_exists( 'the_custom_header_markup' ) ) {
				the_custom_header_markup();
			} else {
				if ( get_header_image() ) :
					?>
					<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
					<?php
				endif;
			}
			?>
		</div>
		<?php
	}

endif;
