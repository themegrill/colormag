<?php

if ( ! is_child_theme() ) {
	$theme = wp_get_theme();
} else {
	$theme = wp_get_theme()->parent();
}

$link_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3 4C2.86739 4 2.74021 4.05268 2.64645 4.14645C2.55268 4.24022 2.5 4.3674 2.5 4.5V10C2.5 10.1326 2.55268 10.2598 2.64645 10.3536C2.74022 10.4473 2.86739 10.5 3 10.5H8.5C8.63261 10.5 8.75978 10.4473 8.85355 10.3536C8.94732 10.2598 9 10.1326 9 10V7C9 6.72386 9.22386 6.5 9.5 6.5C9.77614 6.5 10 6.72386 10 7V10C10 10.3978 9.84196 10.7794 9.56066 11.0607C9.27936 11.342 8.89783 11.5 8.5 11.5H3C2.60217 11.5 2.22064 11.342 1.93934 11.0607C1.65804 10.7794 1.5 10.3978 1.5 10V4.5C1.5 4.10218 1.65804 3.72065 1.93934 3.43934C2.22064 3.15804 2.60218 3 3 3H6C6.27614 3 6.5 3.22386 6.5 3.5C6.5 3.77615 6.27614 4 6 4H3Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 2C7.5 1.72386 7.72386 1.5 8 1.5H11C11.2761 1.5 11.5 1.72386 11.5 2V5C11.5 5.27615 11.2761 5.5 11 5.5C10.7239 5.5 10.5 5.27615 10.5 5V2.5H8C7.72386 2.5 7.5 2.27615 7.5 2Z" fill="#7A7A7A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3536 1.64645C11.5489 1.84171 11.5489 2.15829 11.3536 2.35355L5.8536 7.85355C5.65834 8.04882 5.34175 8.04882 5.14649 7.85355C4.95123 7.65829 4.95123 7.34171 5.14649 7.14645L10.6465 1.64645C10.8418 1.45118 11.1583 1.45118 11.3536 1.64645Z" fill="#7A7A7A"/>
					</svg>';

$star_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
  						<path d="M4.62151 3.66996L1.43151 4.13246L1.37501 4.14396C1.28947 4.16667 1.2115 4.21167 1.14905 4.27436C1.0866 4.33706 1.04191 4.41521 1.01954 4.50082C0.997165 4.58644 0.997919 4.67647 1.02172 4.7617C1.04552 4.84693 1.09151 4.92432 1.155 4.98596L3.46601 7.23546L2.92101 10.413L2.91451 10.468C2.90927 10.5564 2.92764 10.6447 2.96773 10.7237C3.00782 10.8027 3.0682 10.8697 3.14267 10.9177C3.21715 10.9657 3.30305 10.9931 3.39158 10.997C3.48011 11.0009 3.56809 10.9812 3.64651 10.94L6.49951 9.43996L9.346 10.94L9.396 10.963C9.47854 10.9955 9.56823 11.0054 9.65588 10.9918C9.74354 10.9782 9.826 10.9416 9.8948 10.8856C9.96361 10.8296 10.0163 10.7563 10.0474 10.6733C10.0786 10.5902 10.087 10.5004 10.072 10.413L9.5265 7.23546L11.8385 4.98546L11.8775 4.94296C11.9332 4.87435 11.9697 4.79219 11.9834 4.70486C11.997 4.61753 11.9872 4.52815 11.955 4.44583C11.9229 4.3635 11.8695 4.29118 11.8002 4.23622C11.731 4.18126 11.6485 4.14563 11.561 4.13296L8.37101 3.66996L6.94501 0.779961C6.90374 0.696229 6.83986 0.625719 6.7606 0.576414C6.68134 0.527108 6.58985 0.500977 6.49651 0.500977C6.40316 0.500977 6.31167 0.527108 6.23241 0.576414C6.15315 0.625719 6.08927 0.696229 6.04801 0.779961L4.62151 3.66996Z" fill="#222222"/>
						</svg>';

$allowed_html = array(
	'svg'  => array(
		'width'   => array(),
		'height'  => array(),
		'viewBox' => array(),
		'fill'    => array(),
		'xmlns'   => array(),
	),
	'path' => array(
		'fill-rule' => array(),
		'clip-rule' => array(),
		'd'         => array(),
		'fill'      => array(),
	),
);

$admin_url = admin_url();

function create_button_html() {
	$colormag_btn_texts = __( 'Create a new page', 'colormag' );

	$admin_url = admin_url();

	$html = '<a class="btn-create-new-page" href="' . $admin_url . 'post-new.php?post_type=page" aria-label="' . esc_attr( $colormag_btn_texts ) . '">' . esc_html( $colormag_btn_texts ) . '</a>';

	return $html;
}

