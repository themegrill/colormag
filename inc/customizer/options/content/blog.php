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

$options = apply_filters(
	'colormag_blog_options',
	array(
		'colormag_blog_container_tab_group'         => array(
			'type'    => 'customind-tabs',
			'title'   => esc_html__( 'Blog', 'colormag' ),
			'section' => 'colormag_blog_archive_section',
			'tabs'    => array(
				'general' => esc_html__( 'General', 'colormag' ),
				'style'   => esc_html__( 'Style', 'colormag' ),
			),
			'default' => 'general',
		),
		'colormag_blog_container_layout'            => array(
			'default'   => 'default',
			'type'      => 'customind-radio-image',
			'title'     => esc_html__( 'Container Layout', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'tab_group' => 'colormag_blog_container_tab_group',
			'tab'       => 'general',
			'choices'   => $container_layout_choices,
			'columns'   => 2,
			'priority'  => 10,
		),
		'colormag_blog_sidebar_layout_divider'      => array(
			'type'      => 'customind-divider',
			'variant'   => 'dashed',
			'tab_group' => 'colormag_blog_container_tab_group',
			'tab'       => 'general',
			'section'   => 'colormag_blog_archive_section',
		),
		'colormag_blog_sidebar_layout'              => array(
			'default'    => 'default',
			'type'       => 'customind-radio-image',
			'title'      => esc_html__( 'Sidebar Layout', 'colormag' ),
			'section'    => 'colormag_blog_archive_section',
			'tab_group'  => 'colormag_blog_container_tab_group',
			'tab'        => 'general',
			'choices'    => $sidebar_layout_choices,
			'columns'    => 2,
			'conditions' => array(
				'relation' => 'OR',
				'terms'    => array(
					// Simple condition
					array(
						'id'       => 'colormag_blog_container_layout',
						'operator' => '===',
						'value'    => 'no_sidebar_full_width',
					),
					// Nested condition
					array(
						'relation' => 'AND',
						'terms'    => array(
							array(
								'id'       => 'colormag_blog_container_layout',
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
		'colormag_blog_layout_divider'              => array(
			'type'       => 'customind-divider',
			'variant'    => 'dashed',
			'tab'        => 'general',
			'tab_group'  => 'colormag_blog_container_tab_group',
			'section'    => 'colormag_blog_archive_section',
			'conditions' => array(
				'relation' => 'OR',
				'terms'    => array(
					// Simple condition
					array(
						'id'       => 'colormag_blog_container_layout',
						'operator' => '===',
						'value'    => 'no_sidebar_full_width',
					),
					// Nested condition
					array(
						'relation' => 'AND',
						'terms'    => array(
							array(
								'id'       => 'colormag_blog_container_layout',
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
		'colormag_blog_post_elements_heading'       => array(
			'type'        => 'customind-heading',
			'tab_group'   => 'colormag_blog_container_tab_group',
			'title'       => esc_html__( 'Post Elements', 'colormag' ),
			'section'     => 'colormag_blog_archive_section',
			'description' => esc_html__( 'Manage the post elements such as Post Format, Category, Title, Meta, Content, etc.', 'colormag' ),
			'tab'         => 'general',
		),
		'colormag_blog_post_elements'               => array(
			'type'      => 'customind-sortable',
			'tab'       => 'general',
			'tab_group' => 'colormag_blog_container_tab_group',
			'section'   => 'colormag_blog_archive_section',
			'choices'   => array(
				'post_format' => esc_attr__( 'Post Format (Image)', 'colormag' ),
				'category'    => esc_attr__( 'Category', 'colormag' ),
				'meta'        => esc_attr__( 'Meta Tags', 'colormag' ),
				'title'       => esc_attr__( 'Title', 'colormag' ),
				'content'     => esc_attr__( 'Content', 'colormag' ),
			),
			'default'   => array(
				'post_format',
				'category',
				'title',
				'meta',
				'content',
			),
			'condition' => apply_filters( 'colormag_blog_post_elements_order', false ),
		),
		'colormag_blog_post_meta_heading'           => array(
			'type'        => 'customind-heading',
			'title'       => esc_html__( 'Post Meta', 'colormag' ),
			'section'     => 'colormag_blog_archive_section',
			'description' => esc_html__( 'Manage the post meta elements such as Categories, Author, Date, Comments, Tags, etc.', 'colormag' ),
			'tab'         => 'general',
			'tab_group'   => 'colormag_blog_container_tab_group',
		),
		'colormag_blog_post_meta_structure'         => array(
			'type'      => 'customind-sortable',
			'section'   => 'colormag_blog_archive_section',
			'tab'       => 'general',
			'tab_group' => 'colormag_blog_container_tab_group',
			'choices'   => array(
				'author'      => esc_attr__( 'Author', 'colormag' ),
				'date'        => esc_attr__( 'Date', 'colormag' ),
				'views'       => esc_attr__( 'Views', 'colormag' ),
				'comments'    => esc_attr__( 'Comments', 'colormag' ),
				'tags'        => esc_attr__( 'Tags', 'colormag' ),
				'read-time'   => esc_attr__( 'Reading Time', 'colormag' ),
				'edit-button' => esc_attr__( 'Edit button', 'colormag' ),
			),
			'default'   => array(
				'categories',
				'date',
				'author',
			),
			'condition' => apply_filters( 'colormag_post_meta_elements_title_order', false ),
		),
		'colormag_blog_post_title_typography'       => array(
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
			'transport' => 'postMessage',

			'tab'       => 'style',
			'title'     => esc_html__( 'Post Title', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'tab_group' => 'colormag_blog_container_tab_group',
		),
		'colormag_blog_post_date_heading'           => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Post Date', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'tab'       => 'general',
			'tab_group' => 'colormag_blog_container_tab_group',
		),
		'colormag_blog_post_date_type'              => array(
			'default'   => 'post-date',
			'type'      => 'customind-select',
			'title'     => esc_html__( 'Type', 'colormag' ),
			'tab'       => 'general',
			'tab_group' => 'colormag_blog_container_tab_group',
			'section'   => 'colormag_blog_archive_section',
			'choices'   => array(
				'post-date'     => esc_html__( 'Post Date', 'colormag' ),
				'modified-date' => esc_html__( 'Modified Date', 'colormag' ),
				'both-date'     => esc_html__( 'Both Date', 'colormag' ),
			),
		),
		'colormag_blog_content_heading'             => array(
			'type'      => 'customind-heading',
			'tab_group' => 'colormag_blog_container_tab_group',
			'title'     => esc_html__( 'Excerpt', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'tab'       => 'general',
		),
		'colormag_blog_content_excerpt_type'        => array(
			'default'   => 'excerpt',
			'type'      => 'customind-select',
			'tab'       => 'general',
			'tab_group' => 'colormag_blog_container_tab_group',
			'title'     => esc_html__( 'Type', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'choices'   => array(
				'excerpt' => esc_html__( 'Excerpt', 'colormag' ),
				'content' => esc_html__( 'Full Content', 'colormag' ),
			),
		),
		'colormag_pagination_heading'               => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Pagination', 'colormag' ),
			'section'   => 'colormag_blog_archive_section',
			'tab_group' => 'colormag_blog_container_tab_group',
			'tab'       => 'general',
		),
		'colormag_enable_pagination'                => array(
			'title'     => esc_html__( 'Enable', 'colormag' ),
			'default'   => true,
			'type'      => 'customind-toggle',
			'section'   => 'colormag_blog_archive_section',
			'tab_group' => 'colormag_blog_container_tab_group',
			'transport' => 'refresh',
			'tab'       => 'general',
		),
		'colormag_pagination_type'                  => array(
			'default'   => 'excerpt',
			'type'      => 'customind-select',
			'title'     => esc_html__( 'Type', 'colormag' ),
			'tab'       => 'general',
			'section'   => 'colormag_blog_archive_section',
			'tab_group' => 'colormag_blog_container_tab_group',
			'choices'   => array(
				'default'             => esc_html__( 'Default', 'colormag' ),
				'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
			),
			'condition' => array(
				'colormag_enable_pagination' => true,
			),
		),
		'colormag_blog_upgrade'                     => array(
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Grid layout', 'colormag' ),
				esc_html__( 'Blog page layout', 'colormag' ),
				esc_html__( 'Post title length', 'colormag' ),
				esc_html__( 'Read More text options', 'colormag' ),
				esc_html__( 'Post meta separator types', 'colormag' ),
				esc_html__( 'Number pagination alignment', 'colormag' ),
				esc_html__( 'Excerpt length and more text', 'colormag' ),
				esc_html__( 'Category page number of posts', 'colormag' ),
				esc_html__( 'Infinite Scroll pagination options', 'colormag' ),
				esc_html__( 'Feature image caption, lightbox and size', 'colormag' ),
			),
			'section'     => 'colormag_blog_archive_section',
			'priority'    => 100,
		),

		'colormag_site_identity_navigation'         => array(
			'title'    => esc_html__( 'Site Identity', 'colormag' ),
			'type'     => 'customind-navigation',
			'section'  => 'title_tagline',
			'to'       => 'colormag_header_builder_logo',
			'nav_type' => 'section',
			'priority' => 1,
		),
		'colormag_site_identity_navigation_heading' => array(
			'type'        => 'customind-heading',
			'title'       => esc_html__( 'Site Icon', 'colormag' ),
			'section'     => 'title_tagline',
			'priority'    => 2,
			'description' => esc_html__( 'The Site Icon is what you see in browser tabs, bookmark bars, and within the WordPress mobile apps. It should be square and at least 512 by 512 pixels.', 'colormag' ),
		),
	)
);

colormag_customind()->add_controls( $options );
