<?php

namespace Src\Controllers;

use Src\Services\AcordsFactory;
use Src\Services\CatalogueService; 
use Src\Services\ConfigurationService;
use Src\Views\MainDisplay;

class MainController{

    public function getAcordsRandom(){
        $acords = ["A", "B", "C", "D", "E", "F", "G"];
        $controller = new AcordsFactory($acords, true);
        $controller->init();
    }

    public function getAcordsEspecifics(string $acords, bool $random = false){
        $regex = "/([A-G](#|b)?(maj|min|m|dim|aug|\-|\+)?(sus2|sus4)?(\d{1,2})?(add\d{1,2})?(\/[A-G](#|b)?)?)/";
        if(preg_match($regex, $acords)){
            $arrAcords = explode(",", str_replace(' ', '', $acords));
            $controller = new AcordsFactory($arrAcords, $random);
            $controller->init();
        } else{
            $view = new MainDisplay();
            $view->showErrorMessage("❌ Nomenclatura invàlida");
        }
    }

    public function getAcordsColeccio(){
        $controller = new CatalogueService();
        $controller->init();
    }

    public function getConfiguration(){
        $controller = new ConfigurationService();
        $controller->init();
    }
}