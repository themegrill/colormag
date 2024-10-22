# Customind for extending WordPress customizer experience

## Usage

### Include/Require the main init.php in your theme `functions.php` which will expose global variable `$customind`.
Change PATH_TO_CUSTOMIND to the directory path where you add the customind core files.
```php
require PATH_TO_CUSTOMIND . '/init.php';
```

### Registering panels and sections.
Registering panels and sections should done in `customize_register` action callback.
```php
function register_panel_section() {
  global $customind;

  $customind->add_panels(
		[
			'prefix_panel_one' => [
				'title' => 'Panel',
			],
		]
	);

  $customind->add_sections(
		[
			'prefix_section_one' => [
				'title' => 'Section',
				'panel' => 'prefix_panel_one', // This panel arg is required.
			],
		]
	);
}

add_action( 'customize_register', 'register_panel_section' );
```

### Register controls.
Registering controls/settings should done in `customize_register` action callback.
#### Text control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'text_control' => [
    'type'        => 'customind-text',
    'title'       => 'Text',
    'section'     => 'prefix_section',
    'description' => 'Test description',
  ]
]);
```

#### Textarea control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'textarea_control' => [
    'type'        => 'customind-textarea',
    'title'       => 'Text area',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => '',
  ]
]);
```
#### Textarea control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'textarea_control' => [
    'type'        => 'customind-textarea',
    'title'       => 'Text area',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => '',
  ]
]);
```

#### Color control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'color_control' => [
    'type'        => 'customind-color',
    'title'       => 'Color',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => '#fff',
  ]
]);
```

#### Switch control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'switch_control' => [
    'type'        => 'customind-switch',
    'title'       => 'Color',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => false, // boolean
  ]
]);
```
#### Dimensions control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'dimensions_control' => [
    'type'        => 'customind-dimensions',
    'title'       => 'Dimensions',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'input_attrs' => [
      'responsive'  => true, // True: show device selector
      'units'       => [ 'px', 'em', '%', 'ch', 'rem' ], // Units for unit selector in the control
      'defaultUnit' => 'rem', // default unit to show
    ],
  ]
]);
```
#### Slider control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'slider_control' => [
    'type'        => 'customind-slider',
    'title'       => 'Slider',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'input_attrs' => [
      'responsive'  => true, // True: show device selector
      'units'       => [ 'px', 'em', '%', 'ch', 'rem' ], // Units for unit selector in the control
      'defaultUnit' => 'rem', // default unit to show
    ],
  ]
]);
```
#### Classic Editor control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'editor_control' => [
    'type'        => 'customind-editor',
    'title'       => 'Editor',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => ''
  ]
]);
```
#### Checkbox control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'checkbox_control' => [
    'type'        => 'customind-checkbox',
    'title'       => 'Checkbox',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'default'     => false // boolean
  ]
]);
```
#### Select control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'select_control' => [
    'type'        => 'customind-select',
    'title'       => 'Select',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'choices'     => [
      'one' => 'One',
      'two' => 'Two',
    ],
  ]
]);
```
#### Radio control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'radio_control' => [
    'type'        => 'customind-radio',
    'title'       => 'Radio',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'choices'     => [
      'one' => 'One',
      'two' => 'Two',
    ],
  ]
]);
```
#### Toggle button control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'toggle_button_control' => [
    'type'        => 'customind-toggle-button',
    'title'       => 'Toggle button',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'choices'     => [
      'one' => 'One',
      'two' => 'Two',
    ],
  ]
]);
```
#### Typography control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'typography_control' => [
    'type'        => 'customind-typography',
    'title'       => 'Typography',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'input_attrs' => [
      'allowedProperties' => [ // Optional: If not passed all the properties will be displayed.
        'font-family',
        'font-weight',
        'font-size',
        'line-height',
        'letter-spacing',
        'font-style',
        'text-transform',
      ]
    ]
  ]
]);
```
#### Sortable control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'sortable_control' => [
    'type'        => 'customind-sortable',
    'title'       => 'Sortable',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'choices'     => [
      'one'   => 'One',
      'two'   => 'Two',
      'three' => 'Three',
      'four'  => 'Four',
      'five'  => 'Five',
    ],
    'default'     => [
      'one',
      'two',
      'three',
      'four',
    ],
  ]
]);
```
#### Radio image control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'radio_image_control' => [
    'type'        => 'customind-radio-image',
    'title'       => 'Radio image',
    'section'     => 'prefix_section',
    'description' => 'Test description',
    'choices'     => [
      'style-1' => array(
        'label' => 'Left',
        'url'   => 'http://example.com/1img.jpg'
      ),
      'style-2' => array(
        'label' => 'Right',
        'url'   => 'http://example.com/1img.jpg'
      ),
    ],
    'input_attrs' => [
      'columns' => 2,
    ],
  ]
]);
```
#### Background control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'background' => [
    'type'    => 'customind-background',
    'title'   => 'Background',
    'section' => 'prefix_section',
  ]
]);
```
#### Background control
```php
$customind->add_controls([
  // key is the id of the control or settings
  'fontawesome' => [
    'type'    => 'customind-fontawesome',
    'title'   => 'Fontawesome',
    'section' => 'prefix_section',
  ]
]);
```
#### Adding dynamic css in customize preview.
In your theme, enqueue a script with the dependency of `wp-hooks`. This should be inside a callback function of `customize_preview_init` action hook.

Also see how [wp-hooks](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-hooks/) works.
```js
// Example for color palette control. Control id customind[color-palette], apart from `-`, `_` and `.` control id
// characters will be replaced by `.`
wp.hooks.addFilter('customind.dynamic.customind.color-palette.css', 'customind', function (v, to) {
	let styles = Object.entries(to.colors).reduce((acc, [k, v]) => {
		acc += `--${k}:${v};`;
		return acc;
	}, '');
	v = `:root {${styles}}`;
	return v;
});
```
