<?php

$social      = get_theme_mod(
	'colormag_header_socials',
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
$social_icon = get_theme_mod( 'colormag_header_socials_style', 'default' );
$social_separator = get_theme_mod( 'colormag_header_socials_separator', 'pipe' )
?>

<?php if ( ! empty( $social ) ) : ?>
	<div class="social-icons header-social-icons social-separator-<?php echo esc_attr( $social_separator ); ?> social-<?php echo esc_attr( $social_icon ); ?>">
		<?php foreach ( $social as $key => $value ) : ?>
			<?php if ( ! empty( $value ) ) : ?>
				<a href="<?php echo esc_url( $value['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
