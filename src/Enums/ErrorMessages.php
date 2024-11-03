<?php

namespace Src\Enums;

enum ErrorMessages:string {
    case ERR_NO_TRIA_CAP = PHP_EOL . "❌ Tria com a mínim una opció!" . PHP_EOL;
    case ERR_EN_TRIA_MOLTES = PHP_EOL ."❌ Només pots triar una opció!" . PHP_EOL;
}