<?php

namespace Src\exceptions\executor;

use Src\exceptions\CustomException;

class WrongParamsArgsException extends ExecutorException
{
    public static function get(array $args): CustomException
    {
        $className = $args[0] ?? '';
        $methodName = $args[1] ?? '';
        $msg = self::EXECUTOR_EXCEPTION . "Parameters and passed arguments do not match in classes {$className} method {$methodName}";
        return new WrongParamsArgsException($msg);
    }
}