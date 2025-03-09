<?php
/**
 * Section class.
 */

namespace Customind\Core\Types;

defined( 'ABSPATH' ) || exit;

class Section extends \WP_Customize_Section {

	/**
	 * Section.
	 *
	 * @var $section
	 */
	public $section;

	/**
	 * Section type.
	 *
	 * @var string $type;
	 */
	public $type = 'customind-section';

	/**
	 * Is builder section.
	 *
	 * @var boolean
	 */
	public $is_builder_section;

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$args = wp_parse_args(
			$args,
			[
				'type'       => 'customind-section',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			]
		);
		if ( isset( $args['is_builder_section'] ) ) {
			$this->is_builder_section = $args['is_builder_section'];
		}
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
				'panel',
				'type',
				'description_hidden',
				'section',
				'is_builder_section',
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
		global $customind;
		$section_i18n = $customind->get_section_i18n();

		if ( $this->panel ) {
			$json['customizeAction'] = sprintf(
				$section_i18n['customizing-action'],
				esc_html( $this->manager->get_panel( $this->panel )->title )
			);
		} else {
			$json['customizeAction'] = $section_i18n['customizing'];
		}

		return $json;
	}
}
