<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    view('listing');
});