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

function input($name = null)
{
    if(isset($_POST[$name]))
    {
        return $_POST[$name];
    }
    elseif(isset($_GET[$name]))
    {
        return $_GET[$name];
    }
    else
    {
        if(!empty($_POST))
        {
            return $_POST;
        }
        elseif(!empty($_GET))
        {
            return $_GET;
        }
    }

    return null;
}