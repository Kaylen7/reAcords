<?php

namespace Src\Models;

use Src\Enums\Compas;
use Src\Enums\Tempo;

class Configuration{
    protected static array $configuration;
    protected static Compas $compas;
    protected static Tempo $tempo;

    public function __construct(){
        try {
            $file = @file_get_contents('./config.json');
            if (!$file){
                throw new Exception("No s'ha trobat l'arxiu de configuració.");
            }
            self::$configuration = json_decode($file, true);
            self::$compas = $this->getCompas();
            self::$tempo = $this->getTempo();
        }catch(Exception $err){
            var_dump($err->getMessage());
            return;
        }
    }

    protected function getCompas(): Compas{
        return match(self::$configuration['compas']){
            'DOSQUATRE' => Compas::DOSQUATRE,
            'TRESQUATRE' => Compas::TRESQUATRE,
            'QUATREQUATRE' => Compas::QUATREQUATRE,
            'SISVUIT' => Compas::SISVUIT,
            'DOTZEVUIT' => Compas::DOTZEVUIT,
            'CINCSET' => Compas::CINCSET,
            'SETVUIT' => Compas::SETVUIT
        };
    }

    protected function getTempo(): Tempo{
       return match(self::$configuration['tempo']){
        'LARGO' => Tempo::LARGO,
        'ADAGIO' => Tempo::ADAGIO,
        'ANDANTE' => Tempo::ANDANTE,
        'ALLEGRO' => Tempo::ALLEGRO,
        'PRESTO' => Tempo::PRESTO
        };
    }
}