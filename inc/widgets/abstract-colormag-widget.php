<?php
/**
 * Abstract widget class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag Widget.
 *
 * Class ColorMag_Widet
 *
 * @extends  WP_Widget
 */
abstract class ColorMag_Widget extends WP_Widget {

	/**
	 * CSS class.
	 *
	 * @var string
	 */
	public $widget_cssclass;

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description;

	/**
	 * Widget ID.
	 *
	 * @var string
	 */
	public $widget_id;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name;

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * Widget Control Options.
	 *
	 * @var array
	 */
	public $control_options = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		$widget_options = array(
			'classname'                   => $this->widget_cssclass,
			'description'                 => $this->widget_description,
			'customize_selective_refresh' => true,
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_options, $this->control_options );

	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @param array $new_instance New instance.
	 * @param array $old_instance Old instance.
	 *
	 * @return array
	 * @see    WP_Widget->update
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( empty( $this->settings ) ) {
			return $instance;
		}

		// Loop settings and get values to save.
		foreach ( $this->settings as $key => $setting ) {
			if ( ! isset( $setting['type'] ) ) {
				continue;
			}

			// Format the value based on settings type.
			switch ( $setting['type'] ) {

				case 'image':
					/**
					 * Array of valid image file types.
					 *
					 * The array includes image mime types that are included in wp_get_mime_types()
					 */
					$mimes = array(
						'jpg|jpeg|jpe' => 'image/jpeg',
						'gif'          => 'image/gif',
						'png'          => 'image/png',
						'bmp'          => 'image/bmp',
						'tiff|tif'     => 'image/tiff',
						'ico'          => 'image/x-icon',
					);

					// Return an array with file extension and mime_type.
					$file = wp_check_filetype( $new_instance[ $key ], $mimes );

					// If $new_instance[ $key ] has a valid mime_type, assign it to $instance[ $key ], otherwise, assign empty value to $instance[ $key ].
					$instance[ $key ] = $file['ext'] ? $new_instance[ $key ] : $setting['default'];
					break;

				case 'checkbox':
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? 1 : 0;
					break;

				case 'number':
					$instance[ $key ] = is_numeric( $new_instance[ $key ] ) ? intval( $new_instance[ $key ] ) : $setting['default'];

					if ( isset( $setting['input_attrs']['min'] ) && '' !== $setting['input_attrs']['min'] ) {
						$instance[ $key ] = max( $instance[ $key ], $setting['input_attrs']['min'] );
					}

					if ( isset( $setting['input_attrs']['max'] ) && '' !== $setting['input_attrs']['max'] ) {
						$instance[ $key ] = min( $instance[ $key ], $setting['input_attrs']['max'] );
					}
					break;

				case 'radio':
				case 'select':
					$new_instance[ $key ] = sanitize_key( $new_instance[ $key ] );
					$available_choices    = $setting['choices'];

					$instance[ $key ] = array_key_exists( $new_instance[ $key ], $available_choices ) ? $new_instance[ $key ] : $setting['default'];
					break;

				case 'dropdown_categories':
					$new_instance[ $key ] = absint( $new_instance[ $key ] );

					$instance[ $key ] = term_exists( $new_instance[ $key ], 'category' ) ? $new_instance[ $key ] : $setting['default'];
					break;

				default:
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? sanitize_text_field( $new_instance[ $key ] ) : $setting['default'];
					break;

			}

			/**
			 * Sanitize the value of a setting.
			 */
			$instance[ $key ] = apply_filters( 'colormag_widget_settings_sanitize_option', $instance[ $key ], $new_instance, $key, $setting );
		}

