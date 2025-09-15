<?php

function customind_get_footer_components() {

	return array(

		'desktop' => array_filter(
			array(
				array(
					'name'    => __( 'HTML 1', 'colormag' ),
					'section' => 'colormag_footer_builder_html_1',
					'id'      => 'html-1',
				),
				array(
					'name'     => __( 'Widget 1', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_1',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_one_upper',
					'id'       => 'widget-1',
				),
				array(
					'name'     => __( 'Widget 2', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_2',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_two_upper',
					'id'       => 'widget-2',
				),
				array(
					'name'     => __( 'Widget 3', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_3',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_three_upper',
					'id'       => 'widget-3',
				),
				array(
					'name'     => __( 'Widget 4', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_4',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_one',
					'id'       => 'widget-4',
				),
				array(
					'name'     => __( 'Widget 5', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_5',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_two',
					'id'       => 'widget-5',
				),
				array(
					'name'     => __( 'Widget 6', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_6',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_three',
					'id'       => 'widget-6',
				),
				array(
					'name'     => __( 'Widget 7', 'colormag' ),
					'section'  => 'colormag_footer_builder_widget_7',
					'section2' => 'sidebar-widgets-colormag_footer_sidebar_four',
					'id'       => 'widget-7',
				),
				array(
					'name'    => __( 'Menu 1', 'colormag' ),
					'section' => 'colormag_footer_builder_footer_menu',
					'id'      => 'footer-menu',
				),
				array(
					'name'    => __( 'Socials', 'colormag' ),
					'section' => 'colormag_footer_builder_socials',
					'id'      => 'socials',
				),
				array(
					'name'    => __( 'Copyright', 'colormag' ),
					'section' => 'colormag_footer_builder_copyright',
					'id'      => 'copyright',
				),
			)
		),
	);
}

$options = array(
	'colormag_footer_builder_components' => array(
		'type'    => 'customind-builder-components',
		'choices' => customind_get_footer_components(),
		'context' => 'footer',
		'group'   => 'colormag_footer_builder',
		'section' => 'colormag_footer_builder_section',
	),
	'colormag_footer_builder'            => array(
		'section'             => 'colormag_footer_builder_section',
		'type'                => 'customind-footer-builder',
		'transport'           => 'postMessage',
		'components'          => customind_get_footer_components(),
		'default'             => array(
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
					'bottom-2' => array(),
					'bottom-3' => array(),
					'bottom-4' => array(),
					'bottom-5' => array(),
				),
			),
		),
		'areas'               => array(
			array(
				'name'    => 'Top',
				'id'      => 'top',
				'section' => 'colormag_footer_builder_top_area',
				'areas'   => array(
					array(
						'name'    => 'Top 1',
						'id'      => 'top-1',
						'section' => '',
					),
					array(
						'name'    => 'Top 2',
						'id'      => 'top-2',
						'section' => '',
					),
					array(
						'name'    => 'Top 3',
						'id'      => 'top-3',
						'section' => '',
					),
					array(
						'name'    => 'Top 4',
						'id'      => 'top-4',
						'section' => '',
					),
					array(
						'name'    => 'Top 5',
						'id'      => 'top-5',
						'section' => '',
					),
					array(
						'name'    => 'Top 6',
						'id'      => 'top-6',
						'section' => '',
					),
				),
			),
			array(
				'name'    => 'Main',
				'id'      => 'main',
				'section' => 'colormag_footer_builder_main_area',
				'areas'   => array(
					array(
						'name'    => 'Main 1',
						'id'      => 'main-1',
						'section' => '',
					),
					array(
						'name'    => 'Main 2',
						'id'      => 'main-2',
						'section' => '',
					),
					array(
						'name'    => 'Main 3',
						'id'      => 'main-3',
						'section' => '',

					),
					array(
						'name'    => 'Main 4',
						'id'      => 'main-4',
						'section' => '',
					),

					array(
						'name'    => 'Main 5',
						'id'      => 'main-5',
						'section' => '',
					),
					array(
						'name'    => 'Main 6',
						'id'      => 'main-6',
						'section' => '',
					),
				),
			),
			array(
				'name'    => 'Bottom',
				'id'      => 'bottom',
				'section' => 'colormag_footer_builder_bottom_area',
				'areas'   => array(
					array(
						'name'    => 'Bottom 1',
						'id'      => 'bottom-1',
						'section' => '',
					),
					array(
						'name'    => 'Bottom 2',
						'id'      => 'bottom-2',
						'section' => '',
					),
					array(
						'name'    => 'Bottom 3',
						'id'      => 'bottom-3',
						'section' => '',
					),
					array(
						'name'    => 'Bottom 4',
						'id'      => 'bottom-4',
						'section' => '',
					),
					array(
						'name'    => 'Bottom 5',
						'id'      => 'bottom-5',
						'section' => '',
					),
					array(
						'name'    => 'Bottom 6',
						'id'      => 'bottom-6',
						'section' => '',
					),
				),
			),
		),
		'top_row_controls'    => array(
			'row' => 'colormag_footer_top_area_cols',
		),
		'main_row_controls'   => array(
			'row' => 'colormag_footer_main_area_cols',
		),
		'bottom_row_controls' => array(
			'row' => 'colormag_footer_bottom_area_cols',
		),
		'partial'             => array(
			'selector'            => '.cm-footer-builder',
			'container_inclusive' => true,
			'render_callback'     => function () {
				colormag_footer_builder_markup();
			},
		),
	),
);

colormag_customind()->add_controls( $options );
