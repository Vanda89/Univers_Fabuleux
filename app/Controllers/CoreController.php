<?php

namespace P5universFabuleux\Controllers;

// Import Classe erterne + alias
use League\Plates\Engine as Plates;
use P5universFabuleux\Application;
use P5universFabuleux\Utils\User;

// classe héritée par tous les controllers
abstract class CoreController
{
    // moteur de template
    protected $templateEngine;

    // routeur AltoRouter
    protected $router;

    // Lors de la construction des Controllers, instanciation du moteur de templates "Plates", récup en argument de l'objet Application qui a instancié ce Controller
    // Application $app => forcer le paramètre à être un objet de la classe Application
    public function __construct(Application $app)
    {
        // Instance
        $this->templateEngine = new Plates(__DIR__.'/../Views');

        // Stockage de AltoRouter
        $this->router = $app->getRouter();

        // On transmet des données à toutes les views
        $this->templateEngine->addData([
            'router' => $this->router, // => $router dans toutes les views
            'basePath' => $app->getConfig('BASE_PATH'), // => $basePath
            'connectedUser' => User::isConnected() ? User::getConnectedUser() : false, // $connectedUser => user connecté
        ]);
    }

    // Méthode permettant d'afficher la view correspondante pour une page
    protected function show(string $templateName, array $dataToViews = [])
    {
        $viewFolder = '';

        // Construction du template et retour du résultat grâce à "render"
        echo $this->templateEngine->render($viewFolder.$templateName, $dataToViews);
    }

    // Méthode permettant d'afficher une réponse JSON
    protected static function sendJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // Méthode renvoyant sur une page d'erreur (404, 403, 500, etc.)
    public static function sendHttpError($errorCode)
    {
        // Erreur 404 not found
        if ($errorCode == 404) {
            header('HTTP/1.0 404 Not Found');

            exit;
        }
        // Erreur 403 Forbidden = vousn'avez pas les droits pour accéder à cette ressource
        elseif ($errorCode == 403) {
            header('HTTP/1.0 403 Forbidden');

            exit;
        }
    }

    /**
     * Méthode permettant de rediriger en PHP vers une URL.
     *
     * @param string $url
     */
    public function redirect(string $url)
    {
        header('Location: '.$url);
        exit;
    }

    /**
     * Méthode permettant de rediriger vers l'URL de la route en argument.
     *
     * @param string $routeName
     */
    public function redirectToRoute(string $routeName)
    {
        $this->redirect($this->router->generate($routeName));
    }
}
