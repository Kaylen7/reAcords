<?php

namespace Src\Models;
use Src\Enums\Compas;
use Src\Enums\Tempo;

class Acords {
    private array $config;

    public function __construct(
        protected array $acords,
        protected bool $random = false
    ){
        $config = Configuration::getInstance();
        $this->config = $config->getConfig();
    }

    public function calculateRepetitions(): array{
        $total = $this->config["configuration"]['minuts-estudi'] * 60;
        $compas = explode('/', $this->config["compas"]->value);
        $beat = $this->config["tempo"]->value;
        $repeticions = $total / ($compas[1] * $beat);
        $totalAcords = count($this->acords);

        return [
            "repeticions" => $repeticions,
            "compas" => $compas,
            "beat" => $beat,
            "totalAcords" => $totalAcords
        ];
    }

    public function getAcordForPosition(int $position): string{
        if ($this->random){
            return $this->acords[array_rand($this->acords)];
        }
        return $this->acords[$position];
    }
}

