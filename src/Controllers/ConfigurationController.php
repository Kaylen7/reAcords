<?php

namespace Src\Controllers;

use Src\Models\Configuration;
use Src\Views\ConfigurationDisplay;
use Src\Enums\Compas;
use Src\Enums\Tempo;
use Src\Services\MenuFactory;

class ConfigurationController {

    private ConfigurationDisplay $display;
    private Configuration $model;
    private array $data;

    public function __construct(

    ){
        $this->model = Configuration::getInstance();
        $this->display = new ConfigurationDisplay();
        $this->data = $this->model->getConfig();
    }

    public function showConfiguration(): void{
        $this->display->displayConfig($this->data);
    }

    public function changeCompas(): void{
        $options = Compas::showCases();
        $menu = new MenuFactory($options);
        $compas = $menu->init();
        $this->model->setCompas($compas);
        $this->display->message("Compàs canviat a $compas" . PHP_EOL);
    }

    public function changeTempo(): void{
        $options = Tempo::showCases();
        $menu = new MenuFactory($options);
        $tempo = $menu->init();
        $this->model->setTempo($tempo);
        $this->display->message("Tempo canviat a $tempo" . PHP_EOL);
    }

    public function changeMinuts(){
        $minuts = readline("Quant de temps vols estudiar? (En minuts)");
        $this->model->setMinuts($minuts);
        $this->display->message("Temps d'estudi canviat a $minuts" . PHP_EOL);
    }

}