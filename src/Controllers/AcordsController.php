<?php

namespace Src\Controllers;

use Src\Models\Acords;
use Src\Views\AcordsDisplay;

class AcordsController{

    public function __construct(
        private Acords $model,
        private AcordsDisplay $display
    ){}

    public function run(): void{

        $params = $this->model->calculateRepetitions();
        $acordsIndex = 0;
        $repeticions = $params["repeticions"];

        while ($repeticions > 0){
            if($acordsIndex === $params["totalAcords"]){
                $acordsIndex = 0;
            }
            $acord = $this->model->getAcordForPosition($acordsIndex);
            
            $this->display->displayAcord($acord);
            
            usleep((float)$params["beat"] * 10**6);

            for($i = ((int)$params["compas"][0] - 1); $i > 0; $i--){
                $this->display->displayBeat();
                usleep((float)$params["beat"] * 10**6);
            }

            $acordsIndex++;
            $repeticions--;
        }
    }
}