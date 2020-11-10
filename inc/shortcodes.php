<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    return view('listing');
});