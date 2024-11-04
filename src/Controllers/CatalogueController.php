<?php

namespace Src\Controllers;

use Src\Services\MenuFactory;
use Src\Services\PagerFactory;
use Src\Services\AcordsFactory;
use Src\Models\Catalogue;

class CatalogueController{

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
        $collection = new Catalogue();
        $cataleg = $collection->getCollection();

        $pager = new PagerFactory($cataleg, 1, true);
        $result = $pager->init();

        if($result){
            [$pag, $index] = $result;
            $acordsGenerator = new AcordsFactory($pag[$index]["serie"]);
            $acordsGenerator->init();
        }
    }

    private function getPagerPerArtista(): void{
        $collection = new Catalogue();
        $cataleg = $collection->getIndexExamples();

        $pager = new PagerFactory($cataleg, 5, false);
        $result = $pager->init();

        if(!in_array(NULL, $result)){
            [$pag, $key] = $result;
            [$artist, $song] = $pag[$key - 1];

            $acords = $collection->getAcordsByArtistSong($artist, $song);
            echo "\nHas triat " . implode(", ", $acords) . " de la cançó " . $song . " de " . $artist;
            sleep(3);
            $acordsGenerator = new AcordsFactory($acords);
            $acordsGenerator->init();
        } else {
            echo "\nEp! falten paràmetres.\n";
        }
    }
}