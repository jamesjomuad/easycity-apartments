<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    // wp_enqueue_style('ec_bulma');
    // wp_enqueue_style('ec_all');
    // wp_enqueue_style('ec_style');

    // wp_enqueue_script('ec_scrollspy');
    // wp_enqueue_script('ec_jquery.sticky');
    // wp_enqueue_script('ec_script');

    view('listing');
});