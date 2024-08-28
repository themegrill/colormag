<?php
/**
 * Mobile toggle icon template file.
 *
 * @package colormag
 *
 * @since 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$mobile_menu_label      = get_theme_mod( 'colormag_mobile_menu_text', '' );
$enable_header_button   = get_theme_mod( 'colormag_enable_mobile_header_button', '' );
$enable_header_button_2 = get_theme_mod( 'colormag_enable_mobile_header_button_2', '' );

?>

<div class="cm-toggle-menu <?php colormag_css_class( 'colormag_header_mobile_menu_toggle_class' ); ?>"

	<?php echo wp_kses_post( apply_filters( 'colormag_nav_toggle_data_attrs', '' ) ); ?>>

	<?php
	// @codingStandardsIgnoreStart
	echo apply_filters( 'colormag_before_mobile_menu_toggle', '' ); // WPCS: CSRF ok.
	// @codingStandardsIgnoreEnd
	?>

	<button class="cm-menu-toggle"
			aria-label="<?php esc_attr_e( 'Primary Menu', 'colormag' ); ?>" >

		<?php
		if ( get_theme_mod( 'colormag_enable_header_search', true ) ) {

			colormag_get_icon( 'magnifying-glass-bars' );
		} else {

			colormag_get_icon( 'bars' );
		}

		?>

	</button> <!-- /.cm-menu-toggle -->

	<nav id="cm-mobile-nav" class="<?php colormag_css_class( 'colormag_mobile_nav_class' ); ?>"

		<?php echo wp_kses_post( apply_filters( 'colormag_nav_data_attrs', '' ) ); ?>>

		<div class="cm-mobile-nav__header">
			<?php if ( get_theme_mod( 'colormag_enable_header_search', true ) ) : ?>
				<?php get_search_form(); // Header search. ?>
			<?php endif; ?>

			<!-- Mobile nav close icon. -->
			<button id="cm-mobile-nav-close" class="cm-mobile-nav-close" aria-label="<?php esc_attr_e( 'Close Button', 'colormag' ); ?>">
				<?php colormag_get_icon( 'x-mark' ); ?>
			</button>
		</div> <!-- /.cm-mobile-nav__header -->
			<?php
			$builder = get_theme_mod( 'colormag_header_builder', colormag_header_default_builder() );
			echo '<div class="cm-mobile-header-row">';
			foreach ( $builder['offset'] as $cols ) {

				if ( isset( $cols ) ) {
					get_template_part( "template-parts/header-builder-elements/$cols", '' );
				}
			}
			echo '</div>';
			?>
	</nav> <!-- /#cm-mobile-nav-->

</div> <!-- /.cm-toggle-menu -->
