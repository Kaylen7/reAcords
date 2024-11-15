<?php

namespace Src\Views;

use Src\Enums\ErrorMessages;

class MenuDisplay extends ConsoleOutput{
    private const MISSATGE = "\nTria una opció\n\n";
    private const INSTRUCCIONS = "\nMou-te amb les fletxes, selecciona amb espai, acepta amb enter i fes servir 'q' per sortir.\n";

    public function __construct(
        private string $title
    ){}

    public function display(array $options, array $chosen, int $selected): void{
        $this->clearConsole();
        self::showMessage(self::MISSATGE, self::COLORS['blue']);

        foreach($options as $index => $option){
            $checked = in_array($index, $chosen) ? self::COLORS['red'] . 'x' . self::RESET : " ";
            $highlight = $selected === $index ? self::showMessage('>', self::COLORS['green']): " ";

            self::showMessage("$highlight [$checked] $option\n");
        }
        self::showMessage(self::INSTRUCCIONS, self::COLORS['blue']);
    }

    public function showTitle(){
        if ($this->title != ""){
            $this->clearConsole();
            $strings = explode("\n", $this->title);
            $colors = [];
            foreach(self::COLORS as $key=>$value){
                array_push($colors, $value);
            }
            foreach($strings as $string){
                $color = $colors[array_rand($colors)];
                if(str_contains($string, '🎸') || str_contains($string, '📖')){
                    $color = self::COLORS['bold'];
                }
                self::showMessage($string . PHP_EOL, $color);
            }
            self::showMessage(PHP_EOL . PHP_EOL . "La pàgina es carregarà en breus...");
            sleep(3);
        }
    }

    public function showError(ErrorMessages $err): void{
        self::showMessage($err->value, self::COLORS['red']);
    }

    public function leave(): void{
        self::exit();
    }
}