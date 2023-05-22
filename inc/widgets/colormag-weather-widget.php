<?php
/**
 * Weather Widget.
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
 * Weather Widget.
 *
 * Class colormag_weather_widget
 */
class colormag_weather_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_weather';
		$this->widget_description = esc_html__( 'Display weather.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Weather', 'colormag' );
		$this->settings           = array(
			'openweathermap_api' => array(
				'type'              => 'api_key',
				'default'           => '',
				'api_key'           => get_theme_mod( 'colormag_openweathermap_api_key' ),
				'label'             => esc_html__( 'Enter API Key here', 'colormag' ),
				'description'       => sprintf(
					/* Translators: %s Link to OpenWeatherMap API link */
					__( 'OpenWeatherMap requires <a href="%s" target="_blank">API Key</a> to work', 'colormag' ),
					esc_url( 'http://openweathermap.org/appid' )
				),
				'class'             => 'openweathermap-api',
				'customize_control' => 'colormag_openweathermap_api_key',
			),
			'title'              => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'city_id_link'       => array(
				'type'    => 'custom',
				'default' => '',
				'label'   => '<a href="' . esc_url( 'http://openweathermap.org/find' ) . '" target="_blank">' . esc_html__( 'Get City ID', 'colormag' ) . '</a>',
			),
			'city_id'            => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'OpenWeatherMap City ID:', 'colormag' ),
			),
			'unit'               => array(
				'type'    => 'radio',
				'default' => 'imperial',
				'label'   => '',
				'choices' => array(
					'imperial' => esc_html__( 'Fahrenheit', 'colormag' ),
					'metric'   => esc_html__( 'Celsius', 'colormag' ),
				),
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
	 * @return mixed
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {

		// Enqueue the required JS for this widget.
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() || ColorMag_Utils::colormag_elementor_active_page_check() ) {
			wp_enqueue_style( 'owfont' );
		}

		$title   = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$city_id = isset( $instance['city_id'] ) ? $instance['city_id'] : '';
		$unit    = isset( $instance['unit'] ) ? $instance['unit'] : 'imperial';

		if ( 'imperial' == $unit ) {
			$wind_unit        = esc_html__( 'mph', 'colormag' );
			$temp_unit_symbol = esc_html__( 'F', 'colormag' );
		} else {
			$wind_unit        = esc_html__( 'm/s', 'colormag' );
			$temp_unit_symbol = esc_html__( 'C', 'colormag' );
		}

		$gopenweathermap_api_key = get_theme_mod( 'colormag_openweathermap_api_key' );

		if ( ! $gopenweathermap_api_key ) :
			?>
			<div class="weather-api-error">
				<?php esc_html_e( 'OpenWeatherMap requires API Key to work.', 'colormag' ); ?>
				<a href="http://openweathermap.org/appid"><?php esc_html_e( 'Get API Key', 'colormag' ); ?></a>
			</div>
			<?php
			return false;
		endif;
		?>

		<?php if ( ! $city_id ) : ?>
			<div class="weather-api-error">
				<?php esc_html_e( 'OpenWeatherMap requires City ID to work.', 'colormag' ); ?>
				<a href="http://openweathermap.org/find"><?php esc_html_e( 'Get City ID', 'colormag' ); ?></a>
			</div>
			<?php
			return false;
		endif;
		?>

		<?php
		// Get the transient.
		$weather_transient_name = 'colormag_weather_' . $city_id . '_' . strtolower( $unit );

		if ( get_transient( $weather_transient_name ) ) {
			$weather_data = get_transient( $weather_transient_name );
		} else {
			$weather_data['today'] = array();

			// Today's weather data.
			$today_api_url      = 'http://api.openweathermap.org/data/2.5/weather?id=' . $city_id . '&units=' . $unit . '&APPID=' . $gopenweathermap_api_key;
			$today_api_response = wp_remote_get( $today_api_url );

			if ( is_wp_error( $today_api_response ) ) :
				echo $today_api_response->get_error_message(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

				return false;
			endif;

			$today_data            = json_decode( $today_api_response['body'] );
			$weather_data['today'] = $today_data;

			if ( $weather_data['today'] ) {
				set_transient( $weather_transient_name, $weather_data, apply_filters( 'colormag_weather_cache_time', 3 * HOUR_IN_SECONDS ) );
			}
		}

		$today_data = $weather_data['today'];

		// Checks for any error.
		if ( isset( $today_data->cod ) && '4' == substr( $today_data->cod, 0, 1 ) ) {
			echo $today_data->message; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			return false;
		}

		$today_temperature  = isset( $today_data->main->temp ) ? round( $today_data->main->temp ) : false;
		$today_humidity     = isset( $today_data->main->humidity ) ? $today_data->main->humidity : '';
		$today_wind_speed   = isset( $today_data->wind->speed ) ? $today_data->wind->speed : '';
		$today_weather_code = $today_data->weather[0]->id;

		// Get Today High and Low Temperature data.
		$today_high = isset( $today_data->main->temp_max ) ? round( $today_data->main->temp_max ) : false;
		$today_low  = isset( $today_data->main->temp_min ) ? round( $today_data->main->temp_min ) : false;

		$units_display_symbol = apply_filters( 'colormag_weather_widget_deg_symbol', '&deg;' );

		$style = '';
		if ( '' !== colormag_get_weather_color( $today_weather_code ) ) {
			$style = ' style=background-color:' . colormag_get_weather_color( $today_weather_code ) . '';
		}

		$this->widget_start( $args );
		?>

		<div class="weather-forecast"<?php echo esc_attr( $style ); ?>>
			<?php
			if ( ! empty( $title ) ) {
				echo '<header class="weather-forecast-header">' . esc_html( $title ) . '</header>';
			}
			?>

			<div class="weather-info">
				<div class="weather-location">
					<span class="weather-icon"><span class="owf owf-<?php echo esc_attr( $today_weather_code ); ?>"></span></span>
					<span class="weather-location-name"><?php echo esc_html( $today_data->name ); ?></span>
					<span class="weather-desc"><?php echo esc_html( $today_data->weather[0]->description ); ?></span>
				</div>

				<div class="weather-today">
					<span class="weather-current-temp"><?php echo esc_html( $today_temperature ); ?>
						<sup><?php echo esc_html( $units_display_symbol ); ?><?php echo esc_html( $temp_unit_symbol ); ?></sup></span>
					<div class="weather-temp">
						<span class="fa fa-thermometer-full"></span><?php echo absint( $today_high ); ?> -
						<?php echo absint( $today_low ); ?></div>
					<div class="weather_highlow">
						<span class="fa fa-tint"></span><?php echo esc_html( $today_humidity . '%' ); ?></div>
					<div class="weather_wind">
						<span class="owf owf-231"></span><?php echo esc_html( round( $today_wind_speed ) . $wind_unit ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
