<?php
/**
 * Detta är Router.php, som gör om ruttar osv. Med hjälp av denna filen kan vi ta bort onödiga bokstäver och
 * kontrollera vart användaren ska komma till. Detta gör det även lätt för oss att definera rutter till varje view och mer.
 */
namespace App;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/controllers/HomeController.php';

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        // Konvertera routePattern
        $routePattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route);
        // Normalisera strängen
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
        // Normalisera URI
        $uri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        // Loopa igenom dom registerade rutterna
        foreach ($this->routes[$method] as $routePattern => $routeInfo) {
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                array_shift($matches); // Ta bort den fulla träffen från arrayen

                $controller = new $routeInfo['controller']();
                call_user_func_array([$controller, $routeInfo['action']], $matches);
                return;
            }
        }

        // Ingen rutt hittades, skicka error.
        throw new \Exception("No route found for URI: $uri");
    }
}
