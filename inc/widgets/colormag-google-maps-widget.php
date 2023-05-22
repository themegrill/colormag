<?php
/**
 * Google Maps widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Google Maps widget.
 *
 * Class colormag_google_maps_widget
 */
class colormag_google_maps_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_google_maps widget_colormag_google_maps';
		$this->widget_description = esc_html__( 'Display the Google Maps for your site.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Google Maps', 'colormag' );
		$this->settings           = array(
			'googlemaps_api' => array(
				'type'              => 'api_key',
				'default'           => '',
				'api_key'           => get_theme_mod( 'colormag_googlemap_api_key' ),
				'label'             => esc_html__( 'Enter API Key here', 'colormag' ),
				'description'       => sprintf(
					/* Translators: %s Link to Google Maps API link */
					__( 'GoogleMap requires <a href="%s" target="_blank">API Key</a> to work', 'colormag' ),
					esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
				),
				'class'             => 'googlemaps-api',
				'customize_control' => 'colormag_googlemap_api_key',
			),
			'title'          => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'           => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'longitude'      => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Longitude:', 'colormag' ),
			),
			'latitude'       => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Latitude:', 'colormag' ),
			),
			'height'         => array(
				'type'    => 'number',
				'default' => 350,
				'label'   => esc_html__( 'Google Maps height in px:', 'colormag' ),
			),
			'zoom_size'      => array(
				'type'    => 'number',
				'default' => 15,
				'label'   => esc_html__( 'Google Maps Zoom Size:', 'colormag' ),
			),
		);

		parent::__construct();

	}

	/**
	 * Output widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {

		$title     = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text      = isset( $instance['text'] ) ? $instance['text'] : '';
		$longitude = isset( $instance['longitude'] ) ? $instance['longitude'] : '';
		$latitude  = isset( $instance['latitude'] ) ? $instance['latitude'] : '';
		$height    = isset( $instance['height'] ) ? $instance['height'] : 350;
		$zoom_size = isset( $instance['zoom_size'] ) ? $instance['zoom_size'] : 15;

		/**
		 * Localize the Google Maps Longitude and Latitude if both of them is present
		 */
		if ( ! empty( $longitude ) && ! empty( $latitude ) ) {
			wp_localize_script(
				'colormag-custom',
				'colormag_google_maps_widget_settings',
				array(
					'longitude' => esc_attr( $longitude ),
					'latitude'  => esc_attr( $latitude ),
					'height'    => absint( $height ),
					'zoom_size' => absint( $zoom_size ),
				)
			);
		}

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: Google Maps Description' . $this->id, $text );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text = icl_t( 'ColorMag Pro', 'TG: Google Maps Description' . $this->id, $text );
		}

		$this->widget_start( $args );
		?>

		<?php
		// Displays the widget title.
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		// Display the description.
		$this->widget_description( $text );
		?>

		<?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
			<?php
			$googlemap_api_key = get_theme_mod( 'colormag_googlemap_api_key' );

			if ( empty( $googlemap_api_key ) ) {
				?>
				<div class="google-maps-api-error">
					<?php esc_html_e( 'GoogleMaps requires API Key to work.', 'colormag' ); ?>
					<a href="<?php echo esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ); ?>" target="_blank"><?php esc_html_e( 'Get API Key', 'colormag' ); ?></a>
				</div>
			<?php } ?>

			<?php if ( empty( $longitude ) || empty( $latitude ) ) { ?>
				<div class="google-maps-lon-lat-error">
					<?php esc_html_e( 'You need to add longitude and latitude value to display the Google Maps. You can set it up via the widget setting.', 'colormag' ); ?>
				</div>
			<?php } ?>
		<?php } ?>

		<div class="GoogleMaps-wrapper">
			<div id="GoogleMaps"></div>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
