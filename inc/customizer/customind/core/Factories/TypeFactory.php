<?php

namespace Customind\Core\Factories;

use Customind\Core\Types\Controls\BuilderMigration;
use Customind\Core\Types\Controls\Preset;
use Customind\Core\Types\Controls\Socials;
use Customind\Core\Types\Controls\TypographyPreset;
use Customind\Core\Types\Controls\Upgrade;
use Customind\Core\Types\Controls\VisibilityButton;
use Customind\Core\Types\Panel;
use Customind\Core\Types\Section;
use Customind\Core\Types\Controls\Date;
use Customind\Core\Types\Controls\Text;
use Customind\Core\Types\Controls\Color;
use Customind\Core\Types\Controls\Image;
use Customind\Core\Types\Controls\Radio;
use Customind\Core\Types\Controls\Title;
use Customind\Core\Types\Controls\Editor;
use Customind\Core\Types\Controls\Select;
use Customind\Core\Types\Controls\Slider;
use Customind\Core\Types\Controls\Toggle;
use Customind\Core\Types\Controls\Upsell;
use Customind\Core\Types\Controls\Divider;
use Customind\Core\Types\Controls\Checkbox;
use Customind\Core\Types\Controls\Sortable;
use Customind\Core\Types\Controls\Textarea;
use Customind\Core\Types\Controls\Accordion;
use Customind\Core\Types\Controls\Background;
use Customind\Core\Types\Controls\BuilderComponents;
use Customind\Core\Types\Controls\ColorGroup;
use Customind\Core\Types\Controls\Dimensions;
use Customind\Core\Types\Controls\Navigation;
use Customind\Core\Types\Controls\RadioImage;
use Customind\Core\Types\Controls\Typography;
use Customind\Core\Types\Controls\Fontawesome;
use Customind\Core\Types\Controls\ColorPalette;
use Customind\Core\Types\Controls\FooterBuilder;
use Customind\Core\Types\Controls\ToggleButton;
use Customind\Core\Types\Controls\HeaderBuilder;
use Customind\Core\Types\Controls\Heading;
use Customind\Core\Types\Controls\Tabs;
use Customind\Core\Types\UpgradeSection;
use Customind\Core\Types\UpsellSection;

class TypeFactory {

	const CLASSES = array(
		'customind-panel'              => Panel::class,
		'customind-section'            => Section::class,
		'customind-upsell-section'     => UpsellSection::class,
		'customind-upgrade-section'    => UpgradeSection::class,
		'customind-textarea'           => Textarea::class,
		'customind-title'              => Title::class,
		'customind-toggle'             => Toggle::class,
		'customind-toggle-button'      => ToggleButton::class,
		'customind-visibility-button'  => VisibilityButton::class,
		'customind-typography'         => Typography::class,
		'customind-typography-preset'         => TypographyPreset::class,
		'customind-upsell'             => Upsell::class,
		'customind-upgrade'            => Upgrade::class,
		'customind-accordion'          => Accordion::class,
		'customind-background'         => Background::class,
		'customind-checkbox'           => Checkbox::class,
		'customind-color'              => Color::class,
		'customind-color-group'        => ColorGroup::class,
		'customind-color-palette'      => ColorPalette::class,
		'customind-date'               => Date::class,
		'customind-dimensions'         => Dimensions::class,
		'customind-divider'            => Divider::class,
		'customind-editor'             => Editor::class,
		'customind-fontawesome'        => Fontawesome::class,
		'customind-header-builder'     => HeaderBuilder::class,
		'customind-image'              => Image::class,
		'customind-navigation'         => Navigation::class,
		'customind-radio'              => Radio::class,
		'customind-radio-image'        => RadioImage::class,
		'customind-select'             => Select::class,
		'customind-slider'             => Slider::class,
		'customind-sortable'           => Sortable::class,
		'customind-text'               => Text::class,
		'customind-builder-components' => BuilderComponents::class,
		'customind-footer-builder'     => FooterBuilder::class,
		'customind-tabs'               => Tabs::class,
		'customind-socials'            => Socials::class,
		'customind-preset'             => Preset::class,
		'customind-builder-migration'  => BuilderMigration::class,
		'customind-heading'            => Heading::class,
	);

	/**
	 * Create and returns an instance of a class.
	 * @param \WP_Customize $wp_customize
	 * @param string $id
	 * @param array $args
	 * @throws \InvalidArgumentException
	 * @return AbstractControl
	 */
	public static function create( $type, $wp_customize, $id, $args ) {
		$control = self::CLASSES[ $type ] ?? null;
		if ( ! $control ) {
			throw new \InvalidArgumentException( esc_html( "Invalid type provided: $type" ) );
		}
		return new $control( $wp_customize, $id, $args );
	}
}
