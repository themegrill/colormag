<?php

$home_icon_class = 'cm-home-icon';

if ( is_front_page() ) {
	$home_icon_class = 'cm-home-icon front_page_on';
}
?>

<div class="<?php echo esc_attr( $home_icon_class ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
	>
		<?php colormag_get_icon( 'home' ); ?>
	</a>
</div>
