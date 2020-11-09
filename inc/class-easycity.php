<?php

class EasyCity {
    private $viewDir = EASYCITY_DIR.'\views';
    private $viewExtensions = ['php','html','htm'];

    public function view($name=null, $variables = [])
    {
        if($name==null)
        return;

        foreach($this->viewExtensions as $extension){
            $viewPath = EASYCITY_DIR."/views/".$name.'.'.$extension;
            if(file_exists($viewPath)){
                extract($variables);
                ob_start();
                include $viewPath;
                return ob_get_clean();
            }
        }

        throw new Exception("View not found!");
    }

}