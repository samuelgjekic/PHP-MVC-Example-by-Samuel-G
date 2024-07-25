<?php

namespace App\Controllers;
require_once '../src/controller.php';

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $this->render('index');
    }
    
}