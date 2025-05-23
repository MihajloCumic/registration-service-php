<?php

namespace Src\exceptions\container;

use Src\exceptions\CustomException;

class NoTypeException extends ContainerException
{
    public static function get(array $args): CustomException
    {
        $className = $args[0] ?? '';
        $paramName = $args[1] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "No type hint was declared in constructor of class {$className} for param {$paramName}";
        return new NoTypeException($msg);
    }
}