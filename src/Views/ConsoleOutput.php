<?php

namespace Src\Views;

class ConsoleOutput{
    protected const CLEAR_TERMINAL = "\033[2J\033[;H";
    protected string $clearConsole = PHP_OS === 'Windows' ? 'cls' : 'clear';
    protected const GREEN = "\033[32m";
    protected const RED = "\033[31m";
    protected const YELLOW = "\033[33m";
    protected const BLUE = "\033[34m";
    protected const RESET = "\033[0m";

    protected const EXIT = PHP_EOL . PHP_EOL . "👋 Sortint..." . PHP_EOL;

    public function showMessage(string $message, string $color = ""): void{
        echo $color . $message . self::RESET;
    }

    public function exit(): void{
        $this->showMessage(self::EXIT, "");
    }
}