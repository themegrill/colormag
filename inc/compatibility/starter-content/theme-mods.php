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
				'left'   => array( 'news-ticker' ),
				'center' => array(),
				'right'  => array( 'date', 'socials' ),
			),
			'main'   => array(
				'left'   => array(
					'logo',
				),
				'center' => array(),
				'right'  => array( 'socials', 'button', 'search' ),
			),
			'bottom' => array(
				'left'   => array( 'primary-menu' ),
				'center' => array(),
				'right'  => array(),
			),
		),
	),
	'colormag_header_button_text'                    => esc_html__( 'Subscribe', 'colormag' ),
	'colormag_header_button_link'                    => '#',
	'colormag_header_button_background_color'        => '#c57eef',
	'colormag_header_site_identity_color'            => '#FFFFFF',
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
		'background-color'      => '#0D0F11',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'contain',
		'background-attachment' => 'scroll',
	),
	'colormag_header_top_area_background'            => array(
		'background-color'      => '#0D0F11',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'contain',
		'background-attachment' => 'scroll',
	),
	'colormag_header_main_area_background'           => array(
		'background-color'      => '',
		'background-image'      => get_template_directory_uri() . '/assets/img/starter/header-bg.jpg',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'contain',
		'background-attachment' => 'scroll',
	),
	'colormag_header_bottom_area_border_color'       => '#f3f3f3',
	'colormag_header_primary_menu_active_text_color' => '#c57eef',
	'colormag_header_primary_menu_text_color'        => '#FFFFFF',
	'colormag_header_primary_menu_selected_hovered_text_color' => '#c57eef',
	'colormag_header_primary_menu_hover_background'  => 'transparent',
	'colormag_header_primary_menu_active_background' => 'transparent',
	'colormag_default_sidebar_layout'                => 'no_sidebar_full_width',
	'colormag_page_sidebar_layout'                   => 'no_sidebar_full_width',
	'colormag_header_search_icon_color'              => '#000000',
	'colormag_date_color'                            => '#F4F4F4',
);
