<?php

namespace Src\Models;

class Catalogue {
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

    public function getAcordsByArtistSong(string $artist, string $song): array|null {
        if(!self::$database){
            return null;
        }
        $acords = [];
        foreach(self::$database as $tipo=>$contenido){   
            foreach($contenido as $serie){
                foreach($serie['ejemplos'] as $ejemplo){
                    if(array_key_exists('artista', $ejemplo)){
                        if($ejemplo['artista'] === $artist && $ejemplo['cancion'] === $song){                            
                            $acords = $serie["serie"];
                        }
                    }
                }
            }
        }
        if(count($acords) < 1){
            throw new Exception("La cerca no ha donat resultats.");
            return null;
        }
        return $acords;
    }
}