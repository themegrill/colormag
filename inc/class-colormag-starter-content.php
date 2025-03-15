<?php


class ColorMag_Starter_Content {
	const HOME_SLUG       = 'home';
	const BLOG_SLUG       = 'blog';
	const ABOUT_SLUG      = 'about';
	const CONTACT         = 'contact';
	const PORTOFOLIO_SLUG = 'portofolio';
	const PROJECT_DETAILS = 'project-details';

	public function __construct() {
		add_filter( 'colormag_header_builder_options', array( $this, 'header_builder_options' ) );
		add_filter(
			'colormag_header_button_text',
			function () {
				return 'Subscribe';
			}
		);

		add_filter('body_class', function ($classes) {
			$classes[] = 'cm-started-content';
			return $classes;
		});
	}

	public function header_builder_options() {
		return array(
			'desktop' => array(
				'top'    => array(
					'left'   => array(),
					'center' => array(),
					'right'  => array(),
				),
				'main'   => array(
					'left'   => array(
						'logo',
					),
					'center' => array(),
					'right'  => array( 'socials', 'button' ),
				),
				'bottom' => array(
					'left'   => array(
						'primary-menu',
					),
					'center' => array(),
					'right'  => array('search'),
				),
			),
			'mobile'  => array(
				'top'    => array(
					'left'   => array(),
					'center' => array(),
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
					'right'  => array(),
				),
			),
			'offset'  => array(
				'mobile-menu',
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
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::HOME_SLUG . '}}',
			],
			'page_about'           => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::ABOUT_SLUG . '}}',
			],
			'page_portofolio'      => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::PORTOFOLIO_SLUG . '}}',
			],
			'page_project_details' => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::PROJECT_DETAILS . '}}',
			],
			'page_blog'            => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::BLOG_SLUG . '}}',
			],
			'page_contact'         => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::CONTACT . '}}',
			],
		];

		$footer_nav_items = [
			'home'         => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::HOME_SLUG . '}}',
			],
			'page_blog'    => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::BLOG_SLUG . '}}',
			],
			'page_about'   => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::ABOUT_SLUG . '}}',
			],
			'page_contact' => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . self::CONTACT . '}}',
			],
		];

		$content = [
			'nav_menus'   =>
				[
					'primary' => [
						'items' => $nav_items,
					],
					'footer'  => [
						'items' => $footer_nav_items,
					],
				],
			'options'     => [
				'page_on_front'  => '{{' . self::HOME_SLUG . '}}',
				'page_for_posts' => '{{' . self::BLOG_SLUG . '}}',
				'show_on_front'  => 'page',
				'blogname'       => 'ColorMag',
			],
			'theme_mods'  => require __DIR__ . '/compatibility/starter-content/theme-mods.php',
			'attachments' => array(
				'featured-image-logo' => array(
					'post_title'   => 'Featured Logo',
					'post_content' => 'Attachment Description',
					'post_excerpt' => 'Attachment Caption',
					'file'         => 'assets/img/starter-content/logo-agency.png',
				),
			),
			'posts'       => [
				self::HOME_SLUG       => require __DIR__ . '/compatibility/starter-content/home.php',
				self::ABOUT_SLUG      => require __DIR__ . '/compatibility/starter-content/about.php',
				self::CONTACT         => require __DIR__ . '/compatibility/starter-content/contact.php',
				self::PORTOFOLIO_SLUG => require __DIR__ . '/compatibility/starter-content/portofolio.php',
				self::PROJECT_DETAILS => require __DIR__ . '/compatibility/starter-content/project-details.php',
				self::BLOG_SLUG       => [
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
