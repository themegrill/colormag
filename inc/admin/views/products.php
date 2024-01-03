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
						'slug'  => 'user-registration',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/ur.webp',
					),
					'evf'    => array(
						'name'  => 'Everest Forms',
						'slug'  => 'everest-forms',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/evf.webp',
					),
					'masteriyo'    => array(
						'name'  => 'Masteriyo',
						'slug'  => 'learning-management-system',
						'file' => 'lms',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/masteriyo.webp',
					),
					'mzb'    => array(
						'name'  => 'Magazine Blocks',
						'slug'  => 'magazine-blocks',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/magazine-blocks.webp',
					),
					'blockart-blocks'    => array(
						'name'  => 'BlockArt',
						'slug'  => 'blockart-blocks',
						'file' => 'blockart',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/blockart-blocks.webp',
					),
					// Add more themes as needed
				);

				foreach ($plugins_data as $plugin_info) :
					$plugin_slug = $plugin_info['slug'];
					$plugin_file = isset($plugin_info['file']) ? $plugin_info['file'] : $plugin_info['slug'];
					$is_plugin_installed = is_plugin_installed( $plugin_slug . '/' . $plugin_file . '.php' );
					$is_plugin_activated = is_plugin_active($plugin_slug . '/' . $plugin_file . '.php');
					?>
					<div class="item item-<?php echo esc_attr($plugin_file); ?>">
						<img class="<?php echo esc_attr($plugin_file); ?>-logo" src="<?php echo esc_url($plugin_info['image']); ?>" alt="<?php echo esc_attr($plugin_info['name']); ?>">
						<div class="content">
							<h3><?php echo esc_html($plugin_info['name']); ?></h3>
							<p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetr adipiscing elit, sed do smod tempoore aliqua temor dolor imet sed.'); ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="#" class="learn-more" data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Learn More'); ?></a>
								<a href="#" class="live-demo" data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Live demo'); ?></a>
							</div>
							<div class="cta-button">
								<?php if ($is_plugin_installed) : ?>
									<?php if ( $is_plugin_activated ) : ?>
										<span><?php esc_html_e('Activated'); ?></span>
									<?php else : ?>
								<span><a href="#" class="activate-plugin" data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Activate'); ?></span></a>
									<?php endif; ?>
								<?php else : ?>
									<span><a href="#" class="install-plugin" data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Install'); ?></span></a>
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

<script>
	jQuery(document).ready(function ($) {
		$('.install-plugin, .activate-plugin').on('click', function (e) {
			e.preventDefault();
			var button = $(this);
			var plugin = button.data('plugin');
			var action = button.hasClass('install-plugin') ? 'install_plugin' : 'activate_plugin';
			var data = {
				'action': action,
				'plugin': plugin,
				'security': '<?php echo wp_create_nonce('plugin_action_nonce'); ?>'
			};

			// Add loading animation and update text
			var originalText = button.html();
			button.html('<i class="fa fa-spinner fa-spin"></i> <?php esc_html_e('Processing...'); ?>');

			$.post(ajaxurl, data, function (response) {
				// Restore the button text after completion
				button.html('Activated');

				if (response.success) {
					// Optional: You can perform additional actions here if needed.
					if (button.hasClass('activate-plugin') || button.hasClass('install-plugin')) {
						a.removeClass('activate-plugin install-plugin');
					}
				} else {

				}
			});
		});
	});
</script>





