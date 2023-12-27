<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class ColorMag_Products_Page {

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
}

new ColorMag_Products_Page();
