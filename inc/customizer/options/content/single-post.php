<?php

$options = apply_filters(
	'colormag_single_post_options',
	array(
		'colormag_single_post_elements_heading'  => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Post Elements', 'colormag' ),
			'section'      => 'colormag_single_post_section',
			'sub_controls' => apply_filters(
				'colormag_single_post_elements_sub_controls',
				array(
					'colormag_single_post_elements' => array(
						'type'        => 'customind-sortable',
						'title'       => esc_html__( 'Post Elements', 'colormag' ),
						'section'     => 'colormag_single_post_section',
						'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
						'choices'     => array(
							'category' => esc_attr__( 'Category', 'colormag' ),
							'title'    => esc_attr__( 'Title', 'colormag' ),
							'meta'     => esc_attr__( 'Meta Tags', 'colormag' ),
							'content'  => esc_attr__( 'Content', 'colormag' ),
						),
						'default'     => array(
							'category',
							'title',
							'meta',
							'content',
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_single_post_elements_accordion_collapsible', false ),
		),
		'colormag_single_featured_image_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Featured Image', 'colormag' ),
			'section'      => 'colormag_single_post_section',
			'sub_controls' => apply_filters(
				'colormag_single_featured_image_sub_controls',
				array(
					'colormag_enable_featured_image' => array(
						'title'   => esc_html__( 'Enable', 'zakra' ),
						'default' => true,
						'type'    => 'customind-toggle',
						'section' => 'colormag_single_post_section',
					),
					'colormag_enable_lightbox'       => array(
						'title'     => esc_html__( 'LightBox', 'zakra' ),
						'default'   => 0,
						'type'      => 'customind-toggle',
						'section'   => 'colormag_single_post_section',
						'condition' => array(
							'colormag_enable_featured_image' => true,
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_single_featured_image_accordion_collapsible', false ),
		),
		'colormag_related_posts_heading'         => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Related Posts', 'colormag' ),
			'section'      => 'colormag_single_post_section',
			'sub_controls' => apply_filters(
				'colormag_related_posts_sub_controls',
				array(
					'colormag_enable_related_posts' => array(
						'title'   => esc_html__( 'Enable', 'zakra' ),
						'default' => false,
						'type'    => 'customind-toggle',
						'section' => 'colormag_single_post_section',
					),
					'colormag_related_posts_query'  => array(
						'default'   => 'categories',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Query', 'zakra' ),
						'section'   => 'colormag_single_post_section',
						'choices'   => array(
							'categories' => esc_html__( 'Categories', 'colormag' ),
							'tags'       => esc_html__( 'Tags', 'colormag' ),
						),
						'condition' => array(
							'colormag_enable_related_posts' => true,
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_related_posts_accordion_collapsible', false ),
		),
		'colormag_single_post_upgrade'           => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_single_post_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
