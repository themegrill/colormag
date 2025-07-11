<?php

// Category color options.
$args           = array(
	'orderby'    => 'id',
	'hide_empty' => 0,
);
$categories     = get_categories( $args );
$priority_count = 110;

$options = array(
	'colormag_category_color_heading' => array(
		'type'     => 'customind-title',
		'title'    => esc_html__( 'Categories Colors', 'colormag' ),
		'section'  => 'colormag_category_colors_section',
		'priority' => 1,
	),

	'colormag_category_color_divider' => array(
		'type'     => 'customind-divider',
		'variant'  => 'solid',
		'section'  => 'colormag_category_colors_section',
		'priority' => 3,
	),
);

if ( function_exists( 'magazine_blocks' ) ) {
	$options['colormag_enable_override_category_color'] = array(
		'title'       => esc_html__( 'Override for Magazine Blocks', 'colormag' ),
		'description' => esc_html__( 'Enabling will override the magazine block global category colors', 'colormag' ),
		'default'     => false,
		'type'        => 'customind-toggle',
		'section'     => 'colormag_category_colors_section',
		'priority'    => 2,
	);
}

foreach ( $categories as $category_list ) {
	$options[ 'colormag_category_color_' . get_cat_id( $category_list->cat_name ) ] = array(
		'title'    => $category_list->cat_name,
		'default'  => '',
		'type'     => 'customind-color',
		'section'  => 'colormag_category_colors_section',
		'priority' => $priority_count,
	);
	++$priority_count;
}

$options['colormag_category_color_upgrade'] = array(
	'type'        => 'customind-upsell',
	'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
	'title'       => esc_html__( 'Learn more', 'colormag' ),
	'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
	'section'     => 'colormag_category_colors_section',
	'priority'    => 1000,
);

colormag_customind()->add_controls( $options );
