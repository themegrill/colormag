<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Dashboard {

	private static $instance;

	public $demo_packages;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
		add_action( 'in_admin_header', array( $this, 'hide_admin_notices' ) );
	}

	public function create_menu() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s', 'colormag' ), $theme->Name );

		add_theme_page(
			$theme_page_name,
			$theme_page_name,
			'edit_theme_options',
			'colormag',
			array(
				$this,
				'dashboard_page',
			)
		);
	}

	/**
	 * Hide admin notices from BlockArt admin pages.
	 *
	 * @since 1.0.0
	 */
	public function hide_admin_notices() {
		// Bail if we're not on a ColorMag screen or page.
		if ( empty( $_REQUEST['page'] ) || false === strpos( sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ), 'colormag' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		global $wp_filter;
		$ignore_notices = apply_filters( 'colormag_ignore_hide_admin_notices', array() );

		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $wp_notice ) {
			if ( empty( $wp_filter[ $wp_notice ] ) ) {
				continue;
			}

			$hook_callbacks = $wp_filter[ $wp_notice ]->callbacks;

			if ( empty( $hook_callbacks ) || ! is_array( $hook_callbacks ) ) {
				continue;
			}

			foreach ( $hook_callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $callback ) {
					if ( ! empty( $name ) && in_array( $name, $ignore_notices, true ) ) {
						continue;
					}
					if (
						! empty( $callback['function'] ) &&
						! is_a( $callback['function'], '\Closure' ) &&
						isset( $callback['function'][0], $callback['function'][1] ) &&
						is_object( $callback['function'][0] ) &&
						in_array( $callback['function'][1], $ignore_notices, true )
					) {
						continue;
					}
					unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
				}
			}
		}
	}

	public function dashboard_page() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$admin_url = admin_url();
		$tabs      = apply_filters(
			'colormag_dashboard_tabs',
			array(
				'dashboard'         => array(
					'name'     => esc_html__( 'Dashboard', 'colormag' ),
					'callback' => function () {
						include __DIR__ . '/views/dashbaord.php';
					},
				),
				'starter-templates' => array(
					'name'     => esc_html__( 'Starter Templates', 'colormag' ),
					'callback' => function () {
						if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
							wp_enqueue_style( 'tg-demo-importer' );
							wp_enqueue_script( 'tg-demo-importer' );
							$this->demo_packages = get_transient( 'themegrill_demo_importer_packages' );
							include_once plugin_dir_path( TGDM_PLUGIN_FILE ) . '/includes/admin/views/html-admin-page-importer.php';
						} else {
							include __DIR__ . '/views/starter-templates.php';
						}
					},
				),
				'products'          => array(
					'name'     => esc_html__( 'Products', 'colormag' ),
					'callback' => function () {
						include __DIR__ . '/views/products.php';
					},
				),
				'free-vs-pro'       => array(
					'name'     => esc_html__( 'Free Vs Pro', 'colormag' ),
					'callback' => function () {
						include __DIR__ . '/views/free-vs-pro.php';
					},
				),
				'help'              => array(
					'name'     => esc_html__( 'Help', 'colormag' ),
					'callback' => function () {
						include __DIR__ . '/views/help.php';
					},
				),
			)
		)
		?>
		<div class="colormag-wrap">
			<div class="colormag-metabox-holder">
				<div class="colormag-header">
					<div class="cm-container" id="cm-dashboard-menu">
<!--						<div class="cm-dashboard-head-right" id="cm-dashboard-menu">-->
							<a class="cm-title" href="<?php echo esc_url( 'https://themegrill.com/themes/colormag/' ); ?>" target="_blank">
								<img class="cm-icon" src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/cm-logo.png' ); ?>" alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
							</a>
							<div class="cm-dashboard-menu-container">
								<ul id="cm-dashboard-menu-primary" class="cm-dashboard-menu-primary">
									<?php
									foreach ( $tabs as $id => $tab ) :
										if ( ! is_callable( $tab['callback'] ) ) {
											continue;
										}
										?>
										<li class="menu-item menu-item-<?php echo esc_attr( $id ); ?>">
											<a id="<?php echo esc_attr( $id ); ?>" href=<?php echo esc_url( "{$admin_url}themes.php?page=colormag&tab=$id" ); ?>><?php echo esc_html( $tab['name'] ); ?></a>

										</li>
									<?php endforeach; ?>
								</ul>
							</div>
