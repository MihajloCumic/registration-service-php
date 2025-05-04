<?php

namespace Src\exceptions\container;

class NotInstantiableException extends ContainerException
{
    public static function get(array $args): ContainerException
    {
        $className = $args[0] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "Class {$className} is not instantiable.";
        return new NotInstantiableException($msg);
    }
}