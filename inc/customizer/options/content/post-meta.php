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
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_post_meta_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