function import_button_html() {
	// Check if TDI is installed but not activated or not installed at all or installed and activated.
	if ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
		$colormag_btn_texts = __( 'Activate ThemeGrill Demo Importer Plugin', 'colormag' );
	} elseif ( ! file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
		$colormag_btn_texts = __( 'Install ThemeGrill Demo Importer Plugin', 'colormag' );
	} else {
		$colormag_btn_texts = __( 'View Starter Templates', 'colormag' );
	}

	$html = '<a class="btn-get-started" href="#" data-name="' . esc_attr( 'themegrill-demo-importer' ) . '" data-slug="' . esc_attr( 'themegrill-demo-importer' ) . '" aria-label="' . esc_attr( $colormag_btn_texts ) . '">' . esc_html( $colormag_btn_texts ) . '</a>';

	return $html;
}

?>
	<div class="cm-container">
		<div class="postbox-container" style="float: none;">
			<div class="col-70">
				<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
				<div class="postbox postbox-title">
					<div class="dashboard-title">
						<h1 class="hndle"><?php esc_html_e( 'Welcome to ColorMag', 'colormag' ); ?></h1>
						<span><?php esc_html_e( 'Free', 'colormag' ); ?></span>
					</div>
					<div class="inside" style="padding: 0;margin: 0;">
						<p><?php esc_html_e( 'Experience a seamless magazine-themed website building experience with ColorMag! Explore all the settings and features right here and get started with your first page.', 'colormag' ); ?></p>
						<?php echo create_button_html(); ?>
					</div>
				</div>
				<div class="postbox cm-quick-settings">
					<div class="cm-quick-settings-title">
						<h2><?php esc_html_e( 'Quick Settings', 'colormag' ); ?></h2>
						<a href="<?php echo esc_url( ' ' . $admin_url . 'customize.php?' ); ?>" target="_blank"><?php esc_html_e( 'Go to Customizer', 'colormag' ); ?></a>
					</div>
					<div class="cm-quick-settings-content" style="padding: 0;margin: 0;">
						<?php
						// Array of settings items
						$settings_items = array(
							array(
								'title' => esc_html__( 'Site Identity', 'colormag' ),
								'type'  => 'section',
								'id'    => 'title_tagline',
							),
							array(
								'title' => esc_html__( 'Header Options', 'colormag' ),
								'type'  => 'panel',
								'id'    => 'colormag_header_panel',
							),
							array(
								'title' => esc_html__( 'Footer Options', 'colormag' ),
								'type'  => 'panel',
								'id'    => 'colormag_footer_panel',
							),
							array(
								'title' => esc_html__( 'Global Colors', 'colormag' ),
								'type'  => 'section',
								'id'    => 'colormag_global_colors_section',
							),
							array(
								'title' => esc_html__( 'Sidebar Options', 'colormag' ),
								'type'  => 'section',
								'id'    => 'colormag_global_sidebar_section',
							),
							array(
								'title' => esc_html__( 'Blog', 'colormag' ),
								'type'  => 'section',
								'id'    => 'colormag_blog_section',
							),
						);

						// Loop through the settings items
						foreach ( $settings_items as $item ) {
							?>
							<div class="cm-quick-settings-item">
								<h4><?php echo esc_html( $item['title'] ); ?></h4>
								<a href="
								<?php
								if ( isset( $item['type'] ) ) {
									echo esc_url( admin_url( 'customize.php?autofocus[' . $item['type'] . ']=' . $item['id'] ) );
								}
								?>
								" target="_blank">
									<?php echo wp_kses( $link_icon, $allowed_html ) . esc_html__( 'Customize', 'colormag' ); ?>
								</a>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="postbox cm-premium-features">
					<div class="cm-premium-features-title">
						<h2><?php esc_html_e( 'Premium Features', 'colormag' ); ?></h2>
						<a href="<?php echo esc_url( 'https://themegrill.com/pricing/?utm_medium=premiumm-features&utm_source=colormag-theme&utm_campaign=premiumm-features&utm_content=upgrade-now' ); ?>" target="_blank">
						<?php esc_html_e( 'Upgrade Now', 'colormag' ); ?></a>
					</div>
					<div class="cm-premium-features-content" style="padding: 0;margin: 0;">
						<?php
						// Array of premium features items
						$premium_features_items = array(
							array(
								'title' => esc_html__( 'Top Bar', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/customize-top-bar/',
							),
							array(
								'title' => esc_html__( 'Main Header', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/manage-main-header-layout-and-styles/',
							),
							array(
								'title' => esc_html__( 'Primary Menu', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/customize-the-primary-menu-of-the-site/',
							),
							array(
								'title' => esc_html__( 'Blog', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/manage-blog-page-layout/',
							),
							array(
								'title' => esc_html__( 'Meta', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/customize-the-post-meta/',
							),
							array(
								'title' => esc_html__( 'Footer Column', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/customize-footer-column/',
							),
							array(
								'title' => esc_html__( 'Footer Bar', 'colormag' ),
								'link'  => 'https://docs.themegrill.com/colormag/docs/customize-footer-bar-layout-styles/',
							),
							// Add more items as needed
						);

						// Loop through the premium features items
						foreach ( $premium_features_items as $item ) {
							?>
							<div class="cm-premium-features-item">
								<div class="item-content-left">
									<h4><?php echo esc_html( $item['title'] ); ?></h4>
									<a href="
									<?php
									if ( isset( $item['link'] ) ) {
										echo esc_url( $item['link'] );
									}
									?>
									" target="_blank">
										<?php
										echo wp_kses( $link_icon, $allowed_html ) . esc_html__( 'Documentation', 'colormag' );
										?>
									</a>
								</div>
								<div class="item-content-right">
									<img class="cm-icon" src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/cm-premium.png' ); ?>" alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div> <!--/.col-70-->
			<div class="col-30">
				<div class="postbox">
					<h3 class="hndle">
						<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="download">
								<path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M10.5 2.5C10.9602 2.5 11.3333 2.8731 11.3333 3.33333V11.3215L14.0774 8.57741C14.4028 8.25197 14.9305 8.25197 15.2559 8.57741C15.5814 8.90285 15.5814 9.43049 15.2559 9.75592L11.0893 13.9226C10.7638 14.248 10.2362 14.248 9.91074 13.9226L5.74408 9.75592C5.41864 9.43049 5.41864 8.90285 5.74408 8.57741C6.06951 8.25197 6.59715 8.25197 6.92259 8.57741L9.66667 11.3215V3.33333C9.66667 2.8731 10.0398 2.5 10.5 2.5ZM3.83333 13.3333C4.29357 13.3333 4.66667 13.7064 4.66667 14.1667V15.8333C4.66667 16.0543 4.75446 16.2663 4.91074 16.4226C5.06702 16.5789 5.27899 16.6667 5.5 16.6667H15.5C15.721 16.6667 15.933 16.5789 16.0893 16.4226C16.2455 16.2663 16.3333 16.0543 16.3333 15.8333V14.1667C16.3333 13.7064 16.7064 13.3333 17.1667 13.3333C17.6269 13.3333 18 13.7064 18 14.1667V15.8333C18 16.4964 17.7366 17.1323 17.2678 17.6011C16.7989 18.0699 16.163 18.3333 15.5 18.3333H5.5C4.83696 18.3333 4.20107 18.0699 3.73223 17.6011C3.26339 17.1323 3 16.4964 3 15.8333V14.1667C3 13.7064 3.3731 13.3333 3.83333 13.3333Z" fill="#2563EB"/>
							</g>
						</svg>
						<span><?php esc_html_e( 'Starter Templates', 'colormag' ); ?></span>
					</h3>
					<div class="inside">
						<div class="cm-starter-templates">
							<img src="<?php echo esc_url( COLORMAG_PARENT_URL . '/inc/admin/images/cm-starter-templates.png' ); ?>" alt="<?php esc_attr_e( 'ColorMag', 'colormag' ); ?>">
						</div>
						<p><?php echo esc_html__( 'Explore diverse demos from ColorMag theme to get your site running in no time. Simply choose the demo that fits your requirements, import it, and give it some of your personal touch! ', 'colormag' ); ?></p>
						<?php echo import_button_html(); ?>
					</div>
				</div>
				<div class="postbox">
					<h3 class="hndle">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
							<path
								d="M12.584 1.66602H5.50065C5.05862 1.66602 4.6347 1.84161 4.32214 2.15417C4.00958 2.46673 3.83398 2.89065 3.83398 3.33268V16.666C3.83398 17.108 4.00958 17.532 4.32214 17.8445C4.6347 18.1571 5.05862 18.3327 5.50065 18.3327H15.5006C15.9427 18.3327 16.3666 18.1571 16.6792 17.8445C16.9917 17.532 17.1673 17.108 17.1673 16.666V6.24935L12.584 1.66602Z"
								stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M12.166 1.66602V6.66602H17.166" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M13.8327 10.833H7.16602" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M13.8327 14.166H7.16602" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M8.83268 7.5H7.16602" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<span><?php esc_html_e( 'Documentation', 'colormag' ); ?></span>
					</h3>
					<div class="inside">
						<p>
							<?php
							echo esc_html__( 'Stuck due to an issue? Our detailed documentation will surely clear up any confusions you have!', 'colormag' );
							?>
						</p>
						<a href="<?php echo esc_url( 'https://docs.themegrill.com/colormag/' ); ?>"
							target="_blank"><?php esc_html_e( 'Documentation', 'colormag' ); ?></a>
					</div>
				</div>
				<div class="postbox">
					<h3 class="hndle">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
							fill="none">
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
										echo $star_icon;
										echo $star_icon;
										echo $star_icon;
										echo $star_icon;
										echo $star_icon;
										?>
								</span>
							<span><?php esc_html_e( 'Based on 1430+ Reviews', 'colormag' ); ?></span>
						</div>
						<p>
							<?php

							printf(
							/* translators: %s: Theme Name. */
								esc_html__( 'What do you think of our theme? Was it a good experience and did it match your expectations? Let us know so we can improve!', 'colormag' ),
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
							echo esc_html__( 'Please take a moment to suggest any features that could enhance our product.', 'colormag' );
							?>
						</p>
						<a href="<?php echo esc_url( 'https://themegrill.com/contact/#tg-query' ); ?>"
							target="_blank"><?php esc_html_e( 'Request a Feature', 'colormag' ); ?></a>
					</div>
				</div>
				<div class="postbox">
					<h3 class="hndle">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
							fill="none">
							<path
								d="M3 11.6667H5.5C5.94203 11.6667 6.36595 11.8423 6.67851 12.1548C6.99107 12.4674 7.16667 12.8913 7.16667 13.3333V15.8333C7.16667 16.2754 6.99107 16.6993 6.67851 17.0118C6.36595 17.3244 5.94203 17.5 5.5 17.5H4.66667C4.22464 17.5 3.80072 17.3244 3.48816 17.0118C3.17559 16.6993 3 16.2754 3 15.8333V10C3 8.01088 3.79018 6.10322 5.1967 4.6967C6.60322 3.29018 8.51088 2.5 10.5 2.5C12.4891 2.5 14.3968 3.29018 15.8033 4.6967C17.2098 6.10322 18 8.01088 18 10V15.8333C18 16.2754 17.8244 16.6993 17.5118 17.0118C17.1993 17.3244 16.7754 17.5 16.3333 17.5H15.5C15.058 17.5 14.634 17.3244 14.3215 17.0118C14.0089 16.6993 13.8333 16.2754 13.8333 15.8333V13.3333C13.8333 12.8913 14.0089 12.4674 14.3215 12.1548C14.634 11.8423 15.058 11.6667 15.5 11.6667H18"
								stroke="#2563EB" stroke-width="1.66667" stroke-linecap="round"
								stroke-linejoin="round"/>
						</svg>
						<span><?php esc_html_e( 'Support', 'colormag' ); ?></span>
					</h3>
					<div class="inside">
						<p>
							<?php
							echo esc_html__( 'Get in touch with our support team. You can always submit a support ticket for help.', 'colormag' );
							?>
						</p>
						<a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>"
							target="_blank"><?php esc_html_e( 'Create a Ticket', 'colormag' ); ?></a>
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
					// Add more plugins as needed
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
									<?php esc_html_e( 'Activated', 'colormag' ); ?>
								<?php else : ?>
									<span><a href="#" class="activate-plugin" data-plugin="<?php echo esc_attr( $plugin_file ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?> "><?php esc_html_e( 'Activate', 'colormag' ); ?></a></span>
								<?php endif; ?>
							<?php else : ?>
								<span><a href="#" class="install-plugin" data-plugin="<?php echo esc_attr( $plugin_file ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?> "><?php esc_html_e( 'Install', 'colormag' ); ?></a></span>
							<?php endif; ?>
					</div>
						<?php
					}
					?>
				</div>
				<div class="postbox">
					<h3 class="hndle">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
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
							echo esc_html__( 'Join our Facebook group filled with ThemeGrill themes users, including ColorMag users to discuss anything about the theme!', 'colormag' );
							?>
						</p>
						<a href="<?php echo esc_url( 'https://www.facebook.com/groups/themegrill' ); ?>" target="_blank"><?php esc_html_e( 'Join our Facebook Group', 'colormag' ); ?></a>
					</div>
				</div>
			</div><!--/.col-30-->
		</div><!--/.postbox-container-->
	</div><!--/.cm-container-->
<?php
