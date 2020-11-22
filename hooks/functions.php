<?php
#
# Helper Functions
#
function add_ajax($name,$callback)
{
    $fn = function() use($callback) {
        $callback();
        wp_die();
    };
    add_action( 'wp_ajax_'.$name, $fn);
    add_action( 'wp_ajax_nopriv_'.$name, $fn);
}

function view($name=null,$variables=[])
{
    if(class_exists('View'))
    {
        if($name == null)
        {
            return new View();
        }
        else
        {
            return (new View())->set($name,$variables)->render();
            // return (new View())->set($name,$variables)->render();
        }
    }
    return null;
}