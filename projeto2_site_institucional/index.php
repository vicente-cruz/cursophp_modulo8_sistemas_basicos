<?php
require "config.php";

define("BASE_URL", "http://curso_php.pc/modulo8_1_sistemas_basico/projeto2_site_institucional/");

// Carrega as classes das respectivas pastas
spl_autoload_register(function ($class) {
    // Verifica se as classes sao Controller e se os arquivos existem de fato
    // OBS: Só classes controller possuem o padrao de nomeacao <nome>Controller
    if (strpos($class,"Controller") > -1) {
        if (file_exists("controllers/".$class.".php")) {
            require_once "controllers/".$class.".php";
        }
    } else if (file_exists("models/".$class.".php")) {
        require_once "models/".$class.".php";
    } else {
        require_once "core/".$class.".php";
    }
});

// Inicia o MVC
$core = new core();
$core->run();

?>