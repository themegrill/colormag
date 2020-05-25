<?php
/**
 * Extend default customizer section to include upsell section.
 *
 * @package colormag
 *
 * @see     WP_Customize_Section
 * @access  public
 */

if ( class_exists( 'WP_Customize_Section' ) ) {

	/**
	 * Class ColorMag_Customize_Upsell_Section
	 */
	class ColorMag_Customize_Upsell_Section extends WP_Customize_Section {

		/**
		 * Type of this section.
		 *
		 * @var string
		 */
		public $type = 'colormag_customize_upsell_section';

		/**
		 * URL for this section.
		 *
		 * @var string
		 */
		public $url = '';

		/**
		 * ID for this section.
		 *
		 * @var string
		 */
		public $id = '';

		/**
		 * Gather the parameters passed to client JavaScript via JSON.
		 *
		 * @return array The array to be exported to the client as JSON.
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
			<li id="accordion-section-{{ data.id }}" class="colormag-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
				<h3 class="accordion-section-title"><a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a></h3>
			</li>
			<?php
		}

	}

}
