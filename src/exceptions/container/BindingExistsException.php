<?php

namespace Src\exceptions\container;

use Src\exceptions\CustomException;

class BindingExistsException extends ContainerException
{
    public static function get(array $args): CustomException
    {
        $className = $args[0] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "Binding for class {$className} already exists.";
        return new BindingExistsException($msg);
    }
}