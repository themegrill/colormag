<?php
/**
 * Panel class.
 */

namespace Customind\Core\Types;

defined( 'ABSPATH' ) || exit;

/**
 * Panel class.
 */
class Panel extends \WP_Customize_Panel {

	/**
	 * Panel.
	 *
	 * @var $panel.
	 */
	public $panel;

	/**
	 * Panel type.
	 *
	 * @var string
	 */
	public $type = 'customind-panel';

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$args = wp_parse_args(
			$args,
			[
				'type'       => 'customind-panel',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			]
		);
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array
	 */
	public function json() {
		$json                   = wp_array_slice_assoc(
			(array) $this,
			array(
				'id',
				'description',
				'priority',
				'type',
				'panel',
			)
		);
		$json['title']          = html_entity_decode(
			$this->title,
			ENT_QUOTES,
			get_bloginfo( 'charset' )
		);
		$json['content']        = $this->get_content();
		$json['active']         = $this->active();
		$json['instanceNumber'] = $this->instance_number;

		return $json;
	}
}
