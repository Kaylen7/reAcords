<?php

namespace Src\Views;

class MainDisplay extends ConsoleOutput{

    public function showErrorMessage(string $message){
        $this->showMessage($message, self::COLORS['red']);
    }
}