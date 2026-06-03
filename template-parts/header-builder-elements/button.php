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
$button_target = get_theme_mod( 'colormag_header_button_target' ) ? ' target="_blank"' : '';

if ( $button_text ) :
	?>
	<div class="cm-header-buttons">
		<?php
		do_action( 'colormag_header_button_start' );

		if ( $button_text ) {
			?>

			<div class="cm-header-button cm-header-button--1">
				<a class="cm-button" href="<?php echo esc_url( $button_link ); ?>"
					<?php echo esc_attr( $button_target ); ?>
					class="<?php echo colormag_css_class( 'colormag_header_button_class', false ); ?>">
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>

			<?php
		}

		do_action( 'colormag_header_button_end' );
		?>

	</div> <!-- /.cm-header-buttons -->
	<?php
endif;
