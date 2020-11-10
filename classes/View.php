<?php

class View{
    private $viewPath = EASYCITY_DIR.'\views';
    private $ext = ['php','html','htm'];
    private $name = ['php','html','htm'];

    public function view($name=null, $variables = [])
    {
        if($name==null)
        return;

        foreach($this->ext as $extension){
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

    public function get()
    {
        return $this->view($this->name);
    }

    public function getPath()
    {
        return $this->viewPath;
    }

    public function setPath($path)
    {
        $this->viewPath = $path;
        return $this;
    }
}