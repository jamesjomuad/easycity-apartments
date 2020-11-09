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

function easycity(){
  if(class_exists('EasyCity')){
    return new EasyCity();
  }

  return null;
}