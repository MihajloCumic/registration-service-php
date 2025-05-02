<?php

namespace Src\dispatcher\impl;

use Exception;
use ReflectionException;
use Src\container\Container;
use Src\dispatcher\Dispatcher;
use Src\handler\factory\HandlerChainFactory;
use Src\request\Request;
use Src\routes\Routes;

class RequestDispatcher implements Dispatcher
{
    public function __construct(private readonly Container $container, private readonly Request $request)
    {
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function dispatch(): void
    {
           $routes = $this->container->get(Routes::class);
           if(!$routes instanceof Routes){
               throw new Exception("Not Routes.");
           }

           $method = $this->request->getRequestMethod();
           $path = $this->request->getRequestUri();

           $route = $routes->getRoute($method, $path);

           if($route === null){
               echo 'Route does not exist!';
               exit();
           }

           $handlerChain = HandlerChainFactory::buildHandlerChain($this->container, $route->handlerNames, $route->controllerName, $route->controllerMethodName);

           $res = $handlerChain->handle($this->request);

           http_response_code($res->statusCode);
           $res->send();
    }
}