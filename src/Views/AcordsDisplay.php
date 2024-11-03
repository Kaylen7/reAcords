<?php

namespace Src\Views;

class AcordsDisplay extends ConsoleOutput {

    public function clearScreen(): void{
        echo self::CLEAR_TERMINAL;
        system($this->clearConsole);
    }
    
    public function displayBeat(): void{
        echo PHP_EOL . ".";
    }

    public function displayAcord(string $acord): void{
        $this->clearScreen();

        self::showMessage($acord, self::GREEN);
    }
}