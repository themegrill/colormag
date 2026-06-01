<?php
/**
 * ColorMag dashboard starter templates page.
 *
 * @author ThemeGrill
 * @package ColorMag
 * @since @todo
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="cm-wrap">
	<div class="cm-metabox-holder">
		<div class="colormag-header">
			<div class="cm-container" id="cm-dashboard-menu">
				<a class="cm-title" href="<?php echo esc_url( 'https://themegrill.com/themes/colormag/' ); ?>"
					target="_blank">
					<img class="cm-icon cm-logo"
						src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/images/colormag-logo-square.jpg' ); ?>"
						alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
				</a>
				<div class="cm-dashboard-menu-container">
					<ul id="cm-dashboard-menu-primary" class="cm-dashboard-menu-primary">
						<li>
							<a
								href="<?php echo admin_url() . 'themes.php?page=colormag#/dashboard'; ?>">
								<?php echo esc_html__( 'Dashboard','colormag' ); ?>
							</a>
						</li>
						<li class="cm-starter-templates-active">
							<a
								href="<?php echo admin_url() . 'admin.php?page=colormag-starter-templates&browse=all'; ?>">
								<?php echo esc_html__( 'Starter Templates','colormag' ); ?>
							</a>
						</li>
						<li>
							<a
								href="<?php echo admin_url() . 'themes.php?page=colormag#/settings'; ?>">
								<?php echo esc_html__( 'Settings', 'colormag' ); ?>
							</a>
						</li>
						<li>
							<a
								href="<?php echo admin_url() . 'themes.php?page=colormag#/products'; ?>">
								<?php echo esc_html__( 'Products', 'colormag' ); ?>
							</a>
						</li>
						<li>
							<a
								href="<?php echo admin_url() . 'themes.php?page=colormag#/help'; ?>">
								<?php echo esc_html__( 'Help', 'colormag' ); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="cm-dashboard-head-left">
					<span class="cm-version colormag-pro-version" style="border-color: #27AE60; border-width: 1px; color: #27AE60; border-style: solid; padding: 5px 10px; border-radius: 18px; font-weight: 500; text-decoration: none;">
						<?php echo esc_html( COLORMAG_THEME_VERSION ); ?>
						<span class="cm-core">
							<?php esc_html_e( 'Core', 'colormag' ); ?>
						</span>
					</span>
				</div>
			</div>
			<!--/.cm-container-->
		</div>
		<!--/.colormag-header-->
	</div>
	<div class="cm-container m-auto">
		<?php
		if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			include plugin_dir_path( TGDM_PLUGIN_FILE ) . '/includes/admin/views/html-admin-page-importer.php';
			return;
		}
		?>
	</div>
	<!--/.cm-metabox-holder-->
</div>
