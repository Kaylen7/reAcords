<?php

namespace Src\Services;

use Src\Views\PagerDisplay;
use Src\Models\Pager;
use Src\Controllers\PagerController;

class PagerFactory{
    private PagerController $controller;

    public function __construct(
        private array $cataleg,
        private int $itemsPerPag = 5,
        private bool $isCollection = false
    ){
        $display = new PagerDisplay();
        $model = new Pager($this->cataleg, $this->itemsPerPag, $this->isCollection);
        $this->controller = new PagerController($model, $display);
    }

    public function init(): array|null{
        return $this->controller->run();
    }
}