		return $instance;

	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Instance.
	 *
	 * @see   WP_Widget->form
	 */
	public function form( $instance ) {

		if ( empty( $this->settings ) ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {

			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['default'];

			switch ( $setting['type'] ) {

				case 'text':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<input type="text"
						       class="widefat <?php echo esc_attr( $class ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
						       value="<?php echo esc_attr( $value ); ?>"
						/>
					</p>
					<?php
					break;

				case 'image':
					?>
					<div class="media-uploader">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
								<?php echo esc_html( $setting['label'] ); ?>
							</label>
						</p>

						<div class="media-uploader" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<div class="custom_media_preview">
								<?php if ( $value != '' ) : ?>
									<img class="custom_media_preview_default"
									     src="<?php echo esc_url( $value ); ?>"
									     style="max-width:100%;"
									/>
								<?php endif; ?>
							</div>

							<input type="text"
							       class="widefat custom_media_input"
							       id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
							       value="<?php echo esc_attr( $value ); ?>"
							       style="margin-top:5px;"
							/>

							<button class="custom_media_upload button button-secondary button-large"
							        id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
							        data-choose="<?php esc_attr_e( 'Choose an image', 'colormag' ); ?>"
							        data-update="<?php esc_attr_e( 'Use image', 'colormag' ); ?>"
							        style="width:100%;margin-top:6px;margin-right:30px;"
							>
								<?php esc_html_e( 'Select an Image', 'colormag' ); ?>
							</button>
						</div>
					</div>
					<?php
					break;

				case 'checkbox':
					?>
					<p>
						<input class="checkbox"
						       id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
						       type="checkbox"
							<?php echo esc_attr( ( $value == 1 ) ? 'checked' : '' ); ?>
						/>

						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>
					</p>
					<?php
					break;

				case 'number':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<input class="widefat <?php echo esc_attr( $class ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
						       type="number"
						       value="<?php echo esc_attr( $value ); ?>"
							<?php if ( isset( $setting['input_attrs']['step'] ) ) { ?>
								step="<?php echo esc_attr( $setting['input_attrs']['step'] ); ?>"
							<?php } ?>
							<?php if ( isset( $setting['input_attrs']['min'] ) ) { ?>
								min="<?php echo esc_attr( $setting['input_attrs']['min'] ); ?>"
							<?php } ?>
							<?php if ( isset( $setting['input_attrs']['max'] ) ) { ?>
								max="<?php echo esc_attr( $setting['input_attrs']['max'] ); ?>"
							<?php } ?>
						/>
					</p>
					<?php
					break;

				case 'radio':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<?php foreach ( $setting['choices'] as $choices_key => $choices_value ) { ?>
							<br />

							<input type="radio"
							       id="<?php echo esc_attr( $this->get_field_id( $choices_key ) ); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
							       value="<?php echo esc_attr( $this->get_field_name( $choices_key ) ); ?>"
								<?php echo esc_attr( ( $choices_key == $value ) ? 'checked' : '' ); ?>
							/>

							<label for="<?php echo esc_attr( $this->get_field_id( $choices_key ) ); ?>">
								<?php echo esc_html( $choices_value ); ?>
							</label>
						<?php } ?>
					</p>
					<?php
					break;

				case 'select':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<select class="widefat <?php echo esc_attr( $class ); ?>"
						        id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
						        name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
						>
							<?php foreach ( $setting['choices'] as $choices_key => $choices_value ) { ?>
								<option value="<?php echo esc_attr( $choices_key ); ?>"
									<?php selected( $choices_key, $value ); ?>
								>
									<?php echo esc_html( $choices_value ); ?>
								</option>
							<?php } ?>
						</select>
					</p>
					<?php
					break;

				case 'dropdown_categories':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<?php
						wp_dropdown_categories(
							array(
								'show_option_none' => ' ',
								'name'             => $this->get_field_name( $key ),
								'selected'         => $value,
								'class'            => 'widefat postform',
							)
						);
						?>
					</p>
					<?php
					break;

				// Default: run an action.
				default:
					do_action( 'colormag_widget_field_' . $setting['type'], $key, $value, $setting, $instance );
					break;
			}
		}

	}

}
