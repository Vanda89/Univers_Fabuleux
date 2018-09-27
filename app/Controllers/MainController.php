<?php

namespace P5universFabuleux\Controllers;

use P5universFabuleux\Models\GameModel;
use P5universFabuleux\Models\NewsModel;
use P5universFabuleux\Utils\User;

class MainController extends CoreController
{
    /**
     * showHome : méthode gérant l'affichage de la page d'accueil avec message de bienvenue personnalisé et pagination des news.
     */
    public function showHome()
    {
        $user = User::isConnected() ? User::getConnectedUser() : false;
        $welcome = 'Bienvenue ';
        $welcome .= ($user != false) ? $user->getFirstname() : 'visiteur';
        $welcome .= ' !';

        if (isset($_GET['news'])) {
            $news = $_GET['news'];
        } else {
            $news = 1;
        }

        $nbNewsBySlide = 1;
        $nbNews = NewsModel::nbNews();
        $nbSlide = ceil($nbNews / $nbNewsBySlide);
        $allNews = NewsModel::findAllByPagination($news, $nbNewsBySlide);
        $newsList = [];
        foreach ($allNews as $key => $news) {
            $item = [
                'date' => $news->getCreation_date(),
                'title' => $news->getTitle(),
                'content' => $news->getContent(),
           ];
            array_push($newsList, $item);
        }

        $dataToViews = [
            'welcome' => $welcome,
            'nbSlide' => $nbSlide,
            'newsList' => $newsList,
        ];

        $this->show('main/home', $dataToViews);
    }

    /**
     * showGame : méthode permettant d'afficher le jeu désiré grâce à son id indiqué en bdd et sur son bouton de la nav.
     *
     * @param mixed $gameId
     */
    public function showGame($gameId)
    {
        $gameId = $_GET['id'];
        $game = GameModel::find($gameId);
        $gameStyle = $game->getStyle();

        $dataToViews = [
            'game' => $game,
            'gameStyle' => $gameStyle,
        ];

        switch ($game->getId()) {
            case '1':
                $this->show('game/memory');
                break;
            case '2':
                $this->show('game/typeLetter');
                break;
            default:
                $this->show('main/404');
            }
    }

    public function show404()
    {
        $this->show('main/404');
    }

    public function show403()
    {
        $this->show('main/403');
    }
}
