<?php 

class generadorAcords extends guiaAcords{
    private array $acords = ["C", "D", "E", "F", "G", "A", "B"];
    private array $modes = ["aug", "dism", "m", ""];
    private int $totalAcords = 4;
    private int $interval = 2;
    private array $seisAcordesBasicos;
    const MISSATGE = "Ep! Et passaràs del límit de temps que vols estudiar.\n";

    public function __construct(){
        $this->seisAcordesBasicos = array_merge($this->cuatroAcordesBasicos, $this->dosAcordesBasicos);
    }

    public function createAcords(): void{
        $acords = ["C", "D", "E", "F", "G", "A", "B"];
        if ($this->interval > $this->totalAcords){
            echo self::MISSATGE;
            return;
        }
        $totalLoops = $this->totalAcords;
        while($totalLoops > 0){
            echo $this->acords[array_rand($this->acords)] . " " . $this->modes[array_rand($this->modes)] . "\n";
            sleep($this->interval);
            $totalLoops--;
        }
    }

    public function permutateAcords(){
        var_dump($this->seisAcordesBasicos);
    }

}

class guiaAcords{
    protected static array $database = [];

    public function __construct() {
        try {
            $file = @file_get_contents('./acordes.json');
            if (!$file){
                throw new Exception("No s'ha trobat l'arxiu d'acords.");
            }
            self::$database = json_decode($file, true);

        }catch(Exception $err){
            var_dump($err->getMessage());
            return;
        }
    }

    public function getAllSeriesFromTipus(string $tipus): array|null{
        if (!self::$database){
            return null;
        }
        foreach(self::$database as $tipo=>$contenido){
            if($tipo === $tipus){
                $allSeries = [];
                foreach($contenido as $serie){
                    array_push($allSeries, $serie);
                }
                return $allSeries;
            }
        }
    }

    public function getOneSerieFromTipusByIndex(string $tipus, int $inputIndex = 1): array|null{
        if(!self::$database){
            return null;
        }
        $index = $inputIndex - 1;
        foreach(self::$database as $tipo=>$contenido){
            if($tipo === $tipus){
                if ((count($contenido) <= $index) || ($index < 0)){
                    throw new Exception("Valors no admesos a l'index.");
                    return null;
                }
                else {
                    return $contenido[$index]['serie'];
                }
            }
        }
    }

    public function getSeriesByAuthor(string $author): array|null {
        if(!self::$database){
            return null;
        }
        $allSeries = [];
        foreach(self::$database as $tipo=>$contenido){   
            $series = []; 
            foreach($contenido as $serie){
                foreach($serie['ejemplos'] as $ejemplo){
                    if(array_key_exists('artista', $ejemplo)){
                        if($ejemplo['artista'] === strtolower($author)){
                            array_push($series, $serie);                            
                            $allSeries[$tipo] = $series;
                        }
                    }
                }
            }
        }
        if(count($allSeries) < 1){
            throw new Exception("La cerca no ha donat resultats.");
            return null;
        }
        return $allSeries;
    }
}


try{
    $test = new guiaAcords();

}catch(Exception $e){
    echo($e->getMessage());
}
