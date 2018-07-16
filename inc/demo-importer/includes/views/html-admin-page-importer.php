<?php
/**
 * Admin View: Page - Importer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_plugin_installed = false;

// See if the plugin is installed already.
if ( file_exists( WP_PLUGIN_DIR . '/' . $this->plugin_data['slug'] ) ) {
	// Looks like an importer is installed, but not active.
	$plugins = get_plugins( '/' . $this->plugin_data['slug'] );
	if ( ! empty( $plugins ) ) {
		$keys = array_keys( $plugins );
		$plugin_file = $this->plugin_data['slug'] . '/' . $keys[0];
		$url = wp_nonce_url( add_query_arg( array(
			'action' => 'activate',
			'plugin' => $plugin_file,
		), admin_url( 'plugins.php' ) ), 'activate-plugin_' . $plugin_file );

		$is_plugin_installed = true;
	}
} else {
	$url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $this->plugin_data['slug'] ), 'install-plugin_' . $this->plugin_data['slug'] );
}

?>
<div class="wrap demo-importer">
	<h1><?php esc_html_e( 'Demo Importer', 'colormag' ); ?></h1>
	<div class="demo-importer-BlankState">
		<h2 class="demo-importer-BlankState-message"><?php printf( __( '%s available demos can be imported with just a single click. They will appear here once the plugin is active.', 'colormag' ), $theme->Name ); ?></h2>
		<?php if ( ! $is_plugin_installed ) : ?>
			<a class="demo-importer-BlankState-cta button button-primary button-hero install-now" href="<?php echo esc_url( $url ); ?>" aria-label="<?php esc_attr_e( sprintf( __( 'Install %s now', 'colormag' ), $this->plugin_data['name'] ) ); ?>" data-slug="<?php echo esc_attr( $this->plugin_data['slug'] ); ?>" data-name="<?php echo esc_attr( $this->plugin_data['name'] ); ?>"><?php _e( sprintf( __( 'Install %s', 'colormag' ), $this->plugin_data['name'] ) ); ?></a>
		<?php else : ?>
			<a class="demo-importer-BlankState-cta button button-primary button-hero activate-now" href="<?php echo esc_url( $url ); ?>" aria-label="<?php esc_attr_e( sprintf( __( 'Activate %s now', 'colormag' ), $this->plugin_data['name'] ) ); ?>"><?php _e( sprintf( __( 'Activate %s', 'colormag' ), $this->plugin_data['name'] ) ); ?></a>
		<?php endif; ?>
	</div>
</div>

<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
