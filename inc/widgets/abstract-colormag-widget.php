<?php
/**
 * Abstract widget class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
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
	public $widget_cssclass = '';

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description = '';

	/**
	 * Widget ID.
	 *
	 * @var string|bool
	 */
	public $widget_id = false;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name = '';

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
	 * Widget customize selective refresh.
	 *
	 * @var bool
	 */
	public $customize_selective_refresh = true;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$widget_options = array(
			'classname'                   => $this->widget_cssclass,
			'description'                 => $this->widget_description,
			'customize_selective_refresh' => $this->customize_selective_refresh,
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

			/*
			 * A submitted form does not necessarily carry every setting. The REST
			 * `widget-types/<id_base>/encode` endpoint used by the block widget editor
			 * and the Customizer's partial refresh both call update() with a partial
			 * (sometimes empty) $new_instance, and control types such as `custom` never
			 * render an input at all.
			 *
			 * That endpoint calls update() *outside* its output buffer, so a PHP
			 * "Undefined array key" warning raised here is printed straight into the
			 * REST response body and breaks the JSON the editor expects. Never index
			 * $new_instance directly below.
			 */
			$has_value = isset( $new_instance[ $key ] );
			$raw_value = $has_value ? $new_instance[ $key ] : null;
			$default   = isset( $setting['default'] ) ? $setting['default'] : '';

			// Format the value based on settings type.
			switch ( $setting['type'] ) {

				case 'url':
					$instance[ $key ] = $has_value ? esc_url_raw( $raw_value ) : $default;
					break;

				case 'textarea':
					$instance[ $key ] = $has_value ? wp_kses( trim( wp_unslash( $raw_value ) ), wp_kses_allowed_html( 'post' ) ) : $default;
					break;

				case 'image':
					$instance[ $key ] = $has_value ? $this->sanitize_image_value( $raw_value, $default ) : $default;
					break;

				case 'checkbox':
					$instance[ $key ] = (
						$has_value && ( '1' == $raw_value || 'on' == $raw_value )
						) ? '1' : '0';
					break;

				case 'number':
					$instance[ $key ] = ( $has_value && is_numeric( $raw_value ) ) ? intval( $raw_value ) : $default;

					if ( isset( $setting['input_attrs']['min'] ) && '' !== $setting['input_attrs']['min'] ) {
						$instance[ $key ] = max( $instance[ $key ], $setting['input_attrs']['min'] );
					}

					if ( isset( $setting['input_attrs']['max'] ) && '' !== $setting['input_attrs']['max'] ) {
						$instance[ $key ] = min( $instance[ $key ], $setting['input_attrs']['max'] );
					}
					break;

				case 'radio':
				case 'select':
					$new_instance[ $key ] = $has_value ? sanitize_key( $raw_value ) : '';
					$available_choices    = isset( $setting['choices'] ) ? $setting['choices'] : array();

					$instance[ $key ] = array_key_exists( $new_instance[ $key ], $available_choices ) ? $new_instance[ $key ] : $default;
					break;

				case 'dropdown_categories':
					$new_instance[ $key ] = ( ! $has_value || '-1' == $raw_value ) ? '0' : absint( $raw_value );

					$instance[ $key ] = term_exists( $new_instance[ $key ], 'category' ) ? $new_instance[ $key ] : $default;
					break;

				case 'dropdown_tags':
					$new_instance[ $key ] = ( ! $has_value || '-1' == $raw_value ) ? '0' : absint( $raw_value );

					$instance[ $key ] = term_exists( $new_instance[ $key ], 'post_tag' ) ? $new_instance[ $key ] : $default;
					break;

				case 'dropdown_users':
					$new_instance[ $key ] = ( ! $has_value || '-1' == $raw_value ) ? '0' : absint( $raw_value );
					$available_users      = array();
					$all_author_users     = get_users(
						array(
							'capability' => 'authors',
						)
					);

					foreach ( $all_author_users as $author_user ) {
						$available_users[ $author_user->ID ] = $author_user->display_name;
					}

					$instance[ $key ] = array_key_exists( $new_instance[ $key ], $available_users ) ? $new_instance[ $key ] : $default;
					break;

				case 'checkboxes':
					if ( ! $has_value || ! is_array( $raw_value ) ) {
						$instance[ $key ] = $default;
						break;
					}

					$saved_data       = array();
					$instance[ $key ] = $raw_value;

					foreach ( $instance[ $key ] as $item => $value ) {
						$saved_data[ $item ] = isset( $item ) ? 1 : 0;
					}

					$instance[ $key ] = $saved_data;
					break;

				case 'numbers':
					if ( ! $has_value || ! is_array( $raw_value ) ) {
						$instance[ $key ] = $default;
						break;
					}

					$saved_data       = array();
					$instance[ $key ] = $raw_value;

					foreach ( $instance[ $key ] as $item => $value ) {
						$temp_data = is_numeric( $value ) ? intval( $value ) : ( isset( $default[ $item ] ) ? $default[ $item ] : 0 );

						if ( isset( $setting['input_attrs']['min'] ) && '' !== $setting['input_attrs']['min'] && ( $value < $setting['input_attrs']['min'] && ! $temp_data ) ) {
							$temp_data = max( $value, $setting['input_attrs']['min'] );
						}

						if ( isset( $setting['input_attrs']['max'] ) && '' !== $setting['input_attrs']['max'] && $value > $setting['input_attrs']['max'] ) {
							$temp_data = min( $value, $setting['input_attrs']['max'] );
						}

						$saved_data[ $item ] = $temp_data;
					}

					$instance[ $key ] = $saved_data;
					break;

				case 'multiselect':
					$selected_choices     = array();
					$available_choices    = isset( $setting['choices'] ) ? $setting['choices'] : array();
					$new_instance[ $key ] = ( $has_value && is_array( $raw_value ) ) ? $raw_value : array();

					foreach ( $new_instance[ $key ] as $selected_key => $selected_value ) {

						if ( array_key_exists( $selected_value, $available_choices ) ) {
							$selected_choices[] = $selected_value;
						}
					}

					$instance[ $key ] = $selected_choices;
					break;

				default:
					$instance[ $key ] = $has_value ? sanitize_text_field( $raw_value ) : $default;
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
	 * Image mime types accepted by the `image` control.
	 *
	 * Derived from the site's own allowed upload types rather than a hard-coded
	 * list, so formats enabled by WordPress core (AVIF since 6.5, WebP, HEIC) or
	 * by a plugin (SVG) are accepted instead of being silently discarded.
	 *
	 * @return array Map of extension patterns to mime types, as wp_check_filetype() expects.
	 */
	protected function get_allowed_image_mime_types() {

		$mimes = array();

		foreach ( get_allowed_mime_types() as $ext_pattern => $mime_type ) {
			if ( 0 === strpos( $mime_type, 'image/' ) ) {
				$mimes[ $ext_pattern ] = $mime_type;
			}
		}

		/**
		 * Filters the image mime types a ColorMag widget `image` control accepts.
		 *
		 * @since ColorMag 4.2.3
		 *
		 * @param array $mimes Map of extension patterns to mime types.
		 */
		return apply_filters( 'colormag_widget_image_mime_types', $mimes );
	}

	/**
	 * Sanitize the value of an `image` control.
	 *
	 * The control stores an image URL. The previous implementation matched that
	 * URL against a hard-coded extension list using a pattern anchored to the end
	 * of the string, and reset the setting to its default on any miss — with no
	 * error shown. That silently discarded valid images whenever the URL was an
	 * AVIF or SVG file (neither was in the list), or carried a query string or
	 * fragment, which is routine for CDNs, image optimizers and cache busters.
	 *
	 * An URL that resolves to an attachment in the media library is now accepted
	 * as-is; anything else falls back to an extension check that ignores the
	 * query string and honours the site's allowed upload types.
	 *
	 * @param mixed  $value          Raw value submitted for the control.
	 * @param string $default_value  Value to fall back to when $value is not a usable image.
	 *
	 * @return string
	 */
	protected function sanitize_image_value( $value, $default_value = '' ) {

		if ( ! is_scalar( $value ) ) {
			return $default_value;
		}

		$value = trim( (string) $value );

		// An empty control is a deliberate "no image", not a rejected value.
		if ( '' === $value ) {
			return '';
		}

		$url = esc_url_raw( $value );

		if ( '' === $url ) {
			return $default_value;
		}

		// Anything in the media library is valid whatever its extension or query string.
		if ( attachment_url_to_postid( $url ) ) {
			return $url;
		}

		// Otherwise check the extension only, ignoring any query string or fragment.
		$path = wp_parse_url( $url, PHP_URL_PATH );

		if ( empty( $path ) ) {
			return $default_value;
		}

		$file = wp_check_filetype( $path, $this->get_allowed_image_mime_types() );

		return $file['ext'] ? $url : $default_value;
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

				case 'url':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<input type="url"
								class="widefat <?php echo esc_attr( $class ); ?>"
								id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
								name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
								value="<?php echo esc_attr( $value ); ?>"
						/>
					</p>
					<?php
					break;

				case 'textarea':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<textarea class="widefat <?php echo esc_attr( $class ); ?>"
									rows="5"
									cols="20"
									id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
									name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
						><?php echo esc_textarea( $value ); ?></textarea>
					</p>
					<?php
					break;

				case 'image':
					/*
					 * The wrapper, the input and the button used to share one id. Keep it
					 * on the input so the label still points at the control, and give the
					 * other two their own, so several image controls can sit in one
					 * sidebar without colliding.
					 */
					$field_id   = $this->get_field_id( $key );
					$wrapper_id = $field_id . '-wrapper';
					$button_id  = $field_id . '-button';
					?>
					<div class="media-uploader">
						<p>
							<label for="<?php echo esc_attr( $field_id ); ?>">
								<?php echo esc_html( $setting['label'] ); ?>
							</label>
						</p>

						<div class="media-uploader" id="<?php echo esc_attr( $wrapper_id ); ?>">
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
									id="<?php echo esc_attr( $field_id ); ?>"
									name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
									value="<?php echo esc_attr( $value ); ?>"
									style="margin-top:5px;"
							/>

							<?php
							/*
							 * type="button" is required. Without it the button defaults to
							 * type="submit", and the block widget editor renders this form
							 * inside a real <form> element: clicking "Select an Image" then
							 * submits the widget instead of opening the media library
							 * whenever image-uploader.js has not run.
							 */
							?>
							<button type="button"
									class="custom_media_upload button button-secondary button-large"
									id="<?php echo esc_attr( $button_id ); ?>"
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

						<?php
						$count = 1;
						foreach ( $setting['choices'] as $choices_key => $choices_value ) {
							if ( 1 !== $count ) {
								echo '<br />';
							}
							?>

							<input type="radio"
									id="<?php echo esc_attr( $this->get_field_id( $choices_key ) ); ?>"
									name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
									value="<?php echo esc_attr( $choices_key ); ?>"
								<?php echo esc_attr( ( $choices_key == $value ) ? 'checked' : '' ); ?>
							/>

							<label for="<?php echo esc_attr( $this->get_field_id( $choices_key ) ); ?>">
								<?php echo esc_html( $choices_value ); ?>
							</label>
							<?php
							++$count;
						}
						?>
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

				case 'custom':
					?>
					<div class="custom">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php
							echo $setting['label']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
							?>
						</label>

						<?php if ( isset( $setting['image_url'] ) ) { ?>
							<div style="text-align: center;">
								<img src="<?php echo esc_url( $setting['image_url'] ); ?>" alt="" />
							</div>
						<?php } ?>
					</div>
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

				case 'dropdown_tags':
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
								'taxonomy'         => 'post_tag',
								'class'            => 'widefat postform',
							)
						);
						?>
					</p>
					<?php
					break;

				case 'dropdown_users':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<?php
						wp_dropdown_users(
							array(
								'show_option_none' => ' ',
								'name'             => $this->get_field_name( $key ),
								'selected'         => $value,
								'orderby'          => 'name',
								'order'            => 'ASC',
								'capability'       => 'edit_posts',
								'class'            => 'widefat postform',
							)
						);
						?>
					</p>
					<?php
					break;

				case 'separator':
					?>
					<hr />
					<?php
					break;

				case 'checkboxes':
					?>
					<h3><?php echo esc_html( $setting['label'] ); ?></h3>

					<p>
						<?php foreach ( $setting['choices'] as $choices_key => $choices_value ) { ?>
							<label class="alignleft"
									style="width:50%;display:block;margin-bottom:5px"
									for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>_<?php echo esc_attr( $choices_key ); ?>"
							>

								<input type="checkbox"
										id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>_<?php echo esc_attr( $choices_key ); ?>"
										name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>[<?php echo esc_attr( $choices_key ); ?>]"
										value="1"
									<?php
									if ( isset( $value[ $choices_key ] ) ) {
										checked( 1, $value[ $choices_key ], true );
									}
									?>
								/>

								<?php echo esc_html( $choices_value ); ?>
							</label>
						<?php } ?>
					</p>

					<div class="clear"></div>
					<?php
					break;

				case 'numbers':
					?>
					<h3><?php echo esc_html( $setting['label'] ); ?></h3>

					<p>
						<?php foreach ( $setting['choices'] as $choices_key => $choices_value ) { ?>
							<label class="alignleft"
									style="width:50%;display:block;margin-bottom:5px"
									for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>_<?php echo esc_attr( $choices_key ); ?>"
							>

								<input type="number"
										id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>_<?php echo esc_attr( $choices_key ); ?>"
										name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>[<?php echo esc_attr( $choices_key ); ?>]"
										value="<?php echo esc_attr( $value[ $choices_key ] ); ?>"
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

								<?php echo esc_html( $choices_value ); ?>
							</label>
						<?php } ?>
					</p>

					<div class="clear"></div>
					<?php
					break;

				case 'api_key':
					$api_key = $setting['api_key'];

					if ( ! $api_key ) {
						$query['autofocus[control]'] = $setting['customize_control'];
						$control_link                = add_query_arg( $query, admin_url( 'customize.php' ) );
						?>
						<p>
							<span class="<?php echo esc_attr( $setting['class'] ); ?>-error">
								<?php echo $setting['description']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
								<br />
								<a href="<?php echo esc_url( $control_link ); ?>"><?php echo esc_html( $setting['label'] ); ?></a>
							</span>
						</p>
						<?php
					}
					break;

				case 'multiselect':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
							<?php echo esc_html( $setting['label'] ); ?>
						</label>

						<?php
						printf(
							/* Translators: 1. Field name, 2. Field id, 3. Custom style declaration */
							'<select multiple="multiple" name="%s[]" id="%s" %s>',
							esc_attr( $this->get_field_name( $key ) ),
							esc_attr( $this->get_field_id( $key ) ),
							'style="width:100%"'
						);

						$available_values = ! empty( $value ) ? $value : array();

						foreach ( $setting['choices'] as $choices_key => $choices_value ) {
							?>
							<option value="<?php echo esc_attr( $choices_key ); ?>"
								<?php
								if ( in_array( $choices_key, $available_values, true ) ) {
									echo ' selected="selected"';
								}
								?>
							>
								<?php echo esc_html( $choices_value ); ?>
							</option>
							<?php
						}

						echo '</select>';
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

	/**
	 * Output the html at the start of a widget.
	 *
	 * @param array $args Arguments.
	 */
	public function widget_start( $args ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Output the html at the end of a widget.
	 *
	 * @param array $args Arguments.
	 */
	public function widget_end( $args ) {
		echo $args['after_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Displays the widget title within the widgets.
	 *
	 * The entry titles rendered by `the_title()` sit one level below this
	 * heading, so a widget that renders no heading at all would leave those
	 * entry titles skipping a heading level. Widgets without a title setting,
	 * or with the title left empty, therefore pass a fallback that is rendered
	 * for screen readers only.
	 *
	 * @param string $title           The widget title.
	 * @param string $type            The display posts from the widget setting.
	 * @param int    $category        The category id of the widget setting.
	 * @param string $screen_reader   Fallback heading used when $title is empty.
	 */
	public function widget_title( $title, $type, $category, $screen_reader = '' ) {

		$classes = 'cm-widget-title';

		// Fall back to a screen reader only heading, or bail out when there is none.
		if ( ! $title ) {
			if ( ! $screen_reader ) {
				return;
			}

			$title    = $screen_reader;
			$classes .= ' screen-reader-text';
		}

		$border_color   = '';
		$title_color    = '';
		$category_color = colormag_category_color( $category );
		if ( 'latest' != $type && $category_color ) {
			$border_color = 'style="border-bottom-color:' . $category_color . ';"';
			$title_color  = 'style="background-color:' . $category_color . ';"';
		}

		//      // Assign the view all link to be displayed in the widget title.
		//      $category_link = '';
		//      if ( ( ! empty( $category ) && 'latest' != $type ) ) {
		//          $category_link = '<a href="' . esc_url( get_category_link( $category ) ) . '" class="cm-view-all-link">' . esc_html( get_theme_mod( 'colormag_view_all_text', __( 'View All', 'colormag' ) ) ) . '</a>';
		//      }

		$tag = colormag_widget_title_tag();

		// Display the title.
		echo '<' . esc_attr( $tag ) . ' class="' . esc_attr( $classes ) . '" ' . $border_color . '><span ' . $title_color . '>' . esc_html( $title ) . '</span>' . '</' . esc_attr( $tag ) . '>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Displays the widget description within the widgets.
	 *
	 * @param string $text The widget description.
	 */
	public function widget_description( $text ) {

		// Return if $text is empty.
		if ( ! $text ) {
			return;
		}

		echo '<p>' . wp_kses_post( $text ) . '</p>';
	}

	/**
	 * Query of the posts within the widgets.
	 *
	 * @param int    $number                 The number of posts to display.
	 * @param string $type                   The display posts from the widget setting.
	 * @param int    $category               The category id of the widget setting.
	 *
	 * @return \WP_Query
	 */
	public function query_posts( $number, $type, $category, $tag ='', $author='' ) {

		$post_status = 'publish';
		if ( 1 == get_option( 'fresh_site' ) ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'post_status'         => $post_status,
		);

		// Displays from tag chosen.
		if ( 'tag' == $type ) {
			$args['tag__in'] = $tag;
		}

		// Displays from author chosen.
		if ( 'author' == $type ) {
			$args['author__in'] = $author;
		}

		// Display posts from category.
		if ( 'category' == $type ) {
			$args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $args );

		return $get_featured_posts;
	}

	/**
	 * Displays the post title within the widgets.
	 *
	 * Rendered one level below the widget's own heading, see `widget_title()`.
	 */
	public function the_title() {
		$tag = colormag_widget_entry_title_tag();
		echo '<' . esc_attr( $tag ) . ' class="cm-entry-title">';
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
		<?php
		echo '</' . esc_attr( $tag ) . '>';
	}

	/**
	 * Displays the featured image of the post within the widgets.
	 *
	 * @param int    $post_id      The post id.
	 * @param string $size         The featured image size.
	 * @param string $figure_class The class for featured image display.
	 * @param bool   $link_enable  The option to link the featured image to post link.
	 */
	public function the_post_thumbnail( $post_id, $size = '', $link_enable = true ) {

		$image           = '';
		$thumbnail_id    = get_post_thumbnail_id( $post_id );
		$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		$title_attribute = get_the_title( $post_id );
		$image_alt_text  = empty( $image_alt_text ) ? $title_attribute : $image_alt_text;

		if ( $link_enable ) {
			$image .= '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
		}

		$image .= get_the_post_thumbnail(
			$post_id,
			$size,
			array(
				'title' => esc_attr( $title_attribute ),
				'alt'   => esc_attr( $image_alt_text ),
			)
		);

		if ( $link_enable ) {
			if ( has_post_format( 'video' ) ) {
				$image .= '<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
							</span>';
			}

			$image .= '</a>';
		}

		$image .= '</figure>';

		echo $image; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Displays the post meta within the widgets.
	 */
	public function entry_meta() {

		$meta_orders =
			array(
				'categories',
				'date',
				'author',
				'tags',
			);

		$human_diff_time = '';
		if ( 'style-2' == get_theme_mod( 'colormag_post_meta_date_style', 'style-1' ) ) {
			$human_diff_time = 'human-diff-time';
		}

		echo '<div class="cm-below-entry-meta ' . esc_attr( $human_diff_time ) . '">';

		foreach ( $meta_orders as $key => $meta_order ) {

			if ( 'date' === $meta_order ) {
				colormag_date_meta_markup();
			}

			if ( 'author' === $meta_order ) {
				colormag_author_meta_markup();
			}
		}

		echo '</div>';
	}
}
