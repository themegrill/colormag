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
	$migration_flag = get_option( 'colormag_free_major_update_customizer_migration_v1' );

	if ( ! $notice_dismiss && $migration_flag && $demo_imported ) :
		?>
			<div class="notice notice-success colormag-notice demo-import-migrate-notice" style="position:relative;">
				<div class="colormag-message__content">
					<div class="colormag-message__image">
						<img class="colormag-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/admin/images/colormag-logo-square.jpg" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>
					</div>
					<div class="colormag-message__text">
				<p>
					<?php
					esc_html_e(
						'It seems you&#39;ve either imported ColorMag demos recently or updated ColorMag to 3.0 version. After these actions, if you&#39;ve seen any design issues in your site, please try clicking the button below:',
						'colormag'
					);
					?>
				</p>

				<p>
					<a href="<?php echo wp_nonce_url( add_query_arg( 'demo-import-migration', 'true' ), 'demo_import_migration', '_demo_import_migration_nonce' ); ?>" class="btn button-primary">
						<span><?php esc_html_e( 'Fix Migration Issues', 'colormag' ); ?></span>
					</a>

					<a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>" class="btn button-secondary" target="_blank">
						<span><?php esc_html_e( 'Contact Support', 'colormag' ); ?></span>
					</a>
				</p>

				<a class="notice-dismiss" href="<?php echo wp_nonce_url( add_query_arg( 'demo-import-migration-notice-dismiss', 'true' ), 'demo_import_migration_notice_dismiss', '_demo_import_migration_notice_dismiss_nonce' ); ?>"></a>
			</div>
			</div>
			</div>

			<?php
		endif;
}
//add_action( 'admin_notices', 'colormag_demo_import_migration_notice' );

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

