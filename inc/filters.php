<?php
#
# Filter Hooks
#
add_filter( 'post_type_link', function( $post_link, $post, $leavename ) {

    if ( 'apartment' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
  
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
  
    return $post_link;
  }, 10, 3 );
  
  add_filter('single_template', function($single) {
    global $post;
    $template_path = EASYCITY_DIR . '\views\apartment-single.php';
  
    /* Checks for single template by post type */
    if ( $post->post_type == 'apartment' ) {
        if ( file_exists($template_path) ) {
            return $template_path;
        }
    }
  
    return $single;
});
  