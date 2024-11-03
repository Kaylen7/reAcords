<?php

namespace Src\Models;

class Menu {

    public function __construct(
        protected array $options, 
        protected array $chosen = [], 
        protected int $selected = 0
    ){}

    public function setSelected(int $selected): void{
        $this->selected = $selected;
    }

    public function setChosen(array $chosen): void{
        $this->chosen = $chosen;
    }

    public function getParams(){
        return [
            "options" => $this->options,
            "chosen" => $this->chosen,
            "selected" => $this->selected
        ];
    }
}