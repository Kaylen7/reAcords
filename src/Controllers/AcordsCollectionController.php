<?php

namespace Src\Controllers;

use Src\Services\MenuFactory;
use Src\Views\Pager;
use Src\Models\AcordsCollection;

class AcordsCollectionController{

    public function init(){
        $opcions = ["assajar secció", "buscar per artista-cançó"];
        $menu = new MenuFactory($opcions);
        $opcio = $menu->init();
        
        switch(array_search($opcio, $opcions)){
            case 0:
                $this->getPager();
                break;
            case 1:
                echo "1";
                break;
        }
    }

    private function getPager(){
        $collection = new AcordsCollection();
        $cataleg = $collection->getCollection();
        $pager = new Pager($cataleg);
        $pager->navegar();
    }
}