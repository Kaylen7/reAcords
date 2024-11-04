<?php

namespace Src\Controllers;

use Src\Models\Configuration;
use Src\Controllers\AcordsCollectionController;
use Src\Services\AcordsFactory;

class MainController extends Configuration{

    public function getAcordsRandom(){
        $acords = ["A", "B", "C", "D", "E", "F", "G"];
        $controller = new AcordsFactory(
            [
                "acords" => $acords, 
                "minutsAssaig" => self::$configuration['minuts-estudi'],
                "compas" => self::$compas,
                "tempo" => self::$tempo,
                "random" => true
            ]);
        $controller->init();
    }

    public function getAcordsEspecifics(string $acords, bool $random = false){
        $arrAcords = explode(",", str_replace(' ', '', $acords));

        $controller = new AcordsFactory(
            [
                "acords" => $arrAcords, 
                "minutsAssaig" => self::$configuration['minuts-estudi'],
                "compas" => self::$compas,
                "tempo" => self::$tempo,
                "random" => $random
            ]);
        $controller->init();
    }

    public function getAcordsColeccio(){
        $controller = new AcordsCollectionController();
        $controller->init();
    }

    public function getConfig(){
        var_dump(self::$configuration);
    }

    public function setConfig(){
        echo "Working on it!";
    }
}