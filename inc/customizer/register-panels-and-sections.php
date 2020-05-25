<?php
/**
 * Register customizer panels and sections.
 *
 * @package colormag
 */

/**
 * Section: ColorMag Pro Upsell.
 */

$wp_customize->add_section(
	new ColorMag_Customize_Section(
		$wp_customize,
		'colormag_customize_upsell_section',
		array(
			'title'    => esc_html__( 'View Pro Version', 'colormag' ),
			'priority' => 5,
		)
	)
);

