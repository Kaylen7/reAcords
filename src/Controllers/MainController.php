<?php

namespace Src\Controllers;

use Src\Models\Configuration;
use Src\Views\Pager;
use Src\Models\AcordsCollection;
use Src\Controllers\AcordsCollectionController;
use Src\Controllers\AcordsController;
use Src\Models\AcordsGenerator;
use Src\Views\AcordsDisplay;

class MainController extends Configuration{

    public function getAcordsRandom(){
        $acords = ["A", "B", "C", "D", "E", "F", "G"];
        $generator = new AcordsGenerator($acords, self::$configuration['minuts-estudi'], self::$compas, self::$tempo, true);
        $display = new AcordsDisplay();
        $controller = new AcordsController($generator, $display);

        $controller->run();
    }

    public function getAcordsEspecifics(string $acords, bool $random = false){
        $arrAcords = explode(",", str_replace(' ', '', $acords));
        $generator = new AcordsGenerator($arrAcords, self::$configuration['minuts-estudi'], self::$compas, self::$tempo, $random);
        $display = new AcordsDisplay();
        $controller = new AcordsController($generator, $display);
        $controller->run();
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