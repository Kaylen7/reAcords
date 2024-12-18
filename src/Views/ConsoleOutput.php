<?php

namespace Src\Views;

class ConsoleOutput{
    protected const CLEAR_TERMINAL = "\033[2J\033[;H";
    protected string $cmd = PHP_OS_FAMILY === 'Windows' ? 'cls' : 'clear';
    protected const COLORS = [
        "green" => "\033[32m",
        "red" => "\033[31m",
        "yellow" => "\033[33m",
        "blue" => "\033[34m",
        "bold" => "\033[1m"
    ];
    protected const RESET = "\033[0m";

    protected const EXIT = PHP_EOL . PHP_EOL . "👋 Sortint..." . PHP_EOL;

    protected function clearConsole(): void{
        echo self::CLEAR_TERMINAL;
        system($this->cmd);
    }

    protected function showMessage(string $message, string $color = ""): void{
        echo $color . $message . self::RESET;
    }

    protected function exit(): void{
        $this->showMessage(self::EXIT, "");
    }
}
