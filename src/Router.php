<?php

namespace Reelz222z\Cryptoexchange;

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute($method, $path, $handler)
    {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                return $this->callHandler($route['handler']);
            }
        }

        return ['template' => 'errors/404.html.twig', 'params' => []];
    }

    private function callHandler($handler)
    {
        list($class, $method) = $handler;
        $controller = new $class();

        return $controller->$method();
    }
}
