<?php

$enable_builder = get_theme_mod( 'colormag_enable_builder', false );
if ( $enable_builder || colormag_maybe_enable_builder() ) {
	add_action(
		'after_setup_theme',
		function () {
			remove_action( 'colormag_header', 'colormag_header_markup' );
		}
	);
}
