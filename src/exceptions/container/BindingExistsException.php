<?php

namespace Src\exceptions\container;

class BindingExistsException extends ContainerException
{
    public static function get(array $args): ContainerException
    {
        $className = $args[0] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "Binding for class {$className} already exists.";
        return new BindingExistsException($msg);
    }
}