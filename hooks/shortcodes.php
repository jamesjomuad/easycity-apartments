<?php
#
# Shortcodes
#
add_shortcode( 'apartments', function ( $atts ){
    $this->css('ec_bulma');
    $this->css('ec_bulma-calendar');
    $this->css( 'ec_all');
    $this->css( 'ec_jquery-ui');
    $this->css( 'ec_style');
    $this->js( 'ec_scrollspy');
    $this->js( 'ec_jquery-ui');
    $this->js( 'ec_jquery');
    $this->js( 'ec_jquery_sticky');
    $this->js( 'ec_bulma-calendar');
    $this->js( 'ec_validate');
    $this->js( 'ec_listing');

    view('listing');
});