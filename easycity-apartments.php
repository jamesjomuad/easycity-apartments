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

define('EASYCITY_VERSION', '2.0.0');
define('EASYCITY_LOADED', true);
define('EASYCITY_DIR', dirname(__FILE__) );
define('EASYCITY_URL', plugin_dir_url( __FILE__ ) );

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}



$app = new EasyCity();

$app->run();

// $app->init();