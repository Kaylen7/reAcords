<?php

namespace Src\Controllers;

use Src\Controllers\CatalogueController;
use Src\Services\AcordsFactory;

class MainController{

    public function getAcordsRandom(){
        $acords = ["A", "B", "C", "D", "E", "F", "G"];
        $controller = new AcordsFactory($acords, true);
        $controller->init();
    }

    public function getAcordsEspecifics(string $acords, bool $random = false){
        $arrAcords = explode(",", str_replace(' ', '', $acords));

        $controller = new AcordsFactory($arrAcords, $random);
        $controller->init();
    }

    public function getAcordsColeccio(){
        $controller = new CatalogueController();
        $controller->init();
    }
}