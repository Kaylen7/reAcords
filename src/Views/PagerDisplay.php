<?php

namespace Src\Views;

class PagerDisplay extends ConsoleOutput {
    private const INSTRUCCIONS_PAGINA = "Controls: 'c'ontinuar, 'p'rèvia, ";
    private const INSTRUCCIONS_SERIE = "'a'nterior sèrie, 's'egüent sèrie, ";
    private const INSTRUCCIONS_SORTIDA = "'q': sortir." . PHP_EOL . "Tria l'índex: ";

    private const HEADER = PHP_EOL . "====== Pàgina - ";
    private const SUBHEADER = "====== Sèrie - ";

    private string $header = "";
    private string $subheader = "";
    private string $instruccions = "";
    

    public function display(array $pages, int $pagActual, int $indexSerie, array $collectionKeys, bool $isCollection){
        $this->clearConsole();

        $this->header = self::HEADER . ($pagActual + 1) . PHP_EOL;
        $this->showMessage($this->header, self::BLUE);

        if ($isCollection){
            $this->subheader = self::SUBHEADER . ($collectionKeys[$indexSerie] . PHP_EOL . PHP_EOL);
            $this->instruccions = self::INSTRUCCIONS_PAGINA . self::INSTRUCCIONS_SERIE . self::INSTRUCCIONS_SORTIDA;
        } else {
            $this->subheader = "" . PHP_EOL;
            $this->instruccions = self::INSTRUCCIONS_PAGINA . self::INSTRUCCIONS_SORTIDA;
        }
        $this->showMessage($this->subheader, self::BLUE);

        var_dump($pages);

        $this->showMessage($this->instruccions);
        
    }

    public function clearDisplay(){
        echo self::CLEAR_TERMINAL;
    }

    public function leave(): void{
        $this->exit();
    }
}