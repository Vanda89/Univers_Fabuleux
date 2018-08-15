<?php

namespace P5universFabuleux;

use AltoRouter; // => import AltoRouter

// FrontController
class Application
{
    private $router;

    private $config;

    // A l'instanciation
    public function __construct()
    {
        // Récupération des données de la config
        $this->config = parse_ini_file(__DIR__.'/config.conf');

        // instanciation du routeur
        $this->router = new AltoRouter();

        // configuration du routeur instancié
        $this->router->setBasePath($this->getConfig('BASE_PATH'));

        // Appel à la méthode s'occupant de définir toutes les routes
        $this->defineRoutes();
    }

    // Méthode s'occupant de définir toutes les routes
    public function defineRoutes()
    {
        // Home
        $this->router->map('GET', '/', 'MainController#showHome', 'main_home');
        // CGU
        $this->router->map('GET', '/cgu', 'MainController#cgu', 'main_cgu');
        // 1 jeu
        $this->router->map('GET', '/game', 'MainController#showGame', 'game_game');
        // Mentions légales
        $this->router->map('GET', '/legal-notice', 'MainController#legalNotice', 'main_legalnotice');
        // Inscription
        $this->router->map('GET', '/signup', 'UserController#signup', 'user_signup'); // Lien vers la page
        $this->router->map('POST', '/signupSubmit', 'UserController#signupSubmit', 'user_signupSubmit'); // Formulaire
        // Connexion
        $this->router->map('GET', '/login', 'UserController#login', 'user_login'); // Lien vers la page
        $this->router->map('POST', '/loginSubmit', 'UserController#loginSubmit', 'user_loginSubmit'); // Formulaire
        // Déconnexion
        $this->router->map('GET', '/logout', 'UserController#logout', 'user_logout');
        // Espace personnel
        $this->router->map('GET', '/profile', 'UserController#profile', 'user_profile'); // Lien vers la page
        $this->router->map('POST', '/profile/save', 'UserController#saveProfile', 'user_saveProfile'); // Enregistrement des nouvelles données
    }

    // créer la méthode run qui doit afficher un message qui permet de vérifier qu'elle est bien exécutée
    public function run()
    {
        // le routeur doit retourner la route correspondant à l'URL courante
        $match = $this->router->match();

        // Si on trouve une route
        if ($match !== false) {
            // Récupération des informations sur le controller et la méthode
            $dispatcherInfos = $match['target'];

            // Séparation des 2 parties se trouvant dans target ('MainController#home')
            $controllerAndMethod = explode('#', $dispatcherInfos);

            // Stockage des noms dans des variables
            $controllerName = $controllerAndMethod[0];
            $methodName = $controllerAndMethod[1];

            // Ajout du namespace des Controllers afin d'avoir un FQCN
            $controllerName = 'P5universFabuleux\Controllers\\'.$controllerName;

            // Instanciation du controller avec spécification du FQCN et passage de l'objet Application en argument
            $controller = new $controllerName($this);

            // Appel de la méthode correspondante à la route
            $controller->$methodName($match['params']);
        }
        // Si aucune route ne correspond à l'URL courante
        else {
            echo 'PAS DE ROUTE CORRESPONDANTE';
        }
    }

    // GETTERS
    // Spécification du type de données retournées : Altorouter
    public function getRouter(): AltoRouter
    {
        return $this->router;
    }

    // Configuration du fichier de config
    public function getConfig(string $param)
    {
        if (array_key_exists($param, $this->config)) {
            return $this->config[$param];
        }

        return false;
    }
}
