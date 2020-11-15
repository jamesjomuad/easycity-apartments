<?php

class EasyCity{
    public $version = "2.0.0";
    public $plugin_name;
    public $plugin_dir;

    public function __construct() {
        $this->version = defined( 'EASYCITY_DIR' ) ? EASYCITY_VERSION : '1.0.0' ;

        $this->plugin_dir = defined( 'EASYCITY_DIR' ) ? EASYCITY_DIR : dirname(__FILE__) ;

		$this->plugin_name = 'easycity-apartments';
	}

    private function load_hooks() {

        require_once $this->plugin_dir . "/library/functions.php";

        require_once $this->plugin_dir . "/library/shortcodes.php";

        require_once $this->plugin_dir . "/library/actions.php";

        require_once $this->plugin_dir . "/library/filters.php";

        require_once $this->plugin_dir . "/library/shortcodes.php";

        require_once $this->plugin_dir . "/library/ajax.php";

    }

    public function run() {
        $this->load_hooks();
	}
}