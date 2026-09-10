<?php


class ColorMag_Starter_Content {
	const HOME_SLUG       = 'home';
	const BLOG_SLUG       = 'blog';
	const WORLD_SLUG      = 'world';
	const TECHNOLOGY_SLUG = 'technology';
	const SPORTS_SLUG     = 'sports';
	const POLITICS_SLUG   = 'politics';

	public function __construct() {
		add_filter( 'colormag_header_builder_default_options', array( $this, 'header_builder_options' ) );
		add_filter( 'colormag_footer_builder_default_options', array( $this, 'footer_builder_options' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'customizer_starter_css' ) );

		add_filter(
			'body_class',
			function ( $classes ) {
				$classes[] = 'cm-started-content';
				return $classes;
			}
		);

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_fresh_site_notice' ) );
		add_action( 'wp_ajax_colormag_dismiss_starter_content', array( $this, 'ajax_dismiss_starter_content' ) );
	}

	public function customizer_starter_css() {
		if ( is_front_page() && is_customize_preview() ) {
			wp_enqueue_style( 'colormag-starter-content', get_template_directory_uri() . '/assets/css/starter-content.css', array(), '' );
		}
	}

	public function header_builder_options( $options ) {

		if ( ! get_option( 'fresh_site' ) ||
			! is_customize_preview() ) {
			return $options;
		}

		return array(
			'desktop' => array(
				'top'    => array(
					'left'   => array( 'news-ticker' ),
					'center' => array(),
					'right'  => array( 'date', 'socials' ),
				),
				'main'   => array(
					'left'   => array(
						'logo',
					),
					'center' => array(),
					'right'  => array( 'secondary-menu', 'search' ),
				),
				'bottom' => array(
					'left'   => array( 'primary-menu' ),
					'center' => array(),
					'right'  => array( 'random' ),
				),
			),
			'mobile'  => array(
				'top'    => array(
					'left'   => array(),
					'center' => array( 'date' ),
					'right'  => array(),
				),
				'main'   => array(
					'left'   => array(),
					'center' => array(
						'logo',
					),
					'right'  => array(),
				),
				'bottom' => array(
					'left'   => array(
						'toggle-button',
					),
					'center' => array(),
					'right'  => array( 'random' ),
				),
			),
			'offset'  => array(
				'mobile-menu',
			),
		);
	}

	public function footer_builder_options( $options ) {
		if ( ! get_option( 'fresh_site' ) ||
			! is_customize_preview() ) {
			return $options;
		}

		return array(
			'desktop' => array(
				'top'    => array(
					'top-1' => array(),
					'top-2' => array(),
					'top-3' => array(),
					'top-4' => array(),
					'top-5' => array(),
				),
				'main'   => array(
					'main-1' => array(),
					'main-2' => array(),
					'main-3' => array(),
					'main-4' => array(),
					'main-5' => array(),
				),
				'bottom' => array(
					'bottom-1' => array( 'copyright' ),
					'bottom-2' => array( 'footer-menu' ),
					'bottom-3' => array(),
					'bottom-4' => array(),
					'bottom-5' => array(),
				),
			),
		);
	}

