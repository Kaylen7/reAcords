<?php 

namespace Src\Services;

use Src\Controllers\AcordsController;
use Src\Models\Acords;
use Src\Views\AcordsDisplay;

class AcordsFactory {

    private AcordsController $controller;

    public function __construct(
        private array $acords,
        private bool $random = false
    ){
        $display = new AcordsDisplay();
        $model = new Acords($this->acords, $this->random);
        $this->controller = new AcordsController($model, $display);
    }

    public function init(): void {
        $this->controller->run();
    }
}