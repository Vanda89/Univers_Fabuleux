<?php

namespace P5universFabuleux\Controllers;

class MainController extends CoreController
{
    public function showHome()
    {
        $dataToViews = [
        ];

        $this->show('main/home');
    }

    public function showGame($id)
    {
        $dataToViews = [
            'game' => $game,
        ];

        $this->show('main/home');
    }
}
