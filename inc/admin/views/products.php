<div class="colormag-container products-page">
	<div class="postbox-container" style="float: none;">
		<div class="postbox">
			<h1 class="hndle">
				<!--Themes-->
				<span><?php esc_html_e('Themes', 'colormag') ?></span>
			</h1>
			<div class="inside">
				<?php
				$themes_data = array(
					'colormag' => array(
						'name'  => 'ColorMag',
						'slug'  => 'colormag',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/colormag.webp',
					),
					'zakra'    => array(
						'name'  => 'Zakra',
						'slug'  => 'zakra',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/zakra.webp',
					),
					// Add more themes as needed
				);

				foreach ($themes_data as $theme_info) :
					$theme_slug = $theme_info['slug'];
					$active_theme = wp_get_theme();
					$installed_themes = wp_get_themes();
					$theme_is_installed = isset($installed_themes[$theme_slug]);

					?>
					<div class="item item-<?php echo esc_attr($theme_slug); ?>">
						<img class="<?php echo esc_attr($theme_slug); ?>-logo" src="<?php echo esc_url($theme_info['image']); ?>" alt="<?php echo esc_attr($theme_info['name']); ?>">
						<div class="content">
							<h3><?php echo esc_html($theme_info['name']); ?></h3>
							<p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.'); ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="#"><?php esc_html_e('Learn More'); ?></a>
								<a href="#"><?php esc_html_e('Live demo'); ?></a>
							</div>
							<div class="cta-button">
								<?php if ($theme_is_installed) : ?>
									<?php if ($active_theme->stylesheet === $theme_slug) : ?>
										<span><?php esc_html_e('Activated'); ?></span>
									<?php else : ?>
										<a href="#" data-theme-slug="<?php echo esc_attr($theme_slug); ?>" class="activate-theme"><?php esc_html_e('Activate'); ?></a>
									<?php endif; ?>
								<?php else : ?>
									<?php
									$install_theme_url = 'https://api.wordpress.org/themes/info/1.2/?action=theme_information&request[slug]=' . $theme_slug;
									$response = wp_remote_get($install_theme_url);
									$body = wp_remote_retrieve_body($response);
									$theme_info = json_decode($body);

									if ($theme_info) {
										$install_url = esc_url(admin_url('update.php?action=install-theme&theme=' . $theme_slug));
										$nonce = wp_create_nonce('install-theme_' . $theme_slug);
										?>
										<a href="<?php echo esc_url(add_query_arg(array('action' => 'install-theme', 'theme' => $theme_slug, '_wpnonce' => $nonce), $install_url)); ?>">
											<?php esc_html_e('Install'); ?>
										</a>
									<?php } ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<h1 class="hndle">
				<!--Themes-->
				<span><?php esc_html_e('Plugins', 'colormag') ?></span>
			</h1>
			<div class="inside">
				<?php
				$plugins_data = array(
					'ur' => array(
						'name'  => 'User Registration',
						'file'  => 'user-registration',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/ur.webp',
					),
					'evf'    => array(
						'name'  => 'Everest Forms',
						'file'  => 'everest-forms',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/evf.webp',
					),
					'masteriyo'    => array(
						'name'  => 'Masteriyo',
						'file'  => 'masteriyo',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/masteriyo.webp',
					),
					'mzb'    => array(
						'name'  => 'Magazine Blocks',
						'file'  => 'magazine-blocks',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/magazine-blocks.webp',
					),
					'blockart-blocks'    => array(
						'name'  => 'BlockArt',
						'file'  => 'blockart-blocks',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/blockart-blocks.webp',
					),
					// Add more themes as needed
				);

				foreach ($plugins_data as $plugin_info) :
					$plugin_file = $plugin_info['file'];
					$is_plugin_installed = is_plugin_active($plugin_file . '/' . $plugin_file . '.php');
					?>
					<div class="item item-<?php echo esc_attr($plugin_file); ?>">
						<img class="<?php echo esc_attr($plugin_file); ?>-logo" src="<?php echo esc_url($plugin_info['image']); ?>" alt="<?php echo esc_attr($plugin_info['name']); ?>">
						<div class="content">
							<h3><?php echo esc_html($plugin_info['name']); ?></h3>
							<p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.'); ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="#"><?php esc_html_e('Learn More'); ?></a>
								<a href="#"><?php esc_html_e('Live demo'); ?></a>
							</div>
							<div class="cta-button">
								<?php if ($is_plugin_installed) : ?>
									<span><?php esc_html_e('Installed'); ?></span>
								<?php else : ?>
									<span><?php esc_html_e('Install'); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- Add other postboxes as needed -->
	</div>
</div>

