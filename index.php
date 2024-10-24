<?php 

class generadorAcords{
    private array $acords = ["C", "D", "E", "F", "G", "A", "B"];
    private array $modes = ["aug", "dism", "m", ""];

    const MISSATGE = "Ep! Et passaràs del límit de temps que vols estudiar.\n";

    public function __construct(
        private int $totalAcords,
        private int $interval
    ){}

    public function createAcords(): void{
        $acords = ["C", "D", "E", "F", "G", "A", "B"];
        if ($this->interval > $this->totalAcords){
            echo self::MISSATGE;
            return;
        }
        $totalLoops = $this->totalAcords;
        while($totalLoops > 0){
            echo $this->acords[array_rand($this->acords)] . " " . $this->modes[array_rand($this->modes)] . "\n";
            sleep($this->interval);
            $totalLoops--;
        }
    }

}

$createAcords = new generadorAcords(4, 4);
$createAcords->createAcords();

