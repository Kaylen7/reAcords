<?php

namespace Src\Controllers;

use Src\Models\AcordsGenerator;
use Src\Views\AcordsDisplay;

class AcordsController{

    public function __construct(
        private AcordsGenerator $generator,
        private AcordsDisplay $display
    ){}

    public function run(): void{

        $params = $this->generator->calculateRepetitions();
        $acordsIndex = 0;
        $repeticions = $params["repeticions"];

        while ($repeticions > 0){
            if($acordsIndex === $params["totalAcords"]){
                $acordsIndex = 0;
            }
            $acord = $this->generator->getAcordForPosition($acordsIndex);
            
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