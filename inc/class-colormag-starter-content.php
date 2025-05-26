<?php


class ColorMag_Starter_Content {
	const HOME_SLUG = 'home';
	const BLOG_SLUG = 'blog';

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
	 * @return mixed|void
	 */
	public static function get() {

		$nav_items = [
			'home'                 => [
				'title' => 'Home',
				'url'   => '#',
			],
			'page_politics'        => [
				'title' => 'Politics',
				'url'   => '#',
			],
			'page_sports'          => [
				'title' => 'Sports',
				'url'   => '#',
			],
			'page_project_details' => [
				'title' => 'Technology',
				'url'   => '#',
			],
			'page_blog'            => [
				'title' => 'Blog',
				'url'   => '#',
			],
			'page_worlds'          => [
				'title' => 'World',
				'url'   => '#',
			],
		];

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
				'blogname'       => '',
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
				self::HOME_SLUG => require __DIR__ . '/compatibility/starter-content/home.php',
				self::BLOG_SLUG => [
					'post_name'  => self::BLOG_SLUG,
					'post_type'  => 'page',
					'post_title' => _x( 'Blog', 'Theme starter content', 'colormag' ),
				],
			],
		];

		return apply_filters( 'colormag_starter_content', $content );
	}
}

return new ColorMag_Starter_Content();
