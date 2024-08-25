<?php

use App\Controllers\HomeController;
use App\Router;
use App\Controllers\MovieController;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/MovieController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/Router.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/ApiController.php';


$router = new Router();

// Routes for Movies
$router->get('/',MovieController::class,'index');
$router->get('/add', MovieController::class, 'create');  // Display the add movie form
$router->post('/store', MovieController::class, 'store'); // Handle the form submission
$router->get('/delete/{id}', MovieController::class, 'delete');

// Routes för API Movies
$router->get('/api/list',ApiController::class,'index');


$router->dispatch();