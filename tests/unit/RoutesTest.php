<?php
declare(strict_types=1);
namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use Src\enums\HttpMethod;
use Src\routes\Route;
use Src\routes\Routes;

class RoutesTest extends TestCase
{
    private Routes $routes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->routes = new Routes();
    }
    public function testAddsRoute(): void
    {
        $method = HttpMethod::GET;
        $path = '/path';
        $handlerNames = [
            'handler1',
            'handler2'
        ];
        $controllerName = 'controller';
        $controllerMethod = 'method';

        $expected = [
            'GET' => [
                '/path' => new Route($handlerNames, $controllerName, $controllerMethod)
            ]
        ];

        $this->routes->addRoute($method, $path, $handlerNames, $controllerName, $controllerMethod);

        $this->assertEquals($expected, $this->routes->getRoutes());
    }

    public function testGetsRoute(): void
    {
        $method = HttpMethod::GET;
        $path = '/path';
        $handlerNames = [
            'handler1',
            'handler2'
        ];
        $controllerName = 'controller';
        $controllerMethod = 'method';

        $this->routes->addRoute($method, $path, $handlerNames, $controllerName, $controllerMethod);

        $expected = new Route($handlerNames, $controllerName, $controllerMethod);

        $route = $this->routes->getRoute($method, $path);
        $this->assertEquals($expected, $route);
    }

    public function testNonExistingPath(): void
    {
        $method = HttpMethod::GET;
        $path = '/path';
        $handlerNames = [
            'handler1',
            'handler2'
        ];
        $controllerName = 'controller';
        $controllerMethod = 'method';

        $this->routes->addRoute($method, $path, $handlerNames, $controllerName, $controllerMethod);


        $nonExistingPath = '/nonExisting';
        $route = $this->routes->getRoute($method, $nonExistingPath);

        $this->assertNull($route);
    }

    public function testNonExistingMethod(): void
    {
        $method = HttpMethod::GET;
        $path = '/path';
        $handlerNames = [
            'handler1',
            'handler2'
        ];
        $controllerName = 'controller';
        $controllerMethod = 'method';

        $this->routes->addRoute($method, $path, $handlerNames, $controllerName, $controllerMethod);


        $nonExistingMethod = HttpMethod::POST;
        $route = $this->routes->getRoute($nonExistingMethod, $path);

        $this->assertNull($route);
    }
}