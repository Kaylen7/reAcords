<?php

namespace Src\Services;

use Src\Views\MenuDisplay;
use Src\Models\Menu;
use Src\Controllers\MenuController;

class MenuFactory {

    private MenuController $controller;

    public function __construct(
        private array $options,
        private string $title = ""
    ){
        $display = new MenuDisplay($this->title);
        $model = new Menu($this->options);
        $this->controller = new MenuController($display, $model);
    }

    public function init(): string{
        $chosenOption = $this->controller->run();
        return $chosenOption;
    }
}