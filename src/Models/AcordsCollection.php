<?php

namespace Src\Models;

class AcordsCollection{
    protected static array $database = [];
    protected static array $indexCancons = [];

    public function __construct() {
        try {
            $file = @file_get_contents('./acordes.json');
            if (!$file){
                throw new Exception("No s'ha trobat l'arxiu d'acords.");
            }
            self::$database = json_decode($file, true);
            self::$indexCancons = $this->getIndexExamples();
        }catch(Exception $err){
            var_dump($err->getMessage());
            return;
        }
    }

    public function getIndexExamples(){
        $result = [];
        foreach(self::$database as $tipo){
            foreach($tipo as $serie){
                foreach($serie['ejemplos'] as $ejemplo){
                    if(!array_search([$ejemplo['artista'], $ejemplo['cancion']], $result, true)){
                        array_push($result, [$ejemplo['artista'], $ejemplo['cancion']]);
                    };
                }
            }
        }
        array_multisort($result);
        return $result;
    }

    public function getCollection(){
        return self::$database;
    }

    protected function getAllSeriesFromTipus(string $tipus): array|null{
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

    protected function getOneSerieFromTipusByIndex(string $tipus, int $inputIndex = 1): array|null{
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

    protected function getSeriesByAuthor(string $author): array|null {
        if(!self::$database){
            return null;
        }
        var_dump(self::$indexCancons);
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