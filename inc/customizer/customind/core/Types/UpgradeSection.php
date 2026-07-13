<?php
	namespace Customind\Core\Types;

	defined( 'ABSPATH' ) || exit;

class UpgradeSection extends \WP_Customize_Section {

	public $section;
	public $url;
	public $description;
	public $label;
	public $points;
	public $type = 'customind-upgrade-section';

	public function __construct( $manager, $id, $args = array() ) {
			$args              = wp_parse_args(
				$args,
				[
					'type'        => 'customind-upgrade-section',
					'priority'    => 10,
					'capability'  => 'edit_theme_options',
					'url'         => '',
					'description' => '',
					'label'       => '',
					'points'      => [],
				]
			);
			$this->url         = $args['url'] ?? '';
			$this->description = $args['description'] ?? '';
			$this->label       = $args['label'] ?? '';
			$this->points      = $args['points'] ?? [];
			parent::__construct( $manager, $id, $args );
	}

	public function json() {
		$json                = parent::json();
		$json['url']         = isset( $this->url ) ? esc_url_raw( $this->url ) : '';
		$json['id']          = $this->id ?? '';
		$json['description'] = $this->description ?? '';
		$json['label']       = $this->label ?? '';
		$json['points']      = $this->points ?? [];
		return $json;
	}

	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}"
			class="customind-upgrade-accordion-section control-section-{{ data.type }} cannot-expand accordion-section"
		>
			<# if ( data.description ) { #>
				<p class="text-[#222] text-[13px] font-semibold italic my-0">{{ data.description }}</p>
			<# } #>
			<# if ( data.points && data.points.length > 0 ) { #>
				<ul class="mt-4 pl-0 list-none">
					<# _.each( data.points, function( point, index ) { #>
						<li class="flex items-center text-[#4E4E4E] mb-[14px] text-[13px]">
							<span class="text-[#fdb833] text-[15px] font-semibold mr-3">&#10003;</span>
							{{ point }}
						</li>
					<# } ) #>
				</ul>
			<# } #>
			<# if ( data.label && data.url ) { #>
				<a
					href="{{{ data.url }}}"
					target="_blank"
					class="inline-flex justify-center py-[12px] font-semibold text-[13px] rounded-sm mt-5 no-underline border border-solid border-[#fdb833] text-[#24292f] bg-[#fdb833] px-2 w-[93%] hover:text-[#24292f] hover:bg-[#ffc857] active:text-[#24292f] focus:text-[#24292f] focus:bg-[#fdb833] focus:shadow-none focus:outline-none focus:ring-0 focus:ring-[#fdb833] focus:ring-offset-0"
				>
					{{ data.label }}
				</a>
			<# } #>
		</li>
		<?php
	}
}
