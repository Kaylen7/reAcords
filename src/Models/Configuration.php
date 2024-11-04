<?php

namespace Src\Models;

use Src\Enums\Compas;
use Src\Enums\Tempo;

class Configuration{
    private static ?Configuration $instance = null;
    private array $configuration;
    private Compas $compas;
    private Tempo $tempo;

    public function __construct(){
        $file = @file_get_contents('./config.json');
        if (!$file){
            throw new Exception("No s'ha trobat l'arxiu de configuració.");
        }
        $this->configuration = json_decode($file, true);
        $this->compas = $this->getCompas();
        $this->tempo = $this->getTempo();
    }

    public static function getInstance(): Configuration {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getCompas(): Compas{
        return match($this->configuration['compas']){
            'DOSQUATRE' => Compas::DOSQUATRE,
            'TRESQUATRE' => Compas::TRESQUATRE,
            'QUATREQUATRE' => Compas::QUATREQUATRE,
            'SISVUIT' => Compas::SISVUIT,
            'DOTZEVUIT' => Compas::DOTZEVUIT,
            'CINCSET' => Compas::CINCSET,
            'SETVUIT' => Compas::SETVUIT
        };
    }

    private function getTempo(): Tempo{
       return match($this->configuration['tempo']){
        'LARGO' => Tempo::LARGO,
        'ADAGIO' => Tempo::ADAGIO,
        'ANDANTE' => Tempo::ANDANTE,
        'ALLEGRO' => Tempo::ALLEGRO,
        'PRESTO' => Tempo::PRESTO
        };
    }

    public function getConfig(){
        return [
            "configuration" => $this->configuration,
            "compas" => $this->compas,
            "tempo" => $this->tempo
        ];
    }

    private function __clone(){}
    public function __wakeup(){
        throw new Exception("No es pot deserialitzar un Singleton.");
    }
}