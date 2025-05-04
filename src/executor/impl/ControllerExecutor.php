<?php
declare(strict_types=1);
namespace Src\executor\impl;
use ReflectionClass;
use ReflectionException;
use Src\container\Container;
use Src\exceptions\CustomException;
use Src\exceptions\executor\ControllerNotFoundException;
use Src\exceptions\executor\RequestTypeException;
use Src\exceptions\executor\WrongParamsArgsException;
use Src\executor\Executor;
use Src\request\Request;

class ControllerExecutor implements Executor
{
    public function __construct(private readonly Container $container)
    {
    }

    /**
     * @throws ReflectionException
     * @throws CustomException
     */
    public function execute(string $className, string $methodName, array $args): mixed
    {
        if (class_exists($className) && method_exists($className, $methodName)){
            $reflection = new ReflectionClass($className);
            $method = $reflection->getMethod($methodName);
            $parameters = $method->getParameters();

            if (count($parameters) != 1 || count($args) != 1) {
                throw WrongParamsArgsException::get([$className, $methodName]);
            }

            $requestParamType = $parameters[0]->getType();
            $requestParamTypeName = $requestParamType->getName();

            if($requestParamTypeName !== Request::class || ! $args[0] instanceof Request){
                throw RequestTypeException::get([$className, $methodName]);
            }

            $instance = $this->container->get($className);
            return call_user_func_array([$instance, $methodName], $args);
        }
        throw ControllerNotFoundException::get([$className, $methodName]);
    }
}