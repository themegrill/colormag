<?php
/**
 * ColorMag Admin Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ColorMag_Admin' ) ) :

/**
 * ColorMag_Admin Class.
 */
class ColorMag_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'colormag' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'colormag' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'colormag-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		global $colormag_version;

		wp_enqueue_style( 'colormag-welcome', get_template_directory_uri() . '/css/admin/welcome.css', array(), $colormag_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $colormag_version, $pagenow;

		wp_enqueue_style( 'colormag-message', get_template_directory_uri() . '/css/admin/message.css', array(), $colormag_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'colormag_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'colormag_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['colormag-hide-notice'] ) && isset( $_GET['_colormag_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_colormag_notice_nonce'], 'colormag_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'colormag' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['colormag-hide-notice'] );
			update_option( 'colormag_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated colormag-message">
			<a class="colormag-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'colormag-hide-notice', 'welcome' ) ), 'colormag_hide_notices_nonce', '_colormag_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'colormag' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing colormag! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'colormag' ), '<a href="' . esc_url( admin_url( 'themes.php?page=colormag-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=colormag-welcome' ) ); ?>"><?php esc_html_e( 'Get started with ColorMag', 'colormag' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $colormag_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $colormag_version, 0, 3 );
		?>
		<div class="colormag-theme-info">
				<h1>
					<?php esc_html_e('About', 'colormag'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="colormag-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="colormag-actions">
			<a href="<?php echo esc_url( 'https://themegrill.com/themes/colormag/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'colormag' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'colormag_pro_theme_url', 'https://demo.themegrill.com/colormag/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'colormag' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'colormag_pro_theme_url', 'https://themegrill.com/themes/colormag-pro/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'colormag' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'colormag_pro_theme_url', 'https://wordpress.org/support/view/theme-reviews/colormag?filter=5#postform' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'colormag' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'colormag-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'colormag-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'colormag-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Supported Plugins', 'colormag' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'colormag-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'colormag' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'colormag-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'colormag' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
               <div class="col">
                  <h3><?php esc_html_e( 'Import Demo', 'colormag' ); ?></h3>
                  <p><?php esc_html_e( 'Needs ThemeGrill Demo Importer plugin.', 'colormag' ) ?></p>
                  <p><a href="<?php echo esc_url( network_admin_url( 'plugin-install.php?tab=search&type=term&s=themegrill-demo-importer' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'colormag' ); ?></a></p>
               </div>

					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'colormag' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'colormag' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'colormag' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'colormag' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'colormag' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themegrill.com/theme-instruction/colormag/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'colormag' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'colormag' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'colormag' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'colormag' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'colormag' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'colormag' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themegrill.com/themes/colormag-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View PRO version', 'colormag' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got sales related question?', 'colormag' ); ?></h3>
						<p><?php esc_html_e( 'Please send it via our sales contact page.', 'colormag' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Contact Page', 'colormag' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'colormag' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'colormag' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/colormag' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'colormag' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard colormag">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'colormag' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'colormag' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'colormag' ) : esc_html_e( 'Go to Dashboard', 'colormag' ); ?></a>
			</div>
		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'colormag' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'colormag_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}


	/**
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'colormag' ); ?></p>
			<ol>
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/social-icons/'); ?>" target="_blank"><?php esc_html_e('Social Icons', 'colormag'); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'colormag'); ?>
				</li>
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/easy-social-sharing/'); ?>" target="_blank"><?php esc_html_e('Easy Social Sharing', 'colormag' ); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'colormag'); ?>
				</li>
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/contact-form-7/'); ?>" target="_blank"><?php esc_html_e('Contact Form 7', 'colormag'); ?></a></li>
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/wp-pagenavi/'); ?>" target="_blank"><?php esc_html_e('WP-PageNavi', 'colormag'); ?></a></li>
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/woocommerce/'); ?>" target="_blank"><?php esc_html_e('WooCommerce', 'colormag'); ?></a></li>
				<li>
					<a href="<?php echo esc_url('https://wordpress.org/plugins/polylang/'); ?>" target="_blank"><?php esc_html_e('Polylang', 'colormag'); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'colormag'); ?>
				</li>
				<li>
					<a href="<?php echo esc_url('https://wpml.org/'); ?>" target="_blank"><?php esc_html_e('WPML', 'colormag'); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'colormag'); ?>
				</li>
			</ol>

		</div>
		<?php
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'colormag' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'colormag'); ?></h3></th>
						<th><h3><?php esc_html_e('ColorMag', 'colormag'); ?></h3></th>
						<th><h3><?php esc_html_e('ColorMag Pro', 'colormag'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Support', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('Forum', 'colormag'); ?></td>
						<td><?php esc_html_e('Forum + Emails/Support Ticket', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Color Options', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('1', 'colormag'); ?></td>
						<td><?php esc_html_e('22', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Primary color option', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Font Size Options', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Google Fonts Options', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('600+', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Custom Widgets', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('7', 'colormag'); ?></td>
						<td><?php esc_html_e('16', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Social Icons', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('6', 'colormag'); ?></td>
						<td><?php esc_html_e('18 + 6 Custom', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Social Sharing', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Custom Menu', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('1', 'colormag'); ?></td>
						<td><?php esc_html_e('2', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Sidebar', 'colormag'); ?></h3></td>
						<td><?php esc_html_e('4', 'colormag'); ?></td>
						<td><?php esc_html_e('7', 'colormag'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Site Layout Option', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Options in Breaking News', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Unique Post System', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Change Read More Text', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Related Posts', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Author Biography', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Author Biography with Social Icons', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Copyright Editor', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: 125x125 Advertisement', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: 300x250 Advertisement', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: 728x90 Advertisement', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Category Slider', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Highlighted Posts', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Random Posts Widget', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Tabbed Widget', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Videos', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 1)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 2)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 3)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 4)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 5)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 6)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts (Style 7)', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Category Color Options', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WPML Compatible', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Polylang Compatible', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WooCommerce Compatible', 'colormag'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'colormag_pro_theme_url', 'https://themegrill.com/themes/colormag-pro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'colormag' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new ColorMag_Admin();
