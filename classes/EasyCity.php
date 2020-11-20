<?php

class EasyCity{

    public $version = "2.0.0";
    public $plugin_name;
    public $plugin_dir;
    public $plugin_url;
    public $css_url;
    public $js_url;
    protected $register = [
        'css' => [],
        'js' => [],
        'wp_register_style' => [],
        'wp_register_script' => [],
    ];

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
            foreach($this->register['css'] as $name=>$css)
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
            foreach( $this->register['js'] as $name=>$js)
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

    private function init_register()
    {
        add_action( 'wp_enqueue_scripts', function() {
            foreach($this->register['wp_register_style'] as $key=>$css)
            {
                $path = $this->css_url . $css;
                wp_register_style( $key, $path);
            }

            foreach($this->register['wp_register_script'] as $key=>$js)
            {
                $path = $this->js_url . $js;
                wp_register_style( $key, $path);
            }
        }, 11);
    }

    public function registerCss($name, $cssPath)
    {
        $this->register['wp_register_style'][$name] = $cssPath;
        return $this;
    }

    public function registerJs($name, $jsPath)
    {
        $this->register['wp_register_script'][$name] = $jsPath;
        return $this;
    }

    public function addCss($css,$name = null)
    {
        if($name==null)
        {
            $this->register['css'][] = $css;
        }
        else
        {
            $this->register['css'][$name] = $css;
        }

        return $this;
    }

    public function addJs($js,$name = null)
    {
        if($name==null)
        {
            $this->register['js'][] = $js;
        }
        else
        {
            $this->register['js'][$name] = $js;
        }

        return $this;
    }

    public function run()
    {
        $this->load_css();

        $this->load_js();

        $this->load_hooks();

        $this->init_register();

        return $this;
    }
    
}