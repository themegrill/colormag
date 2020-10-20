<?php
/**
 * Extend customize panel to include nested panels.
 *
 * Class ColorMag_WP_Customize_Panel
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Extend customize panel to include nested panels.
 *
 * Class ColorMag_WP_Customize_Panel
 */
class ColorMag_WP_Customize_Panel extends WP_Customize_Panel {

	/**
	 * Panel
	 *
	 * @var string
	 */
	public $panel;

	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'colormag_panel';

	/**
	 * Get section parameters for JS.
	 *
	 * @return array Exported parameters.
	 */
	public function json() {

		$array                   = wp_array_slice_assoc(
			(array) $this,
			array(
				'id',
				'description',
				'priority',
				'type',
				'panel',
			)
		);
		$array['title']          = html_entity_decode(
			$this->title,
			ENT_QUOTES,
			get_bloginfo( 'charset' )
		);
		$array['content']        = $this->get_content();
		$array['active']         = $this->active();
		$array['instanceNumber'] = $this->instance_number;

		return $array;

	}

}
