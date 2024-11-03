<?php

namespace Src\Models;
use Src\Enums\Compas;
use Src\Enums\Tempo;

class AcordsGenerator {
    
    public function __construct(
        protected array $acords,
        protected int $minutsAssaig,
        protected Compas $compas,
        protected Tempo $tempo,
        protected bool $random = false
    ){}

    public function calculateRepetitions(): array{
        $total = $this->minutsAssaig * 60;
        $compas = explode('/', $this->compas->value);
        $beat = $this->tempo->value;
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

