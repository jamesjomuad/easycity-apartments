<?php

class EasyCity{

    public $version = "2.0.0";
    public $plugin_name;
    public $plugin_dir;
    public $plugin_url;
    public $css_url;
    public $js_url;
    public $css = [];
    public $js = [];


    public function __construct()
    {
        $this->version = defined( 'EASYCITY_DIR' ) ? EASYCITY_VERSION : '1.0.0' ;

        $this->plugin_dir = defined( 'EASYCITY_DIR' ) ? EASYCITY_DIR : dirname(__FILE__) ;
        
        $this->plugin_url = defined( 'EASYCITY_URL' ) ? EASYCITY_URL : plugin_dir_url( __FILE__ ) ;
        
        $this->plugin_css_path = defined( 'EASYCITY_DIR' ) ? EASYCITY_DIR : dirname(__FILE__) ;

        $this->css_url = $this->plugin_url . 'assets/css/';
        
        $this->js_url = $this->plugin_url . 'assets/js/';

		$this->plugin_name = 'easycity-apartments';
	}

    private function load_hooks()
    {

        require_once $this->plugin_dir . "/library/functions.php";

        require_once $this->plugin_dir . "/library/enqueue_scripts.php";

        require_once $this->plugin_dir . "/library/shortcodes.php";

        require_once $this->plugin_dir . "/library/actions.php";

        require_once $this->plugin_dir . "/library/filters.php";

        require_once $this->plugin_dir . "/library/shortcodes.php";

        require_once $this->plugin_dir . "/library/ajax.php";

    }

    private function load_css()
    {
        add_action( 'wp_enqueue_scripts', function() {
            foreach($this->css as $name=>$css)
            {
                if(is_int($name))
                {
                    $name = pathinfo($css, PATHINFO_FILENAME);
                    $path = $this->css_url . $css;
                    wp_register_style( 'EC_css_'.$name, $path);
                    wp_enqueue_style( 'EC_css_'.$name );
                }
                else
                {
                    $path = $this->css_url . $css;
                    wp_register_style( 'EC_'.$name, $path);
                    wp_enqueue_style( 'EC_'.$name );
                }
            }
        }, 11);

        return $this;
    }

    private function load_js()
    {
        add_action( 'wp_enqueue_scripts', function() {
            foreach($this->js as $name=>$js)
            {
                if(is_int($name))
                {
                    $name = pathinfo($js, PATHINFO_FILENAME);
                    $path = $this->js_url . $js;
                    wp_register_script('EC_js_'.$name, $path);
                    wp_enqueue_script('EC_js_'.$name);
                }
                else
                {
                    $path = $this->css_url . $css;
                    wp_register_style( 'EC_js_'.$name, $path);
                    wp_enqueue_style( 'EC_js_'.$name );
                }
            }
        }, 11);

        return $this;
    }

    public function addCss($css,$name = null)
    {
        if($name==null)
        {
            $this->css[] = $css;
        }
        else
        {
            $this->css[$name] = $css;
        }
        

        return $this;
    }

    public function addJs($js,$name = null)
    {
        if($name==null)
        {
            $this->js[] = $js;
        }
        else
        {
            $this->js[$name] = $js;
        }

        return $this;
    }

    public function run()
    {
        $this->load_css();

        $this->load_js();

        $this->load_hooks();

        return $this;
    }
    
}