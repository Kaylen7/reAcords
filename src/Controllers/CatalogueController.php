<?php

namespace Src\Controllers;

use Src\Services\PagerFactory;
use Src\Services\AcordsFactory;
use Src\Models\Catalogue;

class CatalogueController{

    public function __construct(
        private Catalogue $model
    ){}

    public function getPagerPerSeccions(): void{
        $cataleg = $this->model->getCollection();

        $pager = new PagerFactory($cataleg, 1, true);
        $result = $pager->init();

        if($result){
            [$pag, $index] = $result;
            $acordsGenerator = new AcordsFactory($pag[$index]["serie"]);
            $acordsGenerator->init();
        }
    }

    public function getPagerPerArtista(): void{
        $cataleg = $this->model->getIndexExamples();

        $pager = new PagerFactory($cataleg, 5, false);
        $result = $pager->init();

        if(!in_array(NULL, $result)){
            [$pag, $key] = $result;
            [$artist, $song] = $pag[$key - 1];

            $acords = $this->model->getAcordsByArtistSong($artist, $song);
            echo "\nHas triat " . implode(", ", $acords) . " de la cançó " . $song . " de " . $artist;
            sleep(3);
            $acordsGenerator = new AcordsFactory($acords);
            $acordsGenerator->init();
        } else {
            echo "\nEp! falten paràmetres.\n";
        }
    }
}