<?php

namespace Src\Services;

use Src\Services\MenuFactory;
use Src\Controllers\ConfigurationController;

class ConfigurationService{

    private const OPCIONS = ["Canviar Compàs", "Canviar Tempo", "Canviar minuts d'estudi", "Activar/Desactivar mode aleatori", "Veure configuració"];

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
                break;
            case 1:
                $this->controller->changeTempo();
                break;
            case 3:
                $this->controller->changeMinuts();
                self::init();
                break;
            case 4:
                $this->controller->showConfiguration();
                break;
        }
    }


}