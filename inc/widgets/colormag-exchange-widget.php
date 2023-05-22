<?php
/**
 * Currency Exchange Widget,
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
 * Currency Exchange Widget,
 *
 * Class colormag_exchange_widget
 */
class colormag_exchange_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_exchange';
		$this->widget_description = esc_html__( 'Display Currency Exchange.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Currency Exchange', 'colormag' );
		$this->settings           = array(
			'exchangerate_api'    => array(
				'type'              => 'api_key',
				'default'           => '',
				'api_key'           => get_theme_mod( 'colormag_exchange_rate_api_key' ),
				'label'             => esc_html__( 'Enter API Key here', 'colormag' ),
				'description'       => sprintf(
				/* Translators: %s Link to Fixer API link */
					__( 'Exchange rate requires <a href="%s" target="_blank">API Key</a> to work', 'colormag' ),
					esc_url( 'https://fixer.io/' )
				),
				'class'             => 'exchangerate-api',
				'customize_control' => 'colormag_exchange_rate_api_key',
			),
			'title'               => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'base_currency'       => array(
				'type'    => 'select',
				'default' => 'usd',
				'label'   => esc_html__( 'Base Currency:', 'colormag' ),
				'choices' => colormag_get_available_currencies(),
			),
			'exchange_currencies' => array(
				'type'    => 'multiselect',
				'default' => array(),
				'label'   => esc_html__( 'Exchange Currencies:', 'colormag' ),
				'choices' => colormag_get_available_currencies(),
			),
			'column'              => array(
				'type'    => 'select',
				'default' => 1,
				'label'   => esc_html__( 'Column:', 'colormag' ),
				'choices' => array(
					'1' => esc_html__( '1', 'colormag' ),
					'2' => esc_html__( '2', 'colormag' ),
					'3' => esc_html__( '3', 'colormag' ),
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

		$title               = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$base_currency       = isset( $instance['base_currency'] ) ? $instance['base_currency'] : 'usd';
		$exchange_currencies = isset( $instance['exchange_currencies'] ) ? $instance['exchange_currencies'] : array();
		$column              = isset( $instance['column'] ) ? $instance['column'] : 1;

		$available_currencies = colormag_get_available_currencies();
		$exchangerate_api_key = get_theme_mod( 'colormag_exchange_rate_api_key' );

		// Get the transient.
		$exchange_transient_name = 'colormag_exchange_' . $base_currency . '_' . current_time( 'Y-m-d' );

		if ( get_transient( $exchange_transient_name ) ) {
			$currency_data = get_transient( $exchange_transient_name );
		} else {
			$api_url = add_query_arg( 'base', strtoupper( $base_currency ), 'http://data.fixer.io/api/latest?access_key=' . $exchangerate_api_key );

			if ( 0 < count( $exchange_currencies ) ) {
				$currency_to_fetch = strtoupper( implode( ',', $exchange_currencies ) );

				$api_url = add_query_arg( 'symbols', esc_html( $currency_to_fetch ), $api_url );
			}

			$json_response = wp_remote_get( $api_url );

			if ( is_wp_error( $json_response ) ) :
				echo $json_response->get_error_message(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

				return false;
			endif;

			$currency_data = json_decode( $json_response['body'] );

			if ( $currency_data ) {
				set_transient( $exchange_transient_name, $currency_data, apply_filters( 'colormag_exchange_cache_time', DAY_IN_SECONDS ) );
			}
		}

		$this->widget_start( $args );
		?>

		<?php
		if ( ! empty( $title ) ) {
			echo '<h3 class="cm-widget-title"><span>' . esc_html( $title ) . '</span></h3>';
		}
		?>

		<div class="exchange-currency exchange-column-<?php echo esc_attr( $column ); ?>">
			<div class="base-currency">
				<?php echo esc_html( $available_currencies[ strtolower( $base_currency ) ] ); ?>
			</div>

			<div class="currency-list">
				<?php
				if ( ! empty( $currency_data->rates ) ) {
					foreach ( $currency_data->rates as $country => $rate ) {
						?>
						<div class="currency-table">
							<div class="currency--country">
								<span class="currency--flag currency--flag-<?php echo esc_attr( strtolower( $country ) ); ?>"></span>
								<?php echo esc_html( $country ); ?>
							</div>
							<div class="currency--rate">
								<?php echo esc_html( $rate ); ?>
							</div>
						</div>
						<?php
					}
				} else {
					if ( current_user_can( 'edit_theme_options' ) ) {
						$query['autofocus[section]'] = 'colormag_exchange_rate_section';
						$section_link                = add_query_arg( $query, admin_url( 'customize.php' ) );

						if ( ! $exchangerate_api_key ) {
							printf(
							/* Translators: 1. Opening of exchange rate API customize section area, 2. Closing of exchange rate API customize section area */
								esc_html__( 'You have not added Fixer API Key. Add it from %1$shere%2$s.', 'colormag' ),
								'<a href="' . esc_url( $section_link ) . '">',
								'</a>'
							);
						} elseif ( $exchangerate_api_key && empty( $currency_data->rates ) ) {
							printf(
							/* Translators: 1. Fixer API key link opening tag, 2. Fixer API key link closing tag, 3. Opening of exchange rate API customize section area, 4. Closing of exchange rate API customize section area */
								esc_html__( 'Invalid Fixer API key. Get your API key from %1$shere%2$s and set it from %3$shere%4$s. ', 'colormag' ),
								'<a href="https://fixer.io/" target="_blank">',
								'</a>',
								'<a href="' . esc_url( $section_link ) . '">',
								'</a>'
							);
						}
					}
				}
				?>
			</div>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
