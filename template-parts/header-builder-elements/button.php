<?php
/**
 * Header buttons markup file.
 *
 * @package colormag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$button_enable = get_theme_mod( 'colormag_enable_header_button' );

$button_text   = apply_filters( 'colormag_header_button_text', get_theme_mod( 'colormag_header_button_text', 'Button 1' ) );
$button_link   = get_theme_mod( 'colormag_header_button_link' );
$button_preset = get_theme_mod( 'colormag_header_button_preset', 'default' );
$button_target = get_theme_mod( 'colormag_header_button_target' ) ? ' target="_blank"' : '';

// Base button classes. Pro can append preset-specific classes via the filter.
$button_classes = apply_filters( 'colormag_header_button_classes', 'cm-button', $button_preset );

if ( $button_text ) :
	?>
	<div class="cm-header-buttons">
		<?php
		do_action( 'colormag_header_button_start' );

		if ( $button_text ) {

			// Build the button markup so it can be filtered as a whole.
			// Pro hooks `colormag_header_button_output` to inject preset icons
			// around the button text.
			ob_start();
			?>

			<div class="cm-header-button cm-header-button--1">
				<a class="<?php echo esc_attr( $button_classes ); ?>" href="<?php echo esc_url( $button_link ); ?>"
					<?php echo esc_attr( $button_target ); ?>
					class="<?php echo colormag_css_class( 'colormag_header_button_class', false ); ?>">
					<?php
					/**
					 * Fires before the button text inside the anchor.
					 *
					 * Pro uses this to render leading preset icons.
					 *
					 * @param string $button_preset The selected button preset.
					 */
					do_action( 'colormag_header_button_before_text', $button_preset );
					?>
					<?php echo esc_html( $button_text ); ?>
					<?php
					/**
					 * Fires after the button text inside the anchor.
					 *
					 * Pro uses this to render trailing preset icons.
					 *
					 * @param string $button_preset The selected button preset.
					 */
					do_action( 'colormag_header_button_after_text', $button_preset );
					?>
				</a>
			</div>

			<?php
			$button_output = ob_get_clean();

			/**
			 * Filters the full header button markup.
			 *
			 * @param string $button_output The button HTML.
			 * @param string $button_preset The selected button preset.
			 */
			echo apply_filters( 'colormag_header_button_output', $button_output, $button_preset ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is built from escaped values above and trusted filter callbacks.
		}

		do_action( 'colormag_header_button_end' );
		?>

	</div> <!-- /.cm-header-buttons -->
	<?php
endif;
