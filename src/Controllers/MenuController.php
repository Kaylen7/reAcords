<?php

namespace Src\Controllers;

use Src\Views\MenuDisplay;
use Src\Models\Menu;
use Src\Enums\ErrorMessages;

class MenuController {

    public function __construct(
        private MenuDisplay $display,
        private Menu $model
    ){}

    public function run(): string{
        if (PHP_OS_FAMILY !== 'Windows'){
            system("stty -icanon -echo");
        }
        
        $this->display->showTitle();
        while (true) {
            $params = $this->model->getParams();
            $this->display->display($params["options"], $params["chosen"], $params["selected"]);

            if(PHP_OS_FAMILY === 'Windows'){
                $key = $this->getWindowsInput();
            } else {
                $key = $this->getUnixInput();
            }

            switch($key){
                case 'down':
                    $selected = ($params["selected"] > 0) ? $params["selected"] - 1 : count($params["options"]) - 1;
                    $this->model->setSelected($selected);
                    break;
                case 'up':
                    $selected = ($params["selected"] + 1) % count($params["options"]);
                    $this->model->setSelected($selected);
                    break;
                case 'space':
                    $chosen = $params["chosen"];
                    if(in_array($params["selected"], $chosen)){
                        $chosen = array_diff($chosen, [$params["selected"]]);
                    } else {
                        $chosen[] = $params["selected"];
                    }
                    $this->model->setChosen($chosen);
                    break;
                case 'enter':
                    if(count($params["chosen"]) > 1){
                        $this->display->showError(ErrorMessages::ERR_EN_TRIA_MOLTES);
                        return "";
                    } elseif(count($params["chosen"]) === 0){
                        $this->display->showError(ErrorMessages::ERR_NO_TRIA_CAP);
                        return "";
                    } else {
                        return $params["options"][$params["chosen"][0]];
                    }
                case 'quit':
                    $this->display->leave();
                    return "";
            }
        }
        if (PHP_OS_FAMILY !== 'Windows'){
            system("stty sane");
        }
        return "";
    }

    public function getUnixInput(): ?string {
        $key = ord(fgetc(STDIN));

        if($key === 27 && ord(fgetc(STDIN)) === 91){ //ESC [
            $arrowKey = ord(fgetc(STDIN));
            return match($arrowKey){
                65 => 'down',
                66 => 'up',
                default => null
            };
        }

        return match($key){
            32 => 'space',
            10 => 'enter',
            113 => 'quit',
            default => null
        };
    }

    public function getWindowsInput(): ?string{
        $input = trim(fgets(STDIN));

        return match($input){
            's' => 'up',
            'w' => 'down',
            'x' => 'space',
            'e' => 'enter',
            'q' => 'quit',
            default => null
        };
    }
}
