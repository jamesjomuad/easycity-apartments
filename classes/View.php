<?php

class View{
    private $path       = EASYCITY_DIR.'/views/';
    private $extensions = ['php','html','htm'];
    private $template   = null;
    private $name       = null;
    private $variables  = [];
    private $view       = null;
    

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function get(string $name)
    {
        return $this->set($name)->render();
    }

    public function isExist($name)
    {
        foreach($this->extensions as $extension)
        {
            if(file_exists( $this->path.$name.'.'.$extension ))
                return true;
        }

        return false;
    }

    public function set($name=null, $variables = [])
    {
        if($name==null)
        return;

        $this->name = $name;
        $this->variables = $variables;

        foreach($this->extensions as $extension)
        {
            $templatePath = $this->path.$name.'.'.$extension;
            if(file_exists( $templatePath ))
            {
                $this->template = $name.'.'.$extension;
                $this->view = $templatePath;
                break;
            }
        }

        if(!$this->isExist($this->name))
        {
            throw new Exception("View not found!");
        }

        return $this;
    }

    public function render()
    {
        extract($this->variables);
        ob_start();
        include $this->view;
        return ob_get_clean();
    }

    public function with(array $variables = [])
    {
        $this->variables = $variables;
        return $this;
    }

}