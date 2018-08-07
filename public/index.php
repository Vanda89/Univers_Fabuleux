<?php

// Chargement de l'autoload de Composer
require __DIR__.'/../vendor/autoload.php';

// Importation de chaque classe grâce à l'objet Application (évite de toutes les inclure)
use P5universFabuleux\Application;

session_start();

// Instanciation de l'objet Application et appel de la méthode run
$app = new Application();
$app->run();
