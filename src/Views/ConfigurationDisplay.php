<?php

namespace Src\Views;

class ConfigurationDisplay extends ConsoleOutput {

    public function displayConfig(array $config){
        $this->clearConsole();
        $this->showMessage("CONFIGURACIÓ" . PHP_EOL . PHP_EOL, self::COLORS['blue']);
        foreach($config as $name=>$values){
            $this->showMessage($name . ": ", self::COLORS['bold']);
            if(gettype($values) === 'array'){
                $this->showMessage(implode(', ', $values) . PHP_EOL, self::COLORS['green']);
            } elseif($name === 'random'){
                $content = $values ? 'Sí' : 'No';
                $this->showMessage($content . PHP_EOL, self::COLORS['green']);
            }else {
                $this->showMessage($values . PHP_EOL, self::COLORS['green']);
            }
        }
        $this->showMessage(PHP_EOL);
    }

    public function message(string $message){
        $this->showMessage($message);
    }

    public function clearScreen(){
        $this->clearConsole();
    }
}