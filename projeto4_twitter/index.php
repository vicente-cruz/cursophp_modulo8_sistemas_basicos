<?php
session_start();
require "config.php";

define ("BASE_URL","/modulo8_1_sistemas_basico/projeto4_twitter/");

// Carrega todas as classes Controllers e Models
spl_autoload_register(function($class) {
    // Verifica se há registros das classes Controllers
    if (strpos($class,"Controller") > -1) {
        // Verifica se existem os arquivos das classes Controllers
        // Obs: Apenas classes controllers possuem a nomenclatura "<nome>Controller"
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
$core = new Core();
$core->run();

?>