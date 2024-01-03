<?php
$plugins = get_plugins();
$action  = $url = $classes = '';

function demo_importer_plugin_check_html() {

	// Check if TDI is installed but not activated or not installed at all or installed and activated.
	if ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
		$colormag_btn_texts = __( 'Activate ThemeGrill Demo Importer Plugin', 'colormag' );
	} elseif ( ! file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
		$colormag_btn_texts = __( 'Install ThemeGrill Demo Importer Plugin', 'colormag' );
	} else {
		$colormag_btn_texts = __( 'View Starter Templates', 'colormag' );
	}

	$html = '<a class="btn-get-started" href="#" data-name="' . esc_attr( 'themegrill-demo-importer' ) . '" data-slug="' . esc_attr( 'themegrill-demo-importer' ) . '" aria-label="' . esc_attr( $colormag_btn_texts ) . '"><span>' . esc_html( $colormag_btn_texts ) . '</span></a>';

	return $html;
}
?>
	<div class="wrap demo-importer">
		<div class="themegrill-demo-importer-BlankState">

			<div class="themegrill-demo-importer-BlankState-info">
				<h2 class="themegrill-demo-importer-BlankState-message"><?php echo __( 'In order to be able to import any starter sites for <br> ColorMag you need to install ThemeGrill demo <br> importer plugin active.', 'colormag' ); ?></h2>
				<?php echo demo_importer_plugin_check_html(); ?>
			</div>

		</div>
	</div>
<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
