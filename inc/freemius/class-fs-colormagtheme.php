<?php
/**
 *  Integrate Freemius SDK for license management.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

class FS_ThemeGrill {

	/**
	 * Instance.
	 *
	 * @var Freemius
	 */
	private static $fs;

	/**
	 * Self instance.
	 *
	 * @return Freemius
	 */
	public static function freemius() {

		return self::$fs;
	}

	/**
	 * Constructor.
	 *
	 * FS_ThemeGrill constructor.
	 */
	private function __construct() {

	}

	/**
	 * Init freemius.
	 *
	 * @param string $id The id of the product.
	 * @param string $slug The slug of the product.
	 * @param string $public_key The public key of the product.
	 * @param string $name The product name.
	 *
	 * @return \Freemius
	 * @throws \Freemius_Exception Thrown when an API call returns an exception.
	 */
	public static function init($id, $slug, $public_key, $name = '')
	{
		if (!isset(self::$fs)) {

			// Include Freemius SDK.
			require_once get_template_directory() . '/freemius/start.php';

			self::$fs = fs_dynamic_init(
				array(
					'id' => $id,
					'slug' => $slug,
					'premium_slug' => "{$slug}-pro",
					'type' => 'theme',
					'public_key' => $public_key,
					'is_premium' => true,
					'is_premium_only' => true,
					'premium_suffix' => 'Pro',
					'has_premium_version' => true,
					'has_addons' => false,
					'has_paid_plans' => true,
					'menu' => array(
						'slug' => 'themegrill_submenu',
						'support' => false,
						'parent' => array(
							'slug' => 'options-general.php',
						),
					),
				)
			);

			// Signal that SDK was initiated.
			do_action("{$slug}_fs_loaded");

			require_once dirname(__FILE__) . '/freemius-migration.php';

			if (empty($name)) {
				$name = ucwords(str_replace('-', ' ', $slug));
			}

			new FS_ThemeGrill_License_Menu($name, $slug);

			new FS_ThemeGrill_License_Migration (

				self::$fs,
				"api_manager_theme_{$slug}",
				$slug
			);
		}

		return self::$fs;
	}
}
