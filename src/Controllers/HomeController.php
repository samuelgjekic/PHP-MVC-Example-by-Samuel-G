<?php

namespace App\Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Controller.php';

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $this->render('index');
    }

    public function examplepage()
    {
        $this->render('example');
    }
    
}