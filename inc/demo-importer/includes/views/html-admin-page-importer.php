<?php
/**
 * Admin View: Page - Importer
 *
 * @package Importer
 */

defined( 'ABSPATH' ) || exit;

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
	<div class="themegrill-demo-importer-BlankState">
		<svg aria-hidden="true" class="octicon octicon-desktop-download themegrill-demo-importer-BlankState-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 6h3V0h2v6h3l-4 4-4-4zm11-4h-4v1h4v8H1V3h4V2H1c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h5.34c-.25.61-.86 1.39-2.34 2h8c-1.48-.61-2.09-1.39-2.34-2H15c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1z"></path></svg>
		<h2 class="themegrill-demo-importer-BlankState-message"><?php esc_html_e( 'Ready to start importing available demos with just a single click?', 'colormag' ); ?></h2>
		<?php if ( ! $is_plugin_installed ) : ?>
			<a class="themegrill-demo-importer-BlankState-cta button button-primary install-now" href="<?php echo esc_url( $url ); ?>" aria-label="<?php esc_attr_e( sprintf( __( 'Install %s now', 'colormag' ), $this->plugin_data['name'] ) ); ?>" data-slug="<?php echo esc_attr( $this->plugin_data['slug'] ); ?>" data-name="<?php echo esc_attr( $this->plugin_data['name'] ); ?>"><?php _e( sprintf( __( 'Install %s', 'colormag' ), $this->plugin_data['name'] ) ); ?></a>
		<?php else : ?>
			<a class="themegrill-demo-importer-BlankState-cta button button-primary activate-now" href="<?php echo esc_url( $url ); ?>" aria-label="<?php esc_attr_e( sprintf( __( 'Activate %s now', 'colormag' ), $this->plugin_data['name'] ) ); ?>"><?php _e( sprintf( __( 'Activate %s', 'colormag' ), $this->plugin_data['name'] ) ); ?></a>
		<?php endif; ?>
		<a class="themegrill-demo-importer-BlankState-cta button" target="_blank" href="https://docs.themegrill.com/knowledgebase/importing-demo-content/"><?php esc_html_e( 'Learn more about demo importer!', 'colormag' ); ?></a>
	</div>
</div>
<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
