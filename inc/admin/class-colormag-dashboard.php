<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class ColorMag_Dashboard
{
	private static $instance;

	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->setup_hooks();
	}

	private function setup_hooks()
	{
		add_action('admin_menu', array($this, 'create_menu'));
		add_action('in_admin_header', array($this, 'hide_admin_notices'));
	}

	public function create_menu()
	{
		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf(esc_html__('%s Options', 'colormag'), $theme->Name);

		add_theme_page(
			$theme_page_name,
			$theme_page_name,
			'edit_theme_options',
			'colormag-dashboard',
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
	public function hide_admin_notices()
	{

		// Bail if we're not on a ColorMag screen or page.
		if (empty($_REQUEST['page']) || false === strpos(sanitize_text_field(wp_unslash($_REQUEST['page'])), 'colormag')) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		global $wp_filter;
		$ignore_notices = apply_filters('colormag_ignore_hide_admin_notices', array());

		foreach (array('user_admin_notices', 'admin_notices', 'all_admin_notices') as $wp_notice) {
			if (empty($wp_filter[$wp_notice])) {
				continue;
			}

			$hook_callbacks = $wp_filter[$wp_notice]->callbacks;

			if (empty($hook_callbacks) || !is_array($hook_callbacks)) {
				continue;
			}

			foreach ($hook_callbacks as $priority => $hooks) {
				foreach ($hooks as $name => $callback) {
					if (!empty($name) && in_array($name, $ignore_notices, true)) {
						continue;
					}
					if (
						!empty($callback['function']) &&
						!is_a($callback['function'], '\Closure') &&
						isset($callback['function'][0], $callback['function'][1]) &&
						is_object($callback['function'][0]) &&
						in_array($callback['function'][1], $ignore_notices, true)
					) {
						continue;
					}
					unset($wp_filter[$wp_notice]->callbacks[$priority][$name]);
				}
			}
		}
	}

	public function dashboard_page() {

		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$admin_url = admin_url();
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="colormag-header">
					<div class="colormag-container">
						<div class="cm-dashboard-head-right" id="cm-dashboard-menu">
							<a class="colormag-title"
							   href="<?php echo esc_url('https://themegrill.com/themes/colormag/'); ?>" target="_blank">
								<img class="colormag-icon"
									 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-logo.png'); ?>"
									 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								<div>
									<a id="dashboard" href=<?php echo esc_url($admin_url . 'themes.php?page=colormag-dashboard'); ?>><?php esc_html_e('Dashboard', 'colormag'); ?></a>
									<a id="products" href=<?php echo esc_url($admin_url . 'themes.php?page=colormag-dashboard&dashboard-page=products'); ?>><?php esc_html_e('Products', 'colormag'); ?></a>
									<a id="free-vs-pro" href=<?php echo esc_url($admin_url . 'themes.php?page=colormag-dashboard&dashboard-page=free-vs-pro'); ?>><?php esc_html_e('Free Vs Pro', 'colormag'); ?></a>
									<a id="help" href=<?php echo esc_url($admin_url . 'themes.php?page=colormag-dashboard&dashboard-page=help'); ?>><?php esc_html_e('Help', 'colormag'); ?></a>
								</div>
							</a>
						</div>
						<div class="cm-dashboard-head-left">
							<span class="colormag-version">
									<?php
									echo $theme->Version;
									?>
							</span>
							<a href=<?php echo esc_url('https://themegrill.com/pricing/'); ?>>
								<span class="cm-upgrade-to-pro">
								<?php esc_html_e('Upgrade to Pro', 'colormag'); ?>
							</span>
							</a>
							<span id="cm-notification" class="cm-notification">
								<img class="colormag-notification"
									 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/notification-button.png'); ?>"
									 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
							</span>
						</div>
					</div><!--/.colormag-container-->
				</div> <!--/.colormag-header-->
				<?php
				// Check for additional parameters in the URL
				if (!empty($_GET['dashboard-page'])) {
					$dashboardPage = sanitize_text_field(wp_unslash($_GET['dashboard-page']));

					// Display content based on the custom parameter
					switch ($dashboardPage) {
						case 'products':
							$instance = new ColorMag_Products_Page();
							$instance->products();
							break;
						case 'free-vs-pro':
							$instance = new ColorMag_Free_vs_Pro_Page();
							$instance->free_vs_pro();
							break;
						case 'help':
							$instance = new ColorMag_Help_Page();
							$instance->help();
							break;
						// Add more cases as needed for different parameters
						default:
							// Default content if no matching parameter is found
							$instance = new ColorMag_Dashboard_Page();
							$instance->dashboard();
					}
				} else {
					// Default content if no additional parameters are present
					$instance = new ColorMag_Dashboard_Page();
					$instance->dashboard();
				}
				?>
			</div><!--/.metabox-holder-->
		</div><!--/.wrap-->
		<div id ="cm-dialog" class="cm-dialog">
			<div class="dialog-head">
				<h3><?php esc_html_e( 'Latest Updates');?></h3>

				<div id="dialog-close" class="dialog-close">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path d="M10.052 9.34082L16.277 3.11582C16.577 2.81582 16.577 2.36582 16.277 2.06582C15.977 1.76582 15.5269 1.76582 15.227 2.06582L9.00195 8.29082L2.77695 2.06582C2.47695 1.76582 2.02695 1.76582 1.72695 2.06582C1.42695 2.36582 1.42695 2.81582 1.72695 3.11582L7.95195 9.34082L1.72695 15.5658C1.42695 15.8658 1.42695 16.3158 1.72695 16.6158C1.87695 16.7658 2.02695 16.8408 2.25195 16.8408C2.47695 16.8408 2.62695 16.7658 2.77695 16.6158L9.00195 10.3908L15.227 16.6158C15.377 16.7658 15.602 16.8408 15.752 16.8408C15.902 16.8408 16.127 16.7658 16.277 16.6158C16.577 16.3158 16.577 15.8658 16.277 15.5658L10.052 9.34082Z" fill="#999999"/>
					</svg>
				</div>
			</div>
		</div>
		<?php
	}




}

ColorMag_Dashboard::instance();
