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
	 * @var string|bool
	 */
	public $widget_id = false;

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

			// Format the value based on settings type.
			switch ( $setting['type'] ) {

				case 'url':
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? esc_url_raw( $new_instance[ $key ] ) : $setting['default'];
					break;

				case 'textarea':
					$instance[ $key ] = wp_kses( trim( wp_unslash( $new_instance[ $key ] ) ), wp_kses_allowed_html( 'post' ) );
					break;

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

				case 'dropdown_tags':
					$new_instance[ $key ] = absint( $new_instance[ $key ] );

					$instance[ $key ] = term_exists( $new_instance[ $key ], 'post_tag' ) ? $new_instance[ $key ] : $setting['default'];
					break;

				case 'dropdown_users':
					$new_instance[ $key ] = absint( $new_instance[ $key ] );
					$available_users      = array();
					$all_author_users     = get_users(
						array(
							'who' => 'authors',
						)
					);

					foreach ( $all_author_users as $author_user ) {
						$available_users[ $author_user->ID ] = $author_user->display_name;
					}

					$instance[ $key ] = array_key_exists( $new_instance[ $key ], $available_users ) ? $new_instance[ $key ] : $setting['default'];
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
							$count ++;
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
								'who'              => 'authors',
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
	 * @param string $title    The widget title.
	 * @param string $type     The display type of the widget.
	 * @param int    $category The category id of the widget setting.
	 */
	public function widget_title( $title, $type, $category ) {

		// Return if $title is empty.
		if ( ! $title ) {
			return;
		}

		$border_color = '';
		$title_color  = '';
		if ( 'latest' != $type ) {
			$border_color = 'style="border-bottom-color:' . colormag_category_color( $category ) . ';"';
			$title_color  = 'style="background-color:' . colormag_category_color( $category ) . ';"';
		}

		// Display the title.
		if ( ! empty( $title ) ) {
			echo '<h3 class="widget-title" ' . $border_color . '><span ' . $title_color . '>' . esc_html( $title ) . '</span></h3>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

	}

	/**
	 * Displays the post title within the widgets.
	 */
	public function the_title() {
		?>
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php
	}

	/**
	 * Displays the featured image of the post within the widgets.
	 *
	 * @param int    $post_id      The post id.
	 * @param string $size         The featured image size.
	 * @param string $figure_class The class for featured image display.
	 */
	public function the_post_thumbnail( $post_id, $size = '', $figure_class = '' ) {

		$image           = '';
		$thumbnail_id    = get_post_thumbnail_id( $post_id );
		$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		$title_attribute = get_the_title( $post_id );
		$image_alt_text  = empty( $image_alt_text ) ? $title_attribute : $image_alt_text;
		$figure_class    = ! empty( $figure_class ) ? 'class="' . $figure_class . '"' : '';
		$image           .= '<figure ' . $figure_class . '>';
		$image           .= '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
		$image           .= get_the_post_thumbnail(
			$post_id,
			$size,
			array(
				'title' => esc_attr( $title_attribute ),
				'alt'   => esc_attr( $image_alt_text ),
			)
		);
		$image           .= '</a>';
		$image           .= '</figure>';

		echo $image; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

	}

	/**
	 * Displays the post meta within the widgets.
	 */
	public function entry_meta() {

		echo '<div class="below-entry-meta">';

		// Displays the same published and updated date if the post is never updated.
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		// Displays the different published and updated date if the post is updated.
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			/* Translators: 1. Post link, 2. Post time, 3. Post date */
			__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		?>

		<span class="byline">
			<span class="author vcard">
				<i class="fa fa-user"></i>
				<a class="url fn n"
				   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
				   title="<?php echo get_the_author(); ?>"
				>
					<?php echo esc_html( get_the_author() ); ?>
				</a>
			</span>
		</span>

		<?php if ( ! post_password_required() && comments_open() ) { ?>
			<span class="comments">
				<i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?>
			</span>
		<?php } ?>

		<?php
		echo '</div>';

	}

}
