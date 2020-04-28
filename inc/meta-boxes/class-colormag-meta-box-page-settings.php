<?php
/**
 * Page settings meta box class.
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
 * Page settings meta box class.
 *
 * Class ColorMag_Meta_Box_Page_Settings
 */
class ColorMag_Meta_Box_Page_Settings {

	/**
	 * Meta box render content callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public static function render( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'colormag_save_data', 'colormag_meta_nonce' );

		global $post;

		/**
		 * Meta box options.
		 */
		// Layout.
		$colormag_page_layout = get_post_meta( $post->ID, 'colormag_page_layout', true );
		if ( '' === $colormag_page_layout ) {
			$colormag_page_layout = 'default_layout';
		}
		?>

		<div id="page-settings-tabs-wrapper">
			<ul class="colormag-ui-nav">
				<?php
				$page_setting = apply_filters(
					'colormag_page_setting',
					array(
						'general' => array(
							'label'  => esc_html__( 'General', 'colormag' ),
							'target' => 'page-settings-general',
							'class'  => array(),
						),
					)
				);

				foreach ( $page_setting as $key => $tab ) {
					?>
					<li class="<?php echo esc_attr( implode( ' ', (array) $tab['class'] ) ); ?>">
						<a href="#<?php echo esc_attr( $tab['target'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
					</li>
					<?php
				}
				?>
			</ul>

			<div class="colormag-ui-content">

				<div id="page-settings-general">
					<?php
					// For site layout.
					self::render_radio_image(
						array(
							'value'   => $colormag_page_layout,
							'id'      => 'colormag_page_layout',
							'label'   => esc_html__( 'Select Layout', 'colormag' ),
							'choices' => array(
								'default_layout'              => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'right_sidebar'               => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar'                => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'       => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered' => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							),
						)
					);
					?>

					<?php
					/**
					 * Hook for general options meta box display.
					 */
					do_action( 'colormag_general_page_setting' );
					?>
				</div>

				<?php
				/**
				 * Hook for page settings tab.
				 */
				do_action( 'colormag_page_settings' );
				?>
			</div>

		</div>

		<?php
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID.
	 */
	public static function save( $post_id ) {

		$colormag_page_layout = isset( $_POST['colormag_page_layout'] ) ? sanitize_key( $_POST['colormag_page_layout'] ) : 'default_layout';

		// Site layout.
		if (
		in_array(
			$colormag_page_layout,
			array(
				'right_sidebar',
				'left_sidebar',
				'no_sidebar_full_width',
				'no_sidebar_content_centered',
			),
			true
		)
		) {
			update_post_meta( $post_id, 'colormag_page_layout', $colormag_page_layout );
		} else {
			delete_post_meta( $post_id, 'colormag_page_layout' );
		}

		/**
		 * Hook for page settings data save.
		 */
		do_action( 'colormag_page_settings_save', $post_id );

	}

	/**
	 * Output a radio image input field.
	 *
	 * @param array $field The fields of the input types.
	 */
	public static function render_radio_image( $field ) {
		?>

		<div class="options-group">
			<div class="colormag-ui-desc">
				<label><?php echo esc_html( $field['label'] ); ?></label>
			</div>

			<div class="colormag-ui-field">
				<?php foreach ( $field['choices'] as $key => $value ) { ?>
					<label class="colormag-label" for="<?php echo esc_attr( $key ); ?>">
						<input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>"
						       id="<?php echo esc_attr( $key ); ?>"
						       value="<?php echo esc_attr( $key ); ?>"
							<?php checked( $field['value'], $key ); ?>
						/>

						<img src="<?php echo esc_url( $value ); ?>" />
					</label>
				<?php } ?>
			</div>
		</div>

		<?php
	}

}
