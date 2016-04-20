<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

add_action( 'widgets_init', 'colormag_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function colormag_widgets_init() {

   /**
    * Registering widget areas for front page
    */
   // Registering main right sidebar
   register_sidebar( array(
      'name'            => __( 'Right Sidebar', 'colormag' ),
      'id'              => 'colormag_right_sidebar',
      'description'     => __( 'Shows widgets at Right side.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering main left sidebar
   register_sidebar( array(
      'name'            => __( 'Left Sidebar', 'colormag' ),
      'id'              => 'colormag_left_sidebar',
      'description'     => __( 'Shows widgets at Left side.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering Header sidebar
   register_sidebar( array(
      'name'            => __( 'Header Sidebar', 'colormag' ),
      'id'              => 'colormag_header_sidebar',
      'description'     => __( 'Shows widgets in header section just above the main navigation menu.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title">',
      'after_title'     => '</h3>'
   ) );

   // registering the Front Page: Slider Area Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Slider Area', 'colormag' ),
      'id'              => 'colormag_front_page_slider_area',
      'description'     => __( 'Show widget just below menu. Suitable for TG: Featured Cat Slider.', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Area beside slider Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Area beside slider', 'colormag' ),
      'id'              => 'colormag_front_page_area_beside_slider',
      'description'     => __( 'Show widget beside the slider. Suitable for TG: Highlighted Posts.', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Top Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Top Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_top_section',
      'description'     => __( 'Content Top Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Middle Left Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Middle Left Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_middle_left_section',
      'description'     => __( 'Content Middle Left Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Middle Right Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Middle Right Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_middle_right_section',
      'description'     => __( 'Content Middle Right Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Bottom Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Bottom Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_bottom_section',
      'description'     => __( 'Content Middle Bottom Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering contact Page sidebar
   register_sidebar( array(
      'name'            => __( 'Contact Page Sidebar', 'colormag' ),
      'id'              => 'colormag_contact_page_sidebar',
      'description'     => __( 'Shows widgets on Contact Page Template.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering Error 404 Page sidebar
   register_sidebar( array(
      'name'            => __( 'Error 404 Page Sidebar', 'colormag' ),
      'id'              => 'colormag_error_404_page_sidebar',
      'description'     => __( 'Shows widgets on Error 404 page.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering advertisement above footer sidebar
   register_sidebar( array(
      'name'            => __( 'Advertisement Above The Footer', 'colormag' ),
      'id'              => 'colormag_advertisement_above_the_footer_sidebar',
      'description'     => __( 'Shows widgets Just Above The Footer, suitable for TG: 728x90 widget.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar One', 'colormag' ),
		'id' 					=> 'colormag_footer_sidebar_one',
		'description'   	=> __( 'Shows widgets at footer sidebar one.', 'colormag' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Two', 'colormag' ),
		'id' 					=> 'colormag_footer_sidebar_two',
		'description'   	=> __( 'Shows widgets at footer sidebar two.', 'colormag' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

   // Registering footer sidebar three
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Three', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_three',
      'description'     => __( 'Shows widgets at footer sidebar three.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering footer sidebar four
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Four', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_four',
      'description'     => __( 'Shows widgets at footer sidebar four.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   register_widget( "colormag_featured_posts_slider_widget" );
   register_widget( "colormag_highlighted_posts_widget" );
   register_widget( "colormag_featured_posts_widget" );
   register_widget( "colormag_featured_posts_vertical_widget" );
   register_widget( "colormag_728x90_advertisement_widget" );
   register_widget( "colormag_300x250_advertisement_widget" );
   register_widget( "colormag_125x125_advertisement_widget" );
}

/****************************************************************************************/

/**
 * Featured Posts widget
 */
class colormag_featured_posts_slider_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_slider widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category, which will be used as the slider.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Category Slider', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <?php $featured = 'colormag-featured-image'; ?>
         <div class="widget_slider_area_rotate">
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

            if ( $i == 1 ) { $classes = "single-slide displayblock"; } else { $classes = "single-slide displaynone"; }

            ?>
            <div class="<?php echo $classes; ?>">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure class="slider-featured-image">';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               } else { ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/slider-featured-image.png">
                  </a>
               <?php }
               ?>
               <div class="slide-content">
                  <?php colormag_colored_category(); ?>
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() )
                        );
                        printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                           esc_url( get_permalink() ),
                           esc_attr( get_the_time() ),
                           $time_string
                        );
                     ?>
                     <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                  </div>
               </div>

            </div>
         <?php
            $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/**
 * Highlighted Posts widget
 */
class colormag_highlighted_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_highlighted_posts widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category. Suitable for the Area Beside Slider Sidebar.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Highligted Posts', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <div class="widget_highlighted_post_area">
      <?php $featured = 'colormag-highlighted-post'; ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <div class="single-article">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure class="highlights-featured-image">';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               } else { ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/highlights-featured-image.png">
                  </a>
               <?php }
               ?>
               <div class="article-content">
                  <?php colormag_colored_category(); ?>
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() )
                        );
                        printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                           esc_url( get_permalink() ),
                           esc_attr( get_the_time() ),
                           $time_string
                        );
                     ?>
                     <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                  </div>
               </div>

            </div>
         <?php
            $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/**
 * Featured Posts widget
 */
class colormag_featured_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_meta', 'description' =>__( 'Display latest posts or posts of specific category.' , 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 1)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-1.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <?php
         if ( $type != 'latest' ) {
            $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
            $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
         } else {
            $border_color = '';
            $title_color = '';
         }
         if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <?php if( $i == 1 ) { $featured = 'colormag-featured-post-medium'; } else { $featured = 'colormag-featured-post-small'; } ?>
            <?php if( $i == 1 ) { echo '<div class="first-post">'; } elseif ( $i == 2 ) { echo '<div class="following-post">'; } ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                     <?php if( $i == 1 ) { ?>
                     <div class="entry-content">
                        <?php the_excerpt(); ?>
                     </div>
                     <?php } ?>
                  </div>

               </div>
            <?php if( $i == 1 ) { echo '</div>'; } ?>
         <?php
            $i++;
         endwhile;
         if ( $i > 2 ) { echo '</div>'; }
         // Reset Post Data
         wp_reset_query();
         ?>
      <!-- </div> -->
      <?php echo $after_widget;
      }
}

/**
 * Featured Posts widget
 */
class colormag_featured_posts_vertical_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_posts_vertical widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 2)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-2.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <?php
         if ( $type != 'latest' ) {
            $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
            $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
         } else {
            $border_color = '';
            $title_color = '';
         }
         if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <?php if( $i == 1 ) { $featured = 'colormag-featured-post-medium'; } else { $featured = 'colormag-featured-post-small'; } ?>
            <?php if( $i == 1 ) { echo '<div class="first-post">'; } elseif ( $i == 2 ) { echo '<div class="following-post">'; } ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                     <?php if( $i == 1 ) { ?>
                     <div class="entry-content">
                        <?php the_excerpt(); ?>
                     </div>
                     <?php } ?>
                  </div>

               </div>
            <?php if( $i == 1 ) { echo '</div>'; } ?>
         <?php
            $i++;
         endwhile;
         if ( $i > 2 ) { echo '</div>'; }
         // Reset Post Data
         wp_reset_query();
         ?>
      <?php echo $after_widget;
      }

}

/****************************************************************************************/

/**
 * 300x250 Advertisement Ads
 */
class colormag_300x250_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_300x250_advertisement', 'description' => __( 'Add your 300x250 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 300x250 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '300x250_image_url' => '', '300x250_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 300x250 Images Here', 'colormag' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      echo $before_widget; ?>

      <div class="advertisement_300x250">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_300x250" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="300" height="250">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="300" height="250">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * 728x90 Advertisement Ads
 */
class colormag_728x90_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_728x90_advertisement', 'description' => __( 'Add your 728x90 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 728x90 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '728x90_image_url' => '', '728x90_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 728x90 Images Here', 'colormag' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';


      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      echo $before_widget; ?>

      <div class="advertisement_728x90">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_728x90" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="728" height="90">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="728" height="90">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * 125x125 Advertisement Ads
 */
class colormag_125x125_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_125x125_advertisement', 'description' => __( 'Add your 125x125 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 125x125 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '125x125_image_url_1' => '', '125x125_image_url_2' => '', '125x125_image_url_3' => '', '125x125_image_url_4' => '', '125x125_image_url_5' => '', '125x125_image_url_6' => '', '125x125_image_link_1' => '', '125x125_image_link_2' => '', '125x125_image_link_3' => '', '125x125_image_link_4' => '', '125x125_image_link_5' => '', '125x125_image_link_6' => '') );
      $title = esc_attr( $instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
         $instance[ $image_url ] = esc_url( $instance[ $image_url ] );
      }
      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 125x125 Images Here', 'colormag' ); ?></label>
      <?php
      for ( $i = 1; $i < 7 ; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;
      ?>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); echo $i; ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); echo $i; ?></label>

         <?php
         if ( $instance[$image_url]  != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[$image_url] . 'preview') . '"src="' . $instance[$image_url] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>
      <?php } ?>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
         $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );
      }

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $image_array = array();
      $link_array = array();

      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
         $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
         if( !empty( $image_link ) ) array_push( $link_array, $image_link );
         if( !empty( $image_url ) ) array_push( $image_array, $image_url );
      }
      echo $before_widget; ?>

      <div class="advertisement_125x125">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_array ) ) {
            $output .= '<div class="advertisement-content">';
            for ( $i = 1; $i < 7; $i++ ) {
               $j = $i - 1;
               if( !empty( $image_array[$j] ) ) {
                  if ( !empty( $link_array[$j] ) ) {
                     $output .= '<a href="'.$link_array[$j].'" class="single_ad_125x125" target="_blank" rel="nofollow">
                                 <img src="'.$image_array[$j].'" width="125" height="125">
                              </a>';
                  } else {
                     $output .= '<img src="'.$image_array[$j].'" width="125" height="125">';
                  }
               }
            }
            $output .= '</div>';
            echo $output;
         } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/
?>