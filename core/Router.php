<?php
namespace App;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private $routes;

    public function load(string $routesDefinition)
    {
        $this->routes = require $routesDefinition;
    }    // Define your roles as constants


    public function dispatch()
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            ($this->routes)($r);
        });

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                include __DIR__ . '/../public/pages/404.php';
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                header('Allow: ' . implode(', ', $routeInfo[1]));
                echo 'Method Not Allowed';
                break;

            case Dispatcher::FOUND:
                list(, $handler, $vars) = $routeInfo;
                list($class, $method) = explode('@', $handler, 2);
                if (!class_exists($class) || !method_exists($class, $method)) {
                    throw new \Exception("Handler {$handler} not found");
                }
                call_user_func_array([new $class(), $method], $vars);
                break;
        }
    }
}

?>