<?php

namespace Src\Controllers;

use Src\Models\Pager;
use Src\Views\PagerDisplay;

class PagerController{
    private int $limits;
    public function __construct(
        private Pager $model,
        private PagerDisplay $display
    ){}

    public function run(): void{
        system("stty -icanon -echo");
        $this->model->setPage();

        while(true){
        $params = $this->model->getParams();
        [$page, $pagActual, $indexSerie, $itemsPerPag, $collectionKeys, $isCollection, $cataleg] = $params;

        if($isCollection){
            $this->limits = count($cataleg[$collectionKeys[$indexSerie]]);
        } else {
            $this->limits = count($cataleg);
        }
        
        $this->display->display($page, $pagActual, $indexSerie, $collectionKeys, $isCollection);

        $key = fgetc(STDIN);
        
        if($key === 'c'){
            if(($pagActual + 1) * $itemsPerPag < $this->limits){
                $this->model->nextPage();
            }
            $this->display->clearDisplay();
        } elseif($key === 'p'){
            if($pagActual > 0){
                $this->model->previousPage();
            }
            $this->display->clearDisplay();
        } elseif($key === 'q'){
            $this->display->leave();
            break;
        } elseif($key === 's' && $isCollection){
            if ($indexSerie + 1 < count($collectionKeys)){
                $this->model->nextSerie();
                $this->display->clearDisplay();
            } else {
                $this->model->pageSerieReset();
                $this->display->clearDisplay();
            }
        } elseif($key === 'a' && $isCollection){
            if($indexSerie > 0){
                $indexSerie = $indexSerie - 1;
                $this->model->previousSerie();
                $this->display->clearDisplay();
            }
        }
        }
    }
}