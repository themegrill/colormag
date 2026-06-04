<?php
/**
 * Footer builder: Social icons markup file.
 *
 * @package colormag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$footer_social = get_theme_mod(
	'colormag_footer_socials',
	array(
		array(
			'id'    => uniqid(),
			'label' => 'facebook',
			'url'   => '#',
			'icon'  => 'fa-brands fa-facebook',
		),
		array(
			'id'    => uniqid(),
			'label' => 'twitter',
			'url'   => '#',
			'icon'  => 'fa-brands fa-x-twitter',
		),
		array(
			'id'    => uniqid(),
			'label' => 'instagram',
			'url'   => '#',
			'icon'  => 'fa-brands fa-square-instagram',
		),
	)
);
?>

<?php if ( ! empty( $footer_social ) ) : ?>
	<div class="social-icons footer-social-icons">
		<?php foreach ( $footer_social as $key => $value ) : ?>
			<?php if ( ! empty( $value ) ) : ?>
				<?php
				// Build the icon anchor markup so it can be filtered.
				// Pro hooks `colormag_social_icon_html` to apply brand colors as
				// inline styles.
				$icon_html = sprintf(
					'<a href="%1$s" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
					esc_url( $value['url'] ),
					esc_attr( $value['icon'] )
				);

				/**
				 * Filters a single social icon anchor markup.
				 *
				 * @param string $icon_html The icon anchor HTML.
				 * @param array  $value     The social network item (label, url, icon).
				 * @param string $context   Where the icon is rendered ('footer').
				 */
				echo apply_filters( 'colormag_social_icon_html', $icon_html, $value, 'footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is built from escaped values above and trusted filter callbacks.
				?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
