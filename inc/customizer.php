<?php

/**
 * ColorMag Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
function colormag_customize_register($wp_customize) {

   // Theme important links started
   class COLORMAG_Important_Links extends WP_Customize_Control {

      public $type = "colormag-important-links";

      public function render_content() {
         //Add Theme instruction, Support Forum, Demo Link, Rating Link
         $important_links = array(
            'view-pro' => array(
               'link' => esc_url('https://themegrill.com/themes/colormag-pro/'),
               'text' => esc_html__('View Pro', 'colormag'),
            ),
            'theme-info' => array(
               'link' => esc_url('https://themegrill.com/themes/colormag/'),
               'text' => esc_html__('Theme Info', 'colormag'),
            ),
            'support' => array(
               'link' => esc_url('https://themegrill.com/support-forum/'),
               'text' => esc_html__('Support', 'colormag'),
            ),
            'documentation' => array(
               'link' => esc_url('https://docs.themegrill.com/colormag/'),
               'text' => esc_html__('Documentation', 'colormag'),
            ),
            'demo' => array(
               'link' => esc_url('https://demo.themegrill.com/colormag/'),
               'text' => esc_html__('View Demo', 'colormag'),
            ),
            'rating' => array(
               'link' => esc_url('https://wordpress.org/support/view/theme-reviews/colormag?filter=5'),
               'text' => esc_html__('Rate this theme', 'colormag'),
            ),
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
      }

   }

   $wp_customize->add_section('colormag_important_links', array(
      'priority' => 1,
      'title' => __('ColorMag Important Links', 'colormag'),
   ));

   /**
    * This setting has the dummy Sanitizaition function as it contains no value to be sanitized
    */
   $wp_customize->add_setting('colormag_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_links_sanitize'
   ));

   $wp_customize->add_control(new COLORMAG_Important_Links($wp_customize, 'important_links', array(
      'label' => __('Important Links', 'colormag'),
      'section' => 'colormag_important_links',
      'settings' => 'colormag_important_links'
   )));
   // Theme Important Links Ended

   // Start of the Header Options
   $wp_customize->add_panel('colormag_header_options', array(
      'capabitity' => 'edit_theme_options',
      'description' => __('Change the Header Settings from here as you want', 'colormag'),
      'priority' => 500,
      'title' => __('Header Options', 'colormag')
   ));

   // breaking news enable/disable
   $wp_customize->add_section('colormag_breaking_news_section', array(
      'title' => __('Breaking News', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_breaking_news', array(
      'priority' => 1,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_breaking_news', array(
      'type' => 'checkbox',
      'label' => __('Check to enable the breaking news section', 'colormag'),
      'section' => 'colormag_breaking_news_section',
      'settings' => 'colormag_breaking_news'
   ));

   // date display enable/disable
   $wp_customize->add_section('colormag_date_display_section', array(
      'title' => __('Show Date', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_date_display', array(
      'priority' => 2,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_date_display', array(
      'type' => 'checkbox',
      'label' => __('Check to show the date in header', 'colormag'),
      'section' => 'colormag_date_display_section',
      'settings' => 'colormag_date_display'
   ));

	// date in header display type
	$wp_customize->add_setting('colormag_date_display_type', array(
		'default' => 'theme_default',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize'
	));

	$wp_customize->add_control('colormag_date_display_type', array(
		'type' => 'radio',
		'label' => esc_html__('Date in header display type:', 'colormag'),
		'choices' => array(
			'theme_default' => esc_html__('Theme Default Setting', 'colormag'),
			'wordpress_date_setting' => esc_html__('From WordPress Date Setting', 'colormag'),
		),
		'section' => 'colormag_date_display_section',
		'settings' => 'colormag_date_display_type'
	));

   // home icon enable/disable in primary menu
   $wp_customize->add_section('colormag_home_icon_display_section', array(
      'title' => __('Show Home Icon', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_home_icon_display', array(
      'priority' => 3,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_home_icon_display', array(
      'type' => 'checkbox',
      'label' => __('Check to show the home icon in the primary menu', 'colormag'),
      'section' => 'colormag_home_icon_display_section',
      'settings' => 'colormag_home_icon_display'
   ));

   // primary sticky menu enable/disable
   $wp_customize->add_section('colormag_primary_sticky_menu_section', array(
      'title' => __('Sticky Menu', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_primary_sticky_menu', array(
      'priority' => 4,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_primary_sticky_menu', array(
      'type' => 'checkbox',
      'label' => __('Check to enable the sticky behavior of the primary menu', 'colormag'),
      'section' => 'colormag_primary_sticky_menu_section',
      'settings' => 'colormag_primary_sticky_menu'
   ));

   // search icon in menu enable/disable
   $wp_customize->add_section('colormag_search_icon_in_menu_section', array(
      'title' => __('Search Icon', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_search_icon_in_menu', array(
      'priority' => 5,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_search_icon_in_menu', array(
      'type' => 'checkbox',
      'label' => __('Check to display the Search Icon in the primary menu', 'colormag'),
      'section' => 'colormag_search_icon_in_menu_section',
      'settings' => 'colormag_search_icon_in_menu'
   ));

   // random posts in menu enable/disable
   $wp_customize->add_section('colormag_random_post_in_menu_section', array(
      'title' => __('Random Post', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_random_post_in_menu', array(
      'priority' => 6,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_random_post_in_menu', array(
      'type' => 'checkbox',
      'label' => __('Check to display the Random Post Icon in the primary menu', 'colormag'),
      'section' => 'colormag_random_post_in_menu_section',
      'settings' => 'colormag_random_post_in_menu'
   ));

   // Responsive new menu enable/disable
   $wp_customize->add_section('colormag_responsive_menu_section', array(
      'title' => esc_html__('Responsive Menu Style', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_responsive_menu', array(
      'priority' => 7,
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_responsive_menu', array(
      'type' => 'checkbox',
      'label' => esc_html__('Check to switch to new responsive menu.', 'colormag'),
      'section' => 'colormag_responsive_menu_section',
      'settings' => 'colormag_responsive_menu'
   ));

   // logo upload options
   $wp_customize->add_section('colormag_header_logo', array(
      'priority' => 1,
      'title' => __('Header Logo', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

	if ( ! function_exists('the_custom_logo') ) {
		$wp_customize->add_setting('colormag_logo', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'colormag_logo', array(
			'label' => __('Upload logo for your header', 'colormag'),
			'section' => 'colormag_header_logo',
			'setting' => 'colormag_logo'
		)));
	}

   $wp_customize->add_setting('colormag_header_logo_placement', array(
      'default' => 'header_text_only',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_show_radio_saniztize'
   ));

   $wp_customize->add_control('colormag_header_logo_placement', array(
      'type' => 'radio',
      'label' => __('Choose the option that you want', 'colormag'),
      'section' => 'colormag_header_logo',
      'choices' => array(
         'header_logo_only' => __('Header Logo Only', 'colormag'),
         'header_text_only' => __('Header Text Only', 'colormag'),
         'show_both' => __('Show Both', 'colormag'),
         'disable' => __('Disable', 'colormag')
      )
   ));

   // header image position setting
   $wp_customize->add_section('colormag_header_image_position_setting', array(
      'priority' => 6,
      'title' => __('Header Image Position', 'colormag'),
      'panel' => 'colormag_header_options'
   ));

   $wp_customize->add_setting('colormag_header_image_position', array(
      'default' => 'position_two',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_header_image_position_sanitize'
   ));

   $wp_customize->add_control('colormag_header_image_position', array(
      'type' => 'radio',
      'label' => __('Header image display position', 'colormag'),
      'section' => 'colormag_header_image_position_setting',
      'choices' => array(
         'position_one' => __('Display the Header image just above the site title/text.', 'colormag'),
         'position_two' => __('Default: Display the Header image between site title/text and the main/primary menu.', 'colormag'),
         'position_three' => __('Display the Header image below main/primary menu.', 'colormag')
      )
   ));

   $wp_customize->add_setting('colormag_header_image_link', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_header_image_link', array(
      'type' => 'checkbox',
      'label' => __('Check to make header image link back to home page', 'colormag'),
      'section' => 'colormag_header_image_position_setting'
   ));

   // Start of the Design Options
   $wp_customize->add_panel('colormag_design_options', array(
      'capabitity' => 'edit_theme_options',
      'description' => __('Change the Design Settings from here as you want', 'colormag'),
      'priority' => 505,
      'title' => __('Design Options', 'colormag')
   ));

   // FrontPage setting
   $wp_customize->add_section('colormag_front_page_setting', array(
      'priority' => 1,
      'title' => __('Front Page Settings', 'colormag'),
      'panel' => 'colormag_design_options'
   ));
   $wp_customize->add_setting('colormag_hide_blog_front', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_hide_blog_front', array(
      'type' => 'checkbox',
      'label' => __('Check to hide blog posts/static page on front page', 'colormag'),
      'section' => 'colormag_front_page_setting'
   ));

   // site layout setting
   $wp_customize->add_section('colormag_site_layout_setting', array(
      'priority' => 2,
      'title' => __('Site Layout', 'colormag'),
      'panel' => 'colormag_design_options'
   ));

   $wp_customize->add_setting('colormag_site_layout', array(
      'default' => 'wide_layout',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_site_layout_sanitize'
   ));

   $wp_customize->add_control('colormag_site_layout', array(
      'type' => 'radio',
      'label' => __('Choose your site layout. The change is reflected in whole site', 'colormag'),
      'choices' => array(
         'boxed_layout' => __('Boxed Layout', 'colormag'),
         'wide_layout' => __('Wide Layout', 'colormag')
      ),
      'section' => 'colormag_site_layout_setting'
   ));

   class COLORMAG_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<style>
				#colormag-img-container .colormag-radio-img-img {
					border: 3px solid #DEDEDE;
					margin: 0 5px 5px 0;
					cursor: pointer;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				#colormag-img-container .colormag-radio-img-selected {
					border: 3px solid #AAA;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				input[type=checkbox]:before {
					content: '';
					margin: -3px 0 0 -4px;
				}
			</style>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul class="controls" id = 'colormag-img-container'>
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'colormag-radio-img-selected colormag-radio-img-img':'colormag-radio-img-img';
					?>
					<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<script type="text/javascript">

				jQuery(document).ready(function($) {
					$('.controls#colormag-img-container li img').click(function(){
						$('.controls#colormag-img-container li').each(function(){
							$(this).find('img').removeClass ('colormag-radio-img-selected') ;
						});
						$(this).addClass ('colormag-radio-img-selected') ;
					});
				});

			</script>
			<?php
		}
	}

	// default layout setting
	$wp_customize->add_section('colormag_default_layout_setting', array(
		'priority' => 3,
		'title' => __('Default layout', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_layout', array(
		'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_layout_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout. This layout will be reflected in whole site archives, categories, search page etc. The layout for a single post and page can be controlled from below options', 'colormag'),
		'section' => 'colormag_default_layout_setting',
		'settings' => 'colormag_default_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for pages
	$wp_customize->add_section('colormag_default_page_layout_setting', array(
		'priority' => 4,
		'title' => __('Default layout for pages only', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_page_layout', array(
		'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_layout_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_page_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page', 'colormag'),
		'section' => 'colormag_default_page_layout_setting',
		'settings' => 'colormag_default_page_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

	// default layout for single posts
	$wp_customize->add_section('colormag_default_single_posts_layout_setting', array(
		'priority' => 5,
		'title' => __('Default layout for single posts only', 'colormag'),
		'panel'=> 'colormag_design_options'
	));

	$wp_customize->add_setting('colormag_default_single_posts_layout', array(
		'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_layout_sanitize'
	));

	$wp_customize->add_control(new COLORMAG_Image_Radio_Control($wp_customize, 'colormag_default_single_posts_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post', 'colormag'),
		'section' => 'colormag_default_single_posts_layout_setting',
		'settings' => 'colormag_default_single_posts_layout',
		'choices' => array(
			'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
		)
	)));

   // primary color options
   $wp_customize->add_section('colormag_primary_color_setting', array(
      'panel' => 'colormag_design_options',
      'priority' => 7,
      'title' => __('Primary color option', 'colormag')
   ));

   $wp_customize->add_setting('colormag_primary_color', array(
      'default' => '#289dcc',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_color_option_hex_sanitize',
      'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
   ));

   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'colormag_primary_color', array(
      'label' => __('This will reflect in links, buttons and many others. Choose a color to match your site', 'colormag'),
      'section' => 'colormag_primary_color_setting',
      'settings' => 'colormag_primary_color'
   )));

	if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
		// Custom CSS setting
		class COLORMAG_Custom_CSS_Control extends WP_Customize_Control {

			public $type = 'custom_css';

			public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
			}

		}

		$wp_customize->add_section('colormag_custom_css_setting', array(
			'priority' => 9,
			'title' => __('Custom CSS', 'colormag'),
			'panel' => 'colormag_design_options'
		));

		$wp_customize->add_setting('colormag_custom_css', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		));

		$wp_customize->add_control(new COLORMAG_Custom_CSS_Control($wp_customize, 'colormag_custom_css', array(
			'label' => __('Write your Custom CSS', 'colormag'),
			'section' => 'colormag_custom_css_setting',
			'settings' => 'colormag_custom_css'
		)));
	}
	// End of the Design Options

   // Start of the Social Link Options
   $wp_customize->add_panel('colormag_social_links_options', array(
   	'priority' => 510,
   	'title' => __('Social Options', 'colormag'),
   	'description'=> __('Change the Social Links settings from here as you want', 'colormag'),
   	'capability' => 'edit_theme_options',
	));

	$wp_customize->add_section('colormag_social_link_activate_settings', array(
		'priority' => 1,
		'title' => __('Activate social links area', 'colormag'),
		'panel' => 'colormag_social_links_options'
	));

	$wp_customize->add_setting('colormag_social_link_activate', array(
		'default' => 0,
      'capability' => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize'
	));

	$wp_customize->add_control('colormag_social_link_activate', array(
		'type' => 'checkbox',
		'label' => __('Check to activate social links area', 'colormag'),
		'section' => 'colormag_social_link_activate_settings',
		'settings' => 'colormag_social_link_activate'
	));

	$colormag_social_links = array(
		'colormag_social_facebook' => array(
			'id' => 'colormag_social_facebook',
			'title' => __('Facebook', 'colormag'),
			'default' => ''
		),
		'colormag_social_twitter' => array(
			'id' => 'colormag_social_twitter',
			'title' => __('Twitter', 'colormag'),
			'default' => ''
		),
		'colormag_social_googleplus' => array(
			'id' => 'colormag_social_googleplus',
			'title' => __('Google-Plus', 'colormag'),
			'default' => ''
		),
		'colormag_social_instagram' => array(
			'id' => 'colormag_social_instagram',
			'title' => __('Instagram', 'colormag'),
			'default' => ''
		),
		'colormag_social_pinterest' => array(
			'id' => 'colormag_social_pinterest',
			'title' => __('Pinterest', 'colormag'),
			'default' => ''
		),
		'colormag_social_youtube' => array(
			'id' => 'colormag_social_youtube',
			'title' => __('YouTube', 'colormag'),
			'default' => ''
		),
	);

	$i = 20;

	foreach($colormag_social_links as $colormag_social_link) {

		$wp_customize->add_setting($colormag_social_link['id'], array(
			'default' => $colormag_social_link['default'],
         'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($colormag_social_link['id'], array(
			'label' => $colormag_social_link['title'],
			'section'=> 'colormag_social_link_activate_settings',
			'settings'=> $colormag_social_link['id'],
			'priority' => $i
		));

		$wp_customize->add_setting($colormag_social_link['id'].'_checkbox', array(
			'default' => 0,
         'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_checkbox_sanitize'
		));

		$wp_customize->add_control($colormag_social_link['id'].'_checkbox', array(
			'type' => 'checkbox',
			'label' => __('Check to open in new tab', 'colormag'),
			'section'=> 'colormag_social_link_activate_settings',
			'settings'=> $colormag_social_link['id'].'_checkbox',
			'priority' => $i
		));

		$i++;

	}
   // End of the Social Link Options

   // Start of the Additional Options
   $wp_customize->add_panel('colormag_additional_options', array(
   	'capability' => 'edit_theme_options',
   	'description'=> __('Change the Additional Settings from here as you want', 'colormag'),
   	'priority' => 515,
   	'title' => __('Additional Options', 'colormag')
	));

	if ( ! function_exists( 'has_site_icon' ) || ( ! has_site_icon() && ( get_theme_mod( 'colormag_favicon_upload', '' ) != '' ) ) ) {
		// favicon options
		$wp_customize->add_section('colormag_favicon_show_setting', array(
			'priority' => 1,
			'title' => __('Activate favicon', 'colormag'),
			'panel' => 'colormag_additional_options'
		));

		$wp_customize->add_setting('colormag_favicon_show', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'colormag_checkbox_sanitize'
		));

		$wp_customize->add_control('colormag_favicon_show', array(
			'type' => 'checkbox',
			'label' => __('Check to activate favicon. Upload favicon from below option', 'colormag'),
			'section' => 'colormag_favicon_show_setting',
			'settings' => 'colormag_favicon_show'
		));

		$wp_customize->add_setting('colormag_favicon_upload', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'colormag_favicon_upload', array(
			'label' => __('Upload favicon for your site', 'colormag'),
			'section' => 'colormag_favicon_show_setting',
			'settings' => 'colormag_favicon_upload'
		)));
	}

   // related posts
   $wp_customize->add_section('colormag_related_posts_section', array(
      'priority' => 4,
      'title' => __('Related Posts', 'colormag'),
      'panel' => 'colormag_additional_options'
   ));

   $wp_customize->add_setting('colormag_related_posts_activate', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_related_posts_activate', array(
      'type' => 'checkbox',
      'label' => __('Check to activate the related posts', 'colormag'),
      'section' => 'colormag_related_posts_section',
      'settings' => 'colormag_related_posts_activate'
   ));

   $wp_customize->add_setting('colormag_related_posts', array(
      'default' => 'categories',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_related_posts_sanitize'
   ));

   $wp_customize->add_control('colormag_related_posts', array(
      'type' => 'radio',
      'label' => __('Related Posts Must Be Shown As:', 'colormag'),
      'section' => 'colormag_related_posts_section',
      'settings' => 'colormag_related_posts',
      'choices' => array(
         'categories' => __('Related Posts By Categories', 'colormag'),
         'tags' => __('Related Posts By Tags', 'colormag')
      )
   ));

   // featured image popup check
   $wp_customize->add_section('colormag_featured_image_popup_setting', array(
      'priority' => 6,
      'title' => __('Image Lightbox', 'colormag'),
      'panel' => 'colormag_additional_options'
   ));

   $wp_customize->add_setting('colormag_featured_image_popup', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'colormag_checkbox_sanitize'
   ));

   $wp_customize->add_control('colormag_featured_image_popup', array(
      'type' => 'checkbox',
      'label' => __('Check to enable the lightbox for the featured images in single post', 'colormag'),
      'section' => 'colormag_featured_image_popup_setting',
      'settings' => 'colormag_featured_image_popup'
   ));
	// End of the Additional Options

	// Category Color Options
   $wp_customize->add_panel('colormag_category_color_panel', array(
      'priority' => 535,
      'title' => __('Category Color Options', 'colormag'),
      'capability' => 'edit_theme_options',
      'description' => __('Change the color of each category items as you want.', 'colormag')
   ));

   $wp_customize->add_section('colormag_category_color_setting', array(
      'priority' => 1,
      'title' => __('Category Color Settings', 'colormag'),
      'panel' => 'colormag_category_color_panel'
   ));

   $i = 1;
   $args = array(
       'orderby' => 'id',
       'hide_empty' => 0
   );
   $categories = get_categories( $args );
   $wp_category_list = array();
   foreach ($categories as $category_list ) {
      $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

      $wp_customize->add_setting('colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]), array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'colormag_color_option_hex_sanitize',
         'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize'
      ));

      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]), array(
         'label' => sprintf(__('%s', 'colormag'), $wp_category_list[$category_list->cat_ID] ),
         'section' => 'colormag_category_color_setting',
         'settings' => 'colormag_category_color_'.get_cat_id($wp_category_list[$category_list->cat_ID]),
         'priority' => $i
      )));
      $i++;
   }

	// sanitization works
	// radio/select buttons sanitization
	function colormag_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

   // radio button sanitization
   function colormag_related_posts_sanitize($input) {
      $valid_keys = array(
         'categories' => __('Related Posts By Categories', 'colormag'),
         'tags' => __('Related Posts By Tags', 'colormag')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function colormag_show_radio_saniztize($input) {
      $valid_keys = array(
         'header_logo_only' => __('Header Logo Only', 'colormag'),
         'header_text_only' => __('Header Text Only', 'colormag'),
         'show_both' => __('Show Both', 'colormag'),
         'disable' => __('Disable', 'colormag')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function colormag_header_image_position_sanitize($input) {
      $valid_keys = array(
         'position_one' => __('Display the Header image just above the site title/text.', 'colormag'),
         'position_two' => __('Default: Display the Header image between site title/text and the main/primary menu.', 'colormag'),
         'position_three' => __('Display the Header image below main/primary menu.', 'colormag')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function colormag_site_layout_sanitize($input) {
      $valid_keys = array(
         'boxed_layout' => __('Boxed Layout', 'colormag'),
         'wide_layout' => __('Wide Layout', 'colormag')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function colormag_layout_sanitize($input) {
   	$valid_keys = array(
         'right_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered'	=> COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png'
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   // color sanitization
   function colormag_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }

   function colormag_color_escaping_option_sanitize($input) {
      $input = esc_attr($input);
      return $input;
   }

   // checkbox sanitization
   function colormag_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

   // sanitization of links
   function colormag_links_sanitize() {
      return false;
   }

}

add_action('customize_register', 'colormag_customize_register');

/*****************************************************************************************/

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'colormag_customizer_custom_scripts' );

function colormag_customizer_custom_scripts() { ?>
<style>
	/* Theme Instructions Panel CSS */
	li#accordion-section-colormag_important_links h3.accordion-section-title, li#accordion-section-colormag_important_links h3.accordion-section-title:focus { background-color: #289DCC !important; color: #fff !important; }
	li#accordion-section-colormag_important_links h3.accordion-section-title:hover { background-color: #289DCC !important; color: #fff !important; }
	li#accordion-section-colormag_important_links h3.accordion-section-title:after { color: #fff !important; }
	/* Upsell button CSS */
	.themegrill-pro-info,
	.customize-control-colormag-important-links a {
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
		background: #008EC2;
		color: #fff;
		display: block;
		margin: 15px 0 0;
		padding: 5px 0;
		text-align: center;
		font-weight: 600;
	}

	.customize-control-colormag-important-links a{
		padding: 8px 0;
	}

	.themegrill-pro-info:hover,
	.customize-control-colormag-important-links a:hover {
		color: #ffffff;
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
		background:#2380BA;
	}
</style>
<?php
}
