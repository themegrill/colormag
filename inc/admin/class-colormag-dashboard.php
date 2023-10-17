<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Dashboard {
	private static $instance;

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
	}

	public function create_menu() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'colormag' ), $theme->Name );

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
	}

	public function import_button_html() {

		// Check if TDI is installed but not activated or not installed at all or installed and activated.
		if ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$colormag_btn_texts = __( 'Activate ThemeGrill Demo Importer Plugin', 'colormag' );
		} elseif ( ! file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$colormag_btn_texts = __( 'Install ThemeGrill Demo Importer Plugin', 'colormag' );
		} else {
			$colormag_btn_texts = __( 'Demo Library', 'colormag' );
		}

		$html = '<a class="btn-get-started" href="#" data-name="' . esc_attr( 'themegrill-demo-importer' ) . '" data-slug="' . esc_attr( 'themegrill-demo-importer' ) . '" aria-label="' . esc_attr( $colormag_btn_texts ) . '">' . esc_html( $colormag_btn_texts . ' &#129066;' ) . '</a>';

		return $html;
	}

	public function option_page() {

		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$support_link = 'https://themegrill.com/contact/';

		$pro_feature_links = array(
			__( 'Top Bar', 'colormag' )       => 'https://docs.themegrill.com/colormag/docs/customize-top-bar/',
			__( 'Main Header', 'colormag' )   => 'https://docs.themegrill.com/colormag/docs/manage-main-header-layout-and-styles',
			__( 'Primary Menu', 'colormag' )  => 'https://docs.themegrill.com/colormag/docs/customize-the-primary-menu-of-the-site',
			__( 'Blog', 'colormag' )          => 'https://docs.themegrill.com/colormag/docs/manage-blog-page-layout',
			__( 'Meta', 'colormag' )          => 'https://docs.themegrill.com/colormag/docs/customize-the-post-meta',
			__( 'Footer Column', 'colormag' ) => 'https://docs.themegrill.com/colormag/docs/customize-footer-column',
			__( 'Footer Bar', 'colormag' )    => 'https://docs.themegrill.com/colormag/docs/customize-footer-bar-layout-styles',
		);

		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="colormag-header" >
					<div class="colormag-container">
						<a class="colormag-title" href="<?php echo esc_url( 'https://themegrill.com/themes/colormag/' ); ?>" target="_blank">
							<img class="colormag-icon" src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/colormag-logo.png' ); ?>" alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
							<span class="colormag-version">
									<?php
									echo $theme->Version;
									?>
								</span>
						</a>
						<div>
							<a href="<?php echo esc_url( 'https://themegrill.com/themes/colormag/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Info', 'colormag' ); ?></a>
							<a href="<?php echo esc_url( 'https://themegrilldemos.com/colormag-demos/#/' ); ?>" target="_blank"><?php esc_html_e( 'Demos', 'colormag' ); ?></a>
							<a href="<?php echo esc_url( 'https://themegrill.com/colormag-pricing/' ); ?>" target="_blank"><?php esc_html_e( 'Premium', 'colormag' ); ?></a>
							<a href="<?php echo esc_url( $support_link ); ?>" target="_blank"><?php esc_html_e( 'Support', 'colormag' ); ?></a>
							<a href="<?php echo esc_url( 'https://docs.themegrill.com/colormag/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'colormag' ); ?></a>
						</div>
					</div><!--/.colormag-container-->
				</div> <!--/.colormag-header-->
				<div class="colormag-container">
					<div class="postbox-container" style="float: none;">
						<div class="col-70">
							<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
							<div class="postbox">
								<h3 class="hndle"><?php esc_html_e( 'Premium Features', 'colormag' ); ?></h3>
								<div class="inside" style="padding: 0;margin: 0;">
									<ul>
										<?php foreach ( $pro_feature_links as $pro_feature_text => $pro_feature_link ) : ?>
											<li class="pro-feature">
												<a href="<?php echo esc_url( $pro_feature_link ); ?>" target="_blank"><?php echo esc_html( $pro_feature_text ); ?></a>
												<span>
														<a href=" <?php echo esc_url( $pro_feature_link ); ?>" target="_blank"><?php echo esc_html__( 'Learn More', 'colormag' ); ?></a>
													</span>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div> <!--/.col-70-->
						<div class="col-30">
							<div class="postbox">
								<h3>
									<span class="dashicons dashicons-category"></span>
									<span><?php esc_html_e( 'Get Started', 'colormag' ); ?></span>
								</h3>
								<a href="<?php echo esc_url( 'https://docs.themegrill.com/colormag/install-colormag-theme//' ); ?>" target="_blank"><?php esc_html_e( 'Learn Basics &#129066;', 'colormag' ); ?></a>
							</div>
							<div class="postbox">
								<h3 class="hndle" ><span class="dashicons dashicons-download"></span><span><?php esc_html_e( 'Starter Demos', 'colormag' ); ?></span></h3>
								<div class="inside">
									<p>
										<?php
										echo sprintf(
										/* translators: 1: Theme Name, 2: Demo Link. */
											esc_html__( 'You do not need to build your site from scratch, %1$s provides a variety of %2$s', 'colormag' ),
											$theme->Name,
											'<a href="' . esc_url( 'https://themegrilldemos.com/colormag-demos/#/' ) . '" target="_blank">' . esc_html__( 'Demos.', 'colormag' ) . '</a>'
										);
										?>
									</p>
									<p><?php esc_html_e( 'Import demo site and start editing as your liking.', 'colormag' ); ?></p>
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
												esc_html__( '%s Community', 'colormag' ),
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
											esc_html__( 'Connect with us and other helpful %s users like you.', 'colormag' ),
											$theme->Name
										);
										?>
									</p>
									<a href="<?php echo esc_url( 'https://www.facebook.com/groups/themegrill' ); ?>" target="_blank"><?php esc_html_e( 'Join Now &#129066;', 'colormag' ); ?></a>
								</div>
							</div>
							<!--								<div class="postbox">-->
							<!--									<h3 class="hndle"><span class="dashicons dashicons-thumbs-up"></span><span>--><?php //esc_html_e( 'Review', 'colormag' ); ?><!--</span></h3>-->
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
}

ColorMag_Dashboard::instance();
