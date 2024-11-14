<?php
require_once __DIR__ . '/vendor/autoload.php';

use Src\Services\MenuFactory;
use Src\Controllers\MainController;
use Src\Models\Caratula;

$modes = ["acords random", "acords de la col·lecció", "acords específics", "canviar configuracio"];
$basePath = str_replace("index.php", "", __FILE__);
$caratula = new Caratula($basePath);
$title = $caratula->init();
$menu = new MenuFactory($modes, $title);
$mode = $menu->init();
$controller = new MainController();

switch(array_search($mode, $modes)){
    case 0:
        if($mode === ''){
            break;
        }elseif($mode === 'w'){
            system("php index.php");
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
