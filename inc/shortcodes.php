<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
	ob_start();
    include(EASYCITY_DIR.'\views\listing.php');
    return ob_get_clean();
});