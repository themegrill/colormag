<?php

function colormag_get_typography_input_attrs( $value ) {

	$input_attrs = array();

	$default_suffix = array(
		'font-size'      => 'px',
		'line-height'    => '-',
		'letter-spacing' => 'px',
	);

	$suffix = array(
		'font-size'      => array( 'px', 'em', 'rem' ),
		'line-height'    => array( '-', 'px', 'em' ),
		'letter-spacing' => array( 'px' ),
	);

	$input_attrs['suffix']         = $suffix;
	$input_attrs['default_suffix'] = $default_suffix;

	$font_size_attribute = array(
		'px'  => array(
			'min'  => 1,
			'max'  => 200,
			'step' => 1,
		),
		'em'  => array(
			'min'  => 0.1,
			'max'  => 12.5,
			'step' => 0.1,
		),
		'rem' => array(
			'min'  => 0.1,
			'max'  => 12.5,
			'step' => 0.1,
		),
	);

	$line_height_attribute = array(
		'px' => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'em' => array(
			'min'  => 0,
			'max'  => 10,
			'step' => 0.1,
		),
		'-'  => array(
			'min'  => 0,
			'max'  => 10,
			'step' => 0.1,
		),
	);

	$letter_spacing_attribute = array(
		'px' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	);

	$font_size_desktop_unit   = ! empty( $value['font-size']['desktop']['unit'] ) ? $value['font-size']['desktop']['unit'] : 'px';
	$font_size_tablet_unit    = ! empty( $value['font-size']['tablet']['unit'] ) ? $value['font-size']['tablet']['unit'] : 'px';
	$font_size_mobile_unit    = ! empty( $value['font-size']['mobile']['unit'] ) ? $value['font-size']['mobile']['unit'] : 'px';
	$line_height_desktop_unit = ! empty( $value['line-height']['desktop']['unit'] ) ? $value['line-height']['desktop']['unit'] : '-';
	$line_height_tablet_unit  = ! empty( $value['line-height']['tablet']['unit'] ) ? $value['line-height']['tablet']['unit'] : '-';
	$line_height_mobile_unit  = ! empty( $value['line-height']['mobile']['unit'] ) ? $value['line-height']['mobile']['unit'] : '-';
	$letter_spacing_unit      = ! empty( $value['letter-spacing']['desktop']['unit'] ) ? $value['letter-spacing']['desktop']['unit'] : 'px';

	$input_attrs['input_attrs'] = array(
		'attributes'        => array(
			'font-size'      => array(
				'desktop' => $font_size_attribute[ $font_size_desktop_unit ],
				'tablet'  => $font_size_attribute[ $font_size_tablet_unit ],
				'mobile'  => $font_size_attribute[ $font_size_mobile_unit ],
			),
			'line-height'    => array(
				'desktop' => $line_height_attribute[ $line_height_desktop_unit ],
				'tablet'  => $line_height_attribute[ $line_height_tablet_unit ],
				'mobile'  => $line_height_attribute[ $line_height_mobile_unit ],
			),
			'letter-spacing' => array(
				'desktop' => $letter_spacing_attribute[ $letter_spacing_unit ],
				'tablet'  => $letter_spacing_attribute[ $letter_spacing_unit ],
				'mobile'  => $letter_spacing_attribute[ $letter_spacing_unit ],
			),
		),
		'attributes_config' => array(
			'font-size'      => $font_size_attribute,
			'line-height'    => $line_height_attribute,
			'letter-spacing' => $letter_spacing_attribute,
		),
	);

	return $input_attrs;

}
