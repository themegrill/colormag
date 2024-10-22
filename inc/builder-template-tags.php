<?php
/**
 * Header builder markup for this theme
 *
 * @package colormag
 */

function colormag_header_default_builder() {
	return array(
		'desktop' => array(
			'top'    => array(
				'left'   => array(),
				'center' => array(),
				'right'  => array(),
			),
			'main'   => array(
				'left'   => array(
					'logo',
				),
				'center' => array(),
				'right'  => array(),
			),
			'bottom' => array(
				'left'   => array(
					'primary-menu',
				),
				'center' => array(),
				'right'  => array(),
			),
		),
		'mobile'  => array(
			'top'    => array(
				'left'   => array(),
				'center' => array(),
				'right'  => array(),
			),
			'main'   => array(
				'left'   => array(),
				'centre' => array(
					'logo',
				),
				'right'  => array(),
			),
			'bottom' => array(
				'left'   => array(
					'toggle-button',
				),
				'center' => array(),
				'right'  => array(),
			),
		),
		'offset'  => array(
			'mobile-menu',
		),
	);
}

function colormag_get_area_class( $id ) {
	return str_replace( 'colormag-builder-', '', str_replace( '_', '-', $id ) );
}

/**
 * @param $cols - array of elements
 * @param $cols_area - left, center, right
 *
 * @return void
 */
function colormag_render_header_cols( $cols, $cols_area ) {
	echo '<div class="cm-header-' . esc_attr( colormag_get_area_class( $cols_area ) ) . '-col">';
	foreach ( $cols as $element ) {
		do_action( 'colormag_header_template_parts', $element );
		get_template_part( "template-parts/header-builder-elements/$element", '' );
	}
	echo '</div>';
}

function colormag_header_builder_markup() {
	$classes = colormag_css_class( 'colormag_header_class', false );

	// Convert the class list string into an array
	$classes_array = explode( ' ', $classes );

	// Remove the class 'cm-header'
	if ( ( $key = array_search( 'cm-header', $classes_array ) ) !== false ) {
		unset( $classes_array[ $key ] );
	}

	// Join the remaining classes into a string
	$class_string = implode( ' ', $classes_array );
	echo '<header id="cm-masthead" class="cm-header-builder ' . $class_string . '">';

	/**
	 * Hook - colormag_action_before_header
	 *
	 * @hooked colormag_header_start - 10
	 * @hooked colormag_transparent_header_start - 20
	 */
	do_action( 'colormag_action_before_header' );

	/**
	 * Hook - colormag_header_builder_inside_markup
	 *
	 * @hooked colormag_header_builder_inside_markup - 10
	 */
	do_action( 'colormag_header_builder_inside_markup' );

	/**
	 * Hook - colormag_header_builder_inside_markup
	 *
	 * @hooked colormag_header_builder_inside_markup - 10
	 */
	do_action( 'colormag_action_after_header' );
	echo '</header>';

	/**
	 * Hook - colormag_page_header
	 *
	 * @hooked colormag_page_header - 10
	 */
	do_action( 'colormag_page_header' );
}
$enable_builder = get_theme_mod( 'colormag_enable_builder', false );
if ( $enable_builder || colormag_maybe_enable_builder() ) {
	add_action( 'colormag_header', 'colormag_header_builder_markup' );
}

function colormag_header_builder_inside_markup() {

	$builder = get_theme_mod( 'colormag_header_builder', colormag_header_default_builder() );
	$builder = apply_filters( 'colormag_header_builder_options', $builder );

	echo '<div class="cm-row cm-desktop-row  cm-main-header">';
	$desktop_builder = filter_areas( $builder, 'desktop' );
	colormag_render_header_rows( $desktop_builder, 'desktop' );
	echo '</div>';

	echo '<div class="cm-row cm-mobile-row">';
	$mobile_builder = filter_areas( $builder, 'mobile' );
	colormag_render_header_rows( $mobile_builder, 'mobile' );
	echo '</div>';
}
add_action( 'colormag_header_builder_inside_markup', 'colormag_header_builder_inside_markup' );

