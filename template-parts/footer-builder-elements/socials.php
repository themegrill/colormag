<?php

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
				<a href="<?php echo esc_url( $value['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
