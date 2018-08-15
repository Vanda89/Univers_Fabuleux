<?php

namespace P5universFabuleux\Controllers;

use P5universFabuleux\Models\GameModel;

class MainController extends CoreController
{
    public function showHome()
    {
        $dataToViews = [
        ];

        $this->show('main/home');
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
            // case '1':
            //     $this->show('game/draw');
            //     break;
            case '2':
                $this->show('game/memory');
                break;
            case '3':
                $this->show('game/typeLetter');
                break;
            case '4':
                $this->show('game/mystery');
                break;
            // case '5':
            //     $this->show('game/bubbles');
            //     break;
        }
    }
}
