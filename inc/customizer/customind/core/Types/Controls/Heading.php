<?php
/**
 * Heading class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Heading class.
 */
class Heading extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-heading';

	/**
	 * Always-visible info notice text shown below the heading label.
	 *
	 * @var string
	 */
	public $info_text;

	/**
	 * {@inheritDoc}
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		$this->info_text = $args['info_text'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			array( 'info_text' )
		);
	}
}
