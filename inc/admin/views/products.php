<div class="cm-container products-page">
	<div class="postbox-container" style="float: none;">
		<div class="postbox">
			<h1 class="hndle">
				<!--Themes-->
				<span><?php esc_html_e( 'Themes', 'colormag' ); ?></span>
			</h1>
			<div class="inside inside__themes">
				<?php
				$themes_data = array(
					'colormag' => array(
						'name'            => __( 'ColorMag', 'colormag' ),
						'slug'            => 'colormag',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/colormag.webp',
						'description'     => __( 'Modern and professional WordPress magazine-styled theme perfect for creating websites for magazines, news portals, and so on.', 'colormag' ),
						'learn_more_link' => 'https://themegrill.com/themes/colormag/',
						'live_demo_link'  => 'https://themegrilldemos.com/#/themes/colormag',
					),
					'zakra'    => array(
						'name'            => __( 'Zakra', 'colormag' ),
						'slug'            => 'zakra',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/zakra.webp',
						'description'     => __( 'Multipurpose WordPress theme loaded with intuitive features and powerful customization options to create professional websites of any kind.', 'colormag' ),
						'learn_more_link' => 'https://zakratheme.com/',
						'live_demo_link'  => 'https://zakratheme.com/demos/#/',
					),
				);

				foreach ( $themes_data as $theme_info ) :
					$theme_slug = $theme_info['slug'];
					?>
					<div class="item item-<?php echo esc_attr( $theme_slug ); ?>">
						<img class="<?php echo esc_attr( $theme_slug ); ?>-logo" src="<?php echo esc_url( $theme_info['image'] ); ?>" alt="<?php echo esc_attr( $theme_info['name'] ); ?>">
						<div class="content">
							<h3><?php echo esc_html( $theme_info['name'] ); ?></h3>
							<p><?php echo esc_html( $theme_info['description'] ); ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="<?php echo esc_url( $theme_info['learn_more_link'] ); ?>" target="_blank"><?php esc_html_e( 'Learn More', 'colormag' ); ?></a>
								<a href="<?php echo esc_url( $theme_info['live_demo_link'] ); ?>" target="_blank"><?php esc_html_e( 'Live demo', 'colormag' ); ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<h1 class="hndle">
				<span><?php esc_html_e( 'Plugins', 'colormag' ); ?></span>
			</h1>
			<div class="inside inside__plugins">
				<?php
				$plugins_data = array(
					'ur'              => array(
						'name'            => __( 'User Registration', 'colormag' ),
						'file'            => 'user-registration/user-registration.php',
						'slug'            => 'user-registration',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/ur.webp',
						'description'     => __( 'Ultimate WordPress user registration plugin to streamline the user signup process. Create registration & login forms, manage users, and more.', 'colormag' ),
						'learn_more_link' => 'https://wpuserregistration.com/',
						'live_demo_link'  => 'https://wpuserregistration.com/',
					),
					'evf'             => array(
						'name'            => __( 'Everest Forms', 'colormag' ),
						'file'            => 'everest-forms/everest-forms.php',
						'slug'            => 'everest-forms',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/evf.webp',
						'description'     => __( 'Feature-rich and highly customizable WordPress form builder plugin to create different types of professional forms for your website.', 'colormag' ),
						'learn_more_link' => 'https://everestforms.net/',
						'live_demo_link'  => 'https://everestforms.net/',
					),
					'masteriyo'       => array(
						'name'            => __( 'Masteriyo', 'colormag' ),
						'file'            => 'learning-management-system/lms.php',
						'slug'            => 'learning-management-system',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/masteriyo.webp',
						'description'     => __( 'Streamline the learning process with an easy-to-use and highly advanced LMS plugin loaded with powerful features to create and sell courses online through your website effortlessly.', 'colormag' ),
						'learn_more_link' => 'https://masteriyo.com/',
						'live_demo_link'  => 'https://masteriyo.com/',
					),
					'mzb'             => array(
						'name'            => __( 'Magazine Blocks', 'colormag' ),
						'file'            => 'magazine-blocks/magazine-blocks.php',
						'slug'            => 'magazine-blocks',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/magazine-blocks.webp',
						'description'     => __( 'Powerful WordPress Gutenberg block plugin with the perfect blocks and editing options to create magazine-themed websites.', 'colormag' ),
						'learn_more_link' => 'https://wpblockart.com/magazine-blocks/',
						'live_demo_link'  => 'https://wpblockart.com/magazine-blocks/',
					),
					'blockart-blocks' => array(
						'name'            => __( 'BlockArt', 'colormag' ),
						'file'            => 'blockart-blocks/blockart.php',
						'slug'            => 'blockart-blocks',
						'image'           => COLORMAG_PARENT_URL . '/inc/admin/images/blockart-blocks.webp',
						'description'     => __( 'Highly customizable WordPress Gutenberg block plugin with pre-made templates and powerful blocks to create websites of any niche in no time. ', 'colormag' ),
						'learn_more_link' => 'https://wpblockart.com/blockart-blocks/',
						'live_demo_link'  => 'https://wpblockart.com/blockart-blocks/',
					),
					// Add more themes as needed
				);

				foreach ( $plugins_data as $plugin_info ) :
					$plugin_file         = $plugin_info['file'];
					$plugin_slug         = $plugin_info['slug'];
					$is_plugin_installed = colormag_is_plugin_installed( $plugin_file );
					$is_plugin_activated = is_plugin_active( $plugin_file );
					?>
					<div class="item item-<?php echo $plugin_slug; ?>">
						<img class="<?php echo $plugin_slug; ?>-logo"
							src="<?php echo $plugin_info['image']; ?>"
							alt="<?php echo $plugin_info['name']; ?>">
						<div class="content">
							<h3><?php echo $plugin_info['name']; ?></h3>
							<p><?php echo $plugin_info['description']; ?></p>
						</div>
						<div class="cta">
							<div class="cta-text">
								<a href="<?php echo $plugin_info['learn_more_link']; ?>" target="_blank"><?php esc_html_e( 'Learn More', 'colormag' ); ?></a>
								<a href="<?php echo $plugin_info['live_demo_link']; ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'colormag' ); ?></a>
							</div>
							<div class="cta-button">
								<?php if ( $is_plugin_installed ) : ?>
									<?php if ( $is_plugin_activated ) : ?>
										<span class="activated"><?php esc_html_e( 'Activated', 'colormag' ); ?></span>
									<?php else : ?>
										<span><a href="#" class="activate-plugin"
												data-plugin="<?php echo $plugin_file; ?>"
												data-slug="<?php echo $plugin_slug; ?> "><?php esc_html_e( 'Activate', 'colormag' ); ?></span></a>
									<?php endif; ?>
								<?php else : ?>
									<span><a href="#" class="install-plugin"
											data-plugin="<?php echo $plugin_file; ?>"
											data-slug="<?php echo $plugin_slug; ?> "><?php esc_html_e( 'Install', 'colormag' ); ?></span></a>
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
