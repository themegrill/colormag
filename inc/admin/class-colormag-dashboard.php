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

	public function import_button_html()
	{
		// Check if TDI is installed but not activated or not installed at all or installed and activated.
		if (file_exists(WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php') && is_plugin_inactive('themegrill-demo-importer/themegrill-demo-importer.php')) {
			$colormag_btn_texts = __('Activate ThemeGrill Demo Importer Plugin', 'colormag');
		} elseif (!file_exists(WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php') && is_plugin_inactive('themegrill-demo-importer/themegrill-demo-importer.php')) {
			$colormag_btn_texts = __('Install ThemeGrill Demo Importer Plugin', 'colormag');
		} else {
			$colormag_btn_texts = __('Demo Library', 'colormag');
		}

		$html = '<a class="btn-get-started" href="#" data-name="' . esc_attr('themegrill-demo-importer') . '" data-slug="' . esc_attr('themegrill-demo-importer') . '" aria-label="' . esc_attr($colormag_btn_texts) . '">' . esc_html($colormag_btn_texts . ' &#129066;') . '</a>';

		return $html;
	}

	public function create_button_html() {

		$colormag_btn_texts = __('Create a new page', 'colormag');

		$admin_url = admin_url();

		$html = '<a class="btn-create-new-page" href="' . $admin_url . 'post-new.php?post_type=page" aria-label="' . esc_attr($colormag_btn_texts) . '">' . esc_html($colormag_btn_texts) . '</a>';

		return $html;
	}

	public function dashboard_page() {

		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$admin_url = admin_url();

		$support_link = 'https://themegrill.com/contact/';

		$link_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3 4C2.86739 4 2.74021 4.05268 2.64645 4.14645C2.55268 4.24022 2.5 4.3674 2.5 4.5V10C2.5 10.1326 2.55268 10.2598 2.64645 10.3536C2.74022 10.4473 2.86739 10.5 3 10.5H8.5C8.63261 10.5 8.75978 10.4473 8.85355 10.3536C8.94732 10.2598 9 10.1326 9 10V7C9 6.72386 9.22386 6.5 9.5 6.5C9.77614 6.5 10 6.72386 10 7V10C10 10.3978 9.84196 10.7794 9.56066 11.0607C9.27936 11.342 8.89783 11.5 8.5 11.5H3C2.60217 11.5 2.22064 11.342 1.93934 11.0607C1.65804 10.7794 1.5 10.3978 1.5 10V4.5C1.5 4.10218 1.65804 3.72065 1.93934 3.43934C2.22064 3.15804 2.60218 3 3 3H6C6.27614 3 6.5 3.22386 6.5 3.5C6.5 3.77615 6.27614 4 6 4H3Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 2C7.5 1.72386 7.72386 1.5 8 1.5H11C11.2761 1.5 11.5 1.72386 11.5 2V5C11.5 5.27615 11.2761 5.5 11 5.5C10.7239 5.5 10.5 5.27615 10.5 5V2.5H8C7.72386 2.5 7.5 2.27615 7.5 2Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3536 1.64645C11.5489 1.84171 11.5489 2.15829 11.3536 2.35355L5.8536 7.85355C5.65834 8.04882 5.34175 8.04882 5.14649 7.85355C4.95123 7.65829 4.95123 7.34171 5.14649 7.14645L10.6465 1.64645C10.8418 1.45118 11.1583 1.45118 11.3536 1.64645Z" fill="#7A7A7A"/>
					</svg>';

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
									<a id="dashboard" href=<?php echo esc_url($admin_url . 'themes.php?page=colormag-dashboard&dashboard-page=dashboard'); ?>><?php esc_html_e('Dashboard', 'colormag'); ?></a>
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
							<span class="cm-upgrade-to-pro">
								<?php esc_html_e('Upgrade to Pro', 'colormag'); ?>
							</span>
							<span class="cm-notification">
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
							$this->products();
							break;
						case 'help':
							$this->help();
							break;
						case 'free-vs-pro':
							$this->free_vs_pro();
							break;
						// Add more cases as needed for different parameters
						default:
							// Default content if no matching parameter is found
							$this->dashboard();
					}
				} else {
					// Default content if no additional parameters are present
					$this->dashboard();
				}
				?>
			</div><!--/.metabox-holder-->
		</div><!--/.wrap-->
		<?php
	}

	public function dashboard()
	{
		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$link_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3 4C2.86739 4 2.74021 4.05268 2.64645 4.14645C2.55268 4.24022 2.5 4.3674 2.5 4.5V10C2.5 10.1326 2.55268 10.2598 2.64645 10.3536C2.74022 10.4473 2.86739 10.5 3 10.5H8.5C8.63261 10.5 8.75978 10.4473 8.85355 10.3536C8.94732 10.2598 9 10.1326 9 10V7C9 6.72386 9.22386 6.5 9.5 6.5C9.77614 6.5 10 6.72386 10 7V10C10 10.3978 9.84196 10.7794 9.56066 11.0607C9.27936 11.342 8.89783 11.5 8.5 11.5H3C2.60217 11.5 2.22064 11.342 1.93934 11.0607C1.65804 10.7794 1.5 10.3978 1.5 10V4.5C1.5 4.10218 1.65804 3.72065 1.93934 3.43934C2.22064 3.15804 2.60218 3 3 3H6C6.27614 3 6.5 3.22386 6.5 3.5C6.5 3.77615 6.27614 4 6 4H3Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 2C7.5 1.72386 7.72386 1.5 8 1.5H11C11.2761 1.5 11.5 1.72386 11.5 2V5C11.5 5.27615 11.2761 5.5 11 5.5C10.7239 5.5 10.5 5.27615 10.5 5V2.5H8C7.72386 2.5 7.5 2.27615 7.5 2Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3536 1.64645C11.5489 1.84171 11.5489 2.15829 11.3536 2.35355L5.8536 7.85355C5.65834 8.04882 5.34175 8.04882 5.14649 7.85355C4.95123 7.65829 4.95123 7.34171 5.14649 7.14645L10.6465 1.64645C10.8418 1.45118 11.1583 1.45118 11.3536 1.64645Z" fill="#7A7A7A"/>
					</svg>';
		?>
		<div class="colormag-container">
			<div class="postbox-container" style="float: none;">
				<div class="col-70">
					<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
					<div class="postbox">
						<h1 class="hndle"><?php esc_html_e('Welcome to ColorMag', 'colormag'); ?></h1>
						<div class="inside" style="padding: 0;margin: 0;">
							<p><?php esc_html_e('Watch our "Getting Started" video series for better understanding of ColorMag Theme. It will guide you through the steps needed to create your website. Then click to create your first page.', 'colormag'); ?></p>
							<?php echo $this->create_button_html(); ?>
						</div>
					</div>
					<div class="postbox cm-quick-settings">
						<div class="cm-quick-settings-title">
							<h2><?php esc_html_e('Quick Settings', 'colormag'); ?></h2>
							<a><?php esc_html_e('Go to Customizer', 'colormag'); ?></a>
						</div>
						<div class="cm-quick-settings-content" style="padding: 0;margin: 0;">
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Site Identity', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?>
								</a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Header Options', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Footer Options', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Global Colors', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Typography', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Page Layout', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Buttons', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Sidebar Options', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
							<div class="cm-quick-settings-item">
								<h4><?php esc_html_e('Blog Archives', 'colormag'); ?></h4>
								<a><?php echo $link_icon;
									esc_html_e('Customizer', 'colormag'); ?></a>
							</div>
						</div>
					</div>
					<div class="postbox cm-premium-features">
						<div class="cm-premium-features-title">
							<h2><?php esc_html_e('Quick Settings', 'colormag'); ?></h2>
							<a><?php esc_html_e('Upgrade Now', 'colormag'); ?></a>
						</div>
						<div class="cm-premium-features-content" style="padding: 0;margin: 0;">
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Top Bar', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?>
									</a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Main Header', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Primary Menu', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Blog', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Meta', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Footer Column', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php esc_html_e('Footer Bar', 'colormag'); ?></h4>
									<a><?php echo $link_icon;
										esc_html_e('Documentation', 'colormag'); ?></a>
								</div>
								<div class="item-content-right">
									<img class="colormag-icon"
										 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png'); ?>"
										 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								</div>
							</div>
						</div>
					</div>
				</div> <!--/.col-70-->
				<div class="col-30">
					<div class="postbox">
						<h3 class="hndle">
							<svg width="21" height="20" viewBox="0 0 21 20" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<g id="download">
									<path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
										  d="M10.5 2.5C10.9602 2.5 11.3333 2.8731 11.3333 3.33333V11.3215L14.0774 8.57741C14.4028 8.25197 14.9305 8.25197 15.2559 8.57741C15.5814 8.90285 15.5814 9.43049 15.2559 9.75592L11.0893 13.9226C10.7638 14.248 10.2362 14.248 9.91074 13.9226L5.74408 9.75592C5.41864 9.43049 5.41864 8.90285 5.74408 8.57741C6.06951 8.25197 6.59715 8.25197 6.92259 8.57741L9.66667 11.3215V3.33333C9.66667 2.8731 10.0398 2.5 10.5 2.5ZM3.83333 13.3333C4.29357 13.3333 4.66667 13.7064 4.66667 14.1667V15.8333C4.66667 16.0543 4.75446 16.2663 4.91074 16.4226C5.06702 16.5789 5.27899 16.6667 5.5 16.6667H15.5C15.721 16.6667 15.933 16.5789 16.0893 16.4226C16.2455 16.2663 16.3333 16.0543 16.3333 15.8333V14.1667C16.3333 13.7064 16.7064 13.3333 17.1667 13.3333C17.6269 13.3333 18 13.7064 18 14.1667V15.8333C18 16.4964 17.7366 17.1323 17.2678 17.6011C16.7989 18.0699 16.163 18.3333 15.5 18.3333H5.5C4.83696 18.3333 4.20107 18.0699 3.73223 17.6011C3.26339 17.1323 3 16.4964 3 15.8333V14.1667C3 13.7064 3.3731 13.3333 3.83333 13.3333Z"
										  fill="#2563EB"/>
								</g>
							</svg>
							<span><?php esc_html_e('Starter Templates', 'colormag'); ?></span>
						</h3>
						<div class="inside">
							<p><?php echo __('Use ColorMags diverse demos instead of starting your site from scratch. <br> <br> Simply import a demo and customize it to your preferences.', 'your-text-domain'); ?></p>
							<a href="<?php echo esc_url('https://themegrilldemos.com/colormag-demos/#/'); ?>"
							   target="_blank"><?php esc_html_e('View Starter Templates', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M12.584 1.66602H5.50065C5.05862 1.66602 4.6347 1.84161 4.32214 2.15417C4.00958 2.46673 3.83398 2.89065 3.83398 3.33268V16.666C3.83398 17.108 4.00958 17.532 4.32214 17.8445C4.6347 18.1571 5.05862 18.3327 5.50065 18.3327H15.5006C15.9427 18.3327 16.3666 18.1571 16.6792 17.8445C16.9917 17.532 17.1673 17.108 17.1673 16.666V6.24935L12.584 1.66602Z"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M12.166 1.66602V6.66602H17.166" stroke="#2563EB" stroke-width="1.5"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.8327 10.833H7.16602" stroke="#2563EB" stroke-width="1.5"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.8327 14.166H7.16602" stroke="#2563EB" stroke-width="1.5"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M8.83268 7.5H7.16602" stroke="#2563EB" stroke-width="1.5"
									  stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Documentation', 'colormag'); ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: 1: Theme Name, 2: Demo Link. */
									esc_html__('Need more details? Please check out basic documentation for detailed information on how to use %1$s', 'colormag'),
									$theme->Name,
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://docs.themegrill.com/colormag/'); ?>"
							   target="_blank"><?php esc_html_e('Documentation', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
									stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
									stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Leave us a Review', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Sharing your review is a valuable way to help us enhance your experience.', 'colormag'),
									$theme->Name
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://wordpress.org/support/theme/colormag/reviews/?rate=5#new-post'); ?>"
							   target="_blank"><?php esc_html_e('Submit a Review', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M12.9998 11.667C13.1664 10.8337 13.5831 10.2503 14.2498 9.58366C15.0831 8.83366 15.4998 7.75033 15.4998 6.66699C15.4998 5.34091 14.973 4.06914 14.0353 3.13146C13.0976 2.19378 11.8258 1.66699 10.4998 1.66699C9.17367 1.66699 7.9019 2.19378 6.96422 3.13146C6.02654 4.06914 5.49976 5.34091 5.49976 6.66699C5.49976 7.50033 5.66642 8.50033 6.74976 9.58366C7.33309 10.167 7.83309 10.8337 7.99976 11.667"
									stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
									stroke-linejoin="round"/>
								<path d="M7.99988 15H12.9999" stroke="#2563EB" stroke-width="1.66667"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M8.83325 18.333H12.1666" stroke="#2563EB" stroke-width="1.66667"
									  stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Feature Request', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Please take a moment to suggest any features that could enhance our product.', 'colormag'),
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://themegrill.com/contact/'); ?>"
							   target="_blank"><?php esc_html_e('Request a Feature', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M3 11.6667H5.5C5.94203 11.6667 6.36595 11.8423 6.67851 12.1548C6.99107 12.4674 7.16667 12.8913 7.16667 13.3333V15.8333C7.16667 16.2754 6.99107 16.6993 6.67851 17.0118C6.36595 17.3244 5.94203 17.5 5.5 17.5H4.66667C4.22464 17.5 3.80072 17.3244 3.48816 17.0118C3.17559 16.6993 3 16.2754 3 15.8333V10C3 8.01088 3.79018 6.10322 5.1967 4.6967C6.60322 3.29018 8.51088 2.5 10.5 2.5C12.4891 2.5 14.3968 3.29018 15.8033 4.6967C17.2098 6.10322 18 8.01088 18 10V15.8333C18 16.2754 17.8244 16.6993 17.5118 17.0118C17.1993 17.3244 16.7754 17.5 16.3333 17.5H15.5C15.058 17.5 14.634 17.3244 14.3215 17.0118C14.0089 16.6993 13.8333 16.2754 13.8333 15.8333V13.3333C13.8333 12.8913 14.0089 12.4674 14.3215 12.1548C14.634 11.8423 15.058 11.6667 15.5 11.6667H18"
									stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
									stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Support', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Get in touch with our support team. You can always submit a support ticket for help.', 'colormag'),
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://themegrill.com/contact/'); ?>"
							   target="_blank"><?php esc_html_e('Create a Ticket', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox cm-useful-plugins">
						<h3 class="hndle">
							<span><?php esc_html_e('Useful Plugins', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<div class=" content-left">
								<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
									 fill="none">
									<rect x="0.5" width="40" height="40" rx="3.63636" fill="#5317AA"/>
									<path d="M27.309 11.1045H22.9999L24.3223 13.3268H28.6186L27.309 11.1045Z"
										  fill="white"/>
									<path d="M30.0183 15.5527H25.7156L27.1025 17.7751H31.4085L30.0183 15.5527Z"
										  fill="white"/>
									<path
										d="M29.9506 26.6704H13.5493L20.4292 15.4136L23.2772 20.0002H20.4292L19.11 22.2225H27.2412L20.4292 11.2432L9.5885 28.8959H31.3408L29.9506 26.6704Z"
										fill="white"/>
								</svg>
								<div class="content-info">
									<h4><?php esc_html_e('Everest Forms', 'colormag') ?></h4>
									<p><?php esc_html_e('Form Builder Plugin', 'colormag') ?></p>
								</div>
							</div>
							<a><?php esc_html_e('Install') ?></a>
						</div>
						<div class="inside">
							<div class=" content-left">
								<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
									 fill="none">
									<rect x="0.5" width="40" height="40" rx="3.63636" fill="#2563EB"/>
									<path fill-rule="evenodd" clip-rule="evenodd"
										  d="M8.5 31.2027H32.5V8.5H8.5V31.2027ZM31.2027 29.9054H9.79728V9.7973H31.2027V29.9054ZM20.7109 11.7432L22.3204 17.1421L19.094 17.1563L20.7109 11.7432ZM18.0383 20.7249H23.3909L24.3433 25.5563L24.4319 27.3107H16.8496L16.9161 25.5351L18.0383 20.7249Z"
										  fill="white"/>
								</svg>
								<div class="content-info">
									<h4><?php esc_html_e('BlockArt', 'colormag') ?></h4>
									<p><?php esc_html_e('Page Builder Plugin', 'colormag') ?></p>
								</div>
							</div>
							<a><?php esc_html_e('Install') ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M13.8327 17.5V15.8333C13.8327 14.9493 13.4815 14.1014 12.8564 13.4763C12.2313 12.8512 11.3834 12.5 10.4993 12.5H5.49935C4.61529 12.5 3.76745 12.8512 3.14233 13.4763C2.51721 14.1014 2.16602 14.9493 2.16602 15.8333V17.5"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M7.99935 9.16667C9.8403 9.16667 11.3327 7.67428 11.3327 5.83333C11.3327 3.99238 9.8403 2.5 7.99935 2.5C6.1584 2.5 4.66602 3.99238 4.66602 5.83333C4.66602 7.67428 6.1584 9.16667 7.99935 9.16667Z"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M18.834 17.5001V15.8334C18.8334 15.0948 18.5876 14.3774 18.1351 13.7937C17.6826 13.2099 17.0491 12.793 16.334 12.6084"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M13.834 2.6084C14.551 2.79198 15.1865 3.20898 15.6403 3.79366C16.0942 4.37833 16.3405 5.09742 16.3405 5.83757C16.3405 6.57771 16.0942 7.2968 15.6403 7.88147C15.1865 8.46615 14.551 8.88315 13.834 9.06673"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('ThemeGrill Community', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Join our facebook group of ColorMag users for creating beautiful websites!', 'colormag'),
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://www.facebook.com/groups/themegrill'); ?>"
							   target="_blank"><?php esc_html_e('Join our Facebook Group', 'colormag'); ?></a>
						</div>
					</div>
				</div><!--/.col-30-->
			</div><!--/.postbox-container-->
		</div><!--/.colormag-container-->
		<?php
	}

	public function products() {
		?>
		<div class="colormag-container products-page">
			<div class="postbox-container" style="float: none;">
				<div class="postbox">
					<h1 class="hndle">
						<span><?php esc_html_e('Themes', 'colormag') ?></span>
					</h1>
					<div class="inside">
						<div class="item item-colormag">
							<img class="colormag-logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/colormag.webp'); ?>"
								 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
							<div class="content">
								<h3> ColorMag </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<?php
								$theme_name = 'colormag';

								$active_theme = wp_get_theme();
								$installed_themes = wp_get_themes();

								// Check if the theme is installed
								if (isset($installed_themes[$theme_name])) {
									// Check if the installed theme is currently active
									if ($active_theme->stylesheet === $theme_name) {
										// The theme is both installed and activated
										$status = "Activated";
									} else {
										// The theme is installed but not activated
										$status = "Activate";
									}
								} else {
									// The theme is not installed
									$status = "Install";
								}
								?>
								<div class="cta-button">
									<span> <?php echo $status ?> </span>
								</div>
							</div>
						</div>
						<div class="item item-zakra">
							<img class="logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/zakra.webp'); ?>"
								 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
							<div class="content">
								<h3> Zakra </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span> Install </span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="postbox">
					<h1 class="hndle">
						<span><?php esc_html_e('Plugins', 'colormag') ?></span>
					</h1>
					<div class="inside">
						<div class="item item-ur">
							<img class="ur-logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/ur.webp'); ?>"
								 alt="<?php esc_attr_e('User Registration', 'colormag'); ?>">
							<div class="content">
								<h3> User Registration </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span>Install</span>
								</div>
							</div>
						</div>
						<div class="item item-evf">
							<img class="logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/evf.webp'); ?>"
								 alt="<?php esc_attr_e('Everest Forms', 'colormag'); ?>">
							<div class="content">
								<h3> Everest Forms </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span>Install</span>
								</div>
							</div>
						</div>
						<div class="item item-masteriyo">
							<img class="logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/masteriyo.webp'); ?>"
								 alt="<?php esc_attr_e('Masteriyo', 'colormag'); ?>">
							<div class="content">
								<h3> Masteriyo </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span>Install</span>
								</div>
							</div>
						</div>
						<div class="item item-mzb">
							<img class="logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/magazine-blocks.webp'); ?>"
								 alt="<?php esc_attr_e('Magazine Blocks', 'colormag'); ?>">
							<div class="content">
								<h3> Magazine Blocks </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span>Install</span>
								</div>
							</div>
						</div>
						<div class="item item-blockart">
							<img class="logo"
								 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/blockart-blocks.webp'); ?>"
								 alt="<?php esc_attr_e('BlockArt', 'colormag'); ?>">
							<div class="content">
								<h3> BlockArt </h3>
								<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.' );?></p>
							</div>
							<div class="cta">
								<div class="cta-text">
									<a>Learn More</a>
									<a>Live demo</a>
								</div>
								<div class="cta-button">
									<span>Install</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public function help() {
		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}
		?>
		<div class="colormag-container help-page">
			<div class="postbox-container" style="float: none;">
				<div class="col-70">
					<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
					<div class="cm-help-top-row">
						<div class="postbox">
							<svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
								<path d="M19.833 3.00977H8.49967C7.79243 3.00977 7.11415 3.29072 6.61406 3.79081C6.11396 4.29091 5.83301 4.96919 5.83301 5.67643V27.0098C5.83301 27.717 6.11396 28.3953 6.61406 28.8954C7.11415 29.3955 7.79243 29.6764 8.49967 29.6764H24.4997C25.2069 29.6764 25.8852 29.3955 26.3853 28.8954C26.8854 28.3953 27.1663 27.717 27.1663 27.0098V10.3431L19.833 3.00977Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M19.1665 3.00977V11.0098H27.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M21.8332 17.6758H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M21.8332 23.0098H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.8332 12.3428H11.1665" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<h3><?php esc_html_e( 'Need Some Help?');?></h3>
							<p><?php esc_html_e( 'Please check out basic documentation for detailed information on how to use ColorMag.');?></p>
							<a><?php esc_html_e( 'View Now');?></a>
						</div>
						<div class="postbox">
							<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 33 33" fill="none">
								<path d="M19.1667 20.3428V23.0094C19.1667 23.3631 19.0262 23.7022 18.7761 23.9523C18.5261 24.2023 18.187 24.3428 17.8333 24.3428H8.5L4.5 28.3428V15.0094C4.5 14.6558 4.64048 14.3167 4.89052 14.0666C5.14057 13.8166 5.47971 13.6761 5.83333 13.6761H8.5M28.5 19.0094L24.5 15.0094H15.1667C14.813 15.0094 14.4739 14.869 14.2239 14.6189C13.9738 14.3689 13.8333 14.0297 13.8333 13.6761V5.67611C13.8333 5.32248 13.9738 4.98335 14.2239 4.7333C14.4739 4.48325 14.813 4.34277 15.1667 4.34277H27.1667C27.5203 4.34277 27.8594 4.48325 28.1095 4.7333C28.3595 4.98335 28.5 5.32248 28.5 5.67611V19.0094Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<h3><?php esc_html_e( 'Support');?></h3>
							<p><?php esc_html_e( 'We would be happy to guide any of your issues and queries');?></p>
							<a><span><?php esc_html_e( 'Contact Support');?></span></a>
						</div>
					</div>
					<h2><?php  esc_html_e( 'Join Our Community' );?></h2>
					<div class="postbox cm-community">
							<div class="cm-image">
								<img
									 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/facebook.webp'); ?>"
									 alt="<?php esc_attr_e('Facebook', 'colormag'); ?>">
							</div>
							<div class="cm-content">
								<h3><?php esc_html_e( 'Facebook Community' ); ?></h3>
								<p><?php esc_html_e( 'Join our Facebook haven, where the latest news and updates eagerly await your arrival.' ) ?></p>
								<a><span><?php esc_html_e( 'Join Group' ); ?></span></a>
							</div>
						</div>
					<div class="postbox cm-community">
						<div class="cm-image">
							<img
								src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/x.webp'); ?>"
								alt="<?php esc_attr_e('Facebook', 'colormag'); ?>">
						</div>
						<div class="cm-content">
							<h3><?php esc_html_e( 'X Community' ); ?></h3>
							<p><?php esc_html_e( 'Join our Twitter haven, where the latest news and updates eagerly await your arrival.' ) ?></p>
							<a><span><?php esc_html_e( 'Join Group' ); ?></span></a>
						</div>
					</div>
					<div class="postbox cm-community">
						<div class="cm-image">
							<img
								src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/youtube.webp'); ?>"
								alt="<?php esc_attr_e('Facebook', 'colormag'); ?>">
						</div>
						<div class="cm-content">
							<h3><?php esc_html_e( 'Youtube Community' ); ?></h3>
							<p><?php esc_html_e( 'Join our YouTube haven, where the latest news and updates eagerly await your arrival.' ) ?></p>
							<a><span><?php esc_html_e( 'Join Group' ); ?></span></a>
						</div>
					</div>
				</div> <!--/.col-70-->
				<div class="col-30">
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
									stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
									stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Leave us a Review', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Sharing your review is a valuable way to help us enhance your experience.', 'colormag'),
									$theme->Name
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://wordpress.org/support/theme/colormag/reviews/?rate=5#new-post'); ?>"
							   target="_blank"><?php esc_html_e('Submit a Review', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M12.9998 11.667C13.1664 10.8337 13.5831 10.2503 14.2498 9.58366C15.0831 8.83366 15.4998 7.75033 15.4998 6.66699C15.4998 5.34091 14.973 4.06914 14.0353 3.13146C13.0976 2.19378 11.8258 1.66699 10.4998 1.66699C9.17367 1.66699 7.9019 2.19378 6.96422 3.13146C6.02654 4.06914 5.49976 5.34091 5.49976 6.66699C5.49976 7.50033 5.66642 8.50033 6.74976 9.58366C7.33309 10.167 7.83309 10.8337 7.99976 11.667"
									stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
									stroke-linejoin="round"/>
								<path d="M7.99988 15H12.9999" stroke="#2563EB" stroke-width="1.66667"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M8.83325 18.333H12.1666" stroke="#2563EB" stroke-width="1.66667"
									  stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('Feature Request', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Please take a moment to suggest any features that could enhance our product.', 'colormag'),
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://themegrill.com/contact/'); ?>"
							   target="_blank"><?php esc_html_e('Request a Feature', 'colormag'); ?></a>
						</div>
					</div>
					<div class="postbox cm-useful-plugins">
						<h3 class="hndle">
							<span><?php esc_html_e('Useful Plugins', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<div class=" content-left">
								<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
									 fill="none">
									<rect x="0.5" width="40" height="40" rx="3.63636" fill="#5317AA"/>
									<path d="M27.309 11.1045H22.9999L24.3223 13.3268H28.6186L27.309 11.1045Z"
										  fill="white"/>
									<path d="M30.0183 15.5527H25.7156L27.1025 17.7751H31.4085L30.0183 15.5527Z"
										  fill="white"/>
									<path
										d="M29.9506 26.6704H13.5493L20.4292 15.4136L23.2772 20.0002H20.4292L19.11 22.2225H27.2412L20.4292 11.2432L9.5885 28.8959H31.3408L29.9506 26.6704Z"
										fill="white"/>
								</svg>
								<div class="content-info">
									<h4><?php esc_html_e('Everest Forms', 'colormag') ?></h4>
									<p><?php esc_html_e('Form Builder Plugin', 'colormag') ?></p>
								</div>
							</div>
							<a><?php esc_html_e('Install') ?></a>
						</div>
						<div class="inside">
							<div class=" content-left">
								<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
									 fill="none">
									<rect x="0.5" width="40" height="40" rx="3.63636" fill="#2563EB"/>
									<path fill-rule="evenodd" clip-rule="evenodd"
										  d="M8.5 31.2027H32.5V8.5H8.5V31.2027ZM31.2027 29.9054H9.79728V9.7973H31.2027V29.9054ZM20.7109 11.7432L22.3204 17.1421L19.094 17.1563L20.7109 11.7432ZM18.0383 20.7249H23.3909L24.3433 25.5563L24.4319 27.3107H16.8496L16.9161 25.5351L18.0383 20.7249Z"
										  fill="white"/>
								</svg>
								<div class="content-info">
									<h4><?php esc_html_e('BlockArt', 'colormag') ?></h4>
									<p><?php esc_html_e('Page Builder Plugin', 'colormag') ?></p>
								</div>
							</div>
							<a><?php esc_html_e('Install') ?></a>
						</div>
					</div>
					<div class="postbox">
						<h3 class="hndle">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
								 fill="none">
								<path
									d="M13.8327 17.5V15.8333C13.8327 14.9493 13.4815 14.1014 12.8564 13.4763C12.2313 12.8512 11.3834 12.5 10.4993 12.5H5.49935C4.61529 12.5 3.76745 12.8512 3.14233 13.4763C2.51721 14.1014 2.16602 14.9493 2.16602 15.8333V17.5"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M7.99935 9.16667C9.8403 9.16667 11.3327 7.67428 11.3327 5.83333C11.3327 3.99238 9.8403 2.5 7.99935 2.5C6.1584 2.5 4.66602 3.99238 4.66602 5.83333C4.66602 7.67428 6.1584 9.16667 7.99935 9.16667Z"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M18.834 17.5001V15.8334C18.8334 15.0948 18.5876 14.3774 18.1351 13.7937C17.6826 13.2099 17.0491 12.793 16.334 12.6084"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path
									d="M13.834 2.6084C14.551 2.79198 15.1865 3.20898 15.6403 3.79366C16.0942 4.37833 16.3405 5.09742 16.3405 5.83757C16.3405 6.57771 16.0942 7.2968 15.6403 7.88147C15.1865 8.46615 14.551 8.88315 13.834 9.06673"
									stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e('ThemeGrill Community', 'colormag') ?></span>
						</h3>
						<div class="inside">
							<p>
								<?php
								echo sprintf(
								/* translators: %s: Theme Name. */
									esc_html__('Join our facebook group of ColorMag users for creating beautiful websites!', 'colormag'),
								);
								?>
							</p>
							<a href="<?php echo esc_url('https://www.facebook.com/groups/themegrill'); ?>"
							   target="_blank"><?php esc_html_e('Join our Facebook Group', 'colormag'); ?></a>
						</div>
					</div>
				</div><!--/.col-30-->
			</div>
		</div>

		<?php
	}

	public function free_vs_pro() {
		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$tick_mark = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  						<path d="M5.37994 11.5537L5.7335 11.9073L6.08705 11.5537L13.887 3.75375C13.9296 3.71119 13.9703 3.7002 14.0002 3.7002C14.03 3.7002 14.0707 3.71119 14.1133 3.75375C14.1558 3.79631 14.1668 3.83698 14.1668 3.86686C14.1668 3.89675 14.1558 3.93742 14.1133 3.97998L5.84661 12.2466C5.80946 12.2838 5.79218 12.2918 5.78876 12.2933L5.7886 12.2934C5.78668 12.2943 5.7738 12.3002 5.7335 12.3002C5.6932 12.3002 5.68032 12.2943 5.67839 12.2934L5.67823 12.2933C5.67482 12.2918 5.65753 12.2838 5.62038 12.2466L1.88705 8.51331C1.84449 8.47075 1.8335 8.43008 1.8335 8.4002C1.8335 8.37031 1.84449 8.32964 1.88705 8.28708L1.54017 7.9402L1.88705 8.28708C1.92961 8.24452 1.97028 8.23353 2.00016 8.23353C2.03005 8.23353 2.07072 8.24452 2.11328 8.28708L5.37994 11.5537Z" fill="#222222" stroke="#219653"/>
						</svg>';

		$cross_mark = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  						<path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 4.70711C13.0976 4.31658 13.0976 3.68342 12.7071 3.29289C12.3166 2.90237 11.6834 2.90237 11.2929 3.29289L8 6.58579L4.70711 3.29289C4.31658 2.90237 3.68342 2.90237 3.29289 3.29289C2.90237 3.68342 2.90237 4.31658 3.29289 4.70711L6.58579 8L3.29289 11.2929C2.90237 11.6834 2.90237 12.3166 3.29289 12.7071C3.68342 13.0976 4.31658 13.0976 4.70711 12.7071L8 9.41421L11.2929 12.7071C11.6834 13.0976 12.3166 13.0976 12.7071 12.7071C13.0976 12.3166 13.0976 11.6834 12.7071 11.2929L9.41421 8L12.7071 4.70711Z" fill="#97022E"/>
							</svg>';
		?>
		<div class="colormag-container free-vs-pro-page">
			<div class="postbox-container" style="float: none;">
				<table class="fvp-table">
					<tbody>
					<tr class="fvp-heading">
						<td><?php esc_html_e( 'General Features' ); ?></td>
						<td><?php esc_html_e( 'Free' ); ?></td>
						<td><?php esc_html_e( 'Pro' ); ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Section' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Column' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Heading' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Paragraph' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Buttons' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Icon' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Seperator' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Spacing' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Popup' ); ?></td>
						<td><?php echo $tick_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr class="fvp-heading">
						<td><?php esc_html_e( 'Advanced Features' ); ?></td>
						<td><?php esc_html_e( 'Free' ); ?></td>
						<td><?php esc_html_e( 'Pro' ); ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Google Map' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Info Box' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Counter' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Countdown' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Social Share' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Tabs' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'FAQs' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'Slider' ); ?></td>
						<td><?php echo $cross_mark ?></td>
						<td><?php echo $tick_mark ?></td>
					</tr>
					</tbody>
				</table>
				<div class="postbox">
					<div class="icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="82" height="70" viewBox="0 0 82 70" fill="none">
							<path d="M62.6843 8.04063L40.8137 0L19.1521 7.9347C16.3861 9.26999 13.9611 10.0724 13.9611 12.7077V25.8488C13.916 35.0457 16.3833 44.0809 21.098 51.9832C25.1376 58.695 31.39 65.6057 41.0388 70C49.8932 67.0566 56.5026 59.2086 60.5423 52.4936C65.2572 44.5926 67.7246 35.5583 67.6791 26.3623V14.5437C67.6631 10.7818 65.7172 8.9458 62.6843 8.04063Z" fill="#4A7EEE"/>
							<g opacity="0.8">
								<path d="M62.6843 8.04063L40.8137 0L19.1521 7.9347C16.3861 9.26999 13.9611 10.0724 13.9611 12.7077V25.8488C13.916 35.0457 16.3833 44.0809 21.098 51.9832C25.1376 58.695 31.39 65.6057 41.0388 70C49.8932 67.0566 56.5026 59.2085 60.5423 52.4936C65.2572 44.5926 67.7246 35.5583 67.6791 26.3623V14.5437C67.6631 10.7818 65.7172 8.9458 62.6843 8.04063Z" fill="white"/>
							</g>
							<path d="M54.1669 41.2814H50.1466V19.4546C50.1466 16.9828 49.1627 14.6123 47.4114 12.8645C45.6601 11.1167 43.2848 10.1348 40.8081 10.1348C38.3314 10.1348 35.9562 11.1167 34.2049 12.8645C32.4536 14.6123 31.4697 16.9828 31.4697 19.4546V41.2814H27.4494V19.4546C27.4219 17.6864 27.7471 15.9304 28.4061 14.2888C29.0651 12.6473 30.0447 11.1529 31.2879 9.89282C32.5311 8.6327 34.0131 7.63198 35.6475 6.94891C37.2819 6.26584 39.0362 5.91406 40.8081 5.91406C42.5801 5.91406 44.3343 6.26584 45.9688 6.94891C47.6032 7.63198 49.0851 8.6327 50.3283 9.89282C51.5715 11.1529 52.5512 12.6473 53.2102 14.2888C53.8692 15.9304 54.1944 17.6864 54.1669 19.4546V41.2814Z" fill="#4A7EEE"/>
							<g opacity="0.4">
								<path d="M54.1679 41.2814H50.1475V19.4546C50.1475 16.9828 49.1637 14.6123 47.4124 12.8645C45.6611 11.1167 43.2858 10.1348 40.8091 10.1348C38.3324 10.1348 35.9571 11.1167 34.2058 12.8645C32.4545 14.6123 31.4707 16.9828 31.4707 19.4546V41.2814H27.4503V19.4546C27.4228 17.6864 27.7481 15.9304 28.4071 14.2888C29.0661 12.6473 30.0457 11.1529 31.2889 9.89282C32.5321 8.6327 34.014 7.63198 35.6485 6.94891C37.2829 6.26584 39.0371 5.91406 40.8091 5.91406C42.5811 5.91406 44.3353 6.26584 45.9697 6.94891C47.6042 7.63198 49.0861 8.6327 50.3293 9.89282C51.5725 11.1529 52.5521 12.6473 53.2111 14.2888C53.8701 15.9304 54.1954 17.6864 54.1679 19.4546V41.2814Z" fill="black"/>
							</g>
							<path d="M56.9436 31.5684H24.6748C23.6428 31.5684 22.8062 32.4033 22.8062 33.4333V52.7564C22.8062 53.7864 23.6428 54.6214 24.6748 54.6214H56.9436C57.9756 54.6214 58.8123 53.7864 58.8123 52.7564V33.4333C58.8123 32.4033 57.9756 31.5684 56.9436 31.5684Z" fill="#4A7EEE"/>
							<g opacity="0.5">
								<path d="M43.8172 40.0942C43.8176 39.5352 43.6617 38.9871 43.367 38.5117C43.0723 38.0363 42.6505 37.6523 42.1491 37.4031C41.6477 37.1538 41.0866 37.0491 40.5288 37.1007C39.971 37.1524 39.4388 37.3583 38.9919 37.6953C38.545 38.0323 38.2011 38.4871 37.9991 39.0085C37.797 39.5299 37.7447 40.0973 37.8481 40.6467C37.9515 41.1961 38.2064 41.7059 38.5842 42.1186C38.962 42.5314 39.4477 42.8308 39.9867 42.9831V47.4768H41.6302V42.9831C42.2607 42.8058 42.8158 42.4275 43.2107 41.9058C43.6056 41.3842 43.8186 40.748 43.8172 40.0942Z" fill="black"/>
							</g>
							<path d="M24.7246 52.4363C24.641 52.4363 24.5767 48.5845 24.5767 43.85C24.5767 39.1155 24.641 35.2637 24.7246 35.2637C24.8082 35.2637 24.8758 39.1155 24.8758 43.85C24.8758 48.5845 24.8082 52.4363 24.7246 52.4363Z" fill="#FAFAFA"/>
							<path d="M38.452 43.9422C38.452 43.9422 38.3105 43.8972 38.0982 43.7432C37.8007 43.5213 37.5392 43.255 37.3231 42.9536C36.9477 42.4591 36.6865 41.888 36.5581 41.281C36.4298 40.674 36.4375 40.0462 36.5807 39.4426C36.724 38.8389 36.9992 38.2743 37.3866 37.7892C37.774 37.3041 38.2642 36.9105 38.8219 36.6366C39.1555 36.4648 39.5134 36.3446 39.8832 36.2803C40.0152 36.2442 40.1533 36.2366 40.2885 36.2578C40.2885 36.3156 39.7192 36.3702 38.9376 36.8228C38.4275 37.1043 37.982 37.4891 37.6297 37.9526C37.2774 38.4161 37.0261 38.9479 36.8919 39.5141C36.7578 40.0802 36.7437 40.6681 36.8506 41.2399C36.9575 41.8118 37.1831 42.3551 37.5128 42.8348C37.7951 43.2289 38.1092 43.5992 38.452 43.9422Z" fill="#FAFAFA"/>
							<path d="M2.08299 57.8382C2.84857 57.8382 3.4692 57.2188 3.4692 56.4547C3.4692 55.6907 2.84857 55.0713 2.08299 55.0713C1.3174 55.0713 0.696777 55.6907 0.696777 56.4547C0.696777 57.2188 1.3174 57.8382 2.08299 57.8382Z" fill="#4A7EEE"/>
							<path d="M81.3022 12.5917C81.3016 12.8652 81.2197 13.1324 81.067 13.3594C80.9143 13.5865 80.6976 13.7633 80.4443 13.8676C80.1909 13.9718 79.9123 13.9987 79.6436 13.945C79.3749 13.8912 79.1282 13.7592 78.9347 13.5656C78.7411 13.372 78.6094 13.1255 78.5562 12.8572C78.503 12.589 78.5306 12.311 78.6356 12.0584C78.7406 11.8058 78.9183 11.5899 79.1462 11.438C79.3741 11.2861 79.642 11.2051 79.916 11.2051C80.0983 11.2051 80.2788 11.241 80.4472 11.3107C80.6156 11.3804 80.7686 11.4826 80.8973 11.6114C81.0261 11.7402 81.1281 11.8931 81.1976 12.0613C81.2671 12.2295 81.3026 12.4098 81.3022 12.5917Z" fill="#4A7EEE"/>
							<path d="M11.8184 60.0269C11.8184 60.0969 11.7976 60.1653 11.7586 60.2234C11.7195 60.2815 11.6641 60.3268 11.5993 60.3534C11.5344 60.3801 11.4631 60.3869 11.3944 60.373C11.3257 60.3591 11.2627 60.3251 11.2133 60.2754C11.164 60.2257 11.1305 60.1625 11.1173 60.0938C11.104 60.0251 11.1114 59.954 11.1387 59.8896C11.166 59.8251 11.2118 59.7702 11.2704 59.7318C11.329 59.6934 11.3977 59.6732 11.4678 59.6738C11.5611 59.6747 11.6503 59.7123 11.7159 59.7784C11.7816 59.8445 11.8184 59.9338 11.8184 60.0269Z" fill="#4A7EEE"/>
							<path d="M19.3419 21.2457C19.3419 21.3155 19.3211 21.3838 19.2822 21.4418C19.2434 21.4999 19.1881 21.5451 19.1235 21.5719C19.0588 21.5986 18.9877 21.6056 18.919 21.592C18.8504 21.5783 18.7874 21.5447 18.7379 21.4953C18.6884 21.4459 18.6547 21.383 18.6411 21.3145C18.6274 21.2461 18.6344 21.1751 18.6612 21.1105C18.688 21.046 18.7333 20.9909 18.7915 20.9521C18.8497 20.9133 18.9181 20.8926 18.9881 20.8926C19.0819 20.8926 19.1719 20.9298 19.2382 20.996C19.3046 21.0622 19.3419 21.152 19.3419 21.2457Z" fill="#4A7EEE"/>
							<path d="M74.337 40.0972C74.337 40.1672 74.3161 40.2356 74.2771 40.2937C74.2381 40.3519 74.1826 40.3971 74.1178 40.4237C74.053 40.4504 73.9817 40.4572 73.913 40.4433C73.8443 40.4294 73.7812 40.3954 73.7319 40.3457C73.6825 40.296 73.6491 40.2328 73.6358 40.1641C73.6225 40.0954 73.63 40.0243 73.6573 39.9599C73.6845 39.8954 73.7304 39.8405 73.789 39.8021C73.8476 39.7637 73.9163 39.7435 73.9864 39.7442C74.0327 39.7442 74.0786 39.7533 74.1213 39.7711C74.1641 39.7889 74.2028 39.8149 74.2354 39.8478C74.268 39.8806 74.2938 39.9195 74.3112 39.9624C74.3286 40.0052 74.3374 40.051 74.337 40.0972Z" fill="#4A7EEE"/>
							<path d="M79.2344 26.3792C79.2351 26.4493 79.2148 26.518 79.1761 26.5765C79.1375 26.6351 79.0823 26.6808 79.0175 26.708C78.9527 26.7351 78.8813 26.7423 78.8124 26.7288C78.7435 26.7153 78.6802 26.6816 78.6305 26.632C78.5808 26.5825 78.547 26.5193 78.5335 26.4505C78.5199 26.3817 78.5272 26.3104 78.5544 26.2458C78.5816 26.1811 78.6274 26.126 78.6861 26.0875C78.7448 26.0489 78.8136 26.0287 78.8839 26.0293C78.9768 26.0293 79.066 26.0662 79.1317 26.1318C79.1975 26.1974 79.2344 26.2864 79.2344 26.3792Z" fill="#4A7EEE"/>
						</svg>
					</div>
					<h3><?php esc_html_e( 'Upgrade Now' ); ?></h3>
					<p><?php esc_html_e( 'Access all premium extensions, features, and upcoming updates right away by upgrading to the Pro version.' ); ?></p>
					<a><span><?php esc_html_e( 'Get ColorMag Pro Now' ); ?></span></a>

				</div>
			</div>
		</div>

		<?php
	}
}

ColorMag_Dashboard::instance();
