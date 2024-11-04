<?php

namespace Src\Controllers;

use Src\Services\MenuFactory;
use Src\Services\PagerFactory;
use Src\Services\AcordsFactory;
use Src\Models\Catalog;

class CatalogController{

    private const OPCIONS = ["assajar secció", "buscar per artista-cançó"]; 

    public function init(){
        $menu = new MenuFactory(self::OPCIONS);
        $opcio = $menu->init();
        switch(array_search($opcio, self::OPCIONS)){
            case 0:
                if($opcio === ""){
                    break;
                }
                $this->getPagerPerSeccions();
                break;
            case 1:
                $this->getPagerPerArtista();
                break;
        }
    }

    private function getPagerPerSeccions(): void{
        $collection = new Catalog();
        $cataleg = $collection->getCollection();

        $pager = new PagerFactory($cataleg, 1, true);
        $result = $pager->init();

        if($result){
            $acordsGenerator = new AcordsFactory($result[0]["serie"]);
            $acordsGenerator->init();
        } else {
            echo "Unrecognized selection" . PHP_EOL;
        }
    }

    private function getPagerPerArtista():void {
        $collection = new Catalog();
        $cataleg = $collection->getIndexExamples();

        $pager = new PagerFactory($cataleg, 5, true);
        $pager->init();
    }
}