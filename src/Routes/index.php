<?php
// Denna fil tar hand om rutterna, den är direktk kopplad till Router.php, där kan man få en större
// inblick av hur det fungerar.
use App\Router;
use App\Controllers\MovieController;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/MovieController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/Router.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/ApiController.php';


$router = new Router();

// Routes for Movies
$router->get('/',MovieController::class,'index'); // Första sidan
$router->get('/add', MovieController::class, 'create');  // Lägg till film sidan
$router->post('/store', MovieController::class, 'store');  // lagra film rutt
$router->get('/delete/{id}', MovieController::class, 'delete'); // ta bort film rutt

// Routes för API Movies
$router->get('/api/list',ApiController::class,'index'); // Rutt till API trendiga filmer


$router->dispatch();