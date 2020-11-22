<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    $this->css('ec_bulma');
    $this->css( 'ec_all');
    $this->css( 'ec_jquery-ui');
    $this->css( 'ec_style');
    $this->js( 'ec_scrollspy');
    $this->js( 'ec_jquery');
    $this->js( 'ec_jquery');
    $this->js( 'ec_script');

    view('listing');
});