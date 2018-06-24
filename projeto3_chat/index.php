<?php
session_start();
require "config.php";

define ("BASE_URL", "/modulo8_1_sistemas_basico/projeto3_chat/");

// Carrega todas as classes controllers e views
spl_autoload_register(function($class) {
    // Verifica se existem registros de classes controllers
    if (strpos($class,"Controller") > -1) {
        // Verifica se existem os arquivos da classe controllers
        // OBS: Apenas classes controllers possuem a nomenclatura "<nome>Controller"
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