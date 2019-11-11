<?php

/**
 * ColorMag Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
function colormag_customize_register( $wp_customize ) {

	// Register `COLORMAG_Upsell_Section` type section.
	$wp_customize->register_section_type( 'COLORMAG_Upsell_Section' );

	// Add `COLORMAG_Upsell_Section` to display pro link.
	$wp_customize->add_section(
		new COLORMAG_Upsell_Section( $wp_customize, 'colormag_upsell_section',
			array(
				'title'      => esc_html__( 'View PRO version', 'colormag' ),
				'url'        => 'https://themegrill.com/themes/colormag/?utm_source=colormag-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'capability' => 'edit_theme_options',
				'priority'   => 1,
			)
		)
	);

	// sanitization works
	function colormag_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	// sanitization of links
	function colormag_links_sanitize() {
		return false;
	}

}

add_action( 'customize_register', 'colormag_customize_register' );

/* * ************************************************************************************** */

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'colormag_customizer_custom_scripts' );

function colormag_customizer_custom_scripts() {
	?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-colormag_upsell_section h3.accordion-section-title {
			background-color: #289DCC !important;
			border-left-color: #0073aa;
			color: #fff !important;
		}

		#accordion-section-colormag_upsell_section h3 a:after {
			content: '\f345';
			color: #fff;
			position: absolute;
			top: 12px;
			right: 10px;
			z-index: 1;
			font: 400 20px/1 dashicons;
			speak: none;
			display: block;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-decoration: none !important;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title a {
			color: #fff;
			display: block;
			text-decoration: none;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title:hover {
			background-color: #1f91bf !important;
			border-left-color: #0073aa !important;
			color: #fff !important;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title:after {
			color: #fff !important;
		}

		/* Upsell button CSS */
		.themegrill-pro-info,
		.customize-control-colormag-important-links a {
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
			background: #008EC2;
			color: #fff;
			display: block;
			margin: 15px 0 0;
			padding: 5px 0;
			text-align: center;
			font-weight: 600;
		}

		.customize-control-colormag-important-links a {
			padding: 8px 0;
		}

		.themegrill-pro-info:hover,
		.customize-control-colormag-important-links a:hover {
			color: #ffffff;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
			background: #2380BA;
		}
	</style>

	<script>
		( function ( $, api ) {
			api.sectionConstructor['colormag-upsell-section'] = api.Section.extend( {

				// No events for this type of section.
				attachEvents : function () {
				},

				// Always make the section active.
				isContextuallyActive : function () {
					return true;
				}
			} );
		} )( jQuery, wp.customize );

	</script>
	<?php
}
