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
    }

    public static function getInstance(): Configuration {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConfig(){
        return $this->configuration;
    }

    public function setMinuts(int $minuts){
        $this->configuration["minuts-estudi"] = $minuts;
        $this->update();
    }

    public function setCompas(string $compas){
        try {
            $validCompas = Compas::fromValue($compas);
            $this->configuration["compas"] = $compas;
            $this->update();
        } catch (\InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    public function setTempo(string $tempo){
        try{
            $validTempo = Tempo::getTempo($tempo);
            $this->configuration["tempo"] = $tempo;
            $this->update();
        } catch(\InvalidArgumentException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function setRandom(bool $random){
        $this->configuration["random"] = $random;
        $this->update();
    }

    public function setAcords(array $acords){
        $this->configuration["acords"] = $acords;
        $this->update();
    }

    private function update(){
        $file = @file_put_contents('./config.json', json_encode($this->configuration, JSON_PRETTY_PRINT));
        if(!$file){
            echo "Failed to write file." . PHP_EOL;
        }
    }

    private function __clone(){}
    public function __wakeup(){
        throw new Exception("No es pot deserialitzar un Singleton.");
    }
}