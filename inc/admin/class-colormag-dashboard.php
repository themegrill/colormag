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
			'colormag-options',
			array(
				$this,
				'option_page',
			)
		);

		// Add a submenu page under ColorMag Options
		add_submenu_page(
			'colormag-options',  // Parent menu slug (ColorMag Options)
			'ColorMag Dashboard', // Page title
			'ColorMag Dashboard', // Menu title
			'edit_theme_options', // Capability required to access the menu
			'colormag-dashboard', // Menu slug
			'colormag_dashboard_page' // Callback function to display content
		);
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

	public function create_button_html()
	{

		$colormag_btn_texts = __('Create a new page', 'colormag');

		$admin_url = admin_url();

		$html = '<a class="btn-create-new-page" href="' . $admin_url . 'post-new.php?post_type=page" aria-label="' . esc_attr($colormag_btn_texts) . '">' . esc_html($colormag_btn_texts) . '</a>';

		return $html;
	}


	public function option_page()
	{

		if (!is_child_theme()) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$support_link = 'https://themegrill.com/contact/';

		$link_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3 4C2.86739 4 2.74021 4.05268 2.64645 4.14645C2.55268 4.24022 2.5 4.3674 2.5 4.5V10C2.5 10.1326 2.55268 10.2598 2.64645 10.3536C2.74022 10.4473 2.86739 10.5 3 10.5H8.5C8.63261 10.5 8.75978 10.4473 8.85355 10.3536C8.94732 10.2598 9 10.1326 9 10V7C9 6.72386 9.22386 6.5 9.5 6.5C9.77614 6.5 10 6.72386 10 7V10C10 10.3978 9.84196 10.7794 9.56066 11.0607C9.27936 11.342 8.89783 11.5 8.5 11.5H3C2.60217 11.5 2.22064 11.342 1.93934 11.0607C1.65804 10.7794 1.5 10.3978 1.5 10V4.5C1.5 4.10218 1.65804 3.72065 1.93934 3.43934C2.22064 3.15804 2.60218 3 3 3H6C6.27614 3 6.5 3.22386 6.5 3.5C6.5 3.77615 6.27614 4 6 4H3Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 2C7.5 1.72386 7.72386 1.5 8 1.5H11C11.2761 1.5 11.5 1.72386 11.5 2V5C11.5 5.27615 11.2761 5.5 11 5.5C10.7239 5.5 10.5 5.27615 10.5 5V2.5H8C7.72386 2.5 7.5 2.27615 7.5 2Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3536 1.64645C11.5489 1.84171 11.5489 2.15829 11.3536 2.35355L5.8536 7.85355C5.65834 8.04882 5.34175 8.04882 5.14649 7.85355C4.95123 7.65829 4.95123 7.34171 5.14649 7.14645L10.6465 1.64645C10.8418 1.45118 11.1583 1.45118 11.3536 1.64645Z" fill="#7A7A7A"/>
					</svg>';

		$pro_feature_links = array(
			__('Top Bar', 'colormag') => 'https://docs.themegrill.com/colormag/docs/customize-top-bar/',
			__('Main Header', 'colormag') => 'https://docs.themegrill.com/colormag/docs/manage-main-header-layout-and-styles',
			__('Primary Menu', 'colormag') => 'https://docs.themegrill.com/colormag/docs/customize-the-primary-menu-of-the-site',
			__('Blog', 'colormag') => 'https://docs.themegrill.com/colormag/docs/manage-blog-page-layout',
			__('Meta', 'colormag') => 'https://docs.themegrill.com/colormag/docs/customize-the-post-meta',
			__('Footer Column', 'colormag') => 'https://docs.themegrill.com/colormag/docs/customize-footer-column',
			__('Footer Bar', 'colormag') => 'https://docs.themegrill.com/colormag/docs/customize-footer-bar-layout-styles',
		);

		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="colormag-header">
					<div class="colormag-container">
						<div class="cm-dashboard-head-right">
							<a class="colormag-title"
							   href="<?php echo esc_url('https://themegrill.com/themes/colormag/'); ?>" target="_blank">
								<img class="colormag-icon"
									 src="<?php echo esc_url(COLORMAG_PARENT_URL . '/inc/admin/images/cm-logo.png'); ?>"
									 alt="<?php esc_attr_e('ColorMag', 'colormag'); ?>">
								<div>
									<a href="<?php echo esc_url('https://themegrill.com/themes/colormag/'); ?>"
									   target="_blank"><?php esc_html_e('Dashboard', 'colormag'); ?></a>
									<a href="<?php echo esc_url('https://themegrilldemos.com/colormag-demos/#/'); ?>"
									   target="_blank"><?php esc_html_e('Starter Templates', 'colormag'); ?></a>
									<a href="<?php echo esc_url('https://themegrill.com/colormag-pricing/'); ?>"
									   target="_blank"><?php esc_html_e('Products', 'colormag'); ?></a>
									<a href="<?php echo esc_url($support_link); ?>"
									   target="_blank"><?php esc_html_e('Free Vs Pro', 'colormag'); ?></a>
									<a href="<?php echo esc_url('https://docs.themegrill.com/colormag/'); ?>"
									   target="_blank"><?php esc_html_e('Help', 'colormag'); ?></a>
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
				<div class="colormag-container">
					<div class="postbox-container" style="float: none;">
						<div class="col-70">
							<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
							<div class="postbox">
								<h1 class="hndle"><?php esc_html_e('Welcome to ColorMag', 'colormag'); ?></h1>
								<div class="inside" style="padding: 0;margin: 0;">
									<p><?php esc_html_e('Watch our "Getting Started" video series for better understanding of ColorMag Theme. It will guide you through the steps needed to create your website. Then click to create your first page.', 'colormag'); ?>
										></p>
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
								<div class="hndle">
									<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g id="download">
											<path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M10.5 2.5C10.9602 2.5 11.3333 2.8731 11.3333 3.33333V11.3215L14.0774 8.57741C14.4028 8.25197 14.9305 8.25197 15.2559 8.57741C15.5814 8.90285 15.5814 9.43049 15.2559 9.75592L11.0893 13.9226C10.7638 14.248 10.2362 14.248 9.91074 13.9226L5.74408 9.75592C5.41864 9.43049 5.41864 8.90285 5.74408 8.57741C6.06951 8.25197 6.59715 8.25197 6.92259 8.57741L9.66667 11.3215V3.33333C9.66667 2.8731 10.0398 2.5 10.5 2.5ZM3.83333 13.3333C4.29357 13.3333 4.66667 13.7064 4.66667 14.1667V15.8333C4.66667 16.0543 4.75446 16.2663 4.91074 16.4226C5.06702 16.5789 5.27899 16.6667 5.5 16.6667H15.5C15.721 16.6667 15.933 16.5789 16.0893 16.4226C16.2455 16.2663 16.3333 16.0543 16.3333 15.8333V14.1667C16.3333 13.7064 16.7064 13.3333 17.1667 13.3333C17.6269 13.3333 18 13.7064 18 14.1667V15.8333C18 16.4964 17.7366 17.1323 17.2678 17.6011C16.7989 18.0699 16.163 18.3333 15.5 18.3333H5.5C4.83696 18.3333 4.20107 18.0699 3.73223 17.6011C3.26339 17.1323 3 16.4964 3 15.8333V14.1667C3 13.7064 3.3731 13.3333 3.83333 13.3333Z" fill="#2563EB"/>
										</g>
									</svg>
									<h3><span><?php esc_html_e('Starter Templates', 'colormag'); ?></span></h3>
								</div>
								<div class="inside">
									<p><?php esc_html_e( 'Use ColorMags diverse demos instead of starting your site from scratch.Simply import a demo and customize it to your preferences.') ?></p>
								</div>
							</div>
							<div class="postbox">
								<h3 class="hndle"><span
										class="dashicons dashicons-download"></span><span><?php esc_html_e('Starter Demos', 'colormag'); ?></span>
								</h3>
								<div class="inside">
									<p>
										<?php
										echo sprintf(
										/* translators: 1: Theme Name, 2: Demo Link. */
											esc_html__('You do not need to build your site from scratch, %1$s provides a variety of %2$s', 'colormag'),
											$theme->Name,
											'<a href="' . esc_url('https://themegrilldemos.com/colormag-demos/#/') . '" target="_blank">' . esc_html__('Demos.', 'colormag') . '</a>'
										);
										?>
									</p>
									<p><?php esc_html_e('Import demo site and start editing as your liking.', 'colormag'); ?></p>
									<?php echo $this->import_button_html(); ?>
								</div>
							</div>
							<div class="postbox">
								<h3 class="hndle">
									<span class="dashicons dashicons-facebook"></span>
									<span>
											<?php
											echo sprintf(
											/* translators: %s: Theme Name. */
												esc_html__('%s Community', 'colormag'),
												'ThemeGrill'
											);
											?>
										</span>
								</h3>
								<div class="inside">
									<p>
										<?php
										echo sprintf(
										/* translators: %s: Theme Name. */
											esc_html__('Connect with us and other helpful %s users like you.', 'colormag'),
											$theme->Name
										);
										?>
									</p>
									<a href="<?php echo esc_url('https://www.facebook.com/groups/themegrill'); ?>"
									   target="_blank"><?php esc_html_e('Join Now &#129066;', 'colormag'); ?></a>
								</div>
							</div>
							<!--								<div class="postbox">-->
							<!--									<h3 class="hndle"><span class="dashicons dashicons-thumbs-up"></span><span>-->
							<?php //esc_html_e( 'Review', 'colormag' ); ?><!--</span></h3>-->
							<!--									<div class="inside">-->
							<!--										<p>-->
							<!--											--><?php
							//											echo sprintf(
							//												/* translators: 1: Theme Name, 2: Review Link. */
							//												esc_html__( 'Love using %1$s? Help us by leaving a review %2$s', 'colormag' ),
							//												$theme->Name,
							//												'<a href="' . esc_url( 'https://wordpress.org/support/theme/colormag/reviews/' ) . '" target="_blank">' . esc_html__( 'here &#129066;', 'colormag' ) . '</a>'
							//											);
							//											?>
							<!--										</p>-->
							<!--									</div>-->
							<!--								</div>-->
						</div><!--/.col-30-->
					</div><!--/.postbox-container-->
				</div><!--/.colormag-container-->
			</div><!--/.metabox-holder-->
		</div><!--/.wrap-->
		<?php
	}

	public function colormag_dashboard_page()
	{
		// Callback function for the ColorMag Dashboard page
		echo '<div class="wrap"><h2>ColorMag Dashboard Page Content</h2><p>This is the content of the ColorMag Dashboard page.</p></div>';
	}
}

ColorMag_Dashboard::instance();
