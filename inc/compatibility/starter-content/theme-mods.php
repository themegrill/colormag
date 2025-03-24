<?php
/**
 * Starter content theme mods definition.
 *
 * @package ColorMag\Compatibility\Starter_Content
 */
return array(
	'colormag_header_builder'                        => array(
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
				'right'  => array( 'search' ),
			),
		),
	),
	'colormag_header_button_text'                    => esc_html__( 'Subscribe', 'colormag' ),
	'colormag_header_button_link'                    => '#',
	'colormag_header_button_background_color'        => '#c57eef',
	'colormag_header_site_identity_color'            => '#000000',
	'colormag_header_button_border_width'            => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_bottom_area_border_width'       => array(
		'top'    => '1',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_bottom_area_background'         => array(
		'background-color'      => '#FFFFFF',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'contain',
		'background-attachment' => 'scroll',
	),
	'colormag_header_bottom_area_border_color'       => '#f3f3f3',
	'colormag_header_primary_menu_active_text_color' => '#c57eef',
	'colormag_header_primary_menu_text_color'        => '#000000',
	'colormag_header_primary_menu_selected_hovered_text_color' => '#c57eef',
	'colormag_header_primary_menu_hover_background'  => 'transparent',
	'colormag_header_primary_menu_active_background' => 'transparent',
	'colormag_default_sidebar_layout'                => 'no_sidebar_full_width',
	'colormag_page_sidebar_layout'                   => 'no_sidebar_full_width',
	'colormag_header_search_icon_color'              => '#000000',
);
