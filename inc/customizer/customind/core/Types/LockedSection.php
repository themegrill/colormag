<?php
/**
 * Locked (Pro) Section class.
 */

namespace Customind\Core\Types;

defined( 'ABSPATH' ) || exit;

class LockedSection extends \WP_Customize_Section {

	/**
	 * Section.
	 *
	 * @var $section
	 */
	public $section;

	/**
	 * Link to the upgrade page.
	 *
	 * @var $url
	 */
	public $url;

	/**
	 * Badge text.
	 *
	 * @var $badge
	 */
	public $badge;

	/**
	 * Section type.
	 *
	 * @var string $type;
	 */
	public $type = 'customind-locked-section';

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$args        = wp_parse_args(
			$args,
			[
				'type'       => 'customind-locked-section',
				'priority'   => 10,
				'capability' => 'edit_theme_options',
				'url'        => '',
				'badge'      => 'PRO',
			]
		);
		$this->url   = $args['url'];
		$this->badge = $args['badge'];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array
	 */
	public function json() {
		$json          = parent::json();
		$json['url']   = esc_url_raw( $this->url );
		$json['id']    = $this->id;
		$json['badge'] = $this->badge;
		return $json;
	}

	/**
	 * An Underscore (JS) template for rendering this section.
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}"
			class="customind-locked-accordion-section control-section-{{ data.type }} cannot-expand accordion-section"
		>
			<h3 class="accordion-section-title customind-locked-section-title">
				{{ data.title }}
				<span class="customind-locked-badge">{{ data.badge }}</span>
			</h3>
		</li>
		<?php
	}
}
