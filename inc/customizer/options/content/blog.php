<?php

$options = apply_filters(
	'colormag_blog_options',
	array(
		'colormag_post_elements_heading'   => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Post Elements', 'colormag' ),
			'section'      => 'colormag_blog_section',
			'sub_controls' => apply_filters(
				'colormag_post_elements_sub_controls',
				array(
					'colormag_blog_post_elements' => array(
						'type'        => 'customind-sortable',
						'title'       => esc_html__( 'Post Elements', 'colormag' ),
						'section'     => 'colormag_blog_section',
						'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
						'choices'     => array(
							'post_format' => esc_attr__( 'Post Format (Image)', 'colormag' ),
							'category'    => esc_attr__( 'Category', 'colormag' ),
							'meta'        => esc_attr__( 'Meta Tags', 'colormag' ),
							'title'       => esc_attr__( 'Title', 'colormag' ),
							'content'     => esc_attr__( 'Content', 'colormag' ),
						),
						'default'     => array(
							'post_format',
							'category',
							'meta',
							'title',
							'content',
						),
						'condition'   => apply_filters( 'colormag_structure_archive_blog_order', false ),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_blog_post_elements_accordion_collapsible', false ),
		),
		'colormag_blog_post_title_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Post title', 'colormag' ),
			'section'      => 'colormag_blog_section',
			'sub_controls' => apply_filters(
				'colormag_blog_post_title_sub_controls',
				array(
					'colormag_blog_post_title_typography' => array(
						'default'   => array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'font-size'      => array(
								'desktop' => array(
									'size' => '24',
									'unit' => 'px',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => 'px',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => 'px',
								),
							),
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.3',
									'unit' => '',
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
							'font-style'     => 'normal',
							'text-transform' => 'none',
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_blog_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_blog_post_title_accordion_collapsible', false ),
		),
		'colormag_blog_post_date_heading'  => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Post Date', 'colormag' ),
			'section'      => 'colormag_blog_section',
			'sub_controls' => apply_filters(
				'colormag_blog_post_date_type_sub_controls',
				array(
					'colormag_blog_post_date_type' => array(
						'default' => 'post-date',
						'type'    => 'customind-select',
						'title'   => esc_html__( 'Type', 'colormag' ),
						'section' => 'colormag_blog_section',
						'choices' => array(
							'post-date'     => esc_html__( 'Post Date', 'colormag' ),
							'modified-date' => esc_html__( 'Modified Date', 'colormag' ),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_blog_post_date_accordion_collapsible', false ),
		),
		'colormag_blog_content_heading'    => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Excerpt', 'colormag' ),
			'section'      => 'colormag_blog_section',
			'sub_controls' => apply_filters(
				'colormag_blog_excerpt_sub_controls',
				array(
					'colormag_blog_content_excerpt_type' => array(
						'default' => 'excerpt',
						'type'    => 'customind-select',
						'title'   => esc_html__( 'Type', 'colormag' ),
						'section' => 'colormag_blog_section',
						'choices' => array(
							'excerpt' => esc_html__( 'Excerpt', 'colormag' ),
							'content' => esc_html__( 'Full Content', 'colormag' ),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_blog_excerpt_accordion_collapsible', false ),
		),
		'colormag_pagination_heading'      => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Pagination', 'colormag' ),
			'section'      => 'colormag_blog_section',
			'sub_controls' => apply_filters(
				'colormag_pagination_sub_controls',
				array(
					'colormag_enable_pagination' => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => true,
						'type'    => 'customind-toggle',
						'section' => 'colormag_blog_section',
					),
					'colormag_pagination_type'   => array(
						'default'   => 'default',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Type', 'colormag' ),
						'section'   => 'colormag_blog_section',
						'choices'   => array(
							'default'             => esc_html__( 'Default', 'colormag' ),
							'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
						),
						'condition' => array(
							'colormag_enable_pagination' => true,
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_pagination_accordion_collapsible', false ),
		),
		'colormag_blog_upgrade'            => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_blog_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
