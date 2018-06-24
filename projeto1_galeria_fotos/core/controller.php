<?php

class controller 
{
    public function __construct() {
        global $config;
        $this->db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        include "views/".$viewName.".php";
    }
    
    public function loadTemplate($viewName, $viewData = array())
    {
        include "views/template.php";
    }
    
    public function loadViewInTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        include "views/".$viewName.".php";
    }
}

?>