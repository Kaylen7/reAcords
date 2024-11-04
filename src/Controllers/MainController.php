<?php

namespace Src\Controllers;

use Src\Services\AcordsFactory;
use Src\Services\CatalogueService; 

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
        $controller = new CatalogueService();
        $controller->init();
    }
}