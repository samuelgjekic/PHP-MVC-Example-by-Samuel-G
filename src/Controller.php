<?php

namespace App;


class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        ob_start();
        include "Views/$view.php";
        $content = ob_get_clean();
        include "Views/layout.php";
    }
}