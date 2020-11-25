<?php

class View{
    private $directory  = EASYCITY_DIR.'/views/';
    private $extensions = ['php','html','htm'];
    private $template   = null;
    private $name       = null;
    private $variables  = [];
    private $viewPath   = null;
    private $toRender   = false;
    public $isExist     = false;

    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    public function getDirectory()
    {
        $this->toRender = false;
        return $this->path;
    }

    public function getPath()
    {
        $this->toRender = false;
        return $this->viewPath;
    }

    public function isExist($name)
    {
        foreach($this->extensions as $extension)
        {
            if(file_exists( $this->directory.$name.'.'.$extension ))
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
        $this->toRender = false;

        foreach($this->extensions as $extension)
        {
            $templatePath = $this->directory.$name.'.'.$extension;
            if(file_exists( $templatePath ))
            {
                $this->isExist = true;
                $this->template = $name.'.'.$extension;
                $this->viewPath = $templatePath;
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
        $this->toRender = true;
        return $this;
    }

    public function partial($name)
    {
        return $this->set("partials/".$name)->render();
    }

    public function section($name, $variables = [])
    {
        return $this->set("sections/".$name, $variables)->render();
    }

    public function with(array $variables = [])
    {
        $this->variables = $variables;
        return $this;
    }

    public function get()
    {
        $this->toRender = false;
        extract($this->variables);
        ob_start();
        include $this->viewPath;
        return ob_get_clean();
    }

    function __destruct()
    {
        if($this->toRender==true)
        {
            extract($this->variables);
            ob_start();
            include $this->viewPath;
            echo ob_get_clean();
        }
        
    }
}