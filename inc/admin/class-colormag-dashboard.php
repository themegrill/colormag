<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Dashboard {
	private static $instance;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'colormag-admin-dashboard', get_template_directory_uri() . '/inc/admin/css/admin.css' );
	}

	public function create_menu() {
		
		if ( is_child_theme() ) {
			$theme = wp_get_theme()->parent();
		} else {
			$theme = wp_get_theme();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'colormag' ), $theme->Name );

		$page = add_theme_page( $theme_page_name, $theme_page_name, 'edit_theme_options', 'colormag-options', array(
			$this,
			'option_page'
		) );

		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'colormag-dashboard', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), COLORMAG_THEME_VERSION );
	}

	public function option_page() {
		
		if ( is_child_theme() ) {
			$theme = wp_get_theme()->parent();
		} else {
			$theme = wp_get_theme();
		}
		?>
		<div class="wrap">
		<div class="colormag-header">
			<h1>
				<?php
				/* translators: %s: Theme version. */
				echo sprintf( esc_html__( 'ColorMag %s', 'colormag' ), $theme->Version );
				?>
			</h1>
		</div>
		<div class="welcome-panel">
			<div class="welcome-panel-content">
				<h2>
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Welcome to %s!', 'colormag' ), $theme->Name );
					?>
				</h2>
				<p class="about-description">
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Important links to get you started with %s', 'colormag' ), $theme->Name );
					?>
				</p>

				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Get Started', 'colormag' ); ?></h3>
						<a class="button button-primary button-hero"
						   href="<?php echo esc_url( 'https://docs.themegrill.com/colormag/#section-1' ); ?>"
						   target="_blank"><?php esc_html_e( 'Learn Basics', 'colormag' ); ?>
						</a>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Next Steps', 'colormag' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'colormag' ) . '</a>', esc_url( 'https://docs.themegrill.com/colormag' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'colormag' ) . '</a>', esc_url( 'https://demo.themegrill.com/colormag-demos' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-migrate">' . esc_html__( 'Premium Version', 'colormag' ) . '</a>', esc_url( 'https://themegrill.com/themes/colormag' ) ); ?></li>
						</ul>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Further Actions', 'colormag' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'colormag' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/colormag/' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'colormag' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/colormag/reviews/' ) ); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

ColorMag_Dashboard::instance();
