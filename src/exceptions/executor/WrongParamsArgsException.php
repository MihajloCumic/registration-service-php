<?php

namespace Src\exceptions\executor;

class WrongParamsArgsException extends ExecutorException
{
    public static function get(array $args): ExecutorException
    {
        $className = $args[0] ?? '';
        $methodName = $args[1] ?? '';
        $msg = self::EXECUTOR_EXCEPTION . "Parameters and passed arguments do not match in classes ${$className} method ${methodName}";
        return new WrongParamsArgsException($msg);
    }
}