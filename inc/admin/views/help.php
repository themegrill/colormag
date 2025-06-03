<?php
if ( ! is_child_theme() ) {
	$theme = wp_get_theme();
} else {
	$theme = wp_get_theme()->parent();
}

$star_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
  						<path d="M4.62151 3.66996L1.43151 4.13246L1.37501 4.14396C1.28947 4.16667 1.2115 4.21167 1.14905 4.27436C1.0866 4.33706 1.04191 4.41521 1.01954 4.50082C0.997165 4.58644 0.997919 4.67647 1.02172 4.7617C1.04552 4.84693 1.09151 4.92432 1.155 4.98596L3.46601 7.23546L2.92101 10.413L2.91451 10.468C2.90927 10.5564 2.92764 10.6447 2.96773 10.7237C3.00782 10.8027 3.0682 10.8697 3.14267 10.9177C3.21715 10.9657 3.30305 10.9931 3.39158 10.997C3.48011 11.0009 3.56809 10.9812 3.64651 10.94L6.49951 9.43996L9.346 10.94L9.396 10.963C9.47854 10.9955 9.56823 11.0054 9.65588 10.9918C9.74354 10.9782 9.826 10.9416 9.8948 10.8856C9.96361 10.8296 10.0163 10.7563 10.0474 10.6733C10.0786 10.5902 10.087 10.5004 10.072 10.413L9.5265 7.23546L11.8385 4.98546L11.8775 4.94296C11.9332 4.87435 11.9697 4.79219 11.9834 4.70486C11.997 4.61753 11.9872 4.52815 11.955 4.44583C11.9229 4.3635 11.8695 4.29118 11.8002 4.23622C11.731 4.18126 11.6485 4.14563 11.561 4.13296L8.37101 3.66996L6.94501 0.779961C6.90374 0.696229 6.83986 0.625719 6.7606 0.576414C6.68134 0.527108 6.58985 0.500977 6.49651 0.500977C6.40316 0.500977 6.31167 0.527108 6.23241 0.576414C6.15315 0.625719 6.08927 0.696229 6.04801 0.779961L4.62151 3.66996Z" fill="#222222"/>
						</svg>';
