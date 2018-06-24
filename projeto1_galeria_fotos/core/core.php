<?php

class core
{
    public function run()
    {
        $url = end(explode("index.php",$_SERVER["PHP_SELF"]));
        $params = array();
        
        if (!empty($url)) {
            $url = explode("/",$url);
            
            // Exclui o primeiro registro que é vazio.
            array_shift($url);
            
            $currentController = $url[0]."Controller";
            array_shift($url);
            
            // Evita erro quando a URL finaliza com "/"
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = "index";
            }
            
            // Pega os parametros
            if (count($url) > 0) {
                $params = $url;
            }
            
        } else {
            $currentController = "homeController";
            $currentAction = "index";
        }
        
        // Chama o Controller e a Action
        require_once "core/controller.php";
        
        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $params);
    }
}

?>