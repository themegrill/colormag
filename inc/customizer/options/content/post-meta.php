<?php

$options = apply_filters(
	'colormag_post_meta_elements_options',
	array(
		'colormag_post_meta_elements_title' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Meta Elements', 'colormag' ),
			'section'      => 'colormag_post_meta_section',
			'sub_controls' => apply_filters(
				'colormag_post_meta_elements_sub_controls',
				array(
					'colormag_post_meta_structure' => array(
						'type'        => 'customind-sortable',
						'title'       => esc_html__( 'Meta Elements', 'colormag' ),
						'section'     => 'colormag_post_meta_section',
						'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
						'choices'     => array(
							'categories'  => esc_attr__( 'Categories', 'colormag' ),
							'author'      => esc_attr__( 'Author', 'colormag' ),
							'date'        => esc_attr__( 'Date', 'colormag' ),
							'views'       => esc_attr__( 'Views', 'colormag' ),
							'comments'    => esc_attr__( 'Comments', 'colormag' ),
							'tags'        => esc_attr__( 'Tags', 'colormag' ),
							'read-time'   => esc_attr__( 'Reading Time', 'colormag' ),
							'edit-button' => esc_attr__( 'Edit button', 'colormag' ),
						),
						'default'     => array(
							'categories',
							'date',
							'author',
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_post_meta_elements_accordion_collapsible', false ),
		),
		'colormag_post_meta_upgrade'        => array(
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Author style', 'colormag' ),
				esc_html__( 'Post date style', 'colormag' ),
				esc_html__( 'Post meta options', 'colormag' ),

			),
			'section'     => 'colormag_post_meta_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
