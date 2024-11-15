<?php

namespace Src\Views;

class MainView extends ConsoleOutput{

    public function showErrorMessage(string $message){
        $this->showMessage($message, self::RED);
    }
}