<!--						</div>-->
						<div class="cm-dashboard-head-left">
							<span class="cm-version">
									<?php
									echo esc_html( $theme->Version );
									?>
							</span>
							<a href="<?php echo esc_url( 'https://themegrill.com/pricing/?utm_medium=dash-header&utm_source=colormag-theme&utm_campaign=dash-header&utm_content=upgrade-to-pro' ); ?>" target="_blank">
								<span class="cm-upgrade-to-pro">
								<?php esc_html_e( 'Upgrade to Pro', 'colormag' ); ?>
							</span>
							</a>
							<span id="cm-notification" class="cm-notification">
								<img class="cm-notification-icon" src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/notification-button.gif' ); ?>" alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
							</span>
						</div>
					</div><!--/.cm-container-->
				</div> <!--/.colormag-header-->
				<?php
				$current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'dashboard';
				$current_tab = in_array( $current_tab, array_keys( $tabs ), true ) ? $current_tab : 'dashboard';
				$callback    = $tabs[ $current_tab ]['callback'];
				call_user_func( $callback );
				?>
			</div><!--/.metabox-holder-->
		</div><!--/.wrap-->
		<div id="cm-dialog" class="cm-dialog">
			<div class="dialog-head">
				<h3><?php esc_html_e( 'Latest Updates', 'colormag' ); ?></h3>

				<div id="dialog-close" class="dialog-close">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path
							d="M10.052 9.34082L16.277 3.11582C16.577 2.81582 16.577 2.36582 16.277 2.06582C15.977 1.76582 15.5269 1.76582 15.227 2.06582L9.00195 8.29082L2.77695 2.06582C2.47695 1.76582 2.02695 1.76582 1.72695 2.06582C1.42695 2.36582 1.42695 2.81582 1.72695 3.11582L7.95195 9.34082L1.72695 15.5658C1.42695 15.8658 1.42695 16.3158 1.72695 16.6158C1.87695 16.7658 2.02695 16.8408 2.25195 16.8408C2.47695 16.8408 2.62695 16.7658 2.77695 16.6158L9.00195 10.3908L15.227 16.6158C15.377 16.7658 15.602 16.8408 15.752 16.8408C15.902 16.8408 16.127 16.7658 16.277 16.6158C16.577 16.3158 16.577 15.8658 16.277 15.5658L10.052 9.34082Z"
							fill="#999999"/>
					</svg>
				</div>
			</div>

			<div class="dialog-content">
				<?php

				$changelog = new ColorMag_Changelog_Parser();

				// Fetch changelog data.
				$changelog_data = $changelog->get_items();

				// Check if the response contains data
				if ( $changelog_data ) {
					// Output the changelog data
					echo '<div class="cm-changelog">';
					foreach ( $changelog_data as $entry ) {
						echo '<div class="cm-changelog__list-item">';
						echo '<div class="cm-changelog__list-head">';
						echo '<h4 class="cm-changelog__version">' . esc_html__( 'Version:', 'colormag' ) . ' ' . esc_html( $entry['version'] ) . '</h4>';
						echo '<p class="cm-changelog__date">' . esc_html( $entry['date'] ) . '</p>';
						echo '</div>'; // cm-changelog__list-head

						// Display each change
						echo '<div class="cm-changelog__change">';
						foreach ( $entry['changes'] as $tag => $changes ) {
							echo '<div class="cm-changelog__change-item item--' . esc_html( strtolower( $tag ) ) . '">';
							echo '<span class="cm-changelog__change-type">' . esc_html( $tag ) . '</span>';
							echo '<div class="cm-changelog__change-list">';
							foreach ( $changes as $change ) {
								echo '<p class="cm-changelog__change-desc">' . esc_html( $change ) . '</p>';
							}
							echo '</div>'; // cm-changelog__change-list
							echo '</div >'; // cm-changelog__change-item
						}
						echo '</div>'; // cm-changelog__change
						echo '</div>'; // cm-changelog__list-item
					}
					echo '</div>'; // cm-changelog
				} else {
					echo '<p>' . esc_html__( 'No changelog data available.', 'colormag' ) . '</p>';
				}

				?>
			</div>
		</div>
		<?php
	}
}

ColorMag_Dashboard::instance();
