<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    // echo view()->set('listing')->render();
    ob_start();
    include(EASYCITY_DIR.'/views/listing.php');
    return ob_get_clean();
});