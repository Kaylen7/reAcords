<?php

namespace Src\Controllers;

use Src\Controllers\CatalogController;
use Src\Services\AcordsFactory;

class MainController{

    public function getAcordsRandom(){
        $acords = ["A", "B", "C", "D", "E", "F", "G"];
        $controller = new AcordsFactory(
            [
                "acords" => $acords,
                "random" => true
            ]);
        $controller->init();
    }

    public function getAcordsEspecifics(string $acords, bool $random = false){
        $arrAcords = explode(",", str_replace(' ', '', $acords));

        $controller = new AcordsFactory(
            [
                "acords" => $arrAcords,
                "random" => $random
            ]);
        $controller->init();
    }

    public function getAcordsColeccio(){
        $controller = new CatalogController();
        $controller->init();
    }
}