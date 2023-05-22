<?php
/**
 * Admin View: Page - Importer
 *
 * @package ThemeGrill_Demo_Importer
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		<h1><?php esc_html_e( 'Demo Importer', 'colormag' ); ?></h1>

		<div class="themegrill-demo-importer-BlankState">
			<svg aria-hidden="true" class="octicon octicon-desktop-download themegrill-demo-importer-BlankState-icon"
			     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
			>
				<path fill-rule="evenodd"
				      d="M4 6h3V0h2v6h3l-4 4-4-4zm11-4h-4v1h4v8H1V3h4V2H1c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h5.34c-.25.61-.86 1.39-2.34 2h8c-1.48-.61-2.09-1.39-2.34-2H15c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1z"
				></path>
			</svg>

			<h2 class="themegrill-demo-importer-BlankState-message"><?php esc_html_e( 'Ready to start importing available demos with just a single click?', 'colormag' ); ?></h2>

			<?php if ( $action ) : ?>
				<a class="themegrill-demo-importer-BlankState-cta button button-primary button-hero<?php echo esc_attr( $classes ); ?>"
				   href="<?php echo esc_url( $url ); ?>"
				   data-name="<?php esc_attr_e( 'ThemeGrill Demo Importer', 'colormag' ); ?>"
				   data-slug="themegrill-demo-importer"
				>
					<?php echo esc_html( $action ); ?>
				</a>
			<?php endif; ?>

			<a class="themegrill-demo-importer-BlankState-cta button button-secondary button-hero" target="_blank"
			   href="https://docs.themegrill.com/knowledgebase/importing-demo-content/"
			>
				<?php esc_html_e( 'Learn more about demo importer!', 'colormag' ); ?>
			</a>
		</div>
	</div>
<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
