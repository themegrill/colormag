<?php
/**
 * The secondary sidebar containing the widget area.
 *
 * @package    ColorMag
 *
 * @since      ColorMag 3.0.8
 */

?>

<div id="tertiary">
	<?php do_action( 'colormag_before_sidebar' );

	if ( ! is_active_sidebar( 'colormag_left_sidebar' ) ) :

		the_widget( 'WP_Widget_Text',
			array(
				'title'  => esc_html__( 'Example Widget', 'colormag' ),
				'text'   => sprintf( esc_html__( 'This is an example widget to show how the Secondary sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets are added then this will be replaced by those widgets', 'colormag' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
				'filter' => true,
			),
			array(
				'before_widget' => '<section class="widget widget_text">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="cm-widget-title">',
				'after_title'   => '</h3>',
			)
		);
	else :
		dynamic_sidebar( 'colormag_left_sidebar' );
	endif;

	do_action( 'colormag_after_sidebar' ); ?>
</div>
