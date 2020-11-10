<?php
#
# Helper Functions
#
function add_ajax($name,$callback){
    $fn = function() use($callback) {
        $callback();
        wp_die();
    };
    add_action( 'wp_ajax_'.$name, $fn);
    add_action( 'wp_ajax_nopriv_'.$name, $fn);
}

function Easycity(){
    if(class_exists('EasyCity')){
        return (new EasyCity())->run();
    }
    return null;
}

function view($name,$variables){
    if(class_exists('View')){
        return (new View())->view($name,$variables);
    }
    return null;
}