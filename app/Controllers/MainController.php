<?php

namespace P5universFabuleux\Controllers;

use P5universFabuleux\Models\GameModel;
use P5universFabuleux\Models\NewsModel;
use P5universFabuleux\Utils\User;

class MainController extends CoreController
{
    public function showHome()
    {
        $user = User::isConnected() ? User::getConnectedUser() : false;
        $welcome = 'Bienvenue ';
        $welcome .= ($user != false) ? $user->getFirstname() : 'visiteur';
        $welcome .= ',';

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
            \dump($item);
        }

        $dataToViews = [
            'welcome' => $welcome,
            'nbSlide' => $nbSlide,
            'newsList' => $newsList,
        ];

        $this->show('main/home', $dataToViews);
    }

    public function showGame($gameId)
    {
        // \dump($_GET['id']);
        $gameId = $_GET['id'];
        $game = GameModel::find($gameId);
        $gameStyle = $game->getStyle();
        // \dump($gameStyle);

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
            case '3':
                $this->show('game/mystery');
                break;
            case '4':
                $this->show('game/bubbles');
                break;
        }
    }
}
