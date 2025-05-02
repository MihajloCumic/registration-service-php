<?php

namespace Src\routes;

use Src\config\Provider;
use Src\enums\HttpMethod;

class Routes
{
    /**
     * @var array<string, array<string, Route>>
     */
    private array $routes = [];

    public function __construct()
    {
    }

    public function addRoute(HttpMethod $method, string $path, array $handlers, string $controllerName, string $controllerMethodName): self
    {
        $this->routes[$method->value][$path] = new Route($handlers, $controllerName, $controllerMethodName);
        return $this;
    }

    public function getRoute(HttpMethod $method, string $path): ?Route
    {
        if(isset($this->routes[$method->value][$path])){
            return $this->routes[$method->value][$path];
        }
        return null;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }



}