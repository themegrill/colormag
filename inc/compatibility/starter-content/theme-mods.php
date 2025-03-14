<?php
/**
 * Starter content theme mods definition.
 *
 * @package ColorMag\Compatibility\Starter_Content
 */
return array(
	'colormag_header_builder'                 => array(
		'desktop' => array(
			'top'    => array(
				'left'   => array(),
				'center' => array(),
				'right'  => array(),
			),
			'main'   => array(
				'left'   => array(
					'logo',
				),
				'center' => array(),
				'right'  => array( 'socials', 'button' ),
			),
			'bottom' => array(
				'left'   => array( 'primary-menu' ),
				'center' => array(),
				'right'  => array(),
			),
		),
	),
	'colormag_header_button_text'             => esc_html__( 'Subscribe', 'colormag' ),
	'colormag_header_button_link'             => '#',
	'colormag_header_button_background_color' => '#c57eef',
	'colormag_header_button_border_width'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
		'units'  => 'px',
	),

);
