<?php
/**
 * The WooCommerce left sidebar widget area.
 *
 * @package    ColorMag
 *
 * @since      ColorMag 2.2.8
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="cm-secondary" class="cm-secondary">
	<?php do_action( 'colormag_before_sidebar' ); ?>

	<?php
	if ( ! is_active_sidebar( 'colormag_woocommerce_left_sidebar' ) ) :

		the_widget(
			'WP_Widget_Text',
			array(
				'title'  => esc_html__( 'Example Widget', 'colormag' ),
				'text'   => sprintf(
					/* Translators: 1. Opening of the link for widgets.php WordPress section, 2. Closing of the link for widgets.php WordPress section */
					esc_html__( 'This is an example widget to show how the WooCommerce Left Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'colormag' ),
					current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '',
					current_user_can( 'edit_theme_options' ) ? '</a>' : ''
				),
				'filter' => true,
			),
			array(
				'before_widget' => '<aside class="widget widget_text clearfix">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="cm-widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);
	else :
		dynamic_sidebar( 'colormag_woocommerce_left_sidebar' );
	endif;
	?>

	<?php do_action( 'colormag_after_sidebar' ); ?>
</div>
