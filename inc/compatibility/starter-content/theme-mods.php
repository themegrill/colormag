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
				'right'  => array( 'secondary-menu', 'search' ),
			),
			'bottom' => array(
				'left'   => array( 'primary-menu' ),
				'center' => array(),
				'right'  => array( 'random' ),
			),
		),
		'mobile'  => array(
			'top'    => array(
				'left'   => array(),
				'center' => array( 'date' ),
				'right'  => array(),
			),
			'main'   => array(
				'left'   => array(),
				'center' => array(
					'logo',
				),
				'right'  => array(),
			),
			'bottom' => array(
				'left'   => array(
					'toggle-button',
				),
				'center' => array(),
				'right'  => array( 'random' ),
			),
		),
		'offset'  => array(
			'mobile-menu',
		),
	),
	'colormag_footer_builder'                        => array(
		'desktop' => array(
			'top'    => array(
				'top-1' => array(),
				'top-2' => array(),
				'top-3' => array(),
				'top-4' => array(),
				'top-5' => array(),
			),
			'main'   => array(
				'main-1' => array(),
				'main-2' => array(),
				'main-3' => array(),
				'main-4' => array(),
				'main-5' => array(),
			),
			'bottom' => array(
				'bottom-1' => array( 'copyright' ),
				'bottom-2' => array( 'footer-menu' ),
				'bottom-3' => array(),
				'bottom-4' => array(),
				'bottom-5' => array(),
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
	'colormag_footer_bottom_area_background'         => array(
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
	'colormag_header_primary_menu_active_text_color' => '#c57eef',
	'colormag_header_primary_menu_text_color'        => '#FFFFFF',
	'colormag_header_primary_menu_selected_hovered_text_color' => '#c57eef',
	'colormag_header_primary_menu_hover_background'  => 'transparent',
	'colormag_header_primary_menu_active_background' => '#252728',
	'colormag_default_sidebar_layout'                => 'no_sidebar_full_width',
	'colormag_page_sidebar_layout'                   => 'no_sidebar_full_width',
	'colormag_header_search_icon_color'              => '#000000',
	'colormag_date_color'                            => '#F4F4F4',
	'colormag_header_search_type'                    => 'search-icon-input',
	'colormag_header_search_background'              => '#FFFFFF24',
	'colormag_header_search_text_color'              => '#FFFFFF',
	'colormag_header_secondary_menu_text_color'      => '#FFFFFF',
	'colormag_date_display_type'                     => 'wordpress_date_setting',
	'colormag_header_random_icon_color'              => '#FFFFFF',
	'colormag_header_bottom_area_border_color'       => '#383838',
	'colormag_header_top_area_border_color'          => '#383838',
	'colormag_footer_bottom_area_border_color'       => '#383838',
	'colormag_footer_copyright_text_color'           => '#BDBDBD',
	'colormag_footer_bottom_area_color'              => '#BDBDBD',
	'colormag_footer_menu_color'                     => '#BDBDBD',
	'colormag_footer_menu'                           => '#BDBDBD',
	'colormag_header_builder_toggle_button_color'    => '#FFFFFF',
	'colormag_news_ticker_color'                     => '#FFFFFF',
	'colormag_news_ticker_link_color'                => '#d3d3d3',
	'colormag_header_search_border_color'            => '#EBEBEC1A',
	'colormag_header_search_placeholder_color'       => '#FFFFFF',
	'colormag_header_socials_color'                  => '#FFFFFF',
	'colormag_header_site_identity_color'            => '#F5F5F5',
	'colormag_header_socials_style'                  => 'style-1',
	'colormag_enable_page_header'                    => false,
	'colormag_enable_site_identity'                  => true,
	'colormag_enable_site_tagline'                   => false,
	'blogname'                                       => 'ColorMag',
	'colormag_news_ticker_label'                     => 'Trending :',
	'colormag_header_search_width'                   => array(
		'size'  => 300,
		'units' => 'px',
	),
	'colormag_header_random_icon_size'               => array(
		'size'  => 20,
		'units' => 'px',
	),
	'colormag_header_top_area_border_width'          => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '1',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_bottom_area_padding'            => array(
		'top'    => '6',
		'right'  => '0',
		'bottom' => '6',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_content_area_padding'                  => array(
		'top'    => '20',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_top_area_padding'               => array(
		'top'    => '15',
		'right'  => '0',
		'bottom' => '15',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_main_area_padding'              => array(
		'top'    => '24',
		'right'  => '0',
		'bottom' => '24',
		'left'   => '0',
		'units'  => 'px',
	),
	'colormag_header_secondary_menu_typography'      => array(
		'font-family' => 'Inter',
		'font-size'   => array(
			'desktop' => array(
				'size' => '13',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),

	),
	'colormag_header_primary_menu_typography'        => array(
		'font-family' => 'Inter',
		'font-weight' => '500',
		'font-size'   => array(
			'desktop' => array(
				'size' => '15',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
	),
	'colormag_header_primary_menu_typography'        => array(
		'font-family'    => 'Inter',
		'font-weight'    => '500',
		'font-size'      => array(
			'desktop' => array(
				'size' => '15',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
		'line-height'    => array(
			'desktop' => array(
				'size' => '1.6',
				'unit' => '-',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '-',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '-',
			),
		),
		'font-style'     => 'normal',
		'text-transform' => 'capitalize',
	),
	'colormag_footer_menu_typography'                => array(
		'font-family' => 'Inter',
	),
	'colormag_header_socials'                        => array(
		array(
			'id'    => uniqid(),
			'label' => 'facebook',
			'url'   => '#',
			'icon'  => 'fa-brands fa-facebook-f',
		),
		array(
			'id'    => uniqid(),
			'label' => 'twitter',
			'url'   => '#',
			'icon'  => 'fa-brands fa-x-twitter',
		),
		array(
			'id'    => uniqid(),
			'label' => 'instagram',
			'url'   => '#',
			'icon'  => 'fa-brands fa-instagram',
		),
		array(
			'id'    => uniqid(),
			'label' => 'youtube',
			'url'   => '#',
			'icon'  => 'fa-brands fa-youtube',
		),
	),
	'colormag_date_typography'                       => array(
		'font-family' => 'Inter',
		'font-weight' => '400',
		'font-size'   => array(
			'desktop' => array(
				'size' => '13',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
	),
	'colormag_news_ticker_typography'                => array(
		'font-family' => 'Inter',
		'font-weight' => '600',
		'font-size'   => array(
			'desktop' => array(
				'size' => '13',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
	),
	'colormag_news_ticker_content_typography'        => array(
		'font-family' => 'Inter',
		'font-weight' => '600',
		'font-size'   => array(
			'desktop' => array(
				'size' => '13',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
	),
	'colormag_header_site_title_typography'          => array(
		'font-family' => 'Ibm Plex Serif',
		'font-weight' => '700',
		'font-size'   => array(
			'desktop' => array(
				'size' => '28',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
	),
);
