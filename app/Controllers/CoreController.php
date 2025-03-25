<?php

namespace univers_fabuleux\Controllers;

// Import Classe erterne + alias
use League\Plates\Engine as Plates;
use univers_fabuleux\Application;
use univers_fabuleux\Utils\User;
use univers_fabuleux\Models\ThemeModel;

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

        $connectedUser = false;
        // $connectedUser = User::isConnected() ? User::getConnectedUser() : false; // $connectedUser => user connecté
        $userTheme = null;
        $themeStyle = null;

	if (User::isConnected() === true) {
	    $connectedUser = User::getConnectedUser();
	    $themeId = $connectedUser->getTheme_id();
	    $userTheme = ($themeId !== null) ? ThemeModel::find($themeId) : null;
	    $themeStyle = ($userTheme !== false && $userTheme !== null) ? $userTheme->getStyle() : 'style.css';
	}
        // Transmission des données à toutes les views
        $this->templateEngine->addData([
            'router' => $this->router,
            'basePath' => $app->getConfig('BASE_PATH'),
            'connectedUser' => $connectedUser,
            'themeStyle' => $themeStyle,
            ]);
    }

    /**
     * show : Méthode permettant d'afficher la view correspondante à une page avec construction du template et retour du résultat grâce à "render".
     *
     * @param string $templateName
     * @param mixed array
     */
    protected function show(string $templateName, array $dataToViews = [])
    {
        $viewFolder = '';

        echo $this->templateEngine->render($viewFolder.$templateName, $dataToViews);
    }

    /**
     * sendJson :  Méthode permettant d'afficher une réponse JSON.
     *
     * @param mixed $data
     */
    protected static function sendJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
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
