<?php
$plugins = get_plugins();
$action  = $url = $classes = '';

if ( current_user_can( 'install_plugins' ) ) {
	if ( empty( $plugins['themegrill-demo-importer/themegrill-demo-importer.php'] ) ) {
		$action  = esc_html__( 'Install ThemeGrill Demo importer', 'colormag' );
		$url     = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=themegrill-demo-importer' ), 'install-plugin_themegrill-demo-importer' );
		$classes = ' install-now';
	} elseif ( is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
		$action  = esc_html__( 'Activate ThemeGrill Demo importer', 'colormag' );
		$url     = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=themegrill-demo-importer/themegrill-demo-importer.php&from=importer' ), 'activate-plugin_themegrill-demo-importer/themegrill-demo-importer.php' );
		$classes = ' activate-now';
	}
}
?>
	<div class="wrap demo-importer">
		<div class="themegrill-demo-importer-BlankState">

			<div class="themegrill-demo-importer-BlankState-info">
				<h2 class="themegrill-demo-importer-BlankState-message"><?php echo __( 'In order to be able to import any starter sites for <br> ColorMag you need to install ThemeGrill demo <br> importer plugin active.', 'colormag' ); ?></h2>

				<?php if ( $action ) : ?>
					<a <?php echo esc_attr( $classes ); ?>"
					href="<?php echo esc_url( $url ); ?>"
					data-name="<?php esc_attr_e( 'ThemeGrill Demo Importer', 'colormag' ); ?>"
					data-slug="themegrill-demo-importer"
					>
					<span><?php echo esc_html( $action ); ?></span>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
