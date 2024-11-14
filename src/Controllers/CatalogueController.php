<?php

namespace Src\Controllers;

use Src\Services\PagerFactory;
use Src\Services\AcordsFactory;
use Src\Models\Catalogue;
use Src\Views\CatalogueDisplay;

class CatalogueController{

    public function __construct(
        private Catalogue $model,
        private CatalogueDisplay $display
    ){}

    public function getPagerPerSeccions(): void{
        $cataleg = $this->model->getCollection();

        $pager = new PagerFactory($cataleg, 1, true);
        $result = $pager->init();

        if($result){
            [$pag, $index] = $result;
            $this->display->showChosenMessage($pag[$index]["serie"], "", "", 2);
            $acordsGenerator = new AcordsFactory($pag[$index]["serie"]);
            $acordsGenerator->init();
        }
    }

    public function getPagerPerArtista(): void{
        $cataleg = $this->model->getIndexExamples();

        $pager = new PagerFactory($cataleg, 5, false);
        $result = $pager->init();

        if($result === NULL){
            //do nothing

        } elseif(!in_array(NULL, $result)){
            [$pag, $key] = $result;
            [$artist, $song] = $pag[$key - 1];

            $acords = $this->model->getAcordsByArtistSong($artist, $song);
            $this->display->showChosenMessage($acords, $song, $artist, 4);
            $acordsGenerator = new AcordsFactory($acords);
            $acordsGenerator->init();
        } else {
            echo "\nEp! falten paràmetres.\n";
            sleep(1);
            self::getPagerPerArtista();
        }
    }
}