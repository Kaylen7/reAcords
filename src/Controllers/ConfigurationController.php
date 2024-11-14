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
        $ok = $this->model->setCompas($compas);
        if ($ok){
            $this->display->message("Compàs canviat a $compas" . PHP_EOL);
        }
    }

    public function changeTempo(): void{
        $options = Tempo::showCases();
        $menu = new MenuFactory($options);
        $tempo = $menu->init();
        $ok = $this->model->setTempo($tempo);
        if ($ok){
            $this->display->message("Tempo canviat a $tempo" . PHP_EOL);
        }  
    }

    public function changeMinuts(string $minuts): void{
        if(preg_match('/[0-9]+/', $minuts)){
            $this->model->setMinuts((int)$minuts);
            $this->display->message("Temps d'estudi canviat a $minuts" . PHP_EOL);
        } else {
            echo "Si us plau, introdueix un nombre enter.";
        }
    }
}