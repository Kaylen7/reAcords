<?php

namespace Src\Services;

use Src\Services\MenuFactory;
use Src\Controllers\CatalogueController;
use Src\Models\Catalogue;

class CatalogueService {

    private const OPCIONS = ["assajar secció", "buscar per artista-cançó"]; 
    private CatalogueController $controller;

    public function __construct(
    ){
        $model = new Catalogue();
        $this->controller = new CatalogueController($model);
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