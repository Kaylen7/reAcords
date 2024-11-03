<?php

namespace Src\Controllers;

use Src\Views\MenuDisplay;
use Src\Models\Menu;

class MenuController {

    public function __construct(
        private MenuDisplay $display,
        private Menu $model
    ){}

    public function run(): string{
        system("stty -icanon -echo");
        $params = $this->model->getParams();

        while (true) {
            $params = $this->model->getParams();
            $this->display->display($params["options"], $params["chosen"], $params["selected"]);
            
            $key = ord(fgetc(STDIN));
            if ($key === 27 && ord(fgetc(STDIN)) === 91) { //ESC [
                $arrowKey = ord(fgetc(STDIN));
                if ($arrowKey === 65) { // Up arrow
                    $selected = ($params["selected"] > 0) ? $params["selected"] - 1 : count($params["options"]) - 1;
                    $this->model->setSelected($selected);
                } elseif ($arrowKey === 66) { // Down arrow
                    $selected = ($params["selected"] + 1) % count($params["options"]);
                    $this->model->setSelected($selected);
                }
            } elseif ($key === 32) { // Space bar
                if (in_array($params["selected"], $params["chosen"])) {
                    $chosen = array_diff($params["chosen"], [$params["selected"]]);
                    $this->model->setChosen($chosen);
                } else {
                    $chosen[] = ($params["selected"]);
                    $this->model->setChosen($chosen);
                }
            } elseif($key === 10){
                if(count($params["chosen"]) > 1){
                    $this->display->showMessage(PHP_EOL ."❌ Només pots triar una opció!" . PHP_EOL);
                    break;
                } elseif(count($params["chosen"]) === 0){
                    $this->display->showMessage(PHP_EOL . "❌ Tria com a mínim una opció!" . PHP_EOL);
                    break;
                }else{
                    return $params["options"][$params["chosen"][0]];
                }
            } elseif ($key === 113) { // 'q' to quit
                $this->display->exit();
                break;
            }
        }
        system("stty sane");
        return "";
    }
    
}