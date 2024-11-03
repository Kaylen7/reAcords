<?php

namespace Src\Views;

class MenuDisplay extends ConsoleOutput{
    private const MISSATGE = "\nTria una opció\n\n";
    private const INSTRUCCIONS = "\nMou-te amb les fletxes, selecciona amb espai, acepta amb enter i fes servir 'q' per sortir.\n";

    public function display(array $options, array $chosen, int $selected): void{
        echo self::CLEAR_TERMINAL;
        system($this->clearConsole);
        self::showMessage(self::MISSATGE, self::BLUE);

        foreach($options as $index => $option){
            $checked = in_array($index, $chosen) ? self::RED . 'x' . self::RESET : " ";
            $highlight = $selected === $index ? self::showMessage('>', self::GREEN): " ";

            echo "$highlight [$checked] $option\n";
        }
        self::showMessage(self::INSTRUCCIONS, self::BLUE);
    }
}