<?php

class Core
{
    public function run()
    {
        // Pega a URL digitada
        $url = end(explode("index.php",$_SERVER["PHP_SELF"]));
        $params = array();
        
        if (!empty($url)) {
            $url = explode("/",$url);
            
            //Exclui o primeiro registro, que é vazio
            array_shift($url);
            
            //Pega o Controller
            $currentController = $url[0]."Controller";
            array_shift($url);
            
            //Pega a Action
            //Evita erro quando URL termina com "/"
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = "index";
            }
            
            // Pega parametros
            if (count($url) > 0) {
                $params = $url;
            }
            
        } else {
            $currentController = "homeController";
            $currentAction = "index";
        }
        
        require_once "core/Controller.php";
        
        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $params);
    }
}