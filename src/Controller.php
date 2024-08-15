<?php

namespace App;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Database/Database.php';
class Controller
{
    protected $db;

    public function __construct()
    {
    $this->db = Database::getInstance()->getConnection();
    }
    protected function render($view, $data = [])
    {
        extract($data);

        ob_start();
        include "Views/$view.php";
        $content = ob_get_clean();
        include "Views/layout.php";
    }
}