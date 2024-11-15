<?php

namespace Src\Views;

class CatalogueDisplay extends ConsoleOutput{

    public function showChosenMessage(array $acords, string $song, string $artista, int $time){
        $this->clearConsole();
        $this->showMessage("Preparant assaig dels acords..." . PHP_EOL . PHP_EOL);
        $this->showMessage(implode(", ", $acords) . PHP_EOL . PHP_EOL, self::COLORS['green']);
        if ($song && $artista){
            $this->showMessage(ucfirst($song) . " - " . ucfirst($artista) . PHP_EOL . PHP_EOL, self::COLORS['bold']);
        }
        sleep($time);
    }
}