<?php

namespace Src\exceptions\executor;

use Src\exceptions\CustomException;

class ControllerNotFoundException extends ExecutorException
{
    public static function get(array $args): CustomException
    {
        $controllerName = $args[0] ?? '';
        $methodName = $args[1] ?? '';
        $msg = self::EXECUTOR_EXCEPTION . "Controller {$controllerName} or its method {$methodName} not found.";
        return new ControllerNotFoundException($msg);
    }
}