	/**
	 * Return starter content definition.
	 *
	 * Every item the primary menu links to (Home, World, Technology, Sports,
	 * Politics, Blog) is a real staged page — object_id/{{slug}} placeholders
	 * resolved by WordPress core, not a dead '#' link. Confirmed via GitHub
	 * issue #324: previously only Home was ever staged; World/Technology/
	 * Sports/Politics existed as unused files and every nav item but Home
	 * pointed nowhere.
	 *
	 * @return mixed|void
	 */
	public static function get() {

		$nav_items = array(
			self::HOME_SLUG       => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::HOME_SLUG . '}}',
			),
			self::WORLD_SLUG      => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::WORLD_SLUG . '}}',
			),
			self::POLITICS_SLUG   => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::POLITICS_SLUG . '}}',
			),
			self::SPORTS_SLUG     => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::SPORTS_SLUG . '}}',
			),
			self::TECHNOLOGY_SLUG => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::TECHNOLOGY_SLUG . '}}',
			),
			self::BLOG_SLUG       => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::BLOG_SLUG . '}}',
			),
		);

		$secondary_nav_items = [
			'privacy' => [
				'title' => 'Privacy',
				'url'   => '#',
			],
			'video'   => [
				'title' => 'Videos',
				'url'   => '#',
			],
			'starter' => [
				'title' => 'Start Demos',
				'url'   => '#',
			],
			'contact' => [
				'title' => 'Contact',
				'url'   => '#',
			],
		];

		$content = [
			'nav_menus'   =>
				[
					'primary'        => [
						'items' => $nav_items,
					],
					'menu-secondary' => [
						'items' => $secondary_nav_items,
					],
				],
			'options'     => [
				'page_on_front'  => '{{' . self::HOME_SLUG . '}}',
				'page_for_posts' => '{{' . self::BLOG_SLUG . '}}',
				'show_on_front'  => 'page',
			],
			'theme_mods'  => require __DIR__ . '/compatibility/starter-content/theme-mods.php',
			'attachments' => array(
				'cm-starter-logo' => array(
					'post_title'   => 'Logo',
					'post_content' => 'Attachment Description',
					'post_excerpt' => 'Attachment Caption',
					'file'         => 'assets/img/starter/cm-logo.png',
				),
			),
			'posts'       => [
				self::HOME_SLUG       => require __DIR__ . '/compatibility/starter-content/home.php',
				self::WORLD_SLUG      => require __DIR__ . '/compatibility/starter-content/world.php',
				self::TECHNOLOGY_SLUG => require __DIR__ . '/compatibility/starter-content/technology.php',
				self::SPORTS_SLUG     => require __DIR__ . '/compatibility/starter-content/sports.php',
				self::POLITICS_SLUG   => require __DIR__ . '/compatibility/starter-content/politics.php',
				self::BLOG_SLUG       => [
					'post_name'  => self::BLOG_SLUG,
					'post_type'  => 'page',
					'post_title' => _x( 'Blog', 'Theme starter content', 'colormag' ),
				],
			],
		];

		return apply_filters( 'colormag_starter_content', $content );
	}

	/**
	 * Enqueue the "fresh site" Customizer notice.
	 *
	 * Shown only on a fresh site (the same condition WordPress uses to
	 * import starter content). Lets the user keep the starter pages —
	 * already staged as a live Customizer preview by the time this notice
	 * appears — or start with a clean slate instead. See GitHub issue #324:
	 * this theme already stages starter content the moment a fresh site's
	 * Customizer loads, but never told the user that's what was happening.
	 *
	 * @return void
	 */
	public function enqueue_fresh_site_notice() {

		if ( ! get_option( 'fresh_site' ) ) {
			return;
		}

		wp_enqueue_script(
			'colormag-starter-content-notice',
			get_template_directory_uri() . '/inc/compatibility/starter-content/customize-notice.js',
			array( 'customize-controls', 'jquery' ),
			defined( 'COLORMAG_THEME_VERSION' ) ? COLORMAG_THEME_VERSION : false,
			true
		);

		wp_localize_script(
			'colormag-starter-content-notice',
			'colormagStarterContent',
			array(
				'title'   => __( 'Welcome to your new site!', 'colormag' ),
				'message' => __( 'We\'ve added starter pages to help you get going quickly. They\'re only published if you keep them.', 'colormag' ),
				'keep'    => __( 'Keep the starter pages', 'colormag' ),
				'clean'   => __( 'Start with a clean slate', 'colormag' ),
				'note'    => __( 'Don\'t worry — you can always change this later.', 'colormag' ),
				'nonce'   => wp_create_nonce( 'colormag-dismiss-starter-content' ),
			)
		);

		wp_add_inline_style( 'customize-controls', self::notice_css() );
	}

	/**
	 * AJAX handler: "Start with a clean slate".
	 *
	 * WordPress core's own starter-content importer only ever runs while
	 * the 'fresh_site' option is set — flipping it off here means the next
	 * Customizer load (customize-notice.js reloads immediately after this
	 * succeeds) never stages the starter pages again. Nothing staged so far
	 * was ever published, so there is nothing else to clean up — same
	 * mechanism Neve (Codeinwp/neve) uses for the same purpose.
	 *
	 * @return void
	 */
	public function ajax_dismiss_starter_content() {

		check_ajax_referer( 'colormag-dismiss-starter-content', 'nonce' );

		if ( ! current_user_can( 'customize' ) ) {
			wp_send_json_error();
		}

		update_option( 'fresh_site', '0' );

		wp_send_json_success();
	}

	/**
	 * Inline CSS for the Customizer notice card.
	 *
	 * @return string
	 */
	private static function notice_css() {

		return '.colormag-sc-notice{margin:12px;padding:16px;background:#fff;border:1px solid #dcdcde;border-left:4px solid #2271b1;border-radius:2px;}'
			. '.colormag-sc-notice h3{margin:0 0 6px;font-size:14px;line-height:1.4;}'
			. '.colormag-sc-notice p{margin:0 0 12px;color:#50575e;font-size:13px;line-height:1.5;}'
			. '.colormag-sc-notice .button{display:block;width:100%;text-align:center;margin:0 0 8px;}'
			. '.colormag-sc-notice .colormag-sc-note{margin:10px 0 0;font-size:12px;color:#787c82;text-align:center;}';
	}
}

return new ColorMag_Starter_Content();
