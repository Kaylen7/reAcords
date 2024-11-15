<?php

namespace Src\Services;

use Src\Services\MenuFactory;
use Src\Controllers\CatalogueController;
use Src\Models\Catalogue;
use Src\Views\CatalogueDisplay;

class CatalogueService {

    private const OPCIONS = ["Veure per seccions", "Veure per artista-cançó"]; 
    private CatalogueController $controller;

    public function __construct(
    ){
        $model = new Catalogue();
        $display = new CatalogueDisplay();
        $this->controller = new CatalogueController($model, $display);
    }

    public function init(){
        $menu = new MenuFactory(self::OPCIONS);
        $opcio = $menu->init();
        switch(array_search($opcio, self::OPCIONS)){
            case 0:
                if($opcio === ""){
                    break;
                }
                $this->controller->getPagerPerSeccions();
                break;
            case 1:
                $this->controller->getPagerPerArtista();
                break;
        }
    }
    
}