<?php

use App\Controllers\HomeController;
use App\Router;

require_once "../src/Router.php";

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/example',HomeController::class,'examplepage');
 

$router->dispatch();