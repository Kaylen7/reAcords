<?php
require_once __DIR__ . '/vendor/autoload.php';

use Src\Services\MenuFactory;
use Src\Controllers\MainController;

$modes = ["acords random", "acords de la col·lecció", "acords específics", "canviar configuracio"];
$menu = new MenuFactory($modes, "Acords CLI");
$mode = $menu->init();
$controller = new MainController();

switch(array_search($mode, $modes)){
    case 0:
        if($mode === ''){
            break;
        }
        $controller->getAcordsRandom();
        break;
    case 1:
        $controller->getAcordsColeccio();
        break;
    case 2:
        $input = readline("Sèrie d'acords separats per comes:\n");
        $controller->getAcordsEspecifics($input);
        break;
    case 3:
        $controller->getConfiguration();
        break;
}

?>
