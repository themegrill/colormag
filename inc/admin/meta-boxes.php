<?php
/**
 * This fucntion is responsible for rendering metaboxes in single post area
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

 add_action( 'add_meta_boxes', 'colormag_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function colormag_add_custom_box() {
	// Adding layout meta box for page
	add_meta_box( 'page-layout', __( 'Select Layout', 'colormag' ), 'colormag_page_layout', 'page', 'side', 'default' );
	// Adding layout meta box for
	add_meta_box( 'page-layout', __( 'Select Layout', 'colormag' ), 'colormag_page_layout', 'post', 'side', 'default' );
}

/****************************************************************************************/

global $page_layout;
$page_layout = array(
							'default-layout' 	=> array(
														'id'			=> 'colormag_page_layout',
														'value' 		=> 'default_layout',
														'label' 		=> __( 'Default Layout', 'colormag' )
														),
							'right-sidebar' 	=> array(
														'id'			=> 'colormag_page_layout',
														'value' 		=> 'right_sidebar',
														'label' 		=> __( 'Right Sidebar', 'colormag' )
														),
							'left-sidebar' 	=> array(
														'id'			=> 'colormag_page_layout',
														'value' 		=> 'left_sidebar',
														'label' 		=> __( 'Left Sidebar', 'colormag' )
														),
							'no-sidebar-full-width' => array(
															'id'			=> 'colormag_page_layout',
															'value' 		=> 'no_sidebar_full_width',
															'label' 		=> __( 'No Sidebar Full Width', 'colormag' )
															),
							'no-sidebar-content-centered' => array(
															'id'			=> 'colormag_page_layout',
															'value' 		=> 'no_sidebar_content_centered',
															'label' 		=> __( 'No Sidebar Content Centered', 'colormag' )
															)
						);

/****************************************************************************************/

/**
 * Displays metabox to for select layout option
 */
function colormag_page_layout() {
	global $page_layout, $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

	foreach ($page_layout as $field) {
		$layout_meta = get_post_meta( $post->ID, $field['id'], true );
		if( empty( $layout_meta ) ) { $layout_meta = 'default_layout'; }
		?>
			<input class="post-format" type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $layout_meta ); ?>/>
			<label class="post-format-icon"><?php echo $field['label']; ?></label><br/>
		<?php
	}
}

/****************************************************************************************/

add_action('pre_post_update', 'colormag_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to pre_post_update hook
 */
function colormag_save_custom_meta( $post_id ) {
	global $page_layout, $post;

	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
      return;

	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
      return;

	if ('page' == $_POST['post_type']) {
      if (!current_user_can( 'edit_page', $post_id ) )
         return $post_id;
   }
   elseif (!current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
   }

	foreach ($page_layout as $field) {
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}