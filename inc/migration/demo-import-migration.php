<?php
/**
 * Demo import migration.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display the admin notice for demo import customize migration.
 */
function colormag_demo_import_migration_notice() {
	$demo_imported  = get_option( 'themegrill_demo_importer_activated_id' );
	$notice_dismiss = get_option( 'colormag_demo_import_migration_notice_dismiss' );

	if ( ! $notice_dismiss ) :

		if ( $demo_imported && ( strpos( $demo_imported, 'colormag' ) !== false ) ) :
			?>
			<div class="notice notice-success colormag-notice demo-import-migrate-notice" style="position:relative;">
				<p>
					<?php
					esc_html_e(
						'It looks like you have imported one of the demos recently. Please check your site, if fonts and background are not the same as in the demo. Please click the \'Fix Imported Demo\' button below.',
						'colormag'
					);
					?>
				</p>

				<p>
					<a href="<?php echo wp_nonce_url( add_query_arg( 'demo-import-migration', 'true' ), 'demo_import_migration', '_demo_import_migration_nonce' ); ?>"
					   class="btn button-primary"
					>
						<span><?php esc_html_e( 'Fix Imported Demo', 'colormag' ); ?></span>
					</a>

					<a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>" class="btn button-secondary" target="_blank">
						<span><?php esc_html_e( 'Any confusion?', 'colormag' ); ?></span>
					</a>
				</p>

				<a class="notice-dismiss" href="<?php echo wp_nonce_url( add_query_arg( 'demo-import-migration-notice-dismiss', 'true' ), 'demo_import_migration_notice_dismiss', '_demo_import_migration_notice_dismiss_nonce' ); ?>"></a>
			</div>
			<?php
		endif;
	endif;
}

add_action( 'admin_notices', 'colormag_demo_import_migration_notice' );


/**
 * Option to dismiss the notice.
 */
function colormag_demo_import_migration_notice_dismiss() {
	if ( isset( $_GET['demo-import-migration-notice-dismiss'] ) && isset( $_GET['_demo_import_migration_notice_dismiss_nonce'] ) ) {
		if ( ! wp_verify_nonce( $_GET['_demo_import_migration_notice_dismiss_nonce'], 'demo_import_migration_notice_dismiss' ) ) {
			wp_die( __( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
		}

		update_option( 'colormag_demo_import_migration_notice_dismiss', true );
	}
}

add_action( 'admin_init', 'colormag_demo_import_migration_notice_dismiss' );


/**
 * Return the value for customize migration on demo import.
 *
 * @return bool
 */
function colormag_demo_import_migration() {
	if ( isset( $_GET['demo-import-migration'] ) && isset( $_GET['_demo_import_migration_nonce'] ) ) {
		if ( ! wp_verify_nonce( $_GET['_demo_import_migration_nonce'], 'demo_import_migration' ) ) {
			wp_die( __( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
		}

		return true;
	}

	return false;
}
