<?php

namespace Src\Models;

class Caratula {

    public function __construct(
        private string $basePath
    ){}

    public function init(): string{
        $caratulaPath = $this->basePath . "/public/caratula.txt";       
        $caratula = file_get_contents($caratulaPath);
        if(!$caratula){
            return "Missing caràtula 🤦‍♀️";
        }
        return $caratula;
    }
}