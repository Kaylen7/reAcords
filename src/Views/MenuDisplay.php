<?php

namespace Src\Views;

use Src\Enums\ErrorMessages;

class MenuDisplay extends ConsoleOutput{
    private const MISSATGE = "\nTria una opció\n\n";
    private const INSTRUCCIONS = "\nMou-te amb les fletxes, selecciona amb espai, acepta amb enter i fes servir 'q' per sortir.\n";

    public function display(array $options, array $chosen, int $selected): void{
        $this->clearConsole();
        self::showMessage(self::MISSATGE, self::BLUE);

        foreach($options as $index => $option){
            $checked = in_array($index, $chosen) ? self::RED . 'x' . self::RESET : " ";
            $highlight = $selected === $index ? self::showMessage('>', self::GREEN): " ";

            echo "$highlight [$checked] $option\n";
        }
        self::showMessage(self::INSTRUCCIONS, self::BLUE);
    }

    public function showError(ErrorMessages $err): void{
        self::showMessage($err->value, self::RED);
    }

    public function leave(): void{
        self::exit();
    }
}