<?php
/**
 * Upsell Section class.
 */

namespace Customind\Core\Types;

defined( 'ABSPATH' ) || exit;

class UpsellSection extends \WP_Customize_Section {

	/**
	 * Section.
	 *
	 * @var $section
	 */
	public $section;

	/**
	 * Link.
	 *
	 * @var $section
	 */
	public $url;

	/**
	 * Section type.
	 *
	 * @var string $type;
	 */
	public $type = 'customind-upsell-section';

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$args      = wp_parse_args(
			$args,
			[
				'type'       => 'customind-upsell-section',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			]
		);
		$this->url = isset( $args['url'] ) ? $args['url'] : '';
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array
	 */
	public function json() {
		$json        = parent::json();
		$json['url'] = esc_url( $this->url );
		$json['id']  = $this->id;
		return $json;
	}

	/**
	 * An Underscore (JS) template for rendering this section.
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}"
			class="customind-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section"
		>
			<h3 class="accordion-section-title"><a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a></h3>
		</li>
		<?php
	}
}
