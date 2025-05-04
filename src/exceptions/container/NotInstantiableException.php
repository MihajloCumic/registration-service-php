<?php

namespace Src\exceptions\container;

use Src\exceptions\CustomException;

class NotInstantiableException extends ContainerException
{
    public static function get(array $args): CustomException
    {
        $className = $args[0] ?? '';
        $msg = self::CONTAINER_EXCEPTION . "Class {$className} is not instantiable.";
        return new NotInstantiableException($msg);
    }
}