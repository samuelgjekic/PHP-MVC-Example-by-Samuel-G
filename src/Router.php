<?php

namespace App;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/HomeController.php';

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        // Convert the route pattern to regex for dynamic parameters
        $routePattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route);
        // Normalize the route pattern to handle trailing slashes
        $routePattern = rtrim($routePattern, '/');
        $this->routes[$method][$routePattern] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch()
    {
        // Normalize the URI by removing trailing slashes
        $uri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        // Loop through the registered routes to find a match
        foreach ($this->routes[$method] as $routePattern => $routeInfo) {
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match from the array

                $controller = new $routeInfo['controller']();
                call_user_func_array([$controller, $routeInfo['action']], $matches);
                return;
            }
        }

        // If no route is found, throw an exception or handle a 404 error
        throw new \Exception("No route found for URI: $uri");
    }
}
