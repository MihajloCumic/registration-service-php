<?php

namespace Src\exceptions\container;

class UnionIntersectionException extends ContainerException
{
    public static function get(array $args): ContainerException
    {
        $className = $args[0] ?? '';
        $paramName = $args[1] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "Union or Intersection not supported, param {$paramName} in class {$className}";
        return new UnionIntersectionException($msg);
    }
}