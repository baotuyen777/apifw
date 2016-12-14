<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class View{
    protected $app_name="";
    protected $module_name="";
    protected $template_directory;
    function __construct($app,$module) {
        $this->app_name=$app;
        $this->module_name=$module;
      //  $this->template_directory=SITE_ROOT.'apps/'.$app.'/';
        

    }

    public function render($file){
            require 'templates/'.$this->app_name.'/header.php';
            require 'apps/'.$this->app_name.'/'.$this->module_name.'/'.$this->module_name.'_views/'.$file.".php";
            require 'templates/'.$this->app_name.'/footer.php';
    }
    /**
     * @var get_controller_url
     * @param type $module
     * @param type $app
     * @return type
     */
    public function get_controller_url($module=NULL, $app=NULL)
    {
        if (empty($app))
        {
            $app = $this->app_name;
        }
        if (empty($module))
        {
            $module = $this->module_name;
        }

        if (file_exists('.htaccess'))
        {
            return SITE_ROOT . $app . '/' . $module . '/';
        }
        return SITE_ROOT . 'index.php?url=' . $app . '/' . $module . '/';
    }

}
?>
