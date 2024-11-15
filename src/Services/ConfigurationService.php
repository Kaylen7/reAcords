<?php

namespace Src\Services;

use Src\Services\MenuFactory;
use Src\Controllers\ConfigurationController;
use Src\Views\ConfigurationDisplay;

class ConfigurationService{

    private const OPCIONS = ["Canviar Compàs", "Canviar Tempo", "Canviar minuts d'estudi", "Veure configuració"];

    private ConfigurationController $controller;

    public function __construct(
    ){
        $this->controller = new ConfigurationController();
    }

    public function init(){
       
        $menu = new MenuFactory(self::OPCIONS);
        $opcio = $menu->init();

        switch(array_search($opcio, self::OPCIONS)){
            case 0:
                if($opcio === ""){
                    break;
                }
                $this->controller->changeCompas();
                $this->backToInit(2);
                break;
            case 1:
                $this->controller->changeTempo();
                $this->backToInit(2);
                break;
            case 2:
                $display = new ConfigurationDisplay();
                $display->clearScreen();
                $minuts = readline("Quant de temps vols estudiar? (En minuts)" . PHP_EOL);
                $this->controller->changeMinuts($minuts);
                $this->backToInit(2);
                break;
            case 3:
                $this->controller->showConfiguration();
                $this->backToInit(4);
                break;
        }
    }

    private function backToInit(int $time){
        sleep($time);
        self::init();
    }


}