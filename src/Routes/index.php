<?php

use App\Controllers\HomeController;
use App\Router;
use App\Controllers\MovieController;
require_once '../src/controllers/MovieController.php';
require_once "../src/Router.php";

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/example',HomeController::class,'examplepage');
$router->get('/movies',MovieController::class,'index');
$router->get('/movies/add', MovieController::class, 'create');  // Display the add movie form
$router->post('/movies/store', MovieController::class, 'store'); // Handle the form submission

$router->dispatch();