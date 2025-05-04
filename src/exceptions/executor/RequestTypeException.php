<?php

namespace Src\exceptions\executor;

class RequestTypeException extends ExecutorException
{
    public static function get(array $args): ExecutorException
    {
        $className = $args[0] ?? '';
        $methodName = $args[1] ?? '';
        $msg = self::EXECUTOR_EXCEPTION . "Param or passed argument for classes {$className} method {$methodName} must be of type Request.";
        return new RequestTypeException($msg);
    }
}