<?php
$container_layout_choices = apply_filters(
	'colormag_container_layout_choices',
	array(
		'default'                     => array(
			'label' => 'Inherit',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/inherit.svg',
		),
		'no_sidebar_full_width'       => array(
			'label' => 'Normal',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/normal.svg',
		),
		'no_sidebar_content_centered' => array(
			'label' => 'Narrow',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/narrow.svg',
		),
	)
);

$sidebar_layout_choices = apply_filters(
	'colormag_site_layout_choices',
	array(
		'default'       => array(
			'label' => 'Inherit',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/inherit.svg',
		),
		'no_sidebar'    => array(
			'label' => 'No Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/no-sidebar.svg',
		),
		'right_sidebar' => array(
			'label' => 'Right Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
		),
		'left_sidebar'  => array(
			'label' => 'Left Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
		),
	)
);
$options                = apply_filters(
	'colormag_single_post_options',
	array(
		'colormag_single_post_container_tab_group'    => array(
			'type'      => 'customind-tabs',
			'title'     => esc_html__( 'Single Post', 'colormag' ),
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tabs'      => array(
				'general' => esc_html__( 'General', 'colormag' ),
				'style'   => esc_html__( 'Style', 'colormag' ),
			),
			'default'   => 'general',
		),
		'colormag_single_post_container_layout'       => array(
			'default'   => 'default',
			'type'      => 'customind-radio-image',
			'title'     => esc_html__( 'Container Layout', 'colormag' ),
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tab'       => 'general',
			'choices'   => $container_layout_choices,
			'columns'   => 2,
			'priority'  => 10,
		),
		'colormag_single_post_sidebar_layout_divider' => array(
			'type'      => 'customind-divider',
			'variant'   => 'dashed',
			'tab'       => 'general',
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
		),
		'colormag_single_post_sidebar_layout'         => array(
			'default'    => 'default',
			'type'       => 'customind-radio-image',
			'title'      => esc_html__( 'Sidebar Layout', 'colormag' ),
			'section'    => 'colormag_single_post_section',
			'tab_group'  => 'colormag_single_post_container_tab_group',
			'tab'        => 'general',
			'choices'    => $sidebar_layout_choices,
			'columns'    => 2,
			'priority'   => 10,
			'conditions' => array(
				'relation' => 'OR',
				'terms'    => array(
					// Simple condition
					array(
						'id'       => 'colormag_single_post_container_layout',
						'operator' => '===',
						'value'    => 'no_sidebar_full_width',
					),
					// Nested condition
					array(
						'relation' => 'AND',
						'terms'    => array(
							array(
								'id'       => 'colormag_single_post_container_layout',
								'operator' => '===',
								'value'    => 'default',
							),
							array(
								'id'       => 'colormag_global_container_layout',
								'operator' => '===',
								'value'    => 'no_sidebar_full_width',
							),
						),
					),
				),
			),
		),
		'colormag_single_post_layout_divider'         => array(
			'type'       => 'customind-divider',
			'variant'    => 'dashed',
			'tab'        => 'general',
			'section'    => 'colormag_single_post_section',
			'tab_group'  => 'colormag_single_post_container_tab_group',
			'conditions' => array(
				'relation' => 'OR',
				'terms'    => array(
					// Simple condition
					array(
						'id'       => 'colormag_single_post_container_layout',
						'operator' => '===',
						'value'    => 'no_sidebar_full_width',
					),
					// Nested condition
					array(
						'relation' => 'AND',
						'terms'    => array(
							array(
								'id'       => 'colormag_single_post_container_layout',
								'operator' => '===',
								'value'    => 'default',
							),
							array(
								'id'       => 'colormag_global_container_layout',
								'operator' => '===',
								'value'    => 'no_sidebar_full_width',
							),
						),
					),
				),
			),
		),
		'colormag_single_post_elements_heading'       => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Post Elements', 'colormag' ),
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tab'       => 'general',
		),
		'colormag_single_post_elements'               => array(
			'type'      => 'customind-sortable-v2',
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tab'       => 'general',
			'choices'   => array(
				'post_format' => array(
					'label'    => 'Image',
					'controls' => array(
						'colormag_enable_featured_image' => array(
							'title'     => esc_html__( 'Enable', 'colormag' ),
							'default'   => true,
							'type'      => 'customind-toggle',
							'tab'       => 'general',
							'section'   => 'colormag_single_post_section',
							'tab_group' => 'colormag_single_post_container_tab_group',
							'transport' => 'refresh',
						),
						'colormag_enable_lightbox'       => array(
							'title'     => esc_html__( 'LightBox', 'colormag' ),
							'default'   => false,
							'type'      => 'customind-toggle',
							'tab'       => 'general',
							'section'   => 'colormag_single_post_section',
							'tab_group' => 'colormag_single_post_container_tab_group',
							'transport' => 'refresh',
							'condition' => array(
								'colormag_enable_featured_image' => true,
							),
						),
					),
				),
				'category'    => array(
					'label'    => 'category',
					'controls' => array(),
				),
				'title'       => array(
					'label'    => 'title',
					'controls' => array(),
				),
				'meta'        => array(
					'label'    => 'meta',
					'controls' => array(),
				),
				'content'     => array(
					'label'    => 'content',
					'controls' => array(),
				),
			),
			'default'   => array(
				'post_format',
				'category',
				'title',
				'meta',
				'content',
			),
		),
		'colormag_single_post_meta_heading'           => array(
			'type'        => 'customind-heading',
			'title'       => esc_html__( 'Post Meta', 'colormag' ),
			'section'     => 'colormag_single_post_section',
			'tab_group'   => 'colormag_single_post_container_tab_group',
			'description' => esc_html__( 'Manage the post meta elements such as Categories, Author, Date, Comments, Tags, etc.', 'colormag' ),
			'tab'         => 'general',
		),
		'colormag_single_post_meta_structure'         => array(
			'type'      => 'customind-sortable-v2',
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tab'       => 'general',
			'choices'   => array(
				'author'      => array(
					'label'    => 'author',
					'controls' => array(),
				),
				'date'        => array(
					'label'    => 'date',
					'controls' => array(),
				),
				'views'       => array(
					'label'    => 'views',
					'controls' => array(),
				),
				'comments'    => array(
					'label'    => 'comments',
					'controls' => array(),
				),
				'tags'        => array(
					'label'    => 'content',
					'controls' => array(),
				),
				'read-time'   => array(
					'label'    => 'read-time',
					'controls' => array(),
				),
				'edit-button' => array(
					'label'    => 'edit-button',
					'controls' => array(),
				),
			),
			'default'   => array(
				'categories',
				'date',
				'author',
			),
		),
		'colormag_single_post_title_typography'       => array(
			'default'   => array(
				'font-family'    => 'default',
				'font-weight'    => '500',
				'font-size'      => array(
					'desktop' => array(
						'size' => '',
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
			'title'     => esc_html__( 'Font', 'colormag' ),
			'transport' => 'postMessage',
			'tab'       => 'style',
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
		),
		'colormag_related_posts_heading'              => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Related Posts', 'colormag' ),
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'tab'       => 'general',
		),
		'colormag_enable_related_posts'               => array(
			'title'     => esc_html__( 'Enable', 'colormag' ),
			'default'   => false,
			'type'      => 'customind-toggle',
			'section'   => 'colormag_single_post_section',
			'tab_group' => 'colormag_single_post_container_tab_group',
			'transport' => 'refresh',
			'tab'       => 'general',
			'partial'   => array(
				'selector' => '.related-posts',
			),
		),
		'colormag_related_posts_query'                => array(
			'default'   => 'categories',
			'type'      => 'customind-select',
			'title'     => esc_html__( 'Query', 'colormag' ),
			'section'   => 'colormag_single_post_section',
			'tab'       => 'general',
			'choices'   => array(
				'categories' => esc_html__( 'Categories', 'colormag' ),
				'tags'       => esc_html__( 'Tags', 'colormag' ),
			),
			'condition' => array(
				'colormag_enable_related_posts' => true,
			),
		),
		'colormag_single_post_upgrade'                => array(
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Author Bio options', 'colormag' ),
				esc_html__( 'Related posts options', 'colormag' ),
				esc_html__( 'Single post image size', 'colormag' ),
				esc_html__( 'Autoload posts options', 'colormag' ),
				esc_html__( 'Post Navigation options', 'colormag' ),
				esc_html__( 'Social share button options', 'colormag' ),
				esc_html__( 'Flyout Related Posts options', 'colormag' ),
				esc_html__( 'Single post tile color option', 'colormag' ),
				esc_html__( 'Comment title typography option', 'colormag' ),
				esc_html__( 'Reading Progress Indicator options', 'colormag' ),

			),
			'section'     => 'colormag_single_post_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
