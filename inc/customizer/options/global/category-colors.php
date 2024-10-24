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
		'type'    => 'customind-title',
		'title'   => esc_html__( 'Categories Colors', 'colormag' ),
		'section' => 'colormag_category_colors_section',
	),
	'colormag_category_color_divider' => array(
		'type'    => 'customind-divider',
		'variant' => 'solid',
		'section' => 'colormag_category_colors_section',
	),
);

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
	'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
	'section'     => 'colormag_category_colors_section',
	'priority'    => 1000,
);

colormag_customind()->add_controls( $options );
