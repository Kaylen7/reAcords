<?php 

namespace Src\Services;

use Src\Controllers\AcordsController;
use Src\Models\Acords;
use Src\Views\AcordsDisplay;

class AcordsFactory {

    private AcordsController $controller;

    public function __construct(
        private array $config
    ){
        $c = $this->config;
        $display = new AcordsDisplay();
        $model = new Acords($c["acords"], $c["minutsAssaig"], $c["compas"], $c["tempo"], $c["random"]);
        $this->controller = new AcordsController($model, $display);
    }

    public function init(): void {
        $this->controller->run();
    }
}