<div class="colormag-container products-page">
	<div class="postbox-container" style="float: none;">
		<div class="postbox">
			<h1 class="hndle">
				<!--Themes-->
				<span><?php esc_html_e('Themes', 'colormag') ?></span>
			</h1>
			<div class="inside inside__themes">
				<?php
				$themes_data = array(
					'colormag' => array(
						'name' => 'ColorMag',
						'slug' => 'colormag',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/colormag.webp',
						'description' => 'Modern and professional WordPress magazine-styled theme perfect for creating websites for magazines, news portals, and so on.',
					),
					'zakra' => array(
						'name' => 'Zakra',
						'slug' => 'zakra',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/zakra.webp',
						'description' => 'Multipurpose WordPress theme loaded with intuitive features and powerful customization options to create professional websites of any kind.',
					),
					// Add more themes as needed
				);

				foreach ($themes_data as $theme_info) :
					$theme_slug = $theme_info['slug'];
					?>
					<div class="item item-<?php echo esc_attr($theme_slug); ?>">
						<img class="<?php echo esc_attr($theme_slug); ?>-logo"
							 src="<?php echo esc_url($theme_info['image']); ?>"
							 alt="<?php echo esc_attr($theme_info['name']); ?>">
						<div class="content">
							<h3><?php echo esc_html($theme_info['name']); ?></h3>
							<p><?php esc_html_e($theme_info['description']); ?></p>
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
				<span><?php esc_html_e('Plugins', 'colormag') ?></span>
			</h1>
			<div class="inside inside__plugins">
				<?php
				$plugins_data = array(
					'ur' => array(
						'name' => 'User Registration',
						'file' => 'user-registration/user-registration.php',
						'slug' => 'user-registration',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/ur.webp',
						'description' => 'Ultimate WordPress user registration plugin to streamline the user signup process. Create registration & login forms, manage users, and more.'
					),
					'evf' => array(
						'name' => 'Everest Forms',
						'file' => 'everest-forms/everest-forms.php',
						'slug' => 'everest-forms',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/evf.webp',
						'description' => 'Feature-rich and highly customizable WordPress form builder plugin to create different types of professional forms for your website.'
					),
					'masteriyo' => array(
						'name' => 'Masteriyo',
						'file' => 'learning-management-system/lms.php',
						'slug' => 'learning-management-system',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/masteriyo.webp',
						'description' => 'Easy-to-use LMS plugin loaded with powerful features to create and sell courses online through your website effortlessly. '
					),
					'mzb' => array(
						'name' => 'Magazine Blocks',
						'file' => 'magazine-blocks/magazine-blocks.php',
						'slug' => 'magazine-blocks',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/magazine-blocks.webp',
						'description' => 'Powerful WordPress Gutenberg block plugin with the perfect blocks and editing options to create magazine-themed websites.'
					),
					'blockart-blocks' => array(
						'name' => 'BlockArt',
						'file' => 'blockart-blocks/blockart.php',
						'slug' => 'blockart-blocks',
						'image' => COLORMAG_PARENT_URL . '/inc/admin/images/blockart-blocks.webp',
						'description' => 'Highly customizable WordPress Gutenberg block plugin with pre-made templates to create websites of any niche in no time. '
					),
					// Add more themes as needed
				);

				foreach ($plugins_data as $plugin_info) :
					$plugin_file = $plugin_info['file'];
					$plugin_slug = $plugin_info['slug'];
					$is_plugin_installed = is_plugin_installed($plugin_file);
					$is_plugin_activated = is_plugin_active($plugin_file);
					?>
					<div class="item item-<?php echo esc_attr($plugin_slug); ?>">
						<img class="<?php echo esc_attr($plugin_slug); ?>-logo"
							 src="<?php echo esc_url($plugin_info['image']); ?>"
							 alt="<?php echo esc_attr($plugin_info['name']); ?>">
						<div class="content">
							<h3><?php echo esc_html($plugin_info['name']); ?></h3>
							<p><?php esc_html_e($plugin_info['description']); ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="#" class="learn-more"
								   data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Learn More'); ?></a>
								<a href="#" class="live-demo"
								   data-plugin="<?php echo esc_attr($plugin_file); ?>"><?php esc_html_e('Live demo'); ?></a>
							</div>
							<div class="cta-button">
								<?php if ($is_plugin_installed) : ?>
									<?php if ($is_plugin_activated) : ?>
										<span><?php esc_html_e('Activated'); ?></span>
									<?php else : ?>
										<span><a href="#" class="activate-plugin"
												 data-plugin="<?php echo esc_attr($plugin_file); ?>"
												 data-slug="<?php echo esc_attr($plugin_slug); ?> "><?php esc_html_e('Activate'); ?></span></a>
									<?php endif; ?>
								<?php else : ?>
									<span><a href="#" class="install-plugin"
											 data-plugin="<?php echo esc_attr($plugin_file); ?>"
											 data-slug="<?php echo esc_attr($plugin_slug); ?> "><?php esc_html_e('Install'); ?></span></a>
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
