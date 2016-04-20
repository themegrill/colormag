<?php if ( has_post_format( 'gallery' ) ) : ?>

   <div class="gallery-post-format">
      <?php
      $galleries = get_post_gallery_images( $post );

      $output = '<ul class="gallery-images">';
      foreach ($galleries as $gallery) {
         $output .= '<li>' . '<img src="'. $gallery . '">' . '</li>';
      }
      $output .= '</ul>';

      echo $output;
      ?>
   </div>

<?php endif; ?>