?>
<div class="cm-container help-page">
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
					<h3><?php esc_html_e( 'Need Some Help?', 'colormag' ); ?></h3>
					<p><?php esc_html_e( 'Please check out basic documentation for detailed information on how to use ColorMag.', 'colormag' ); ?></p>
					<a href="<?php echo esc_url( 'https://docs.themegrill.com/colormag/' ); ?>" class="help-box" target="_blank"><?php esc_html_e( 'View Now', 'colormag' ); ?></a>
				</div>
				<div class="postbox">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 33 33" fill="none">
						<path d="M19.1667 20.3428V23.0094C19.1667 23.3631 19.0262 23.7022 18.7761 23.9523C18.5261 24.2023 18.187 24.3428 17.8333 24.3428H8.5L4.5 28.3428V15.0094C4.5 14.6558 4.64048 14.3167 4.89052 14.0666C5.14057 13.8166 5.47971 13.6761 5.83333 13.6761H8.5M28.5 19.0094L24.5 15.0094H15.1667C14.813 15.0094 14.4739 14.869 14.2239 14.6189C13.9738 14.3689 13.8333 14.0297 13.8333 13.6761V5.67611C13.8333 5.32248 13.9738 4.98335 14.2239 4.7333C14.4739 4.48325 14.813 4.34277 15.1667 4.34277H27.1667C27.5203 4.34277 27.8594 4.48325 28.1095 4.7333C28.3595 4.98335 28.5 5.32248 28.5 5.67611V19.0094Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<h3><?php esc_html_e( 'Support', 'colormag' ); ?></h3>
					<p><?php esc_html_e( 'We would be happy to guide you through any issues and queries you have regarding ColorMag!', 'colormag' ); ?></p>
					<a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>" target="_blank"><span><?php esc_html_e( 'Contact Support', 'colormag' ); ?></span></a>
				</div>
			</div>
			<h2><?php esc_html_e( 'Join Our Community', 'colormag' ); ?></h2>
			<div class="postbox cm-community">
				<div class="cm-image">
					<img src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/facebook.webp' ); ?>" alt="<?php esc_attr_e( 'facebook', 'colormag' ); ?>">
				</div>
				<div class="cm-content">
					<h3><?php esc_html_e( 'Facebook Community', 'colormag' ); ?></h3>
					<p><?php esc_html_e( 'Join our Facebook haven, where the latest news and updates eagerly await your arrival.', 'colormag' ); ?></p>
					<a href="<?php echo esc_url( 'https://www.facebook.com/themegrill' ); ?>" target="_blank"><span><?php esc_html_e( 'Join Group', 'colormag' ); ?></span></a>
				</div>
			</div>
			<div class="postbox cm-community">
				<div class="cm-image">
					<img src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/x.webp' ); ?>" alt="<?php esc_attr_e( 'x', 'colormag' ); ?>">
				</div>
				<div class="cm-content">
					<h3><?php esc_html_e( 'X Community', 'colormag' ); ?></h3>
					<p><?php esc_html_e( 'Join our Twitter haven, where the latest news and updates eagerly await your arrival.', 'colormag' ); ?></p>
					<a href="<?php echo esc_url( 'https://twitter.com/themegrill' ); ?>" target="_blank"><span><?php esc_html_e( 'Join Group', 'colormag' ); ?></span></a>
				</div>
			</div>
			<div class="postbox cm-community">
				<div class="cm-image">
					<img src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/youtube.webp' ); ?>" alt="<?php esc_attr_e( 'youtube', 'colormag' ); ?>">
				</div>
				<div class="cm-content">
					<h3><?php esc_html_e( 'Youtube Community', 'colormag' ); ?></h3>
					<p><?php esc_html_e( 'Join our YouTube haven, where the latest news and updates eagerly await your arrival.', 'colormag' ); ?></p>
					<a href="<?php echo esc_url( 'https://www.youtube.com/@ThemeGrillOfficial' ); ?>" target="_blank"><span><?php esc_html_e( 'Subscribe', 'colormag' ); ?></span></a>
				</div>
			</div>
		</div> <!--/.col-70-->
		<div class="col-30">
			<div class="postbox">
				<h3 class="hndle">
					<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
						<path
							d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
							stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
							stroke-linejoin="round"/>
					</svg>
					<span><?php esc_html_e( 'Leave us a Review', 'colormag' ); ?></span>
				</h3>
				<div class="inside">
					<div class="ratings">
								<span>
										<?php
										for ( $i = 0; $i < 5; $i++ ) {
											echo $star_icon;
										}
										?>
								</span>
						<span><?php esc_html_e( 'Based on 1430+ Reviews', 'colormag' ); ?></span>
					</div>
					<p>
						<?php
						printf(
						/* translators: %s: Theme Name. */
							esc_html__( 'Sharing your review is a valuable way to help us enhance your experience.', 'colormag' ),
							$theme->Name
						);
						?>
					</p>
					<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/colormag/reviews/?rate=5#new-post' ); ?>"
						target="_blank"><?php esc_html_e( 'Submit a Review', 'colormag' ); ?></a>
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
					<span><?php esc_html_e( 'Feature Request', 'colormag' ); ?></span>
				</h3>
				<div class="inside">
					<p>
						<?php
						printf(
						/* translators: %s: Theme Name. */
							esc_html__( 'Please take a moment to suggest any features that could enhance our product.', 'colormag' ),
						);
						?>
					</p>
					<a href="<?php echo esc_url( 'https://themegrill.com/contact/#tg-query' ); ?>"
						target="_blank"><?php esc_html_e( 'Request a Feature', 'colormag' ); ?></a>
				</div>
			</div>
			<div class="postbox cm-useful-plugins">
				<h3 class="hndle">
					<span><?php esc_html_e( 'Useful Plugins', 'colormag' ); ?></span>
				</h3>
				<?php
				$plugins = array(
					array(
						'name'        => __( 'Everest Forms', 'colormag' ),
						'file'        => 'everest-forms/everest-forms.php',
						'slug'        => 'everest-forms',
						'description' => __( 'Form Builder Plugin', 'colormag' ),
						'color'       => '#5317AA',
						'svg'         => '<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"-->
								 fill="none">
								<rect x="0.5" width="40" height="40" rx="3.63636" fill="#5317AA"/>
								<path d="M27.309 11.1045H22.9999L24.3223 13.3268H28.6186L27.309 11.1045Z"
									  fill="white"/>
								<path d="M30.0183 15.5527H25.7156L27.1025 17.7751H31.4085L30.0183 15.5527Z"
									  fill="white"/>
								<path
									d="M29.9506 26.6704H13.5493L20.4292 15.4136L23.2772 20.0002H20.4292L19.11 22.2225H27.2412L20.4292 11.2432L9.5885 28.8959H31.3408L29.9506 26.6704Z"
									fill="white"/>
							</svg>',
					),
					array(
						'name'        => __( 'BlockArt', 'colormag' ),
						'file'        => 'blockart-blocks/blockart.php',
						'slug'        => 'blockart',
						'description' => __( 'Page Builder Plugin', 'colormag' ),
						'color'       => '#2563EB',
						'svg'         => '<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"-->
								 fill="none">
								<rect x="0.5" width="40" height="40" rx="3.63636" fill="#2563EB"/>
								<path fill-rule="evenodd" clip-rule="evenodd"
									  d="M8.5 31.2027H32.5V8.5H8.5V31.2027ZM31.2027 29.9054H9.79728V9.7973H31.2027V29.9054ZM20.7109 11.7432L22.3204 17.1421L19.094 17.1563L20.7109 11.7432ZM18.0383 20.7249H23.3909L24.3433 25.5563L24.4319 27.3107H16.8496L16.9161 25.5351L18.0383 20.7249Z"
									  fill="white"/>
							</svg>',
					),
				);

				// Loop through the plugins
				foreach ( $plugins as $plugin ) {
					$plugin_file         = $plugin['file'];
					$plugin_slug         = $plugin['slug'];
					$is_plugin_installed = colormag_is_plugin_installed( $plugin_file );
					$is_plugin_activated = is_plugin_active( $plugin_file );
					?>
					<div class="inside">
						<div class="content-left">
							<?php echo $plugin['svg']; ?>
							<div class="content-info">
								<h4><?php echo esc_html( $plugin['name'] ); ?></h4>
								<p><?php echo esc_html( $plugin['description'] ); ?></p>
							</div>
						</div>
						<?php if ( $is_plugin_installed ) : ?>
							<?php if ( $is_plugin_activated ) : ?>
								<span><?php esc_html_e( 'Activated', 'colormag' ); ?></span>
							<?php else : ?>
								<span><a href="#" class="activate-plugin" data-plugin="<?php echo esc_attr( $plugin_file ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?> "><?php esc_html_e( 'Activate', 'colormag' ); ?></span></a>
							<?php endif; ?>
						<?php else : ?>
							<span><a href="#" class="install-plugin" data-plugin="<?php echo esc_attr( $plugin_file ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?> "><?php esc_html_e( 'Install', 'colormag' ); ?></span></a>
						<?php endif; ?>
					</div>
					<?php
				}
				?>
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
					<span><?php esc_html_e( 'ThemeGrill Community', 'colormag' ); ?></span>
				</h3>
				<div class="inside">
					<p>
						<?php
						printf(
						/* translators: %s: Theme Name. */
							esc_html__( 'Join our facebook group of ColorMag users for creating beautiful websites!', 'colormag' ),
						);
						?>
					</p>
					<a href="<?php echo esc_url( 'https://www.facebook.com/groups/themegrill' ); ?>"
						target="_blank"><?php esc_html_e( 'Join our Facebook Group', 'colormag' ); ?></a>
				</div>
			</div>
		</div><!--/.col-30-->
	</div>
</div>