function filter_areas( $builder, $device ) {
	return array_filter(
		isset( $builder[ $device ] ) ? $builder[ $device ] : colormag_header_default_builder()[ $device ],
		function ( $row ) {
			foreach ( $row as $cols ) {
				if ( ! empty( $cols ) ) {
					return true;
				}
			}
			return false;
		}
	);
}


function colormag_render_header_rows( $builder, $device ) {

	foreach ( $builder as $area => $row ) {
		if ( 'desktop' === $device && 'top' === $area ) {
			do_action( 'colormag_before_header_top' );
		}

		if ( apply_filters( 'colormag_disable_header_area', false, $area, $row, $builder ) ) {
			continue;
		}

		echo '<div class="cm-header-' . esc_attr( colormag_get_area_class( $area ) ) . '-row">';
		echo '<div class="cm-container">';
		echo '<div class="cm-' . esc_attr( colormag_get_area_class( $area ) ) . '-row">';

		foreach ( $row as $cols_area => $cols ) {
			colormag_render_header_cols( $cols, $cols_area );
		}

		echo '</div>';
		echo '</div>';
		echo '</div>';

		if ( 'desktop' === $device && 'top' === $area ) {
			do_action( 'colormag_after_header_top' );
		}
	}
}

// Footer builder markup.
function colormag_footer_builder_default() {
	return array(
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
		'offset'  => array(
			'mobile-menu',
		),
	);
}

function colormag_footer_get_area_class( $id ) {
	return str_replace( 'colormag-builder-', '', str_replace( '_', '-', $id ) );
}

function colormag_render_footer_cols( $cols, $cols_area ) {
	echo '<div class="cm-footer-' . esc_attr( colormag_footer_get_area_class( $cols_area ) ) . '-col">';
	foreach ( $cols as $element ) {
		get_template_part( "template-parts/footer-builder-elements/$element", '' );
	}
	echo '</div>';
}

function colormag_footer_builder_markup() {
	$footer_builder = get_theme_mod( 'colormag_footer_builder', colormag_footer_builder_default() );
	$footer_builder = apply_filters( 'colormag_footer_builder_options', $footer_builder );

	if ( empty( $footer_builder ) ) {
		return;
	}
	echo '<footer id="cm-footer" class="cm-footer cm-footer-builder">';
	echo '<div class="cm-row cm-footer-desktop-row">';
	foreach ( $footer_builder['desktop'] as $area => $row ) {
		$non_empty_row = array_filter(
			array_map(
				function ( $r ) {
					return ! empty( $r );
				},
				$row
			)
		);

		if ( empty( $non_empty_row ) ) {
			continue;
		}

		if ( apply_filters( 'colormag_disable_footer_area', false, $area, $row, $footer_builder ) ) {
			continue;
		}

		echo '<div class="cm-footer-' . esc_attr( colormag_footer_get_area_class( $area ) ) . '-row" >';
		echo '<div class="cm-container" >';
		$classes = apply_filters(
			'colormag_footer_row_classes',
			array(
				'cm-' . esc_attr( colormag_footer_get_area_class( $area ) ) . '-row',
			),
			$area
		);
		echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
		$i       = 1;
		$top_row = get_theme_mod( 'colormag_footer_' . $area . '_area_cols', ( 'top' === $area || 'main' === $area ) ? 4 : 1 );
		$top_row = apply_filters( 'colormag_footer_' . $area . '_area_cols', $top_row );

		foreach ( $row as $cols_area => $cols ) {
			if ( $i <= $top_row ) {
				colormag_render_footer_cols( $cols, $cols_area );
			}
			++$i;
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	echo '</footer>';
}

$enable_builder = get_theme_mod( 'colormag_enable_builder', false );
if ( $enable_builder || colormag_maybe_enable_builder() ) {
	add_action( 'colormag_builder_footer', 'colormag_footer_builder_markup' );
}
