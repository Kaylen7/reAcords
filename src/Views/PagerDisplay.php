<?php

namespace Src\Views;

class PagerDisplay extends ConsoleOutput {
    private const INSTRUCCIONS_PAGINA = "Controls: 'c'ontinuar, 'p'rèvia, ";
    private const INSTRUCCIONS_SERIE = "'a'nterior sèrie, 's'egüent secció, ";
    private const INSTRUCCIONS_SORTIDA = "'q': sortir." . PHP_EOL;

    private const HEADER = PHP_EOL . "====== Pàgina - ";
    private const SUBHEADER = "====== Secció - ";

    private string $header = "";
    private string $subheader = "";
    private string $instruccions = "";
    

    public function display(array $pages, int $pagActual, int $indexSerie, array $collectionKeys, bool $isCollection){
        $this->clearConsole();

        $this->header = self::HEADER . ($pagActual + 1) . PHP_EOL;
        $this->showMessage($this->header, self::BLUE);

        if ($isCollection){
            $this->subheader = self::SUBHEADER . ($collectionKeys[$indexSerie] . PHP_EOL . PHP_EOL);
            $this->instruccions = self::INSTRUCCIONS_PAGINA . self::INSTRUCCIONS_SERIE . self::INSTRUCCIONS_SORTIDA . "Fes clic a 'enter' per triar la pàgina d'estudi." . PHP_EOL;
        } else {
            $this->subheader = "" . PHP_EOL;
            $this->instruccions = self::INSTRUCCIONS_PAGINA . self::INSTRUCCIONS_SORTIDA . "Tría l'índex i fes clic a 'enter' per assajar els acords relacionats amb la cançó escollida.";
        }
        $this->showMessage($this->subheader, self::BLUE);

       
        $data = $isCollection ? $this->extractDataCollection($pages, $pagActual) : $this->parseDataIndex($pages);

        $this->prettyPrint($data);

        $this->showMessage($this->instruccions, self::BLUE);
        
    }

    public function clearDisplay(){
        echo self::CLEAR_TERMINAL;
    }

    public function leave(): void{
        $this->exit();
    }

    private function extractDataCollection($pages, $pagActual): array{
        $serie = $pages[$pagActual]["serie"];
        $descripcion = $pages[$pagActual]["descripcion"];
        $ejemplos = $pages[$pagActual]["ejemplos"];
        $artistaCanco = [];
        
        if(count($ejemplos) > 0){
            foreach($ejemplos as $pair){
                array_push($artistaCanco, $pair);
            }
        }
        return [
            "serie" => $serie,
            "descripcion" => $descripcion,
            "artistaCanco" => $artistaCanco
        ];
    }

    private function parseDataIndex($pages): array{
        $artistaCanco = [];
        foreach($pages as $content){
            $pair = [
                "artista" => $content[0],
                "cancion" => $content[1]
            ];
            array_push($artistaCanco, $pair);
        }
        return $artistaCanco;
    }

    private function prettyPrint(array $data): void{

        foreach($data as $key=>$content){
            if ($content){
                $text = "";
                if($key === 'artistaCanco'){
                    foreach($content as $pair){
                        $artista = $pair["artista"];
                        $canco = $pair["cancion"];
                        $header = "Artista - Canción" . PHP_EOL;
                        $text .= $artista . " - " . $canco . PHP_EOL;
                    }
                } elseif(in_array($key, ["0", "1", "2", "3", "4"])){
                    $header = "Índex [". $key + 1 . "]" . PHP_EOL;
                    $text = ucwords(implode(" - ", ($content))) . PHP_EOL;
                } else {
                    $header = ($key != 'descripcion' ? ucwords($key) : 'Descripción'). PHP_EOL;
                    $data = (gettype($content) === "string" ? $content : implode(", ", $content));
                    $text = $data . PHP_EOL;
                }
            $this->showMessage($header, self::BOLD);
            $this->showMessage($text . PHP_EOL);
            }
        }
    }
}