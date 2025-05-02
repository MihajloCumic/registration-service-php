<?php
declare(strict_types=1);
namespace Src\executor\impl;
use Exception;
use ReflectionClass;
use ReflectionException;
use Src\container\Container;
use Src\executor\Executor;
use Src\request\Request;

class ControllerExecutor implements Executor
{
    public function __construct(private readonly Container $container)
    {
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function execute(string $className, string $methodName, array $args): mixed
    {
        if (class_exists($className) && method_exists($className, $methodName)){
            $reflection = new ReflectionClass($className);
            $method = $reflection->getMethod($methodName);
            $parameters = $method->getParameters();

            if (count($parameters) != 1 || count($args) != 1) {
                throw new Exception("Wrong params or args in method: " . $methodName);
            }

            $requestParamType = $parameters[0]->getType();
            $requestParamTypeName = $requestParamType->getName();

            if($requestParamTypeName !== Request::class || ! $args[0] instanceof Request){
                throw new Exception("Param or arg must be of type Request.");
            }

            $instance = $this->container->get($className);
            return call_user_func_array([$instance, $methodName], $args);
        }
        throw new Exception("No controller: " . $className . " or controller method: " . $methodName . " found.");

    }
}