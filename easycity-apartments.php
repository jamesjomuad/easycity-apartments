<?php
/*
Plugin Name: Easycity Apartments
Plugin URI: https://easycity.com
Description: Easycity Apartment Listings
Version: 2.0.0
Author: Ken, James Jomuad
Author URI: http://easycity.com
Copyright: Ken
Text Domain: easycity-apartments
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// vars
define('EASYCITY_DIR', dirname(__FILE__) );
define('EASYCITY_URL', plugin_dir_url( __FILE__ ) );

// $basename = plugin_basename( __FILE__ );
// $path = plugin_dir_path( __FILE__ );
// $url = plugin_dir_url( __FILE__ );
// $slug = dirname($basename);

include_once('inc/class-easycity.php');
include_once('inc/helpers.php');
include_once('inc/actions.php');
include_once('inc/filters.php');
include_once('inc/shortcodes.php');
include_once('inc/ajax.php');


// add_action('init', function(){
//     dd(
//         easycity()->view('map-popup')
//     );
// });