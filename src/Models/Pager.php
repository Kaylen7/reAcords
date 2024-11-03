<?php 

namespace Src\Models;

class Pager {
    
    private int $pagActual = 0;
    private int $indexSerie = 0;
    private array $collectionKeys;
    private array $page = [];

    public function __construct(
        private array $cataleg,
        private int $itemsPerPag,
        private bool $isCollection
    ){
        $this->collectionKeys = array_keys($this->cataleg);
    }

    public function setPage(): void{
        $inici = $this->pagActual * $this->itemsPerPag;
        $cataleg = $this->isCollection ? $this->cataleg[$this->collectionKeys[$this->indexSerie]] : $this->cataleg;
        $this->page = array_slice($cataleg, $inici, $this->itemsPerPag, true);
    }

    public function nextPage(): void{
        $this->pagActual++;
        $this->setPage();
    }

    public function previousPage(): void{
        $this->pagActual--;
        $this->setPage();
    }

    public function nextSerie(): void{
        $this->indexSerie++;
        $this->pagActual = 0;
        $this->setPage();
    }

    public function previousSerie(): void{
        $this->indexSerie--;
        $this->pagActual = 0;
        $this->setPage();
    }

    public function pageSerieReset(): void{
        $this->indexSerie = 0;
        $this->pagActual = 0;
        $this->setPage();
    }

    public function setIndexSerie(int $indexSerie): void{
        $this->indexSerie = $indexSerie;
    }

    public function getParams(){
        return [
            $this->page,
            $this->pagActual,
            $this->indexSerie,
            $this->itemsPerPag,
            $this->collectionKeys,
            $this->isCollection,
            $this->cataleg
        ];
    }
    
}