<?php 

namespace Src\Views;

class Pager extends ConsoleOutput{
    
    private int $pagActual = 0;
    private int $itemsPerPag = 5;
    private int $indexSerie = 0;
    private array $collectionKeys;

    public function __construct(
        private array $cataleg,
        private bool $isCollection = false
    ){
        $this->collectionKeys = array_keys($this->cataleg);
    }

    public function renderPage(){
        
        echo self::CLEAR_TERMINAL;
        system($this->clearConsole);

        self::showMessage(PHP_EOL . "===== Pàgina - " . ($this->pagActual + 1) . PHP_EOL, self::BLUE);
        echo $this->isCollection ?? "===== Sèrie: " . ($this->collectionKeys[$this->indexSerie]) . PHP_EOL . PHP_EOL;
        $inici = $this->pagActual * $this->itemsPerPag;
        $cataleg = $this->isCollection ? $this->cataleg[$this->collectionKeys[$this->indexSerie]] : $this->cataleg;
        $pages = array_slice($cataleg, $inici, $this->itemsPerPag, true);
        var_dump($pages);

        echo "Controls: 'c'ontinuar, 'p'rèvia, " . ($this->isCollection ?? "'a'nterior sèrie, 's'egüent sèrie, ") . "'q': sortir." . PHP_EOL . "Tria l'índex: ";
    }

    public function navegar(){
        system("stty -icanon -echo");

        while(true){
        $this->renderPage();
        $key = fgetc(STDIN);
        $cataleg = $this->isCollection ? $this->cataleg[$this->collectionKeys[$this->indexSerie]] : $this->cataleg;
        
        if($key === 'c'){
            if(($this->pagActual + 1) * $this->itemsPerPag < count($cataleg)){
                $this->pagActual++;
            }
            echo self::CLEAR_TERMINAL;
        } elseif($key === 'p'){
            if($this->pagActual > 0){
                $this->pagActual--;
            }
            echo self::CLEAR_TERMINAL;
        } elseif($key === 'q'){
            echo PHP_EOL . PHP_EOL . "Sortint..." . PHP_EOL;
            break;
        } elseif($key === 's' && $isCollection){
            if ($this->indexSerie + 1 < count($this->collectionKeys)){
                $this->indexSerie++;
                $this->pagActual = 0;
            } else {
                $this->indexSerie = 0;
                $this->pagActual = 0;
            }
        } elseif($key === 'a' && $isCollection){
            if($this->indexSerie > 0){
                $this->indexSerie--;
                $this->pagActual = 0;
            }
        }
        }

    }
    
}