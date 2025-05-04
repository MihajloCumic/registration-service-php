<?php

namespace Src\handler\factory;

use ReflectionException;
use Src\container\Container;
use Src\exceptions\CustomException;
use Src\handler\chain\HandlerChain;
use Src\handler\Handler;
use Src\handler\implementations\ControllerHandler;

class HandlerChainFactory
{
    /**
     * @throws ReflectionException
     * @throws CustomException
     */
    public static function buildHandlerChain(Container $container, array $concreteHandlerNames, string $controllerClassName, string $controllerMethodName): HandlerChain
    {
        $handlerChain = new HandlerChain();
        foreach($concreteHandlerNames as $handlerName){
            $handler = $container->get($handlerName);
            if($handler instanceof Handler){
                $handlerChain->addHandler($handler);
            }
        }
        return $handlerChain->addHandler(new ControllerHandler($container, $controllerClassName, $controllerMethodName));
    }
}